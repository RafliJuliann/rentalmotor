<!DOCTYPE html>
<html>

<style>
    body {
        font-family: Arial, sans-serif; 
        background-image: url(sewamotor.jpg);
        background-repeat: no-repeat;
        background-size: cover;
    }
    .a { 
        display: flex;
        flex-direction: column;
        text-align: center;
        align-items: center;
        justify-content: center;
        height: 90vh;
        color: #f5deb3;
    }
        
    .e {
        margin: 10px;
        padding: 15px;
    }
        
    ::placeholder{
        color: #333;
        font-weight: bold;
    }

    label { 
        margin-bottom: 5px;
        font-weight: bold;
    }

    input[type="text"], input[type="number"], select { 
        width: 200px;
        padding: 8px;
        margin-top: 5px;
        border: 1px solid #ccc;
        border-radius: 4px;
    }

    input[type="submit"] { 
        background-color: #4CAF50;
        color: white;
        border: none;
        padding: 10px 20px;
        text-decoration: none;
        margin: 20px 2px;
        cursor: pointer;
        border-radius: 4px;
        font-size: 16px;
    }

    input[type="submit"]:hover { 
        background-color: #45a049;
    }

    .results {
        border: 2px solid #ccc;
        border-radius: 4px;
    }
</style>
<body>
<div class="a">
    <h1>Rental Motor</h1>
    <form method="POST" action="">
        <div class="b">
        <label for="nama">Nama Pelanggan:</label >
        <input type="text" name="nama" id="nama" placeholder="(Masukan nama)">
        </div>
        <div class="c">
        <label for="motor">Jenis Motor:</label>
        <select name="motor" id="motor">
            <option value="mio">Yamaha Mio</option>
            <option value="beat">Honda Beat</option>
            <option value="nmax">Yamaha NMAX</option>
            <option value="vario">Honda Vario</option>
        </select>
        <div class="d">
            <label for="lama_rental">Lama Waktu Rental:</label>
            <input type="number" name="lama_rental" id="lama_rental" min="1" placeholder="(Per-Hari)">
        </div>
    <br>
    <input type="submit" value="Hitung Total" >
</form>
</div>
</body>
</html>
<div class="e <?php if (isset($_POST['nama'])) echo 'results'; ?>">
<?php
class RentalMotor {
    private $nama;
    private $motor;
    private $lama_rental;
    private $pajak = 10000;

    private $harga_motor = array(
        "mio" => 50000,
        "beat" => 60000,
        "nmax" => 80000,
        "vario" => 70000
    );

    public function __construct($nama, $motor, $lama_rental) {
        $this->nama = $nama;
        $this->motor = $motor;
        $this->lama_rental = $lama_rental;
    }

    public function getHargaPerHari() {
        return $this->harga_motor[$this->motor];
    }

    public function getTotalHarga() {
        $harga_per_hari = $this->getHargaPerHari();
        $total_harga = $harga_per_hari * $this->lama_rental + $this->pajak;
        
        $nama_member = array("Fadhlan", "Bintang", "Mumtaz");
        if (in_array($this->nama, $nama_member)) {
            $diskon = $total_harga * 0.05;
            $total_harga -= $diskon;
        }

        return $total_harga;
    }
}

if (isset($_POST['nama']) && isset($_POST['motor']) && isset($_POST['lama_rental'])) {
    $nama = $_POST['nama'];
    $motor = $_POST['motor'];
    $lama_rental = $_POST['lama_rental'];
    $rental = new RentalMotor($nama, $motor, $lama_rental);

    $nama_member = array("Fadhlan", "Bintang", "Mumtaz");
    if (in_array($nama, $nama_member)) {
        echo "Anda berstatus sebagai Member mendapatkan diskon 5%<br>";
    }

    echo "Jenis Motor yang di-rental: " . ucfirst($motor) . " Waktu Rental: " . $lama_rental . " hari<br>";
    echo "Harga rental per-harinya: Rp. " . number_format($rental->getHargaPerHari(), 2, ',', '.') . "<br>";
    $total_harga = $rental->getTotalHarga();
    echo "Total yang harus dibayarkan: Rp. " . number_format($total_harga, 2, ',', '.');
}
?>
</div>
</div>