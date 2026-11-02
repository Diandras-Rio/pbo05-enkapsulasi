<?php
class Mahasiswa {
    private string $nim;

    public function __construct(string $nim) {
        $nim = trim($nim);
        if ($nim === "") {
            throw new InvalidArgumentException("NIM wajib diisi");
        }
        $this->nim = $nim;
    }

    public function getNim(): string {
        return $this->nim;
    }
    // Tidak disediakan setNim()
}

$m = new Mahasiswa("23001");
echo $m->getNim();