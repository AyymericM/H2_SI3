<?php

function createQuestion( String $question = null, Array $choices = null)
{
    if ($question === null || $choices === null)
    {
        return false;
    }
    else
    {
        $result = 
        [
            'question' => $question,
            'choices' => $choices,
        ];
        return $result;
    }
}