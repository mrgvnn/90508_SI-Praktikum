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
 * function getById untuk mengambil satu data dari database
 * @param Integer $id berisi id dari suatub data di database
 */
    public function getById($id)
    {
        $sql = "SELECT * FROM praktikum  WHERE id=$id";
        $query = koneksi()->query($sql);
        return $query->fetch_assoc();
    }
}
