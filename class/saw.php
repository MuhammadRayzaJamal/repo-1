<?php
class saw {
    private $konek;
    private $idCookie;

    public function setconfig($konek, $idCookie){
        $this->konek = $konek;
        $this->idCookie = $idCookie;
    }

    public function getConnect(){
        return $this->konek;
    }

    // Ambil kriteria
    public function getKriteria(){
        $data = [];
        $query = "SELECT id_kriteria, namaKriteria, sifat FROM kriteria ORDER BY id_kriteria ASC";
        $execute = $this->getConnect()->query($query);
        while ($row = $execute->fetch_assoc()) {
            $data[] = [
                "id_kriteria" => $row['id_kriteria'],
                "namaKriteria" => $row['namaKriteria'],
                "sifat" => strtolower($row['sifat'])
            ];
        }
        return $data;
    }

    // Ambil alternatif (supplier)
    public function getAlternative(){
        $data = [];
        $query = "SELECT s.id_supplier, s.namaSupplier
                  FROM supplier s
                  INNER JOIN nilai_supplier ns USING(id_supplier)
                  WHERE ns.id_jenisbarang='$this->idCookie'
                  GROUP BY ns.id_supplier";
        $execute = $this->getConnect()->query($query);
        while ($row = $execute->fetch_assoc()) {
            $data[] = [
                "id_supplier" => $row['id_supplier'],
                "namaSupplier" => $row['namaSupplier']
            ];
        }
        return $data;
    }

    // Ambil nilai matriks untuk satu supplier
    public function getNilaiMatriks($id_supplier){
        $data = [];
        $query = "SELECT k.id_kriteria, k.sifat, nk.nilai AS nilai
                  FROM kriteria k
                  LEFT JOIN nilai_supplier ns 
                  ON ns.id_kriteria = k.id_kriteria 
                  AND ns.id_supplier='$id_supplier' 
                  AND ns.id_jenisbarang='$this->idCookie'
                  LEFT JOIN nilai_kriteria nk 
                  ON nk.id_nilaikriteria = ns.id_nilaikriteria
                  ORDER BY k.id_kriteria ASC";
        $execute = $this->getConnect()->query($query);
        while ($row = $execute->fetch_assoc()) {
            $data[] = [
                "id_kriteria" => $row['id_kriteria'],
                "nilai" => isset($row['nilai']) ? floatval($row['nilai']) : 0,
                "sifat" => strtolower($row['sifat'])
            ];
        }
        return $data;
    }

    // Ambil semua nilai untuk kriteria tertentu
    public function getArrayNilai($id_kriteria){
        $data = [];
        $query = "SELECT nk.nilai AS nilai
                  FROM nilai_supplier ns
                  LEFT JOIN nilai_kriteria nk 
                  ON nk.id_nilaikriteria = ns.id_nilaikriteria
                  WHERE ns.id_kriteria='$id_kriteria' AND ns.id_jenisbarang='$this->idCookie'";
        $execute = $this->getConnect()->query($query);
        while ($row = $execute->fetch_assoc()) {
            $data[] = floatval($row['nilai']);
        }
        return $data;
    }

    // Normalisasi
    public function normalisasi($array, $sifat, $nilai){
        $sifat = strtolower($sifat);
        if (empty($array) || $nilai == 0) return 0;

        if ($sifat == 'benefit'){
            return round($nilai / max($array), 3);
        } elseif ($sifat == 'cost'){
            return round(min($array) / $nilai, 3);
        } else {
            return 0;
        }
    }

    // Ambil bobot kriteria
    public function getBobot($id_kriteria){
        $query = "SELECT bobot FROM bobot_kriteria WHERE id_jenisbarang='$this->idCookie' AND id_kriteria='$id_kriteria'";
        $row = $this->getConnect()->query($query)->fetch_assoc();
        return isset($row['bobot']) ? floatval($row['bobot']) : 0;
    }

