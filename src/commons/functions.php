<?php
/**
 * Created by PhpStorm.
 * User: stephocay
 * Date: 14/02/2017
 * Time: 17:09
 */

function requireFiles($url)
{
    $files = scandir($url);
    foreach ($files as $file) {
        if (!in_array($file, array(".", ".."))) {
            if (!is_dir($file)) {
                require_once($url . "/" . $file);
            }
        }
    }
}