<?php

include 'gotRequest.php';
include 'createQuestion.php';

function createtvQuestion(Int $answersAmount = null, Int $answerId = null, Int $id = null)
{
    // $answerId = strval(floor(mt_rand(1, 2138)));//development
    $answerName = returnGotData('https://anapioficeandfire.com/api/characters/', $answerId , 'name');
    $answerSeasons = returnGotData('https://anapioficeandfire.com/api/characters/', $answerId, 'tvSeries');
    $answerValue = strval(sizeof($answerSeasons));
    $choices = [];

    if($answerName === '' || $answerSeasons[0] === '')
    {
        return false;
    }
    else
    {
        array_push($choices, ['right' => true, 'text' => $answerValue]);
        while(sizeof($choices) < $answersAmount)
        { 
            $wrongAnswer = strval(floor(mt_rand(0, 7)));
            if($wrongAnswer !== $answerValue)
            {
                $inArray = false;
                foreach($choices as $choice)
                {
                    if($choice['text'] === $wrongAnswer)
                    {
                        $inArray = true;
                    }
                }
                if(!$inArray)
                {
                    $choice =
                    [
                            'right' => false,
                            'text' =>  $wrongAnswer
                    ];
                    array_push($choices, $choice);
                }  
            }
           
        }
        shuffle($choices);
        $result = createQuestion($id, 'In how many season '.$answerName.' appears?', $choices);

        echo '<pre>';
        print_r($result);
        echo '</pre>';
        return $result;
    }
}
createtvQuestion(4, 4, 1);