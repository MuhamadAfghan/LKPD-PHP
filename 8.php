<?php

$data = ['PPLG', 'TJKT', 'HTL', 'PMN', 'htl', 'pplg', 'HTL'];
$dataBaru = [];

foreach ($data as $value) {
    if (!in_array(strtoupper($value), $dataBaru)) {
        array_push($dataBaru, $value);
    }
}


print_r($dataBaru);
