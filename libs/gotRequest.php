<?php

include 'Request.php';

function returnGotData( String $url = null, String $index = null, String $keyName = null )
{
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
