<?php
class Mahasiswa {
    private int $semester;

    public function __construct(int $semester) {
        $this->setSemester($semester);
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
}

$m = new Mahasiswa(3);
$m->setSemester(5);
echo $m->getSemester();
// $m->semester = -7; // Error akses private