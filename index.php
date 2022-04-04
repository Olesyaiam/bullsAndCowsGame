<?php
$computerGenerated4NumbersArray = generate4numbers();

$userGuess = get4NumbersFromUser();

function generate4numbers()
{
    do {
        $secret = mt_rand(0, 9999) . '000';
        $secret = substr($secret, 0, 4);
    } while (hasItDuplicates($secret));

    return $secret;
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
        echo PHP_EOL . PHP_EOL;
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