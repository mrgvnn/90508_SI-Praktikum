<?php
class DaftarPrakModel
{
    /**Function get berfungsi untuk mengambil seluruh data praktikum yang telah mendaftar praktikum */
    public function get()
    {
        $sql = "SELECT daftarprak.id as idDaftar , daftarprak.praktikan_id as idPraktikan , praktikan.nama as namaPraktikan , daftarprak.status as status, praktikum.nama as namaPraktikum FROM daftarprak
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
   

/**
 * @param integer $id berisi id
 * @param integer idAslab berisi id aslab
 * function prosesVerif berfungsi untuk mengupdate status pada database yang telah diverifikasi
 */

public function prosesVerif($id, $idAslab)
{
    $sql = "UPDATE daftarprak SET status=1, aslab_id = $idAslab where id = $id";
    $query = koneksi()->query($sql);
    return $query;
}


/**
 * @param integer id berisi id
 * @param integer idPraktikan berisi id praktikan
 * function unverif untuk membatalkan status verifikasi
 * 
 */

public function prosesUnVerif($id, $idPraktikan)
{
    $sqlDelete = "DELETE FROM nilai where praktikan_id = $idPraktikan";
    $query = koneksi()->query($sqlDelete);
    $sqlUpdate = "UPDATE daftarprak SET status=0, aslab_id = NULL where id=$id";
    $query = koneksi()->query($sqlUpdate);
    return $query;
}


}

