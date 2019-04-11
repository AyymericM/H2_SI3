<?php



/**
 * get SW data
 */
function getStarWarsData( String $uri = null, String $index = null, String $keyName = null, String $url = 'https://swapi.co/api/' )
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

/**
 * Question builder
 */

function questionBuilder($q)
{
    
    // turn array into variables
    $id = $q['id'];
    $questionPart1 = $q['questionPart1'];
    $uri = $q['uri'];
    $goodAnswerId = $q['goodAnswerId'];
    $hint = $q['hint'];
    $questionPart2 = $q['questionPart2'];
    $answer = $q['answer'];
    $answersAmount = $q['answersAmount'];
    $type = $q['type'];
    
    $urlAnswer = $q['urlAnswer'];
    $resultUri = $q['resultUri'];
    $resultAnswer = $q['resultAnswer'];

    $countAnswers = $q['countAnswers'];
    
    
    // turn variables into strings
    $hint = getStarWarsData($uri, $goodAnswerId, $hint); // luke skywalker
    $question = $q['questionPart1'].$hint.$q['questionPart2']; // full question
    $goodAnswer = getStarWarsData($uri, $goodAnswerId, $answer); // 77

    if ($goodAnswer == 'unknown') // if this id's value doesn't exist
    {
        return false;
    }
    else 
    {
            // Is the answer an URL ?
        if($urlAnswer == true)
        {
            $resultId = basename($goodAnswer);
            $finalAnswer = getStarWarsData($resultUri, $resultId, $resultAnswer);
            
            $goodAnswer = $finalAnswer;
            $uri = $resultUri;
            $answer = $resultAnswer;
        }

        // Is the real answer the sum of answers ?
        if($countAnswers == true)
        {
            $finalAnswer = count($goodAnswer);
            
            $goodAnswer = $finalAnswer;
        }

        // add good answer to options
        $options = [];
        array_push($options, ['right' => true, 'text' => $goodAnswer]);

        // find bad answer and add them
        $choices = wrongAnswersCreator($uri, $id, $answersAmount, $answer, $options, $countAnswers);

        // shuffle options
        shuffle($choices);

        // send or debug display
        // echo '<pre>';
        // print_r('$id = '.$id);
        // echo '</pre>';

        // echo '<pre>';
        // print_r('$question = '.$question);
        // echo '</pre>';

        // echo '<pre>';
        // print_r($choices);
        // echo '</pre>';

        $result = createQuestion($id, $question, $choices, $type);
        return $result;
    }
    
}

function computeId($uri, $questionId)
{
    if($uri == 'people/')
    {
        $randomId = strval(floor(mt_rand(1, 88))); // because there are 88 entries in api/planets/
        if($randomId == 17) // this character does not exist in the API
        {
            return computeId($uri, $questionId);
        }
        else 
        {
            return $randomId;
        }
    }
    if($uri == 'planets/')
    {
        $randomId = strval(floor(mt_rand(1, 61))); // because there are 61 entries in api/planets/
        return $randomId;
    }
    if($uri == 'species/')
    {
        $randomId = strval(floor(mt_rand(1, 37))); // because there are 61 entries in api/planets/
        return $randomId;
    }
    if($uri == 'films/')
    {
        $randomId = strval(floor(mt_rand(1, 7))); // because there are 61 entries in api/planets/
        return $randomId;
    }
}

function wrongAnswersCreator($uri, $id, $answersAmount, $answer, $options, $countAnswers)
{
    while(sizeof($options) < $answersAmount) // repeat jusqu'à ce que $answersAmount options existent dans le tableau choix
    {
        // select a random possible answer
        $randomId = computeId($uri, $id);
        $value = getStarWarsData($uri, $randomId, $answer);

        // in case the requested output is a count()
        if($countAnswers == true)
        {
            $finalAnswer = count($value);
            
            $value = $finalAnswer;
        }

        // echo '<pre>';
        // echo 'new value is '.$value.' (for randomId='.$randomId.')';

        // check the existence of the value
        if ($value == 'unknown') // if this id's value doesn't exist
        {
            // echo ', so bye bye '.$randomId.'</pre>'; 
            // array_push($idToBeExcluded, $randomId);
        }
        else // if this id's value exists
        {
            $notUsedBefore = checkPastOptions($options, $value); // assume this value is not already an option
            
            if($notUsedBefore === true) // then if this value is not already an option
            {
                array_push($options, ['right' => false, 'text' => $value]); // push it
                // echo '<pre>';
                // echo 'pushed '.$value;
                // echo '</pre>';
            }
            else 
            {
                // echo '<pre>..Tant pis, on reprend.</pre>';
            }
        } 

        // echo '<pre>';
        // echo '$options contains '.sizeof($options).' values';
        // echo '</pre>'; 
    }
    return $options;
}

/* valid answer checker */
function checkPastOptions($options, $value)
{
    foreach ($options as $_option) // check each already stated options
    {
        // echo '<pre>';
        // echo $_option['text'].' is in the table, ';

        if ($_option['text'] == $value) // if this value is already an option
        {
            // echo 'uh oh...<pre>';
            // echo 'cette valeur est déjà dans le tableau... que faire ?';
            // echo '</pre>';
            return false;
        }
        // else 
        // {
        //     echo 'so far so good</pre>';
        // }
    }
    return true;
}

/**
 * Questions
 */
/* Question templates */
require 'swQuestionTemplates.php';

/* Questions Generation */
require 'swQuestionsGenerator.php';