    // Simpan hasil
    public function simpanHasil($id_supplier, $hasil){
        $queryCek = "SELECT id_hasil FROM hasil WHERE id_supplier='$id_supplier' AND id_jenisbarang='$this->idCookie'";
        $execute = $this->getConnect()->query($queryCek);
        if ($execute->num_rows > 0){
            $querySimpan = "UPDATE hasil SET hasil='$hasil' WHERE id_supplier='$id_supplier' AND id_jenisbarang='$this->idCookie'";
        } else {
            $querySimpan = "INSERT INTO hasil(hasil,id_supplier,id_jenisbarang) VALUES ('$hasil','$id_supplier','$this->idCookie')";
        }
        $this->getConnect()->query($querySimpan);
    }

    // Menampilkan Matriks Keputusan
    public function tampilMatriks(){
        $kriteria = $this->getKriteria();
        $alternatives = $this->getAlternative();

        echo "<h3>Matriks Keputusan</h3><table border='1' cellpadding='5'><tr><th>Alternatif</th>";
        foreach($kriteria as $k) echo "<th>{$k['namaKriteria']}</th>";
        echo "</tr>";

        foreach($alternatives as $alt){
            echo "<tr><td>{$alt['namaSupplier']}</td>";
            $nilaiMatriks = $this->getNilaiMatriks($alt['id_supplier']);
            foreach($nilaiMatriks as $nm){
                $val = isset($nm['nilai']) ? floatval($nm['nilai']) : 0;
                echo "<td>$val</td>";
            }
            echo "</tr>";
        }
        echo "</table><br>";
    }

    // Tampilkan Normalisasi
    public function tampilNormalisasi(){
        $kriteria = $this->getKriteria();
        $alternatives = $this->getAlternative();

        echo "<h3>Normalisasi Matriks Keputusan</h3><table border='1' cellpadding='5'><tr><th>Alternatif</th>";
        foreach($kriteria as $k) echo "<th>{$k['namaKriteria']}</th>";
        echo "</tr>";

        foreach($alternatives as $alt){
            echo "<tr><td>{$alt['namaSupplier']}</td>";
            $nilaiMatriks = $this->getNilaiMatriks($alt['id_supplier']);
            foreach($nilaiMatriks as $nm){
                $arrayNilai = $this->getArrayNilai($nm['id_kriteria']);
                $normal = $this->normalisasi($arrayNilai, $nm['sifat'], $nm['nilai']);
                echo "<td>".round($normal,3)."</td>";
            }
            echo "</tr>";
        }
        echo "</table><br>";
    }

    // Perangkingan
    public function perangkingan(){
        $kriteria = $this->getKriteria();
        $alternatives = $this->getAlternative();

        echo "<h3>Perangkingan</h3><table border='1' cellpadding='5'><tr><th>Alternatif</th><th>Nilai Akhir</th></tr>";

        foreach($alternatives as $alt){
            $total = 0;
            $nilaiMatriks = $this->getNilaiMatriks($alt['id_supplier']);
            foreach($nilaiMatriks as $nm){
                $arrayNilai = $this->getArrayNilai($nm['id_kriteria']);
                $normal = $this->normalisasi($arrayNilai, $nm['sifat'], $nm['nilai']);
                $bobot = $this->getBobot($nm['id_kriteria']);
                $total += $normal * $bobot;
            }
            $this->simpanHasil($alt['id_supplier'], $total);
            echo "<tr><td>{$alt['namaSupplier']}</td><td>".round($total,3)."</td></tr>";
        }

        echo "</table><br>";
    }

    // Hasil rekomendasi
    public function getHasil(){
        $query = "SELECT h.hasil AS hasil, jb.namaBarang, s.namaSupplier
                  FROM hasil h
                  JOIN jenis_barang jb ON jb.id_jenisbarang = h.id_jenisbarang
                  JOIN supplier s ON s.id_supplier = h.id_supplier
                  WHERE h.hasil = (SELECT MAX(hasil) FROM hasil WHERE id_jenisbarang='$this->idCookie')";
        $execute = $this->getConnect()->query($query)->fetch_assoc();
        if($execute){
            echo "<h3>Hasil Rekomendasi</h3>";
            echo "<p>Rekomendasi pemilihan supplier <i>{$execute['namaSupplier']}</i> untuk barang <i>{$execute['namaBarang']}</i> dengan Nilai <b>".round($execute['hasil'],3)."</b></p>";
        } else {
            echo "<p>Belum ada data hasil.</p>";
        }
    }
}
?>
