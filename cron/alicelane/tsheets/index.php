<?php

include_once('tsheets_api/tsheets.inc.php');
date_default_timezone_set ('America/Denver');

$currentDate = date('Y-m-d');

$tsheets = new TSheetsRestClient(1, 'S.1__ffdd498faeec5de632b5729eb5164321464327e2');
//$result = $tsheets->get_report(ReportType::Timesheets,
//    array('start_date' => '2015-9-20',
//            'end_date' => $currentDate));


$timesheet = $tsheets->get(ObjectType::Timesheets, array('start_date' => '2015-2-20',
    'end_date' => $currentDate));

$array = $timesheet['results']['timesheets'];

$idsArray = array();
foreach ($array as $timesheet)
{
    array_push($idsArray, $timesheet['user_id']);
}

$ids = implode(', ', $idsArray);


$users = $tsheets->get(ObjectType::Users, array('ids' => $ids));
$timesheetArray = array();
foreach ($array as $timesheet)
{

//    $user = $tsheets->get(ObjectType::Users, array('ids' => '626832'));
    foreach ($users['results']['users'] as $id)
    {
        if ($id['id'] == $timesheet['user_id'])
        {
            $name = $id['first_name'] . ' ' . $id['last_name'];
        }
    }

    $timesheet['user_name'] = $name;
    $timesheet['timesheet_id'] = $timesheet['id'];
    $timesheet['duration'] = gmdate("H:i:s", $timesheet['duration']);
    unset($timesheet['id']);
    unset($timesheet['tz']);
    unset($timesheet['tz_str']);
    array_push($timesheetArray, $timesheet);
}


print_r(json_encode($timesheetArray, JSON_PRETTY_PRINT));


