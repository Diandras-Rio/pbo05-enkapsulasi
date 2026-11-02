<?php
require_once 'Mahasiswa.php';

class DataMahasiswa {
    private array $data = [];

    public function __construct() {
        if (!isset($_SESSION['mahasiswa'])) {
            $_SESSION['mahasiswa'] = [];
        }
        $this->data = $_SESSION['mahasiswa'];
    }

    public function tambah(Mahasiswa $m): void {
        // Pengecekan agar NIM duplikat ditolak
        if (isset($this->data[$m->getNim()])) {
            throw new InvalidArgumentException("NIM sudah terdaftar!");
        }

        $this->data[$m->getNim()] = $m;
        $_SESSION['mahasiswa'] = $this->data;
    }

    public function getAll(): array {
        return array_values($this->data);
    }
}
?>