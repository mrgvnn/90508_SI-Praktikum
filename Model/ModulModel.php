<?php
class ModulModel
{
    /**Function get berfungsi untuk mengambil seluruh data modul */
    public function get(){
        $sql = "SELECT modul.id as id , praktikum.nama as praktikum , praktikum.status as status , modul.nama as nama
        FROM modul JOIN praktikum ON modul.praktikum_id = praktikum.id WHERE praktikum.status = 1";
        $query = koneksi()->query($sql);
        $hasil = [];
        while($data = $query->fetch_assoc()){
            $hasil[] = $data;
        }
        return $hasil;
    }

    /** Function index untuk mengatur tampilan awal halaman modul */
    public function index(){
        $data = $this->get();
        extract($data);
        require_once("View/modul/index.php");
    }

}

//$tes = new ModulModel();
//var_export($tes->get());
//die();