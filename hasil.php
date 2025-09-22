<?php
require 'connect.php';
require 'class/saw.php';

// Gunakan id_jenisbarang dummy
$dummyJenisBarang = 1; // bisa diganti sesuai kebutuhan
$saw = new saw();
$saw->setconfig($konek, $dummyJenisBarang);

// Jika tidak ada data, kita buat data dummy sementara
$kriteria = $saw->getKriteria();
$alternatives = $saw->getAlternative();

// Jika kriteria kosong, buat dummy
if (empty($kriteria)) {
    $kriteria = [
        ['id_kriteria'=>1,'namaKriteria'=>'Harga','sifat'=>'cost'],
        ['id_kriteria'=>2,'namaKriteria'=>'Kualitas','sifat'=>'benefit'],
        ['id_kriteria'=>3,'namaKriteria'=>'Layanan','sifat'=>'benefit']
    ];
}

// Jika alternatif kosong, buat dummy
if (empty($alternatives)) {
    $alternatives = [
        ['id_supplier'=>1,'namaSupplier'=>'Supplier A'],
        ['id_supplier'=>2,'namaSupplier'=>'Supplier B'],
        ['id_supplier'=>3,'namaSupplier'=>'Supplier C']
    ];
}

// Dummy nilai matriks
$nilaiDummy = [
    1 => [100, 80, 90],
    2 => [90, 85, 80],
    3 => [95, 70, 85]
];

// Tampilkan Matriks Keputusan
echo "<h3>Matriks Keputusan</h3><table border='1' cellpadding='5'><tr><th>Alternative</th>";
foreach($kriteria as $k) echo "<th>{$k['namaKriteria']}</th>";
echo "</tr>";
foreach($alternatives as $alt){
    echo "<tr><td>{$alt['namaSupplier']}</td>";
    $id = $alt['id_supplier'];
    foreach($nilaiDummy[$id] as $nilai){
        echo "<td>$nilai</td>";
    }
    echo "</tr>";
}
echo "</table><br>";

// Normalisasi
echo "<h3>Normalisasi Matriks Keputusan</h3><table border='1' cellpadding='5'><tr><th>Alternative</th>";
foreach($kriteria as $k) echo "<th>{$k['namaKriteria']}</th>";
echo "</tr>";
$normalisasi = [];
foreach($alternatives as $alt){
    echo "<tr><td>{$alt['namaSupplier']}</td>";
    $id = $alt['id_supplier'];
    $no=0;
    foreach($nilaiDummy[$id] as $nilai){
        $arrayNilai = array_column($nilaiDummy, $no);
        $sifat = strtolower($kriteria[$no]['sifat']);
        if($sifat=='benefit') $norm = round($nilai/max($arrayNilai),3);
        else $norm = round(min($arrayNilai)/$nilai,3);
        echo "<td>$norm</td>";
        $normalisasi[$id][$no] = $norm * 0.3; // contoh bobot 0.3
        $no++;
    }
    echo "</tr>";
}
echo "</table><br>";

// Perangkingan
echo "<h3>Perangkingan</h3><table border='1' cellpadding='5'><tr><th>Alternative</th><th>Hasil</th></tr>";
foreach($alternatives as $alt){
    $id = $alt['id_supplier'];
    $total = array_sum($normalisasi[$id]);
    echo "<tr><td>{$alt['namaSupplier']}</td><td>".round($total,3)."</td></tr>";
}
echo "</table><br>";

// Rekomendasi
$max = 0;
$best = '';
foreach($alternatives as $alt){
    $id = $alt['id_supplier'];
    $total = array_sum($normalisasi[$id]);
    if($total > $max){
        $max = $total;
        $best = $alt['namaSupplier'];
    }
}
echo "<h3>Hasil Rekomendasi</h3>";
echo "<p>Rekomendasi supplier terbaik: <b>$best</b> dengan nilai <b>".round($max,3)."</b></p>";
?>
