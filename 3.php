<?php

$number = 90;

for ($i = 1; $i <= 30; $i++) {
    if ($number % $i == 0) {
        echo "$number : $i = " . $number / $i . "<br>";
    }
}
