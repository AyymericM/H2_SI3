<?php

function createQuestion( Number $id = null, String $question = null, Array $choices = null)
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
            'question' => $question,
            'choices' => $choices,
        ];
        return $result;
    }
}