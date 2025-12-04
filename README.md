# Lab10Web - OOP PHP

NAMA: SYAFIRA LUTHFI AZZAHRA

KELAS: TI.24.A.4

NIM: 312410353

MATA KULIAH: PEMROGRAMAN WEB 1

# mobil.php

```php
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
```

Program `mobil.php` ini dibuat untuk menunjukkan cara kerja OOP (Object-Oriented Programming) di dalam PHP melalui sebuah class bernama Mobil. Class ini memiliki beberapa bagian penting, yaitu:
* Properti private seperti `$warna`, `$merk`, dan `$harga` yang menyimpan data utama mobil.
* Constructor (`__construct`), yang memberikan nilai default pada objek ketika dibuat, yaitu warna Biru, merk BMW, dan harga 10.000.000.
* Method-method penting, seperti `gantiWarna()` untuk mengganti warna mobil, `tampilWarna()` untuk menampilkan warna saat ini, dan `info()` untuk menampilkan seluruh informasi mobil dalam format rapi.

Setelah class dibuat, program kemudian membuat dua objek mobil, yaitu:
* Objek `$a` → menggunakan nilai default (Biru, BMW, 10 juta).
* Objek `$b` → menggunakan nilai baru (Hijau, Toyota, 150 juta).

Pada bagian HTML, program menampilkan hasil dari objek tersebut, yaitu:
* Warna awal mobil pertama.
* Warna mobil pertama setelah diganti menjadi Merah menggunakan method `gantiWarna()`.
* Warna mobil kedua dan informasi lengkapnya yang dihasilkan oleh method `info()`.

<img width="1919" height="650" alt="image" src="https://github.com/user-attachments/assets/495ee134-2045-4ce3-a82f-97c1af8cc069" />

# form.php

```php
<?php
class Form {
    private $fields = array();
    private $action;
    private $submit = "Submit";
    private $jumField = 0;

    public function __construct($action, $submit) {
        $this->action = $action;
        $this->submit = $submit;
    }

    public function addField($name, $label) {
        $this->fields[$this->jumField]['name']  = $name;
        $this->fields[$this->jumField]['label'] = $label;
        $this->jumField++;
    }

    public function displayForm() {
        echo "<form action='".$this->action."' method='POST'>";
        echo "<table border='0' width='100%'>";
        for ($i = 0; $i < count($this->fields); $i++) {
            echo "<tr>
                    <td align='right'>".$this->fields[$i]['label']."</td>
                    <td><input type='text' name='".$this->fields[$i]['name']."'></td>
                  </tr>";
        }
        echo "<tr><td colspan='2'><input type='submit' value='".$this->submit."'></td></tr>";
        echo "</table>";
        echo "</form>";
    }
}
?>
```

File `form.php` ini berfungsi sebagai class library yang digunakan untuk membuat form input secara dinamis menggunakan konsep OOP di PHP. Class ini dibuat agar pembuatan form lebih mudah, rapi, dan modular. Di dalam class Form terdapat beberapa bagian utama, yaitu:
* Properti `$fields` yang digunakan untuk menyimpan daftar field input yang akan dibuat.
* Properti `$action` yang menentukan ke mana form akan dikirim ketika disubmit.
* Properti `$submit` yang menyimpan teks dari tombol submit.
* Properti `$jumField` sebagai penghitung jumlah field yang sudah ditambahkan.

Class ini memiliki constructor yang berfungsi untuk mengatur nilai awal seperti action form dan label tombol submit. Selain itu, tersedia method `addField()` yang digunakan untuk menambahkan field baru ke dalam form, dengan mencatat nama dan label dari input tersebut. Method yang paling penting adalah `displayForm()`, yang bertugas untuk:
* Membuat tag `<form>` lengkap dengan method POST.
* Menghasilkan tabel HTML berisi seluruh field input yang sudah ditambahkan.
* Membuat row terakhir yang berisi tombol submit sesuai teks yang diberikan.

# form_input.php

```php
<?php
include "form.php";
?>
<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="utf-8">
  <title>Form Input - Praktikum 10</title>
  <meta name="viewport" content="width=device-width,initial-scale=1">
  <link rel="stylesheet" href="style.css">
</head>
<body>
  <div class="container">
    <div class="card">
      <h2>Silahkan isi form berikut ini :</h2>

      <?php
      $form = new Form("", "Kirim");
      $form->addField("nim", "NIM");
      $form->addField("nama", "Nama");
      $form->addField("alamat", "Alamat");

      $form->displayForm();
      ?>

      <?php if ($_SERVER['REQUEST_METHOD'] == "POST"): ?>
        <div class="submitted">
          <h3>Data yang diterima:</h3>
          <ul>
            <?php foreach ($_POST as $k => $v): ?>
              <li><strong><?php echo htmlspecialchars($k) ?></strong>: <?php echo nl2br(htmlspecialchars($v)) ?></li>
            <?php endforeach; ?>
          </ul>
        </div>
      <?php endif; ?>

    </div>
  </div>
</body>
</html>
```

