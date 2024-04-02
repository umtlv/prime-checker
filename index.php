<?php
$minValue = 0;
$maxValue = 1000000;
$isChecking = false;
$isPrime = false;
$primeNumbers = [];
$number = $_POST['number'] ?? null;

function isPrimeNumber(int $number): bool
{
    if ($number <= 1) {
        return false;
    }

    for ($i = 2; $i <= sqrt($number); $i++) {
        if ($number % $i == 0) {
            return false;
        }
    }

    return true;
}

if (
    isset($_POST['check']) ??
    !empty($number) &&
    $number >= $minValue &&
    $number <= $maxValue
) {
    $isChecking = true;
    $isPrime = isPrimeNumber($number);
    if (!$isPrime) {
        if ($number > 2) {
            for ($i = $number; $i > 1; $i--) {
                if (isPrimeNumber($i)) {
                    $primeNumbers[] = $i;
                }

                if (count($primeNumbers) === 2) break;
            }

            for ($i = $number; $i < $maxValue; $i++) {
                if (isPrimeNumber($i)) {
                    $primeNumbers[] = $i;
                }

                if (count($primeNumbers) === 4) break;
            }
        }
    }
}

sort($primeNumbers);
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Проверка на простое число</title>
    <style>
        * {
            padding: 0;
            margin: 0;
            box-sizing: border-box;
            font-family: sans-serif;
        }

        .container {
            margin: 10px;
            padding: 10px;
        }

        input {
            width: 300px;
            padding: 10px;
            border: 1px solid #000;
            outline: none;
            border-radius: 5px;
            margin: 5px;
        }

        button {
            width: 100px;
            padding: 10px;
            border: 1px solid #000;
            outline: none;
            border-radius: 5px;
            margin: 5px;
            cursor: pointer;
        }

        .answer {
            margin: 5px;
            padding: 10px;
            width: 415px;
            border: 1px solid #000;
            outline: none;
            border-radius: 5px;
        }
    </style>
</head>
<body>
<div class="container">
    <form action="" method="POST">
        <label>
            <input type="number" name="number" required inputmode="numeric" min="<?= $minValue ?>"
                   max="<?= $maxValue ?>" value="<?= $number ?>">
        </label>
        <button type="submit" name="check">Проверить</button>
    </form>
    <?php if ($isChecking) { ?>
        <div class="answer">
            <p>Введенное число: <?= $number ?></p>
            <p>Является ли число простым: <?= $isPrime ? 'Да' : 'Нет' ?></p>
            <?php if (count($primeNumbers)) { ?>
                <p>Простые числа: <?= implode(', ', $primeNumbers) ?></p>
            <?php } ?>
        </div>
    <?php } ?>
</div>
</body>
</html>
