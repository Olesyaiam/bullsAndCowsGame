<?php
$computerGenerated4NumbersArray = generate4numbers();
$moves = 0;

do {
    $userGuessArray = get4NumbersFromUser();
    $bullsAndCows = game($computerGenerated4NumbersArray, $userGuessArray);
    $moves++;

    echo 'Bulls: ' . $bullsAndCows['bulls'] . PHP_EOL;
    echo 'Cows: ' . $bullsAndCows['cows'] . PHP_EOL;

    if ($bullsAndCows['bulls'] != 4) {
        echo PHP_EOL . 'Please try again!' . PHP_EOL;
    }
} while ($bullsAndCows['bulls'] != 4);

echo PHP_EOL . "Congratulations! You guessed it in $moves moves!" . PHP_EOL;

function generate4numbers()
{
    do {
        $secret = mt_rand(0, 9999) . '000';
        $secret = substr($secret, 0, 4);
    } while (hasItDuplicates($secret));

    return str_split($secret);
}

function hasItDuplicates($stringWith4Numbers)
{
    $arrayWith4Numbers = str_split($stringWith4Numbers);

    return count($arrayWith4Numbers) != count(array_flip($arrayWith4Numbers));
}

function get4NumbersFromUser()
{
    $userGuess = null;

    while ($userGuess == null) {
        echo PHP_EOL;
        $userGuess = readline('Enter 4 numbers: ');

        if (strlen($userGuess) != 4) {
            echo 'You entered not 4 symbols. Please try again.';
            $userGuess = null;
        } elseif (!is_numeric($userGuess)) {
            echo 'You entered not numeric symbols. Please try again.';
            $userGuess = null;
        } elseif (hasItDuplicates($userGuess)) {
            echo 'You entered a number with duplicates. Please try again.';
            $userGuess = null;
        }
    }

    return str_split($userGuess);
}

function game($computerGenerated4NumbersArray, $userGuessArray)
{
    $result = array(
        'cows' => 0,
        'bulls' => 0
    );

    foreach (array_keys($computerGenerated4NumbersArray) as $key) {
        if ($computerGenerated4NumbersArray[$key] == $userGuessArray[$key]) {
            $result['bulls']++;
        } elseif (in_array($userGuessArray[$key], $computerGenerated4NumbersArray)) {
            $result['cows']++;
        }
    }

    return $result;
}