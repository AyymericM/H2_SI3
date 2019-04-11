<?php

function createQuestion(Int $id = null, String $question = null, Array $choices = null, Int $type = null)
{
    if ($id === null || $question === null || $choices === null || $type === null)
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
            'type' => $type
        ];
        return $result;
    }
}