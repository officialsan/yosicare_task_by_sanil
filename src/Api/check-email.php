<?php
header('Content-Type: application/json');
use Yosicare\Task\Model\User;

$user = new User();
if($user->getByEmail($_POST['email'])) echo json_encode(['status'=> "Error","message"=> "Email Already Exist"]);
else echo json_encode(['status'=> "Success","message"=> "Email not exist"]);