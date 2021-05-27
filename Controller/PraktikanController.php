<?php 
class PraktikanController
{
    private $model;
    /** Funcction ini adalah konstruktor untuk menginisialisasi objek praktikan model */
    public function __construct()
    {
        $this->model = new PraktikanModel();
    }
     /** Function index berfungsi untuk mengatur tampilan awal halaman praktikan */
     public function index(){
        $id = $_SESSION['praktikan']['id'];
        $data = $this->model->get($id);
        extract($data);
        require_once("View/praktikan/index.php");
    }

    /**function edit berfungsi untuk menamppilkan form edit */
    public function edit(){
        $id = $_SESSION['praktikan']['id'];
        $data = $this ->model-> get($id);
        extract($data);
        require_once("View/praktikan/edit.php");
    }

    /** function update berfungsi untuk menyimpan hasil edit */
    public function update (){
        $id = $_POST['id'];
        $nama = $_POST['nama'];
        $npm = $_POST['npm'];
        $no_hp = $_POST['no_hp'];
        $password = $_POST['password'];

        if($this->model->prosesUpdate($nama, $npm, $password, $no_hp, $id)){
            header("location= index.php?page=praktikan&aksi=view&pesan=Berhasil ubah data");
        }else
        header("location= index.php?page=praktikan&aksi=edit&pesan= Gagal ubah data");
    }

    /**
     * Function praktikum yaitu untuk mengatur awal halaman praktikum
     */
    public function praktikum(){
        $idPraktikan = $_SESSION['praktikan']['id'];
        $data = $this->model->getPendaftaranPraktikum($idPraktikan);
        extract($data);
        require_once("View/praktikan/praktikum.php");
    }
    
    /**Function daftarPraktikum berfungsi untuk mengatur tampilan awal halaman daftar praktikum  */
    public function daftarPraktikum(){
        $data = $this->model->getPraktikum();
        extract($data);
        require_once("View/praktikan/daftarPraktikum.php");
    }

    /** function sotrePraktikum berfungsi untuk memproses data praktikum yang dipilih untuk ditambahkan */
    public function storePraktikum(){
        $praktikum = $_POST['praktikum'];
        $idPraktikan = $_SESSION['praktikan']['id'];
        if($this -> model-> prosesStorePraktikum($idPraktikan,$praktikum)){
            header("location: index.php?page=praktikan&aksi=praktikum&pesan=Berhasil Daftar Praktikum");
        }else{
            header("location: index.php?page=praktikan&aksi=daftarPraktikum&pesan= Gagal Daftar Praktikum");
        }
    }

     /** Function nilai praktikan untuk mengatur halaman nilai praktikum*/
     public function nilaiPraktikan(){
        $idPraktikan = $_SESSION['praktikan']['id'];
        $idPraktikum = $_GET['idPraktikum'];
        $modul = $this->model->getModul();
        $nilai = $this->model->getNilaiPraktikan($idPraktikan, $idPraktikum);
        extract($modul);
        extract($nilai);
        require_once("View/praktikan/nilaiPraktikan.php");
    }


}
?>