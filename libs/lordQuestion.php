<?php

function createLordQuestion(Int $answersAmount = null, Int $answerId = null, $id)
{
    $answerHouse = returnGotData('https://anapioficeandfire.com/api/houses/', $answerId , 'name');
    $answerLordLink = returnGotData('https://anapioficeandfire.com/api/houses/', $answerId, 'currentLord');
    $answerLord = returnGotData($answerLordLink, '', 'name');

    if($answerHouse === null || $answerLord === null)
    {
        return false;
    }
    $choices = [];

    if( strlen($answerHouse) < 2 || strlen($answerLord) < 2)
    {
        return false;
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
        $result = createQuestion($id, 'Who is leading the "'.$answerHouse.'"?', $choices, 1);

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
