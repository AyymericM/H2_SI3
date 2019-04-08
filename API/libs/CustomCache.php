<?php

class CustomCache {
    public function checkCache(String $url = null)
    {
        if (!file_exists($_SERVER['DOCUMENT_ROOT'] . '/cache/')) {
            mkdir($_SERVER['DOCUMENT_ROOT'] . '/cache/');    
        }

        if ($url == null) {
            return false;
        } else {
            $hash_url = md5($url);
            $filename = $_SERVER['DOCUMENT_ROOT'] . '/cache/' . $hash_url . '.cache';
            if (file_exists($filename)) {
                $date = new DateTime();

                if ($date->getTimestamp() - filemtime($filename) < 3600) {
                    return true;
                } else {
                    return false;
                }
            } else {
                return false;
            }
        }
    }

    public function setCache(String $url = null)
    {
        if ($url == null) {
            return false;
        } else {
            $hash_url = md5($url);
            $content = file_get_contents($url);
            $file = $_SERVER['DOCUMENT_ROOT'] . '/cache/' . $hash_url . '.cache';
            if ($content) {
                file_put_contents($file, json_encode(($content)));
                return true;
            } else {
                return false;
            }
        }
    }

    public function getFromCache(String $url = null)
    {
        if ($url == null) {
            return false;
        } else {
            $hash_url = md5($url);
            $filename = $_SERVER['DOCUMENT_ROOT'] . '/cache/' . $hash_url . '.cache';
            $file_data = file_get_contents($filename);

            if ($file_data) {
                return json_decode($file_data);
            } else {
                return false;
            }
        }
    }
}