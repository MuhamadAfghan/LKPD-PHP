<?php

$kalimat_awal = 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Ratione ad consequuntur animi alias nostrum vero a ducimus fuga doloribus neque voluptates blanditiis harum aliquam laudantium odio ipsum, cupiditate consequatur nulla.';

if (strlen($kalimat_awal) > 50) {
    $kalimat_awal = substr($kalimat_awal, 0, 50) . '...';
}

echo $kalimat_awal;
