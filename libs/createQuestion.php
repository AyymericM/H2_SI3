<?php

function createQuestion( $id = null, String $question = null, Array $choices = null)
{
    if ($id === null || $question === null || $choices === null)
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