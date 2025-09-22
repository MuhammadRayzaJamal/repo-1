<?php
$listWeight = array(
    array("nama"=>"0 - Sangat Rendah","nilai"=>0),
    array("nama"=>"0.25 - Rendah","nilai"=>0.25),
    array("nama"=>"0.5 - Tengah","nilai"=>0.5),
    array("nama"=>"0.75 - Tinggi","nilai"=>0.75),
    array("nama"=>"1 - Sangat Tinggi","nilai"=>1),
);

$id = htmlspecialchars(@$_GET['id']);
$querylihat = "SELECT id_jenisbarang,bobot,id_bobotkriteria,kriteria.namaKriteria AS namaKriteria 
               FROM bobot_kriteria 
               INNER JOIN kriteria USING(id_kriteria) 
               WHERE id_jenisbarang='$id'";
$execute2 = $konek->query($querylihat);
if ($execute2->num_rows == 0){
    header('location:./?page=bobot');
}

// Proses simpan bobot
if(isset($_POST['simpanBobot'])){
    $idBobot = $_POST['id'];   // array id_bobotkriteria
    $nilaiBobot = $_POST['bobot']; // array nilai baru

    foreach($idBobot as $key => $idb){
        $nilai = $konek->real_escape_string($nilaiBobot[$key]);
        $konek->query("UPDATE bobot_kriteria SET bobot='$nilai' WHERE id_bobotkriteria='$idb'");
    }

    // Hitung ulang SAW otomatis
    include 'saw.php'; // pastikan class saw ada
    $saw = new saw();
    $saw->setconfig($konek, $id); // $id = id_jenisbarang
    $alternatives = $saw->getAlternative();

    foreach($alternatives as $alt){
        $nilaiMatriks = $saw->getNilaiMatriks($alt['id_supplier']);
        $total = 0;
        foreach($nilaiMatriks as $nm){
            $arrayNilai = $saw->getArrayNilai($nm['id_kriteria']);
            $normal = $saw->normalisasi($arrayNilai, $nm['sifat'], $nm['nilai']);
            $bobot = $saw->getBobot($nm['id_kriteria']);
            $total += $normal * $bobot;
        }
        $saw->simpanHasil($alt['id_supplier'], $total);
    }

    echo "<script>alert('Bobot berhasil disimpan dan hasil SAW diperbarui'); window.location='?page=bobot';</script>";
}
?>

<!-- judul -->
<div class="panel-top">
    <b class="text-green">Detail data</b>
</div>
<form method="POST">
    <div class="panel-middle">
        <div class="group-input">
            <?php
            $query="SELECT namaBarang FROM jenis_barang WHERE id_jenisbarang='$id'";
            $execute=$konek->query($query);
            $data=$execute->fetch_array(MYSQLI_ASSOC);
            ?>
            <div class="group-input">
                <label for="jenisbarang">Jenis Barang</label>
                <input class="form-custom" value="<?php echo $data['namaBarang'];?>" disabled type="text">
            </div>
        </div>

        <?php
        $execute2=$konek->query($querylihat);
        while($data=$execute2->fetch_array(MYSQLI_ASSOC)){
            echo "<div class=\"group-input\">
                    <label for=\"$data[namaKriteria]\">$data[namaKriteria]</label>
                    <input type='hidden' value=\"$data[id_bobotkriteria]\" name=\"id[]\">
                    <select class=\"form-custom\" required name=\"bobot[]\" id=\"$data[namaKriteria]\">";
                foreach ($listWeight as $key) {
                    $selected = ($key['nilai']==$data['bobot']) ? "selected" : "";
                    echo "<option $selected value=\"$key[nilai]\">$key[nama]</option>";
                }
            echo "</select>
            </div>";
        }
        ?>
    </div>
    <div class="panel-bottom">
        <button type="submit" name="simpanBobot" class="btn btn-green">Simpan Bobot</button>
    </div>
</form>
