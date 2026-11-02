<?php
class Rekening {
    private int $saldo = 0;

    public function setor(int $jumlah): void {
        if ($jumlah <= 0) {
            throw new InvalidArgumentException("Setoran harus positif");
        }
        $this->saldo += $jumlah;
    }

    public function tarik(int $jumlah): void {
        if ($jumlah <= 0 || $jumlah > $this->saldo) {
            throw new InvalidArgumentException("Penarikan tidak valid");
        }
        $this->saldo -= $jumlah; 
    }

    public function getSaldo(): int { return $this->saldo; }
}

$r = new Rekening();
$r->setor(100000);
$r->tarik(25000);
echo $r->getSaldo();