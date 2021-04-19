<?php
class AuthModel
{
    /** Function index berfungsi untuk mengatur tampilan awal */
    public function index(){
        require_once("View/auth/index.php");
    }

    /** Function login_aslab berfungsi untuk mengatur halaman login aslab */
    public function login_aslab(){
        require_once("View/auth/login_aslab.php");
    }

    /** Function login_aslab berfungsi untuk mengatur halaman login praktikan */
    public function login_praktikan(){
        require_once("View/auth/login_praktikan.php");
    }

    /** Function login_aslab berfungsi untuk mengatur halaman tampilan daftar */
    public function daftarPraktikan(){
        require_once("View/auth/daftar_praktikan.php");
    }


    public function prosesAuthAslab($npm,$password){
        $sql = "select * from aslab where npm='$npm' and password='$password'";
        $query = koneksi()->query($sql);
        return $query->fetch_assoc();
    }

    /** Function authaslab berfungsi untuk authetication aslab */
    public function authAslab(){
        $npm = $_POST['npm'];
        $password = $_POST['password'];
        $data = $this->prosesAuthAslab($npm,$password);
        if($data){
            $_SESSION['role'] = 'aslab';
            $_SESSION['aslab'] = $data;

            header("location:index.php?page=aslab&aksi=view&pesan=Berhasil Login");
        }else{
            header("location:index.php?page=auth&aksi=loginAslab&pesan=Password atau NPM salah");
        }
    }


    /**
     * function untuk cek dari database berdasarkan
     * @param String $npm berisi npm
     * @param String $password berisi password
     */
    public function prosesAuthPraktikan($npm,$password){
        $sql = "select * from praktikan where npm='$npm' and password='$password'";
        $query = koneksi()->query($sql);
        return $query->fetch_assoc();
    }


    /** Function authPraktikan berfungsi untuk authetication praktikan */
    public function authPraktikan(){
        $npm = $_POST['npm'];
        $password = $_POST['password'];
        $data = $this->prosesAuthPraktikan($npm,$password);
        if($data){
            $_SESSION['role'] = 'praktikan';
            $_SESSION['praktikan'] = $data;

            header("location:index.php?page=praktikan&aksi=view&pesan=Berhasil Login");
        }else{
            header("location:index.php?page=auth&aksi=loginPraktikan&pesan=Password atau NPM salah");
        }
    }
    
    public function logout(){
        session_destroy();
        header("location:index.php?page=auth&aksi=view&pesan=Berhasil Logout");
    }
}

//$tes = new AuthModel();
//var_export($tes->prosesAuthPraktikan('06.2018.1.07000', '123'));
//die();