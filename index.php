<?php
require_once "lib/Database.php";
require_once "lib/nusoap.php";
//require_once "lib/Rest.inc.php";
require_once "utilities.php";

//$_SESSION["userId"] = "1";

//freds hack
//$_SESSION["userId"] = $_GET["userId"];
//$userid = $_SESSION['id'];
$userid = $_GET['id'];

//echo $userid;


// $conn = mysql_connect("localhost","root","");
// mysql_select_db("phppot_examples",$conn);
// if(count($_POST)>0) {
// 	$result = mysql_query("SELECT * from users WHERE userId='" . $_SESSION["userId"] . "'");
// 	$row=mysql_fetch_array($result);
// 	if($_POST["currentPassword"] == $row["password"]) {
// 		mysql_query("UPDATE users set password='" . $_POST["newPassword"] . "' WHERE userId='" . $_SESSION["userId"] . "'");
// 		$message = "Password Changed";
// 	} else $message = "Current Password is not correct";
// }

  $con = Database::getInstance()->getConnection();
	$query = "CALL CHANGE_PASSWORD_EMAIL(:userid,:password,@status)";
	$stmt = $con->prepare($query);
	//$password = $_POST['password'];
	$password = $_POST['password'];
	$stmt->bindParam(":userid",$userid);
	//$stmt->bindParam(":password",$fields["password"]);
	$stmt->bindParam(":password",sha1($password));
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
																	echo '<h1 class="login-heading"><center><font color="yellow">'.$umoja.'</font></center></h1>';


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

<html >
<head>
  <meta charset="UTF-8">
  <title>Change Password</title>

  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/meyer-reset/2.0/reset.min.css">


      <link rel="stylesheet" href="css/style.css">

			<script>
			function validatePassword() {
				var password,confirmPassword,output = true;

				//currentPassword = document.frmChange.currentPassword;
				password = document.frmChange.password;
				confirmPassword = document.frmChange.confirmPassword;

				// if(!currentPassword.value) {
				// 	currentPassword.focus();
				// 	document.getElementById("currentPassword").innerHTML = "required";
				// 	output = false;
				// }
				// else
				if(!password.value) {
					password.focus();
					document.getElementById("password").innerHTML = "required";
					output = false;
				}
				else if(!confirmPassword.value) {
					confirmPassword.focus();
					document.getElementById("confirmPassword").innerHTML = "required";
					output = false;
				}
				if(password.value != confirmPassword.value) {
					password.value="";
					confirmPassword.value="";
					password.focus();
					document.getElementById("confirmPassword").innerHTML = "not same";
					output = false;
				}
				return output;
				document.getElementById("demo").innerHTML = output;
			}
			</script>


</head>

<body>

</br></br></br></br></br></br></br></br></br></br>

  <div class="container">
  <div class="login">
  	<h1 class="login-heading">
      <strong>Change Password.</strong> </h1>
      <form method="post" name="frmChange" action="" onSubmit="return validatePassword()">
					<div class="message"><strong><font color="yellow"><?php if(isset($message)) { echo $message; } ?></font></strong></div>
					<!--<?php echo $_POST["password"]; ?>-->
        <!--<input type="text" name="currentPassword" placeholder="Current Password" required="required" class="input-txt" id="currentPassword" />-->
          <input type="password" name="password" placeholder="New Password" required="required" class="input-txt" id="password"/>
					<input type="password" name="confirmPassword" placeholder="Confirm Password" required="required" class="input-txt" id="confirmPassword"/>
          <div class="login-footer">
             <a href="#" class="lnk">

            </a>
            <center><button type="submit" class="btn btn--right">CHANGE  </button></center>

          </div>
      </form>
  </div>
</div>

    <script src="js/index.js"></script>

</body>
</html>
