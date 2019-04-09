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

function createSurnameQuestion()
{
    $answerId = strval(floor(mt_rand(1, 2138)));
    $answerName = returnGotData('characters/', $answerId , 'name');
    $answerSurname = returnGotData('characters/', $answerId, 'aliases');

    
    if($answerName === '' || $answerSurname[0] === '')
    {
        createSurnameQuestion();
    }
    else
    {
        echo '<pre>';
        print_r($answerSurname);
        echo '</pre>';
        echo '<pre>';
        print_r($answerName);
        echo '</pre>';
    }
}
createSurnameQuestion();