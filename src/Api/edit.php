<?php
header('Content-Type: application/json');
use Yosicare\Task\Model\User;

$user = new User();
$haveError = false;
if(!isset($_POST['id'])) {
    echo json_encode(['status'=> "Error", "message"=> "Invalid input"]);
    exit;
}
if(!$user->getId($_POST['id'])){
    echo json_encode(['status'=> "Error", "message"=> "User not found"]);
    exit;
}
$user->data = $_POST;
if($user->update()) echo json_encode(['status'=> "Success","message"=> "Form Edited  successfully"]);
else echo json_encode(['status'=> "Error","message"=> "Something went wrong please try again"]);