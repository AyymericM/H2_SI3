<?php

function createtvQuestion(Int $answersAmount = null, Int $answerId = null, $id)
{
    $answerName = returnGotData('https://anapioficeandfire.com/api/characters/', $answerId , 'name');
    $answerSeasons = returnGotData('https://anapioficeandfire.com/api/characters/', $answerId, 'tvSeries');
    
    if($answerSeasons === null || $answerName === null)
    {
        return false;
    }
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
        $result = createQuestion($id, 'In how many season '.$answerName.' appears?', $choices, 1);

        return $result;
    }
}