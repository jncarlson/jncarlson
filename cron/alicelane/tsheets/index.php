<?php

include_once('tsheets_api/tsheets.inc.php');
date_default_timezone_set ('America/Denver');

$currentDate = date('Y-m-d');
$hour_ago = strtotime('-1 day');
$time = date('Y-m-d', $hour_ago);

$tsheets = new TSheetsRestClient(1, 'S.1__ffdd498faeec5de632b5729eb5164321464327e2');
//$result = $tsheets->get_report(ReportType::Timesheets,
//    array('start_date' => '2015-9-20',
//            'end_date' => $currentDate));


$timesheet = $tsheets->get(ObjectType::Timesheets, array('start_date' => $time,
    'end_date' => $currentDate));

$array = $timesheet['results']['timesheets'];

$idsArray = array();
$jobcodeArray = array();

foreach ($array as $timesheet)
{
    array_push($idsArray, $timesheet['user_id']);
    array_push($jobcodeArray, $timesheet['jobcode_id']);
}

$ids = implode(', ', $idsArray);
$jobs = implode(', ', $jobcodeArray);


$users = $tsheets->get(ObjectType::Users, array('ids' => $ids));
$jobCodes = $tsheets->get(ObjectType::Jobcodes, array('ids' => $jobs));



$timesheetArray = array();
foreach ($array as $timesheet)
{

    foreach ($users['results']['users'] as $id)
    {
        if ($id['id'] == $timesheet['user_id'])
        {
            $name = $id['first_name'] . ' ' . $id['last_name'];
            $group_id = $id['group_id'];
        }
    }

    if ($group_id == "75142")
    {
        $group_name = "Designer";
    }
    else if ($group_id == "75434")
    {
       $group_id = "Administrative";
    }

    $jobName = "none";
    foreach ($jobCodes['results']['jobcodes'] as $jobCode)
    {
        if ($jobCode['id'] == $timesheet['jobcode_id'])
        {
            $jobName = $jobCode['name'];
        }
    }

    $timesheet['client_name'] = $jobName;
    $timesheet['user_name'] = $name;
    $timesheet['timesheet_id'] = $timesheet['id'];
    $timesheet['duration'] = $timesheet['duration'] / 60 / 60;
    unset($timesheet['id']);
    unset($timesheet['tz']);
    unset($timesheet['tz_str']);
    array_push($timesheetArray, $timesheet);
}


print_r(json_encode($timesheetArray, JSON_PRETTY_PRINT));


