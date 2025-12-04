<?php

class Mobil {
    private $warna;
    private $merk;
    private $harga;

    public function __construct($warna = "Biru", $merk = "BMW", $harga = "10000000") {
        $this->warna = $warna;
        $this->merk  = $merk;
        $this->harga = $harga;
    }

    public function gantiWarna($warnaBaru) {
        $this->warna = $warnaBaru;
    }

    public function tampilWarna() {
        return $this->warna;
    }

    public function info() {
        return "Merk: {$this->merk}, Warna: {$this->warna}, Harga: Rp " . number_format($this->harga, 0, ',', '.');
    }
}
$a = new Mobil();
$b = new Mobil("Hijau", "Toyota", 150000000);
?>
<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="utf-8">
  <title>Contoh Mobil</title>
  <meta name="viewport" content="width=device-width,initial-scale=1">
  <link rel="stylesheet" href="style.css">
</head>
<body>
  <div class="container">
    <div class="card">
      <h2>Contoh Class Mobil</h2>

      <p><strong>Mobil pertama</strong><br>
      Warna: <span class="info"><?php echo htmlspecialchars($a->tampilWarna()) ?></span></p>

      <?php $a->gantiWarna("Merah"); ?>

      <p>Setelah ganti warna:<br>
      Warna: <span class="info"><?php echo htmlspecialchars($a->tampilWarna()) ?></span></p>

      <hr>

      <p><strong>Mobil kedua</strong><br>
      Warna: <span class="info"><?php echo htmlspecialchars($b->tampilWarna()) ?></span><br>
      Info: <span class="info"><?php echo htmlspecialchars($b->info()) ?></span></p>

    </div>
  </div>
</body>
</html>