File `form_input.php` ini berfungsi sebagai halaman utama yang menampilkan form yang dibuat dari class `Form` serta menampilkan data yang sudah dikirimkan oleh pengguna. Pada bagian atas file, dilakukan include terhadap `form.php`, sehingga class Form dapat digunakan di halaman ini tanpa harus menuliskan ulang kode form. Program kemudian membuat struktur HTML lengkap dengan CSS agar tampilan lebih rapi. Di dalam bagian utama halaman, sebuah objek Form dibuat dengan teks tombol submit “Kirim”, dan ditambahkan beberapa field ke dalamnya seperti:
* NIM sebagai input pertama,
* Nama sebagai input kedua,
* Alamat sebagai input ketiga.

Setelah field ditambahkan, method `displayForm()` dipanggil untuk menampilkan seluruh form yang sudah dirancang sebelumnya. Pada bagian bawah program terdapat kondisi pengecekan menggunakan `$_SERVER['REQUEST_METHOD']`, yaitu untuk:
* Mengecek apakah user sudah menekan tombol submit,
* Jika iya, maka program akan menampilkan data yang dikirim pengguna,
* Data ditampilkan dalam bentuk list menggunakan `<ul>` agar lebih rapi.

Semua data yang tampil juga diamankan menggunakan `htmlspecialchars()` agar tidak terjadi input berbahaya dari user.

<img width="1919" height="659" alt="image" src="https://github.com/user-attachments/assets/821d7d7f-a6d5-43d3-bf3f-b0d7198348fc" />

# database.php

```php
<?php
class Database {
    private $host     = "localhost";
    private $user     = "root";
    private $password = "";
    private $db_name  = "lab10web";
    public  $conn;

    public function __construct() {
        $this->conn = new mysqli($this->host, $this->user, $this->password, $this->db_name);

        if ($this->conn->connect_error) {
            die("Koneksi gagal: " . $this->conn->connect_error);
        }
    }

    public function get($table) {
        $sql = "SELECT * FROM $table";
        return $this->conn->query($sql);
    }

    public function insert($table, $data) {
        $columns = implode(",", array_keys($data));
        $values  = "'" . implode("','", array_values($data)) . "'";
        $sql = "INSERT INTO $table ($columns) VALUES ($values)";
        return $this->conn->query($sql);
    }
}
?>
```

File `database.php` ini berisi class bernama Database yang digunakan untuk menangani koneksi dan operasi dasar terhadap database MySQL. Class ini dirancang agar proses pengelolaan data lebih mudah dan modular, sehingga program lain cukup membuat objek dari class ini tanpa harus menulis ulang kode koneksi database. Di dalam class terdapat beberapa properti penting seperti:
* `$host`, yang menyimpan alamat server database (default: `localhost`),
* `$user`, sebagai username MySQL (default: `root`),
* `$password`, yaitu password MySQL (default: kosong),
* `$db_name`, yaitu nama database yang digunakan (`lab10web`),
* `$conn`, yaitu koneksi yang akan digunakan untuk menjalankan query.

Saat objek Database dibuat, constructor `__construct()` dijalankan untuk:
* Membuat koneksi ke MySQL menggunakan `mysqli`,
* Mengecek apakah koneksi berhasil,
* Jika gagal, program akan dihentikan dan menampilkan pesan *"Koneksi gagal"*.

Class ini juga menyediakan dua method utama yaitu:
* `get($table)`, yang digunakan untuk mengambil semua data dari tabel tertentu dengan menjalankan query `SELECT * FROM nama_tabel`.
* `insert($table, $data)`, yang digunakan untuk menambahkan data baru ke tabel. Method ini akan:
  * Mengambil nama kolom dari array `$data`,
  * Mengambil nilai dari array tersebut,
  * Menggabungkannya menjadi query INSERT yang siap dijalankan.

Dengan adanya class Database ini, program lain bisa lebih mudah melakukan operasi database tanpa menulis ulang kode koneksi atau query secara manual. Cukup memanggil method yang tersedia, dan semua proses database dapat dilakukan secara lebih terorganisir.

# Hasil akhir

<img width="1293" height="897" alt="image" src="https://github.com/user-attachments/assets/7b53b853-864b-4a05-8bf0-40162645a0fd" />
