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
      <form method="post" name="frmChange" action="welcome.php/?id=<?php echo  $_GET["id"]; ?>" onSubmit="return validatePassword()">
					<div class="message"><strong>
                            <font color="dodgerblue"><?php if(isset($message)) { echo $message; } ?></font>
                        </strong></div>
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

