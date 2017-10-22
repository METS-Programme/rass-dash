<?php
/**
 * Created by PhpStorm.
 * User: kayemilton
 * Date: 12/10/2017
 * Time: 22:05
 */

require_once ("db.php");

$level = $_POST['level'];

$sql = "SELECT DISTINCT entity, uid FROM staging.rass_kpi_stka_w WHERE level = '$level' ORDER BY entity;";

$res = pg_query($db, $sql);

if(!$res) {
    echo pg_last_error($db);
    exit;
}
//$numrows = pg_numrows($res);

$orgunits =array();

while($row = pg_fetch_array($res)) {
    $orgunits[] = array('entity' => $row['entity'], 'uid' => $row['uid']);
}
//echo "Operation done successfully\n";
pg_close($db);
//$query = "";
//$result = pg_query($query);

echo json_encode($orgunits);

?>