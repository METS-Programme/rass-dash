<?php
/**
 * Created by PhpStorm.
 * User: kayemilton
 * Date: 20/10/2017
 * Time: 00:17
 */

  session_start();

  if (!isset($_SESSION['status'])) {

      $timestamp = date("Y-m-d H:i:s");

      $connection = mysql_connect("127.0.0.1", "root", "METSUganda321");
      mysql_select_db("rass", $connection);

      $ip = $_SERVER['REMOTE_ADDR'];
      mysql_query("INSERT INTO visits VALUES (NULL, '$ip', '$timestamp')");

      mysql_close($connection);

      $_SESSION['status'] = true;

  }
?>
