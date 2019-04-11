<?php

$qtList = [];
array_push($qtList, $qt1);
array_push($qtList, $qt2);
// array_push($ qtList, $qt3); // multiple warning
array_push($qtList, $qt4);
array_push($qtList, $qt5);
array_push($qtList, $qt6);
array_push($qtList, $qt7);
array_push($qtList, $qt8);
// array_push($qtList, $qt9); // 1 notice
array_push($qtList, $qt10);

$qList = [];

foreach ($qtList as $_qt) 
{
    if($_qt['uri'] == 'people/')
    {
        for ($i=1; $i <= 88; $i++) 
        { 
            if($i != 17) // this character does not exist in the API
            {
                $_qt['goodAnswerId'] = $i;
                $q = questionBuilder($_qt);
                if($q != false)
                {
                    array_push($qList, $q);
                }
            }
        }
    }
    if($_qt['uri'] == 'planets/')
    {
        for ($i=1; $i <= 61; $i++) 
        { 
            $_qt['goodAnswerId'] = $i;
            $q = questionBuilder($_qt);
            if($q != false)
            {
                array_push($qList, $q);
            }
        }
    }
    if($_qt['uri'] == 'species/')
    {
        for ($i=1; $i <= 37; $i++) 
        { 
            $_qt['goodAnswerId'] = $i;
            $q = questionBuilder($_qt);
            if($q != false)
            {
                array_push($qList, $q);
            }
        }
    }
    if($_qt['uri'] == 'films/')
    {
        for ($i=1; $i <= 7; $i++) 
        { 
            $_qt['goodAnswerId'] = $i;
            $q = questionBuilder($_qt);
            if($q != false)
            {
                array_push($qList, $q);
            }
        }
    }
}

$finalList = [];

foreach ($qList as $key => $_q) 
{
    $_q['id'] = $key + 1;

    array_push($finalList, $_q);
}




echo '<pre>';
print_r($finalList);
echo '</pre>';