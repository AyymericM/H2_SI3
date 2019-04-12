<?php

include 'Request.php';

function returnGotData( String $url = null, String $index = null, String $keyName = null )
{
    if($index === 1510 || $index === 1509 || $index === 1511 || $index === 1995)
    {
        return false;
    }
    if ($url === null || $index === null || $keyName === null)
    {
        return false;
    }
    else
    {
        $jsonData = request($url.$index);
        $data = stripslashes(html_entity_decode($jsonData));
        $phpData = json_decode($data, true);
        
        return $phpData[$keyName];

    }
}
