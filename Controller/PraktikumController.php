<?php 
class PraktikumController
{
    private $model;
    /** Funcction ini adalah konstruktor untuk menginisialisasi objek praktikum model */
    public function __construct()
    {
        $this->model = new PraktikumModel();
    }    

     
    /**
    * function index untuk mengatur tampilan awal
    */
    public function index()
    {
        $data = $this->model->get();

        extract($data);
        require_once("View/praktikum/index.php");
    }

    /**
    * function create untuk mengatur tampilan tambah data 
    */
    public function create()
    {
    require_once("View/praktikum/create.php");
    }

     
    /**
    * function store untuk memproses data untuk ditambahkan
    * fungsi ini membutuhkan data nama, tahun dengan metode http request POST
    */
    public function store()
    {
        $nama = $_POST['nama'];
        $tahun = $_POST['tahun'];
        if ($this->model->prosesStore($nama, $tahun)) {
            header("location:index.php?page=praktikum&aksi=view&pesan=Berhasil Menambah Data");
        } else{
            header("location:index.php?page=praktikum&aksi=create&pesan=Gagal Menambah Data");
        }
    }

    
    /**
     * function ini untuk menampilkan halaman edit
     * juga mengambil salah satu data dari database
     * function ini membutuhkan data id dengan metode http request GET
     */
    public function edit()
    {
        $id = $_GET['id'];
        $data = $this->model->getById($id);

        extract($data);
        require_once("View/praktikum/edit.php");
    }

        
    /**
     * fuction update untuk memproses data untuk di update
     * fungsi ini membutuhkan data nama, tahun dengan metode http request POST
     */
    public function update()
    {
        $id = $_POST['id'];
        $nama = $_POST['nama'];
        $tahun = $_POST['tahun'];
        if ($this->model->storeUpdate($nama, $tahun, $id)) {
            header("location:index.php?page=praktikum&aksi=view&pesan=Berhasil Mengubah Data");
        } else{
            header("location:index.php?page=praktikum&aksi=edit&pesan=Gagal Mengubah Data");
        }
    }

    
    /**
    * function aktifkan untuk memproses update salah satu field data
    * fungsi ini membutuhkan data id dengan metode http request GET
    */
    public function aktifkan(){
    $id = $_GET['id'];
    if ($this->model->prosesAktifkan($id)) {
        header("location:index.php?page=praktikum&aksi=view&pesan=Berhasil Men-Aktifkan Data");
        } else{
        header("location:index.php?page=praktikum&aksi=edit&pesan=Gagal Men-Aktifkan Data");
    }
}
    /**
    * function aktifkan untuk memproses update salah satu field data
    * fungsi ini membutuhkan data id dengan metode http request GET
    */
    public function nonAktifkan()
    {$id = $_GET['id'];
    if ($this->model->prosesNonAktifkan($id)) {
        header("location:index.php?page=praktikum&aksi=view&pesan=Berhasil non-Aktifkan Data");
        } else{
        header("location:index.php?page=praktikum&aksi=edit&pesan=Gagal non-Aktifkan Data");
    }
    

}
}
?>