<?php
/**
 * Created by PhpStorm.
 * User: kayemilton
 * Date: 20/10/2017
 * Time: 00:17
 */

session_start();

date_default_timezone_set('Africa/Kampala');

function getUserIP()
{
    $client  = @$_SERVER['HTTP_CLIENT_IP'];
    $forward = @$_SERVER['HTTP_X_FORWARDED_FOR'];
    $remote  = $_SERVER['REMOTE_ADDR'];

    if(filter_var($client, FILTER_VALIDATE_IP))
    {
        $ip = $client;
    }
    elseif(filter_var($forward, FILTER_VALIDATE_IP))
    {
        $ip = $forward;
    }
    else
    {
        $ip = $remote;
    }

    return $ip;
}


if (!isset($_SESSION['status'])) {

      $connection = mysql_connect("127.0.0.1", "root", "");
      mysql_select_db("rass", $connection);

      $timestamp = date('Y-m-d H:m:s');

      $ip = getUserIP();
      mysql_query("INSERT INTO visits VALUES (NULL, '$ip', '$timestamp')");

      mysql_close($connection);

      $_SESSION['status'] = true;

  }

?>