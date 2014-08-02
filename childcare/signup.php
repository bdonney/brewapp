<?php




include 'header.php';
?>	
	<head>
			<link href='http://fonts.googleapis.com/css?family=Open+Sans+Condensed:300,300italic,700' rel='stylesheet' type='text/css'>
			<link href="css/stylesheet.css" rel="stylesheet">
		<title>
			Welcome to the future daycare site!
		</title>
	</head>
	
	<body>
	<div class="container">
	<form name="form1" method="post" action="signup.php">
<p><table><tr><td>USERNAME: </td><td>
<input type="text" name="un" size=50></td></tr>
<tr><td>PASSWORD: </td><td>
<input type="password" name="pwd" size=50></td></tr>
<tr><td>Verify PASSWORD: </td><td>
<input type="password" name="vpwd" size=50></td></tr>
<tr><td>Email: </td><td>
<input type="text" name="email" size=50></td></tr>
</table>
<input type="submit" name="Submit" value="Submit">
</p>

</form></div>
		
	</body>
</html>