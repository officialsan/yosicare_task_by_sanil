<?php
header('Content-Type: application/json');
use Yosicare\Task\Model\User;

$user = new User();
$user->data = $_POST;
if($user->save()) echo json_encode(['status'=> "Success","message"=> "Form submit successfully"]);
else echo json_encode(['status'=> "Error","message"=> "Something went wrong please try again"]);