<?php
class AslabModel
{
    /**
     * @param integer $idAslab berisi id aslab
     * Function get berfungsi untuk mengambil seluruh data praktikum dari database
     */
    public function get($idAslab)
    {
        $sql = "SELECT praktikan.id as idPraktikan , praktikan.nama as namaPraktikan , praktikan.npm as npmPraktikan , praktikan.nomor_hp as nohpPraktikan , praktikum.nama as namaPraktikum FROM praktikan
        JOIN daftarprak ON daftarprak.praktikan_id = praktikan.id
        JOIN praktikum ON daftarprak.praktikum_id = praktikum.id
        WHERE daftarprak.status = 1
        AND daftarprak.aslab_id = $idAslab
        AND praktikum.status = 1";
        $query = koneksi()->query($sql);
        $hasil = [];
        while($data = $query->fetch_assoc()){
            $hasil = $data;
        }
        return $hasil;
    }

    /** Function index digunakan untuk mengatur tampilan awal */
    public function index(){
        $idAslab = $_SESSION['aslab']['id'];
        $data = $this->get($idAslab);
        extract($data);
        require_once("View/aslab/index.php");
    }
    
    /**Function modul digunakan untuk mengambil seluruh data modul */
    public function getModul(){
        $sql = "SELECT modul.id as idModul , modul.nama as namaModul FROM modul
        JOIN praktikum ON praktikum.id = modul.praktikum_id
        WHERE praktikum.status = 1";
         $query = koneksi()->query($sql);
         $hasil = [];
         while($data = $query->fetch_assoc()){
             $hasil = $data;
            }
        return $hasil;
    }
    
    /**
     * @param integer $idPraktikan berisi id praktikan
     * Function getNilaiPraktikan berfungsi untuk mengambil seluruh data nilai dari database
      */
    public function getNilaiPraktikan($idPraktikan){
        $sql = "SELECT * from nilai
        JOIN modul on modul.id = nilai.modul_id
        WHERE praktikan_id = $idPraktikan
        ORDER BY modul.id";
          $query = koneksi()->query($sql);
          $hasil = [];
          while($data = $query->fetch_assoc()){
              $hasil = $data;
             }
         return $hasil;
    }

    /**Function nilai berfungsi untuk mengatur tampilan halaman data nilai praktikan */
    public function nilai(){
        $idPraktikan = $_GET['id'];
        $modul = $this->getModul();
        $nilai = $this->getNilaiPraktikan($idPraktikan);
        extract($modul);
        extract($nilai);
        require_once("View/aslab/nilai.php");
    }

}

//$tes = new AslabModel();
//var_export($tes->getNilaiPraktikan(1));
//die();