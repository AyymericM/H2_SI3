<?php
include 'gotRequest.php';
include 'createQuestion.php';

include 'lordQuestion.php';
include 'surnameQuestion.php';
include 'tvQuestion.php';


define('DB_HOST', 'localhost');
define('DB_PORT', '8889');
define('DB_NAME', 'h2si3');
define('DB_USER', 'root');
define('DB_PASS', 'root');

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

function generateQuestionsSet()
{
    //Generate GoT Questions
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
$questions = generateQuestionsSet();
echo '<pre>';
print_r($questions);
echo '</pre>';

// $exec = $pdo->exec('DELETE * FROM questions');

// foreach($questions as $question)
// {
//     $exec = $pdo->exec('INSERT INTO questions (id, text, answers, type)
//     VALUES ('.$question['id'].','.$question['text'].', '.$question['answers'].', '.$question['type'].' )');
// }