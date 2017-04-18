<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>
<head>
<title>Gateway Option Stats Login</title>
</head>
<body topmargin="0" leftmargin="0">

<div id="NatixisLoginForm">
<?php include ("banner.php"); ?>
<table width="960" border="0" leftmargin="0" topmargin="0" marginwidth="0" marginheight="0" cellpadding="0" cellspacing="0">
<tr>
<td bgcolor="#8080C0"><!-- include top navigation bar -->
<!-- end of top navigation bar --></td>
</tr>
<tr>
<td><table bgcolor="#FFFFFF" width="960" height="100%" border="0" leftmargin="0"
topmargin="0" marginwidth="0" marginheight="0" cellpadding="0" cellspacing="0">
<tr>
<td width="192" valign="top" height="100%"><!-- include left navigation bar -->
<!-- end of left navigation bar --><br/></td>
<td width="576" valign="top" height="100%"><br /><!-- main content -->
<table width="520" border="0" cellspacing="0" cellpadding="0">
<tr>
<td width="140"></td>
<td class="body" valign="top"><p><h3>Gateway Option Stats Login</h3></p>
<form name="LoginForm" method="post" id="loginFormId" action='login.php' accept-charset='UTF-8'>
<table>
<tr>
<td><b>Username:</b></td>
<td><input type="text" name="v_username" id="v_username"  maxlength="20"></td>
</tr>
<tr>
<td><b>Password:</b></td>
<td><input type="password" name="v_password" id = "v_password" autocomplete="off"  maxlength="20" ></td>
</tr>
<tr>
<td colspan="4" align="center">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="submit" name="login" value="Login" ></td>
</tr>
</table>
</form></td>
</tr>
</table>
<!-- end main content --></td>
<td width="192" valign="top" height="100%"><br /><!-- include right navigation bar -->
<!-- end of right navigation bar --></td>
</tr>
</table></td>
</tr>
</table>
</div>

<?php 
include ("databaseUtil.php"); 
if(isset($_POST['v_username']) && isset($_POST['v_password'])) {
$myusername=$_POST['v_username'];
$mypassword=$_POST['v_password'];

     	$counter=0;	
		$sql = "SELECT UserName, PWD FROM ank23_ngam_gatewayauthorizeduser where UserName = '$myusername' AND PWD = '$mypassword'";
			foreach ($connection->query($sql) as $row) {
		++$counter;	
		
		if($counter = 1) {
		session_start();
			$_SESSION['loggedin'] = true;
			$_SESSION['username'] = $myusername; 
     
			header('Location: mdomestic.php');
		} 
        
    }	
		if($counter < 1) {
			echo "Login Failed ";
			echo "<p style='color:red;margin-left:35%;'>Login Failed</p>";
		} 
	              	
    }	


 ?>

<?php include ("footer.php"); ?>

</div>
</body>
</html>
