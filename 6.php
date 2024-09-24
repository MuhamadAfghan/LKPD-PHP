<?php

$barang = [
    [
        'nama_barang' => 'Pasta Gigi',
        'harga_barang' => 18000,
        'jumlah_beli' => 1
    ],
    [
        'nama_barang' => 'Sabun Mandi',
        'harga_barang' => 5000,
        'jumlah_beli' => 3
    ],
    [
        'nama_barang' => 'Aloe Vera Sheet Mask',
        'harga_barang' => 15000,
        'jumlah_beli' => 4
    ]
];

function hitungTotal($arr)
{
    $total = 0;
    foreach ($arr as $key => $value) {
        $total += $value['harga_barang'] * $value['jumlah_beli'];
    }

    return $total;
}

echo 'Daftar belanja: <br>';
echo '<ol>';
foreach ($barang as $key => $value) {
    echo '<li>' . $value['nama_barang'] . ' (' . $value['jumlah_beli'] . ') : ' . number_format($value['harga_barang'] * $value['jumlah_beli'], 0, ',', '.') . '<br>';
}
echo '</ol>';

echo 'Total belanja: <b>Rp.' . number_format(hitungTotal($barang), 0, ',', '.') . '<br>';
