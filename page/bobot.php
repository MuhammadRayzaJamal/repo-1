<?php
require './connect.php';

// Daftar nilai bobot
$listWeight = array(
    array("nama"=>"0 - Sangat Rendah","nilai"=>0),
    array("nama"=>"0.25 - Rendah","nilai"=>0.25),
    array("nama"=>"0.5 - Tengah","nilai"=>0.5),
    array("nama"=>"0.75 - Tinggi","nilai"=>0.75),
    array("nama"=>"1 - Sangat Tinggi","nilai"=>1),
);
?>
<!-- judul -->
<div class="panel">
    <div class="panel-middle" id="judul">
        <img src="asset/image/bobot.svg">
        <div id="judul-text">
            <h2 class="text-green">BOBOT</h2>
            Halaman Administrator Bobot Kriteria
        </div>
    </div>
</div>

<div class="row">
    <div class="col-4">
        <div class="panel">
            <?php
            $aksi = @htmlspecialchars($_GET['aksi']);
            if ($aksi=='ubah'){
                include 'ubahbobot2.php';
            } elseif ($aksi=='lihat'){
                include 'lihatbobot.php';
            } else{
                include 'tambahbobot2.php';
            }
            ?>
        </div>
    </div>

    <div class="col-8">
        <div class="panel">
            <div class="panel-top">
                <b class="text-green">Daftar Bobot</b>
            </div>
            <div class="panel-middle">
                <div class="table-responsive">
                    <table>
                        <thead>
                            <tr><th>No</th><th>Nama Barang</th><th>Aksi</th></tr>
                        </thead>
                        <tbody>
                        <?php
                        $query = "SELECT bobot_kriteria.id_jenisbarang AS idbarangbobot, jenis_barang.namaBarang AS namaBarang 
                                  FROM bobot_kriteria 
                                  INNER JOIN jenis_barang ON bobot_kriteria.id_jenisbarang=jenis_barang.id_jenisbarang 
                                  GROUP BY idbarangbobot 
                                  ORDER BY idbarangbobot ASC";
                        $execute = $konek->query($query);
                        if ($execute->num_rows > 0){
                            $no = 1;
                            while($data = $execute->fetch_array(MYSQLI_ASSOC)){
                                echo "<tr id='data'>
                                        <td>$no</td>
                                        <td>$data[namaBarang]</td>
                                        <td>
                                            <div class='norebuttom'>
                                                <a class='btn btn-green' href='./?page=bobot&aksi=lihat&id=".$data['idbarangbobot']."'><i class='fa fa-eye'></i></a>
                                                <a class='btn btn-light-green' href='./?page=bobot&aksi=ubah&id=".$data['idbarangbobot']."'><i class='fa fa-pencil-alt'></i></a>
                                                <a class='btn btn-yellow' data-a='".$data['namaBarang']."' id='hapus' href='./proses/proseshapus.php/?op=bobot&id=".$data['idbarangbobot']."'><i class='fa fa-trash-alt'></i></a>
                                            </div>
                                        </td>
                                      </tr>";
                                $no++;
                            }
                        } else {
                            echo "<tr><td class='text-center text-green' colspan='3'><b>Kosong</b></td></tr>";
                        }
                        ?>
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="panel-bottom"></div>
        </div>
    </div>
</div>
