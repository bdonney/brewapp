<?php
If($_GET['msg']==1){echo "<h5>Please fill in all fields</h5>";}
elseif($_GET['msg']==2){echo "<h5>Username / Email is already in our system</h5>";}
elseif($_GET['msg']==3){echo "<h5>Unknown Error, User not created</h5>";}
elseif($_GET['msg']==4){echo "<h5>Username/Password Were Incorrect.</h5>";}
If($_GET['signup']==1){
?>	
	<head>
			<link href='http://fonts.googleapis.com/css?family=Open+Sans+Condensed:300,300italic,700' rel='stylesheet' type='text/css'>
			<link href="css/stylesheet.css" rel="stylesheet">
	</head>
	
	<body>
	<div class="container">
<?php echo 
"<form name=\"form\" method=\"post\" action=\"controller/checkin.php?signup=1\">
<p><table cellpadding=\"10\"><tr><td>Create Username: </td><td>
<input type=\"text\" name=\"newun\" size=50 value=".$_POST['newun']."></td></tr>
<tr><td>Create Password: </td><td>
<input type=\"password\" name=\"createpwd\" size=50></td></tr>
<tr><td>Confirm Password: </td><td>
<input type=\"password\" name=\"conpwd\" size=50></td></tr>
<tr><td>Email: </td><td>
<input type=\"text\" name=\"newemail\" size=50 value=".$_POST['newemail']."></td></tr>
<tr><td>Confirm Email: </td><td>
<input type=\"text\" name=\"conemail\" size=50 value=".$_POST['conemail']."></td></tr></table><table cellpadding=\"10\">
<tr><td><img src=\"css/verify.jpg\" alt=\"Verify You Are Human\"></td><td>
</td></tr>

<tr><td>Type The Two Words From The Image: </td><td>
<input type=\"text\" name=\"verify\" size=50></td></tr><tr><td></td><td>
<input class=\"btn btn-primary\" type=\"submit\" name=\"Submit\" value=\" Sign Up \"></td></table>
</p>";

}
else {
echo "<form name=\"form\" method=\"post\" action=\"controller/checkin.php\">
<p><table cellpadding=\"10\"><tr><td>USERNAME: </td><td>
<input type=\"text\" name=\"username\" size=50></td></tr>
<tr><td>PASSWORD: </td><td>
<input type=\"password\" name=\"pwd\" size=50></td></tr>
</table>
<input class=\"btn btn-primary\" type=\"submit\" name=\"Submit\" value=\"Welcome Back!\">
</p>";
}?>

</form></div>
	</body>
</html>