<?php
header('Content-Type: application/json');
use Yosicare\Task\Model\User;

$user = new User(); 
$haveError = false;
if(!isset($_POST['id'])) {
    echo json_encode(['status'=> "Error", "message"=> "Invalid input"]);
    $haveError = true;
}
$id = base64_decode($_POST['id']);
$user->data['id'] = $id;
if(!$user->getId($id)){
    echo json_encode(['status'=> "Error", "message"=> "User not found"]);
    $haveError = true;
}
if(!$haveError && $user->delete()) echo json_encode(['status'=> "Success","message"=> "Form Deleted successfully"]);
else echo json_encode(['status'=> "Error","message"=> "Something went wrong please try again"]);