<?php
include_once 'CustomCache.php';

function request(String $url = null)
{
    if ($url == null) {
        return false;
    } else {
        $cache = new CustomCache;
        $isCached = $cache->checkCache($url);

        if ($isCached == true) {
            $res = $cache->getFromCache($url);
            return $res;
        } else {
            $cache->setCache($url);
            $res = $cache->getFromCache($url);

            // cache fallback
            if ($res) {
                return $res;
            } else {
                try {
                    $fallback = file_get_contents($url);
                    if ($fallback) {
                        return $fallback;
                    } else {
                        return false;
                    }
                } catch (\Throwable $th) {
                    return false;
                }
            }
        }
    }
}