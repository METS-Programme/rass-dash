<?php
/**
 * Created by PhpStorm.
 * User: kayemilton
 * Date: 05/12/2017
 * Time: 18:25
 */

require_once ("db.php");

$o = $_POST['o'];
$wn= $_POST['wn'];
$cat = $_POST['cat'];
$col = $_POST['col'];
$on  = $_POST['on'];
$yr = '2017';

if ($cat == "Adult"){

    $sql = "SELECT region, district, subcounty, hf FROM staging.weekly_data_smry_a WHERE \"$col\" = 1 AND weekno = $wn AND yr = $yr AND (cuid = '$o' OR ruid = '$o' OR duid = '$o')";

}elseif ($cat == "Paediatric"){

    $sql = "SELECT region, district, subcounty, hf FROM staging.weekly_data_smry_c WHERE \"$col\" = 1 AND weekno = $wn AND yr = $yr AND (cuid = '$o' OR ruid = '$o' OR duid = '$o')";

}

if ($cat == "akpi")//KPIs for Adults
    $tbl = 'staging.weekly_data_smry_a';
if ($cat == "pkpi")//KPIs for Paediatrics
    $tbl = 'staging.weekly_data_smry_c';

if ($col == "aso"){//Facilities reporting stockouts
    $sql = "SELECT region, district, subcounty, hf FROM $tbl WHERE rso = 1 AND weekno = $wn AND yr = $yr AND (cuid = '$o' OR ruid = '$o' OR duid = '$o')";
}elseif($col == "areports"){//Facilities Reported
    $sql = "SELECT region, district, subcounty, hf FROM $tbl WHERE weekno = $wn AND yr = $yr AND (cuid = '$o' OR ruid = '$o' OR duid = '$o')";
}elseif($col == "atotal"){//Total registered facilities
    $sql = "SELECT region, district, subcounty, hf FROM staging.rass_reporting_orgs WHERE country = '$on' OR region = '$on' OR district = '$on'";
}

$res = pg_query($db, $sql);

if(!$res) {
    echo pg_last_error($db);
    exit;
}
//$numrows = pg_numrows($res);

//$orgunits =array();
$tr = "<table id = 'hf-list' class='display' cellspacing='0' data-ccat = '".$cat."'>";
$tr .=  "<thead><tr><th></th><th>Health Facility</th><th>Sub County</th><th>District</th><th>Region</th></tr></thead><tbody>";

while($row = pg_fetch_array($res)) {
    //$orgunits[] = array('entity' => $row['entity'], 'uid' => $row['uid']);
    $tr .= "<tr><td class='details-control'></td><td>" . $row['hf'] . "</td>";
    $tr .= "<td>" . $row['subcounty'] . "</td>";
    $tr .= "<td>" . $row['district'] . "</td>";
    $tr .= "<td>" . $row['region'] . "</td></tr>";
}

$tr .=  "</tbody></table>";

//echo "Operation done successfully\n";
pg_close($db);
//$query = "";
//$result = pg_query($query);
//echo json_encode($orgunits);

echo $tr;

?>