<?php

include 'gotRequest.php';
include 'createQuestion.php';

function createSurnameQuestion($answersAmount, $answerId)
{
    $answerName = returnGotData('https://anapioficeandfire.com/api/characters/', $answerId , 'name');
    $answerSurname = returnGotData('https://anapioficeandfire.com/api/characters/', $answerId, 'aliases');

    $choices = [];

    if($answerName === '' || $answerSurname[0] === '')
    {
        return false;
    }
    else
    {
        array_push($choices, ['right' => true, 'text' => $answerSurname[0]]);
        while(sizeof($choices) < $answersAmount)
        {
           $choice =
           [
                'right' => false,
                'text' =>  createSurnameChoice(returnGotData('https://anapioficeandfire.com/api/characters/', strval(floor(mt_rand(1, 2138))), 'aliases'), $answerSurname, $choices)
           ];
            array_push($choices, $choice);
        }

        shuffle($choices);
        $result = createQuestion(1, 'Quel est le surnom de '.$answerName.' ?', $choices);

        echo '<pre>';
        print_r($result);
        echo '</pre>';
        return $result;
    }
}

function createSurnameChoice($data, $answer, $array)
{
    if(strlen($data[0]) > 1 || $data[0] !== $answer)
    {
        return $data[0]; 
    }
    else
    {
        return createSurnameChoice(returnGotData('https://anapioficeandfire.com/api/characters/', strval(floor(mt_rand(1, 2138))), 'aliases'), $answer, $array); 
    }
}