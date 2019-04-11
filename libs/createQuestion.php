<?php

function createQuestion(Int $id = null, String $question = null, Array $choices = null)
{
    if ($id === null || $question === null || $choices === null)
    {
        return false;
    }
    else
    {
        $result = 
        [
            'id' => $id,
            'text' => $question,
            'answers' => $choices,
        ];
        return $result;
    }
}