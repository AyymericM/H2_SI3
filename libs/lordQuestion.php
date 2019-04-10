<?php

include 'gotRequest.php';
include 'createQuestion.php';

function createLordQuestion($answersAmount)
{
    $answerId = strval(floor(mt_rand(1, 444)));//development
    $answerHouse = returnGotData('https://anapioficeandfire.com/api/houses/', $answerId , 'name');
    $answerLordLink = returnGotData('https://anapioficeandfire.com/api/houses/', $answerId, 'currentLord');
    $answerLord = returnGotData($answerLordLink, '', 'name');

    $choices = [];

    if( strlen($answerHouse) < 2 || strlen($answerLord) < 2)
    {
        echo 'ta mère';
    }
    else
    {
        array_push($choices, ['right' => true, 'text' => $answerLord]);
        while(sizeof($choices) < $answersAmount)
        {
            $text = 
            $choice =
           [
                'right' => false,
                'text' =>  createLordChoice(returnGotData('https://anapioficeandfire.com/api/characters/', strval(floor(mt_rand(1, 444))), 'name'), $answerLord, $choices)
           ];
            array_push($choices, $choice);
        }
        shuffle($choices);
        $result = createQuestion('Who is leading the "'.$answerHouse.'"?', $choices);

        echo '<pre>';
        print_r($result);
        echo '</pre>';
        return $result;
    }

}
function createLordChoice($data, $answer, $array)
{
    if(strlen($data) > 1 || $data !== $answer)
    {
        return $data; 
    }
    else
    {
        return createLordChoice(returnGotData('https://anapioficeandfire.com/api/characters/', strval(floor(mt_rand(1, 444))), 'name'), $answer, $array); 
    }
}
createLordQuestion(4, 4);
