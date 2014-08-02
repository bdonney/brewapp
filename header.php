<?php error_reporting(0);
session_start(); ?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <title>Brü Meister</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">

    <!-- Le styles -->
    <link href="css/bootstrap.css" rel="stylesheet">
    <link href="css/bootstrap-datepicker.css" rel="stylesheet">
	<script src="//ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
    <script src="js/bootstrap.js"></script>
    <script src="js/bootstrap-datepicker.js"></script>
	<script src="js/kyle.js"></script>
    <style>
      body {
        padding-top: 60px; /* 60px to make the container go all the way to the bottom of the topbar */
      }
    </style>
    <link href="/css/bootstrap-responsive.css" rel="stylesheet">

    <!-- HTML5 shim, for IE6-8 support of HTML5 elements -->
    <!--[if lt IE 9]>
      <script src="js/html5shiv.js"></script>
    <![endif]-->

  </head>

  <body>
   <!-- Modal 
  <div class="modal fade" id="myModal" tabindex="-1" style="display: none" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
      <div class="modal-dialog">
          <div class="modal-content">
              <div class="modal-header">
                  <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                  <h4 class="modal-title" id="myModalLabel">Send a Note</h4>
              </div>
              <div class="modal-body">
                  <form method="post" action="index.php?action=note/create">
                      <textarea name="note" class="form-control" rows="3" style="width: 90%"
                                placeholder="Be as descriptive as possible with your request.  Include your name!"></textarea>

              </div>
              <div class="modal-footer">
                  <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                  <input type="submit" class="btn btn-primary" name="submit">
                  </form>
              </div>
          </div>  -- /.modal-content --
      </div> -- /.modal-dialog --
  </div>  -- /.modal --
   -- Modal -->
  <div class="modal fade" id="myModal" tabindex="-1" style="display: none" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
      <div class="modal-dialog">
          <div class="modal-content">
              <div class="modal-header">
                  <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                  <h4 class="modal-title" id="myModalLabel">Login</h4>
              </div>
              <div class="modal-body">
					<form method="post" action="controller/checkin.php">
					<p><table cellpadding="10"><tr><td><h5>Username: </h5></td><td>
					<input type="text" name="username" size=50></td></tr>
					<tr><td><h5>Password: </h5></td><td>
					<input type="password" name="pwd" size=50></td></tr>
					</table></p>
                  <!-- <form method="post" action="index.php?action=note/create">
                      <textarea name="note" class="form-control" rows="3" style="width: 90%"
                                placeholder="Be as descriptive as possible with your request.  Include your name!"></textarea> -->

              </div>
              <div class="modal-footer">
                  <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                  <input type="submit" class="btn btn-primary" name="submit">
                  </form>
              </div>
          </div><!-- /.modal-content -->
      </div><!-- /.modal-dialog -->
  </div><!-- /.modal -->
    <div class="navbar navbar-default navbar-fixed-top">
      <div class="navbar-inner">
        <div class="container">
          <button type="button" class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="brand" href="index.php">Brü Meister</a>
          <div class="nav-collapse collapse">
            <ul class="nav">
                <!--<li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">Katrina <b class="caret"></b></a>
                    <ul class="dropdown-menu">
                        <li><a href="index.php?action=sale/all&id=id">All Sales</a></li>
                        <li><a href="index.php?action=sale/close&query=<?=date('U')?>">Closing Report</a></li>
                        <li><a href="index.php?action=report/parent&query=<?=date('U')?>">Parent Balance Report</a></li>
                    </ul>
                </li>-->
              <li class="dropdown">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown">Store <b class="caret"></b></a>
                <ul class="dropdown-menu">
                  <li><a href="index.php?action=product/all">Beer Ingredients</a></li>
                  <li><a href="index.php?action=product/create">Brewing Equipment</a></li>
                </ul>
              </li>
  
              <li><button class="btn btn-primary" data-toggle="modal" data-target="#myModal">Login</button></li>
            </ul>
			<ul class="pull-right nav"><li>
			<a href="
				<?php if($_SESSION['ID'] != null){
				echo "index.php?pg=home";}
				else { echo "index.php?pg=login"; } ?>
			">
				<?php if($_SESSION['ID'] != null){
				echo "Welcome " . $_SESSION['USERNAME'];}
				else{ echo "Login"; } ?>
				</a></li>
			<?php
			if($_SESSION['ID'] == null){
			echo "<li><a href=\"index.php?pg=login&signup=1\">Sign Up</a></li>"; }
			else { echo "<li><a href=\"controller/checkin.php?logout=1\">Log Out</a></li>"; }
			?>
			</ul>
          </div><!--/.nav-collapse -->
        </div>
      </div>
    </div>



    <div class="container">
        <?php if (isset($result['error'])) { ?>
            <div class="alert alert-error">
                <button type="button" class="close" data-dismiss="alert">&times;</button>
                <h4>Uh-oh!</h4>
                <?=$result['error']?>
            </div>
        <?php } ?>
        <?php if (isset($result['success'])) { ?>
        <div class="alert alert-success">
            <button type="button" class="close" data-dismiss="alert">&times;</button>
            <h4>Success!</h4>
            <?=$result['success'];?>
        </div>
        <?php } ?>