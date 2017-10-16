<?php
/**
 * Created by PhpStorm.
 * User: kayemilton
 * Date: 12/10/2017
 * Time: 22:05
 */

require_once ("db.php");

//$level = $_POST['level'];

$sql = "SELECT DISTINCT * FROM staging.rass_kpi_stka_w WHERE entity = 'National' AND week = '2017W39';";

$res = pg_query($db, $sql);

if(!$res) {
    echo pg_last_error($db);
    exit;
}
//$numrows = pg_numrows($res);

$wks = array();

while($row = pg_fetch_array($res)) {
    $wks[] = array('weekno'=> $row['weekno'], 'week' => $row['week']);
}
//echo "Operation done successfully\n";
pg_close($db);
//$query = "";
//$result = pg_query($query);

echo json_encode($wks);

?>