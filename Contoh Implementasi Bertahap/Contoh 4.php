<?php
class Mahasiswa {
    private string $nama;
    private int $semester;

    public function __construct(string $nama, int $semester) {
        $this->setNama($nama);
        $this->setSemester($semester);
    }

    public function setNama(string $nama): void {
        $nama = trim($nama);
        if (mb_strlen($nama) < 3) {
            throw new InvalidArgumentException("Nama minimal 3 karakter");
        }
        $this->nama = $nama;
    }

    public function getNama(): string { return $this->nama; }

    public function setSemester(int $nilai): void {
        if ($nilai < 1 || $nilai > 14) {
            throw new InvalidArgumentException("Semester harus 1-14");
        }
        $this->semester = $nilai;
    }

    public function getSemester(): int { return $this->semester; }
}

$m = new Mahasiswa(" Siti", 4);
echo $m->getNama() . " / " . $m->getSemester();