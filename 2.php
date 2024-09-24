<?php

$hari_ini = date("l");
$diskon = 0;
$total_belanja = 130000;

if ($hari_ini == "Tuesday") {
    $diskon += .05;
}

if ($total_belanja > 100000) {
    $diskon += .07;
}

$total_yang_dibayar = $total_belanja - ($total_belanja * $diskon);

echo "Hari ini: <b>" . $hari_ini . "</b><br>";
echo "Diskon: <b>" . $diskon * 100 . "%" . "</b><br>";
echo "Total belanja: <b>" . number_format($total_belanja, 0, ',', '.') . "</b><br>";
echo "Total yang harus dibayarkan: <b>" . number_format($total_yang_dibayar, 0, ',', '.') . "</b><br>";
