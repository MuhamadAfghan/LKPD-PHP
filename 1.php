    <?php

    $text = "Selamat ulang tahun yang ke-18!!";
    $specialchars = [];

    echo "<h1>Teks: $text</h1>";

    if (preg_match_all('/[\'^£$!%&*()}{@#~?><>,|=_+¬-]/', $text)) {
        preg_match_all('/[\'^£$!%&*()}{@#~?><>,|=_+¬-]/', $text, $specialchars);
    }

    if (empty($specialchars)) {
        echo "<p>Tidak ada special karakter</p>";
    } else {
        echo "<p>Special karakter yang terdapat:";
        foreach (array_unique($specialchars[0]) as $specialchar) {
            echo $specialchar . ",";
        }
        echo "</p>";
    }
