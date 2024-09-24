<?php
$uang = 17500;
$nilai_koin = [1000, 500, 200, 100];

echo "Jenis koin untuk Uang Rp. " . number_format($uang, 0, ',', '.') . " : <br>";

echo "<ul>";
foreach ($nilai_koin as $nilai) {
    $koin = intdiv($uang, $nilai);
    $uang %= $nilai; //500

    if ($koin > 0) {
        echo "<li>";
        echo $koin . " Koin Rp. " . number_format($nilai, 0, ',', '.') . "<br>";
        echo "</li>";
    }
}
echo "</ul>";
