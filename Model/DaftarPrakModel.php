<?php
class DaftarPrakModel
{
    /**Function get berfungsi untuk mengambil seluruh data praktikum yang telah mendaftar praktikum */
    public function get()
    {
        $sql = "SELECT daftarprak.id as idDaftar , daftarprak.praktikan_id as id_Praktikan , praktikan.nama as namaPraktikan , daftarprak.status as status, praktikum.nama as namaPraktikum FROM daftarprak
         JOIN praktikan ON praktikan.id = daftarprak.praktikan_id
         JOIN praktikum ON praktikum.id = daftarprak.praktikum_id
         WHERE praktikum.status = 1";
         $query = koneksi()->query($sql);
         $hasil = [];
         while($data = $query->fetch_assoc()){
             $hasil [] = $data;
         }
         return $hasil;
    }
    /** Function index berfungsi untuk mengatur tampilan halaman awal daftar */
    public function index(){
        $data = $this->get();
        extract($data);
        require_once("View/daftarprak/index.php");
    }
}

//$tes = new DaftarPrakModel();
//var_export($tes->get());
//die();