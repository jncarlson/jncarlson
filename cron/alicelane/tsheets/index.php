<?php

include_once('tsheets_api/tsheets.inc.php');
date_default_timezone_set ('America/Denver');

$currentDate = date('Y-m-d');

$tsheets = new TSheetsRestClient(1, 'S.1__ffdd498faeec5de632b5729eb5164321464327e2');
$result = $tsheets->get_report(ReportType::Payroll,
    array('start_date' => '2015-9-20',
            'end_date' => $currentDate));

$user = $tsheets->get(ObjectType::Users, array('usernames' => 'administrator'));
//echo '<pre>';
//print_r($user);
//echo '</pre>';


$masterArray = array();
foreach($result['results']['payroll_report'] as $report)
{
    array_push($masterArray, $report);
}


print_r(json_encode($masterArray, JSON_PRETTY_PRINT));

