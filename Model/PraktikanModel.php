<?php
class PraktikanModel
{

    /** Function get berfungsi untuk mengambil seluruh data praktikan 
     * @param integer id berisi id praktikan
    */
    public function get($id)
    {
        $sql = "SELECT * FROM praktikan WHERE id = $id";
        $query = koneksi()->query($sql);
        return $query->fetch_assoc();
    }


    /** Function index berfungsi untuk mengatur tampilan awal halaman praktikan */
    public function index(){
        $id = $_SESSION['praktikan']['id'];
        $data = $this->get($id);
        extract($data);
        require_once("View/praktikan/index.php");
    }

    /**
     * Function getPraktikum berfungsi untuk mengambil seluruh data praktikum yang aktif
     */
    public function getPraktikum(){
        $sql = "SELECT * FROM praktikum WHERE status = 1";
        $query = koneksi()->query($sql);
         $hasil = [];
         while($data = $query->fetch_assoc()){
             $hasil = $data;
            }
        return $hasil;
    }

    /**Function daftarPraktikum berfungsi untuk mengatur tampilan awal halaman daftar praktikum  */
    public function daftarPraktikum(){
        $data = $this->getPraktikum();
        extract($data);
        require_once("View/praktikan/daftarPraktikum.php");
    }

    /** Function getPendaftaran praktikum berfungsi untuk mengambil data pendaftaran praktikum praktikan
     * @param integer idPraktikan berisi idpraktikan
     */
    public function getPendaftaranPraktikum($idPraktikan)
    {
        $sql = "SELECT daftarprak.id as idDaftar , praktikum.nama as namaPraktikum , praktikum.id as idPraktikum , daftarprak.status FROM daftarprak
        JOIN praktikum on praktikum.id = daftarprak.praktikum_id
        WHERE daftarprak.praktikan_id = $idPraktikan";
        $query = koneksi()->query($sql);
        $hasil = [];
        while($data = $query->fetch_assoc()){
            $hasil = $data;
           }
       return $hasil;
    }

    /**
     * Function praktikum yaitu untuk mengatur awal halaman praktikum
     */
    public function praktikum(){
        $idPraktikan = $_SESSION['praktikan']['id'];
        $data = $this->getPendaftaranPraktikum($idPraktikan);
        extract($data);
        require_once("View/praktikan/praktikum.php");
    }

    /** Function getModul yaitu untuk mengambil data praktikum modul */
    public function getModul($idPraktikum)
    {
        $sql = "SELECT modul.id as idModul , modul.nama as namaModul FROM modul
        JOIN praktikum on praktikum.id = modul.praktikum_id
        WHERE modul.praktikum_id = $idPraktikum";
        $query = koneksi()->query($sql);
        $hasil = [];
        while($data = $query->fetch_assoc()) {
            $hasil = $data;
     }
       return $hasil;
    }

    /** Function getNilaiPraktikan untuk mengambil data nilai praktikan di setiap praktikum
     * @param integer $idPraktikan berisi id praktikan
     * @param integer $idPraktikumberisi id praktikum
    */
    public function getNilaiPraktikan($idPraktikan, $idPraktikum){
        $sql = "SELECT * FROM nilai
        JOIN modul on modul.id = nilai.modul_id
        WHERE praktikan_id = $idPraktikan
        AND praktikum_id = $idPraktikum
        ORDER BY modul.id";
        $query = koneksi()->query($sql);
        $hasil = [];
        while($data = $query->fetch_assoc()){
            $hasil = $data;
           }
       return $hasil;
    }

    /** Function nilai praktikan untuk mengatur halaman nilai praktikum*/
    public function nilaiPraktikan(){
        $idPraktikan = $_SESSION['praktikan']['id'];
        $idPraktikum = $_GET['idPraktikum'];
        $modul = $this->getModul($idPraktikum);
        $nilai = $this->getNilaiPraktikan($idPraktikan, $idPraktikum);
        extract($modul);
        extract($nilai);
        require_once("View/praktikan/nilaiPraktikan.php");
    }
 
    /**
     * Function update berfungsi untuk update data praktikan pada database
     * @param string nama berisi nama praktikan
     * @param string npm berisi npm praktikan
     * @param string password berisi password
     * @param string no hp berisi nomor telepon
     * @param integer id berisi id praktikan
     */
    public function prosesUpdate($nama, $npm, $password, $no_hp, $id){
        $sql = "UPDATE praktikan SET nama='$nama', npm='$npm', password='$password', nomor_hp='$no_hp', WHERE id='$id'";
        $query = koneksi()->query($sql);
        return $query;
    }

    /**
     * Function update berfungsi untuk menyimpan hasil edit
     */
    public function update(){
        $id = $_POST['id'];
        $nama = $_POST['nama'];
        $npm = $_POST['npm'];
        $no_hp = $_POST['no hp'];
        $password = $_POST['password'];

        if($this->prosesUpdate($nama, $npm, $password, $no_hp, $id)){
            header("location: index.php?page=praktikan&aksi=view&pesan=berhasil Ubah Data");
        }else{
            header("location: index.php?page=praktikan&aksi=edit&pesan=berhasil Ubah Data");
        }
    }

    /**
     * Function edit berfungsi untuk menampilkan form edit
     */
    public function edit()
    {
        $id = $_SESSION['praktikan']['id'];
        $data = $this->get($id);
        extract($data);
        require_once("View/praktikan/edit.php");
    }

    /**
     * Function Store Praktikum berfungsi untuk input data daftar praktikum ke database
     * @param integer idPraktikan berisiid praktikan
     * @param integer idPraktikum berisi id praktikum
     */
    public function prosesStorePraktikum($idPraktikan,$idPraktikum){
        $sql="INSERT INTO daftarprak(praktikan_id,praktikum_id,status) VALUE($idPraktikan,$idPraktikum,0)";
        $query = koneksi()->query($sql);
        return $query;
    }

    /**
     * Function storePraktikan berfungsi untuk memproses data praktikum yang dipilih untuk ditambahkan
     */

    public function storePraktikum(){
        $praktikum = $_POST['praktikum'];
        $idPraktikan - $_SESSION['praktikan']['id'];
        if($this->prosesStorePraktikum($idPraktikan,$praktikum)){
            header("location: index.php?page=praktikan&aksi=praktikum&pesan=Berhasil Daftar Praktikum");
        }else{
            header("location: index.php?page=praktikan&aksi=daftarPraktikum&pesan=Gagal Daftar Praktikum");
        }
    }
}


//$tes = new PraktikanModel();
//var_export($tes->prosesUpdate('tesnamaupdate','1234','pass','1234',3));
//die();

//$tes = new PraktikanModel();
//var_export($tes->prosesStorePraktikum(3,2));
//die();







