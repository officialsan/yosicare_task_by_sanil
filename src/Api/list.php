<?php
header('Content-Type: application/json');

use Yosicare\Task\Config;
use Yosicare\Task\Model\User;

$user = new User();

$draw = $_GET['draw'];
$start = $_GET['start'];
$rowperpage = $_GET['length'];  
$searchValue = $_GET['search']['value'];  

$searchQuery = " ";
if($searchValue != ''){
   $searchQuery = " AND (first_name like '%".$searchValue."%' or last_name like '%".$searchValue."%' or email like '%".$searchValue."%') ";
}

$totalRecords = $user->getCount();

$condition = " WHERE 1 ".$searchQuery;
$totalRecordwithFilter =  $user->getCount($condition);

$condition .= "  LIMIT ".$start.",".$rowperpage;

$rows = $user->all($condition);
$i = 0;
$data = [];
foreach ($rows as $row ) {
    $row[ "action"] = '<div class="d-flex"><a class="font-25 text-white btn btn-sm btn-info" style="margin-right:18px" onclick="" href="'.Config::APP_URL.'view?id='.base64_encode($row['id']).'" title="edit" ><i class="fa fa-edit "></i></a><a class="font-25 text-white btn btn-danger mr-2" onclick="deleteUser(`'.base64_encode($row['id']).'`)"  title="view" ><i class="fa fa-trash "></i></a></div>';
    $data[] =  $row;
}

$response = array(
  "draw" => intval($draw),
  "iTotalRecords" => $totalRecords,
  "iTotalDisplayRecords" => $totalRecordwithFilter,
  "aaData" => $data
);

echo json_encode($response);