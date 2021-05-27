<?php
class AuthModel
{

    public function prosesAuthAslab($npm,$password)
    {
        $sql = "select * from aslab where npm='$npm' and password='$password'";
        $query = koneksi()->query($sql);
        return $query->fetch_assoc();
    }
   
    /**
     * function untuk cek data dari database berdasarkan
     * @param String $npm berisi npm
     * @param String $password berisi password
     **/
    public function prosesAuthPraktikan($npm,$password)
    {
        $sql = "select * from praktikan where npm='$npm' and password='$password'";
        $query = koneksi()->query($sql);
        return $query->fetch_assoc();
    }
    
    public function logout()
    {
        session_destroy();
        header("location:index.php?page=auth&aksi=view&pesan=Berhasil Logout!");
    }
    /**
     * function store untuk menambahkan data ke database
     * @param String $nama berisi data nama
     * @param String $npm berisi data npm
     * @param String $no_hp berisi data nomor hp
     * @param String $password berisi data password
     */
    public function prosesStorePraktikan($nama, $npm, $no_hp, $password)
    {
        $sql = "INSERT INTO praktikan(nama, npm, nomor_hp, password) VALUE('$nama', '$npm', '$no_hp', '$password')";
        return koneksi()->query($sql);
    }
    /**
     * function store untuk memproses data untuk ditambahkan
     * fungsi ini membutuhkan data nama, npm, password, nomor hp dengan metode http request POST
     */
    public function storePraktikan()
    {
        $nama = $_POST['nama'];
        $npm = $_POST['npm'];
        $no_hp = $_POST['no_hp'];
        $password = $_POST['password'];

        if ($this->prosesStorePraktikan($nama, $npm, $no_hp, $password)){
            header("location:index.php?page=auth&aksi=view&pesan=Berhasil Daftar");
        } else {
            header("location:index.php?page=auth&aksi=daftarPraktikan&pesan=Gagal Daftar");
        }
    }
}
