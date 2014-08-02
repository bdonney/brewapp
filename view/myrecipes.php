<?php // this page is "home" in the index and shown on the header

?>	
  <div class="modal fade" id="NewRecipeModal" tabindex="-1" style="display: none" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
      <div class="modal-dialog">
          <div class="modal-content">
              <div class="modal-header">
                  <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                  <h4 class="modal-title" id="myModalLabel">Create New Recipe</h4>
              </div>
              <div class="modal-body">
						<form method="post" action="index.php?pg=recipe"><table cellpadding="10">
	<tr><td>Beer Name: </td><td><input type="text" name="RecipeName"></td></tr>
	<tr><td></td><td><select>
	<option class="dropdown">Recipe Type</option>
  <option name="RecipeType" value="allgrain">All Grain</option>
  <option name="RecipeType" value="partial">Partial Mash</option>
  <option name="RecipeType" value="extract">Extract</option>
</select></td>
	</table>
                  <!-- <form method="post" action="index.php?action=note/create">
                      <textarea name="note" class="form-control" rows="3" style="width: 90%"
                                placeholder="Be as descriptive as possible with your request.  Include your name!"></textarea> -->

              </div>
              <div class="modal-footer">
                  <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                  <input type="submit" class="btn btn-primary" name="Submit" value="Create New Recipe">
                  </form>
              </div>
          </div><!-- /.modal-content -->
      </div><!-- /.modal-dialog -->
  </div><!-- /.modal -->
	<head>
			<link href='http://fonts.googleapis.com/css?family=Open+Sans+Condensed:300,300italic,700' rel='stylesheet' type='text/css'>
			<link href="css/stylesheet.css" rel="stylesheet">
	</head>
	<body>
	<div class="container">
	<p><button class="btn btn-primary" data-toggle="modal" data-target="#NewRecipeModal">Create New Recipe</button></p>
	</div>
	</body>
</html>