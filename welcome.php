<?php

require_once "lib/Database.php";
require_once "lib/nusoap.php";
//require_once "lib/Rest.inc.php";
require_once "utilities.php";

/**
 * Created by PhpStorm.
 * User: fred
 * Date: 4/4/17
 * Time: 2:17 PM
 */

$userid = $_GET['id'];

//echo $userid;

$con = Database::getInstance()->getConnection();
$query = "CALL CHANGE_PASSWORD_EMAIL(:userid,:password,@status)";
$stmt = $con->prepare($query);
//$password = $_POST['password'];
$password = $_POST['password'];
$stmt->bindParam(":userid",$userid);
$pitiahapa = sha1($password);
//$stmt->bindParam(":password",$fields["password"]);
$stmt->bindParam(":password",$pitiahapa);
if($stmt->execute()){
    $result = $stmt->fetch(PDO::FETCH_OBJ);
    $stmt->closeCursor();
    //$status = $con->query("SELECT @status as status")->fetch(PDO::FETCH_OBJ);
    $status = $con->query("SELECT @status as status")->fetch(PDO::FETCH_OBJ);
    if($status->status == "0000"){
        //$response = array("status_code"=>"0000","message"=>"Success");
        //$response = '{"status_code"=>"0000","message"=>"Success"}';
        //	$this->response(json_encode($response),200,$this->callback);
        $response = '{"status_code":"0000","message":"Password Change was Successful"}';
        $fredshome = json_decode($response);
        // access message $book object

        $umoja = $fredshome->message;
        //echo '<html ><head><meta charset="UTF-8"><title>Simple login form</title><link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/meyer-reset/2.0/reset.min.css"><link rel="stylesheet" href="css/style.css"></head><body></br></br></br></br></br></br></br></br></br></br><div class="container"><div class="login"><h1 class="login-heading"><center><strong><h1 class="login-heading"><center><font color="dodgerblue">'.$umoja.'</font></center></h1></strong></center></h1></div></div><script src="js/index.js"></script></body></html>';
        echo '<strong><h1 class="login-heading"><center><font color="yellow">'.$umoja.'</font></center></h1></strong>';
        header('Location: http://localhost/ResetPasswordUsingPHPandMySQLProcedures/?id='.$_GET["id"]);
        die();


    }else{
        //$response = array("status_code"=>$status->status,"message"=>"Please Try changing your password Again");
        $response =  '{"status_code":"0021","message":"Please Try changing your password Again"}';
        $fredshomemum = json_decode($response);
        // access title of $book object
        $buruburu = $fredshomemum->message;
        echo '<h1 class="login-heading"><center><font color="red">'.$buruburu.'</font></center></h1>';
        //	$this->response(json_encode($response),200,$this->callback);
        //echo json_encode($response) ;
    }
}else{
    $error = $stmt->errorInfo();
    $response = array("status_code"=>$stmt->errorCode(),"message"=>"Error inserting to the database.".$error[2]);
    //$this->response(json_encode($response),200,$this::callback);
    echo json_encode($response) ;
}


?>

