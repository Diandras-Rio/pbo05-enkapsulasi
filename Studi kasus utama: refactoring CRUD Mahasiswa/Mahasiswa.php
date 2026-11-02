<?php
class Mahasiswa {
    private string $nim;
    private string $nama;
    private int $semester;
    private string $prodi;

    public function __construct(string $nim, string $nama, int $semester, string $prodi) {
        $this->setNim($nim);
        $this->setNama($nama);
        $this->setSemester($semester);
        $this->setProdi($prodi);
    }

    public function getNim(): string {
        return $this->nim;
    }

    public function setNim(string $nim): void {
        $nim = trim($nim);
        if (empty($nim)) {
            throw new InvalidArgumentException("NIM wajib diisi!");
        }
        $this->nim = $nim;
    }

    public function getNama(): string {
        return $this->nama;
    }

    public function setNama(string $nama): void {
        $nama = trim($nama);
        if (empty($nama)) {
            throw new InvalidArgumentException("Nama wajib diisi!");
        }
        $this->nama = $nama;
    }

    public function getSemester(): int {
        return $this->semester;
    }

    public function setSemester(int $semester): void {
        if ($semester < 1 || $semester > 14) {
            throw new InvalidArgumentException("Semester harus 1-14");
        }
        $this->semester = $semester;
    }

    public function getProdi(): string {
        return $this->prodi;
    }

    public function setProdi(string $prodi): void {
        $prodi = trim($prodi);
        if (empty($prodi)) {
            throw new InvalidArgumentException("Program Studi wajib diisi!");
        }
        $this->prodi = $prodi;
    }
}
?>