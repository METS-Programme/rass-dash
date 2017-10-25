<?php
/**
 * Created by PhpStorm.
 * User: kayemilton
 * Date: 12/10/2017
 * Time: 16:59
 */

$host        = "host = 127.0.0.1";
$port        = "port = 5432";
$dbname      = "dbname = dhis2";
$credentials = "user = postgres password=__Postgr35__";

$db = pg_connect( "$host $port $dbname $credentials"  );

if(!$db) {
    echo "Connection Error!";
}

?>
