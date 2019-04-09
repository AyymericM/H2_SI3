<?php

include 'Request.php';

function returnGotData( String $uri = null, String $index = null, String $keyName = null, String $url = 'https://www.anapioficeandfire.com/api/' )
{
    if ($uri === null || $index === null || $keyName === null)
    {
        return false;
    }
    else
    {
        $jsonData = request($url.$uri.$index);
        $data = stripslashes(html_entity_decode($jsonData));
        $phpData = json_decode($data, true);
        
        return $phpData[$keyName];

    }
}

function createSurnameQuestion($answersAmount)
{
    $answerId = strval(floor(mt_rand(1, 2138)));
    $answerName = returnGotData('characters/', $answerId , 'name');
    $answerSurname = returnGotData('characters/', $answerId, 'aliases');

    $choices = [];

    if($answerName === '' || $answerSurname[0] === '')
    {
        createSurnameQuestion($answersAmount);
    }
    else
    {
        array_push($choices, ['right' => true, $answerSurname[0]]);
        while(sizeof($choices) < $answersAmount)
        {
           $choice =
           [
                'right' => false,
                'text' =>  createSurnameChoice(returnGotData('characters/', strval(floor(mt_rand(1, 2138))), 'aliases'), $answerSurname, $choices)
           ];
            array_push($choices, $choice);
        }
        $result = [
            'text' => 'Quel est le surnom de '.$answerName.' ?',
            'choices' => $choices
        ];
        echo '<pre>';
        print_r($result);
        echo '</pre>';
    }
}

function createSurnameChoice($data, $answer, $array)
{
    if(strlen($data[0]) > 1)
    {
        return $data[0]; 
    }
    else
    {
        return createSurnameChoice(returnGotData('characters/', strval(floor(mt_rand(1, 2138))), 'aliases'), $answer, $array); 
    }
}

createSurnameQuestion(4);