<?php
class PraktikumModel
{
/**
 * function get untuk seluruh data dari database
 */
    public function get()
    {
        $sql = "SELECT * FROM praktikum";
        $query = koneksi()->query($sql);
        $hasil = [];
        while ($data = $query->fetch_assoc()) {
            $hasil[] = $data;
        }
        return $hasil;
    }
/**
 * function index untuk mengatur tampilan awal
 */
    public function index()
    {
        $data = $this->get();

        extract($data);
        require_once("View/praktikum/index.php");
    }
/**
 * function prosesStore untuk input data praktikum
 * @param String $nama berisi nama praktikum
 * @param String $tahun berisi tahun praktikum
 */
    public function prosesStore($nama, $tahun)
    {
        $sql = "INSERT INTO praktikum(nama, tahun) VALUES('$nama', '$tahun')";
        return koneksi()->query($sql);
    }
/**
 * function storeUpdate untuk mengubah data di database
 * @param String $nama berisi data nama 
 * @param String $tahun berisi data tahun
 * @param Integer $id berisi id dari suatu data di database 
 */
    public function storeUpdate($nama, $tahun, $id)
    {
        $sql = "UPDATE praktikum SET nama='$nama', tahun='$tahun' WHERE id=$id";
        return koneksi()->query($sql);
    }
/**
 * function prosesAktifkan untuk mengubah salah satu field di database
 * @param Integer $id berisi id dari suatu data di database 
 */
    public function prosesAktifkan($id)
    {
        koneksi()->query(("UPDATE praktikum SET status=0")); // merubah status praktikum yang aktif menjadi tidak aktif

        $sql = "UPDATE praktikum SET status=1 WHERE id=$id";
        return koneksi()->query($sql);
    }
/**
 * function prosesNonAktifkan untuk mengubah salah satu field di database
 * @param Integer $id berisi id dari suatu data di database 
 */
    public function prosesNonAktifkan($id)
    {
        $sql = "UPDATE praktikum SET status=0 WHERE id=$id";
        return koneksi()->query($sql);
    }
/**
 * function create untuk mengatur tampilan tambah data 
 */
    public function create()
    {
    require_once("View/praktikum/create.php");
    }
/**
 * function store untuk memproses data untuk ditambahkan
 * fungsi ini membutuhkan data nama, tahun dengan metode http request POST
 */
    public function store()
    {
        $nama = $_POST['nama'];
        $tahun = $_POST['tahun'];
        if ($this->prosesStore($nama, $tahun)) {
            header("location:index.php?page=praktikum&aksi=view&pesan=Berhasil Menambah Data");
        } else{
            header("location:index.php?page=praktikum&aksi=create&pesan=Gagal Menambah Data");
        }
    }
/**
 * function getById untuk mengambil satu data dari database
 * @param Integer $id berisi id dari suatub data di database
 */
    public function getById($id)
    {
        $sql = "SELECT * FROM praktikum  WHERE id=$id";
        $query = koneksi()->query($sql);
        return $query->fetch_assoc();
    }
/**
 * fuction update untuk memproses data untuk di update
 * fungsi ini membutuhkan data nama, tahun dengan metode http request POST
 */
    public function update()
    {
        $id = $_POST['id'];
        $nama = $_POST['nama'];
        $tahun = $_POST['tahun'];
        if ($this->storeUpdate($nama, $tahun, $id)) {
            header("location:index.php?page=praktikum&aksi=view&pesan=Berhasil Mengubah Data");
        } else{
            header("location:index.php?page=praktikum&aksi=edit&pesan=Gagal Mengubah Data");
        }
    }
/**
 * function aktifkan untuk memproses update salah satu field data
 * fungsi ini membutuhkan data id dengan metode http request GET
 */
    public function aktifkan(){
    $id = $_GET['id'];
    if ($this->prosesAktifkan($id)) {
        header("location:index.php?page=praktikum&aksi=view&pesan=Berhasil Men-Aktifkan Data");
        } else{
        header("location:index.php?page=praktikum&aksi=edit&pesan=Gagal Men-Aktifkan Data");
    }
}
/**
 * function aktifkan untuk memproses update salah satu field data
 * fungsi ini membutuhkan data id dengan metode http request GET
 */
    public function nonAktifkan()
    {$id = $_GET['id'];
    if ($this->prosesNonAktifkan($id)) {
        header("location:index.php?page=praktikum&aksi=view&pesan=Berhasil non-Aktifkan Data");
        } else{
        header("location:index.php?page=praktikum&aksi=edit&pesan=Gagal non-Aktifkan Data");
    }
}
/**
 * function ini untuk menampilkan halaman edit
 * juga mengambil salah satu data dari database
 * function ini membutuhkan data id dengan metode http request GET
 */
    public function edit()
    {
        $id = $_GET['id'];
        $data = $this->getById($id);

        extract($data);
        require_once("View/praktikum/edit.php");
    }
}

//$tes = new PraktikumModel();
//var_export($tes -> getById(1));
//var_export($tes -> storeUpdate("tesNama", "2021-02-22",3));
//var_export($tes -> prosesAktifkan(1));
//var_export($tes -> prosesNonAktifkan(1));
//die();