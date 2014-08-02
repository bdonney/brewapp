<?php

?>	
	<head>
			<link href='http://fonts.googleapis.com/css?family=Open+Sans+Condensed:300,300italic,700' rel='stylesheet' type='text/css'>
			<link href="css/stylesheet.css" rel="stylesheet">
	</head>
	<body><h5>
	<div class="container">
	Beer Name - <?php echo $_POST['RecipeName'] . "Recipe Type - " . $_POST['RecipeType']; ?>
	
	
	<form><table cellpadding="10">
	<tr><td>Beer Name: </td><td><input type="text" name="RecipeName"></td>
	<td><select>
	<option class="dropdown">Recipe Type</option>
  <option value="volvo">All Grain</option>
  <option value="saab">Partial Mash</option>
  <option value="opel">Extract</option>
  <option value="audi">Mystery</option>
</select></td>
<td><select>
	<option>Beer Style</option>
  <option value="volvo">IPA</option>
  <option value="saab">Nut Brown Ale</option>
  <option value="opel">Belgian Trippel</option>
  <option value="audi">Pale Ale</option>
</select></td>
	</table></form>
	</div>
	</h5></body>
</html>