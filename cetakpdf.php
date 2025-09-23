<?php
ini_set('display_errors',1);
error_reporting(E_ALL);

// Panggil library FPDF
require('./fpdf/fpdf.php');

// Koneksi database
$konek = new mysqli('localhost','root','','spksaw',3306);
if($konek->connect_error){
    die("Koneksi gagal: ".$konek->connect_error);
}

// Query data hasil penilaian
$sql = "SELECT 
            h.id_hasil, 
            s.namaSupplier AS nama_supplier, 
            jb.namaBarang AS nama_barang, 
            h.hasil
        FROM hasil h
        JOIN supplier s ON h.id_supplier = s.id_supplier
        JOIN jenis_barang jb ON h.id_jenisbarang = jb.id_jenisbarang
        ORDER BY h.hasil DESC";

$result = $konek->query($sql);
if(!$result){
    die("Query gagal: ".$konek->error);
}

// Buat PDF
$pdf = new FPDF();
$pdf->AddPage();
$pdf->SetFont('Arial','B',16);

// Judul PDF
$pdf->Cell(0,10,'HASIL PENILAIAN SUPPLIER',0,1,'C');
$pdf->Ln(5);

// Header tabel
$pdf->SetFont('Arial','B',12);
$pdf->Cell(10,8,'No',1);
$pdf->Cell(50,8,'Supplier',1);
$pdf->Cell(50,8,'Jenis Barang',1);
$pdf->Cell(30,8,'Hasil',1);
$pdf->Ln();

// Isi tabel
$pdf->SetFont('Arial','',12);
$no = 1;
if($result->num_rows > 0){
    while($row = $result->fetch_assoc()){
        $pdf->Cell(10,8,$no++,1);
        $pdf->Cell(50,8,$row['nama_supplier'],1);
        $pdf->Cell(50,8,$row['nama_barang'],1);
        $pdf->Cell(30,8,$row['hasil'],1);
        $pdf->Ln();
    }
}else{
    $pdf->Cell(0,8,'Tidak ada data',1,1,'C');
}

// Rekomendasi supplier terbaik
$result->data_seek(0);
$top = $result->fetch_assoc();
if($top){
    $pdf->Ln(10);
    $pdf->SetFont('Arial','B',14);
    $pdf->Cell(0,10,'Hasil Rekomendasi',0,1);
    $pdf->SetFont('Arial','',12);
    $pdf->MultiCell(0,8,'Rekomendasi supplier terbaik: '.$top['nama_supplier'].' dengan nilai '.$top['hasil']);
}

// Tutup koneksi
$konek->close();

// Tampilkan PDF
$pdf->Output('I','Hasil_Penilaian.pdf');
?>
