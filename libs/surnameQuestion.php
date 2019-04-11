<?php

include 'gotRequest.php';
include 'createQuestion.php';

function createSurnameQuestion(Int $answersAmount = null, Int $answerId = null, Int $id = null)
{   
    // $answerId = strval(floor(mt_rand(1, 444)));//development
    $answerName = returnGotData('https://anapioficeandfire.com/api/characters/', $answerId , 'name');
    $answerSurname = returnGotData('https://anapioficeandfire.com/api/characters/', $answerId, 'aliases');

    $choices = [];

    if($answerName === '' || $answerSurname[0] === '')
    {
        createSurnameQuestion(4, 2, 1);
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
           if(strlen($choice['text']) > 2)
           {
            array_push($choices, $choice);
           }
            
        }

        shuffle($choices);
        $result = createQuestion($id, 'What is the nickname of '.$answerName.'?', $choices);
        return $result;
    }
}

function createSurnameChoice($data, $answer, $array)
{
    if(strlen($data[0]) > 2 || $data[0] !== $answer)
    {
        echo $data[0];
        return $data[0]; 
    }
    else
    {
        return createSurnameChoice(returnGotData('https://anapioficeandfire.com/api/characters/', strval(floor(mt_rand(1, 2138))), 'aliases'), $answer, $array); 
    }
}