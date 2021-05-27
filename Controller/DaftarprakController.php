<?php 
class DaftarprakController
{
    private $model;
    /** Funcction ini adalah konstruktor untuk menginisialisasi objek daftarprak */
    public function __construct()
    {
        $this->model = new DaftarPrakModel();
    }    
     /** Function index berfungsi untuk mengatur tampilan halaman awal daftar */
     public function index(){
        $data = $this->model->get();
        extract($data);
        require_once("View/daftarprak/index.php");
    }
        
    /**
     * function verif berfungsi untuk memverifikasi praktikan yang sudah mendaftar praktikum
     */

    public function verif()
    {
        $id = $_GET['id'];
        $idAslab = $_SESSION['aslab']['id'];
        if($this->model->prosesVerif($id, $idAslab)){
            header("location: index.php?page=daftarprak&aksi=view&pesan=Berhasil Verif Praktikan");
        }else{
            header("location: index.php?page=daftarprak&aksi=view&pesan=Gagal Verif Praktikan");
        }
    }

    /**
     * function Unverif digunakan untuk membatalkan verifikasi
     */

    public function unVerif()
    {
        $id = $_GET['id'];
        $idAslab = $_GET['idPraktikan'];
        if($this->model->prosesUnVerif($id, $idPraktikan)){
            header("location: index.php?page=daftarprak&aksi=view&pesan=Berhasil Verif Praktikan");
        }else{
            header("location: index.php?page=daftarprak&aksi=view&pesan=Gagal Verif Praktikan");
        }
    }
}
?>