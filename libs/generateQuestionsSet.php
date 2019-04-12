<?php
include 'gotRequest.php';
include 'createQuestion.php';

include 'lordQuestion.php';
include 'surnameQuestion.php';
include 'tvQuestion.php';

include 'swRequest.php';

define('DB_HOST', 'localhost');
define('DB_PORT', '8889');
define('DB_NAME', 'h2si3');
define('DB_USER', 'root');
define('DB_PASS', 'root');

/*
*
PDO CONNECTION
*
*/
try
{
    $pdo = new PDO(
        'mysql:dbname='.DB_NAME.';host='.DB_HOST.';port='.DB_PORT,
        DB_USER,
        DB_PASS
    );
    $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_OBJ);

}
catch(PDOException $e)
{
    die('cannot connect');
}

//Generate GoT Questions
function generateQuestionsSet()
{
    $gotQuestions = [];
    $tvId = 1;
    $lordId = 1;
    $surnameId = 1;
    while(sizeof($gotQuestions) <= 300)
    {
        if(sizeof($gotQuestions) < 100)
        {
            $question = CreateTvQuestion(floor(mt_rand(2, 4)), $tvId, sizeof($gotQuestions));
            if($question)
            {
                array_push($gotQuestions, $question);
            }
            $tvId++;
        }
        else if(sizeof($gotQuestions) >= 100 && sizeof($gotQuestions) < 200)
        {
            $question = CreateSurnameQuestion(floor(mt_rand(2, 4)), $surnameId, sizeof($gotQuestions));
            if($question)
            {
                array_push($gotQuestions, $question);
            }
            $surnameId++;
        }
        else
        {
            $question = CreateLordQuestion(floor(mt_rand(2, 4)), $lordId, sizeof($gotQuestions));
            if($question)
            {
                array_push($gotQuestions, $question);
            }
            $lordId++;
        }
    }
    return $gotQuestions;
}
// $gotQuestionsSet = generateQuestionsSet();


// $questions = array_merge($gotQuestionsSet, $finalList);
// shuffle($questions);

// $exec = $pdo->exec('DELETE FROM questions'); //Delete all database if someone tries to access this and create duplication of questions

// foreach($questions as $question) //Push every questions in the database
// {
//     $prepare = $pdo->prepare('
//         INSERT INTO
//             questions (text, answers, type)
//         VALUES
//             (:text, :answers, :type)');

//     $prepare->bindValue('text', $question['text']); //Question title
//     $prepare->bindValue('answers', json_encode($question['answers']));//Encode array into JSON so that it goes into the sql dbb
//     $prepare->bindValue('type', $question['type']); //question type (Game of thrones or Star wars)

//     $execute = $prepare->execute();
// }