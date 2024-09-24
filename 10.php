<?php

function getSoal()
{
    $soal = [
        [
            'soal' => 'Berapa hasil dari 2 x 3?',
            'jawaban' => [2, 3, 6, 8],
            'kunci' => 6
        ],
        [
            'soal' => 'Berapa hasil dari 4 x 7?',
            'jawaban' => [4, 7, 28, 10],
            'kunci' => 28
        ],
        [
            'soal' => 'Berapa hasil dari 12 x 9?',
            'jawaban' => [12, 9, 108, 100],
            'kunci' => 108
        ],
        [
            'soal' => 'Berapa hasil dari 5 x 2?',
            'jawaban' => [5, 2, 10, 12],
            'kunci' => 10
        ],
        [
            'soal' => 'Berapa hasil dari 8 x 9?',
            'jawaban' => [8, 9, 72, 81],
            'kunci' => 72
        ],
    ];

    return $soal;
}

$soal = getSoal();
$jawaban_murid = [];
$jawaban_benar = [];
$jawabanBenar = 0;
$jawabanSalah = 0;

if (isset($_POST['submit'])) {
    $nama = $_POST['nama'];
    for ($i = 0; $i < count($soal); $i++) {
        $jawaban_murid[] = $_POST['jawaban' . $i];
        $jawaban_benar[] = $soal[$i]['kunci'];
    }

    cekJawaban($jawaban_murid, $jawaban_benar);
}

function cekJawaban($jawaban_murid, $jawaban_benar)
{
    global $jawabanBenar, $jawabanSalah;

    for ($i = 0; $i < count($jawaban_murid); $i++) {
        if ($jawaban_benar[$i] == $jawaban_murid[$i]) {
            $jawabanBenar++;
        } else {
            $jawabanSalah++;
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kuis MTK</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
    #quiz-section {
        display: none;
    }

    #result-section {
        display: none;
    }

    #info {
        display: none;
    }
    </style>
</head>

<body class="bg-gray-100 p-8">
    <div class="max-w-lg mx-auto bg-white p-6 rounded-lg shadow-lg">
        <h1 class="text-2xl font-bold mb-4 text-center">Kuis MTK</h1>
        <span id="info"></span>
        <!-- Timer -->
        <div id="timer" class="text-right text-lg font-bold mb-4">1:00</div>

        <!-- Mulai Button -->
        <button id="start-btn"
            class="w-full bg-indigo-600 text-white py-2 px-4 rounded-md hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500">Mulai</button>

        <!-- Quiz Section -->
        <form action="" method="post" id="quiz-section">
            <div class="mb-4">
                <label for="nama" class="block text-lg font-medium text-gray-700">Nama:</label>
                <input type="text" name="nama" id="nama" required
                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
            </div>

            <?php
            $abjad = ['A', 'B', 'C', 'D'];
            foreach ($soal as $key => $value) {
                $soalText = $key + 1 . '. ' . $value['soal'] ?>
            <div class="mb-4">
                <p class="block text-lg font-medium text-gray-700"><?php echo $soalText; ?></p>

                <?php foreach ($value['jawaban'] as $index => $jawaban) {
                        $opsi = $abjad[$index] . '. ' . $jawaban; ?>
                <div class="flex items-center mb-2">
                    <input type="radio" name="jawaban<?php echo $key; ?>" id="jawaban<?php echo $key . $index; ?>"
                        value="<?php echo $jawaban; ?>" required
                        class="h-4 w-4 text-indigo-600 focus:ring-indigo-500 border-gray-300">

                    <label for="jawaban<?php echo $key . $index; ?>" class="ml-2 block text-sm text-gray-900">
                        <?php echo $opsi; ?>
                    </label>
                </div>
                <?php }; ?>

            </div>
            <?php }; ?>

            <div>
                <button type="submit" name="submit"
                    class="w-full bg-indigo-600 text-white py-2 px-4 rounded-md hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500">Submit</button>
            </div>
        </form>

        <!-- Result Section -->
        <div id="result-section" class="mt-4 text-center">
            <h2 class="text-xl font-bold">Hasil Kuis</h2>
            <p class="text-lg mt-2">Nama: <span id="result-nama"></span></p>
            <p class="text-lg mt-2">Jawaban Benar: <span id="result-benar"><?php echo $jawabanBenar; ?></span></p>
            <p class="text-lg mt-2">Jawaban Salah: <span id="result-salah"><?php echo $jawabanSalah; ?></span></p>
            <p class="text-lg mt-2">Nilai: <span id="result-nilai"></span></p>
        </div>
    </div>

    <script>
    const startBtn = document.getElementById('start-btn');
    const quizSection = document.getElementById('quiz-section');
    const resultSection = document.getElementById('result-section');
    const timerElement = document.getElementById('timer');

    let timer;
    let timeLeft = localStorage.getItem('quiz-timer') || 60; // 1 minute in seconds

    timerElement.textContent = 0 + ':' + Number.isInteger(localStorage.getItem('quiz-timer')) || '1:00';

    startBtn.addEventListener('click', function() {
        if (localStorage.getItem('quiz-timer') >= 0 || localStorage.getItem('quiz-timer') == null) {
            startBtn.style.display = 'none';
            quizSection.style.display = 'block';
            startTimer();
        } else {
            alert('Anda sudah mengisi kuis ini!');
        }
    });

    function startTimer() {
        timer = setInterval(function() {
            timeLeft--;
            localStorage.setItem('quiz-timer', timeLeft);
            updateTimerDisplay();

            if (timeLeft <= 0) {
                clearInterval(timer);
                document.getElementById('quiz-section').submit();
            }
        }, 1000);
    }

    function updateTimerDisplay() {
        const minutes = Math.floor(timeLeft / 60);
        const seconds = timeLeft % 60;
        timerElement.textContent = `${minutes}:${seconds < 10 ? '0' : ''}${seconds}`;
    }

    <?php if (isset($_POST['submit'])) : ?>
    quizSection.style.display = 'none';
    resultSection.style.display = 'block';
    document.getElementById('result-nama').textContent = "<?php echo $nama; ?>";
    document.getElementById('result-benar').textContent = "<?php echo $jawabanBenar; ?>";
    document.getElementById('result-salah').textContent = "<?php echo $jawabanSalah; ?>";
    document.getElementById('result-nilai').textContent = "<?php echo ($jawabanBenar / count($soal)) * 100; ?>";
    localStorage.removeItem('quiz-timer');
    <?php endif; ?>
    </script>
</body>

</html>