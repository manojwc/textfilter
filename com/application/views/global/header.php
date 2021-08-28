<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>Video Library - Admin</title>
	<link rel="stylesheet" href="<?php echo base_url('assets/css/bootstrap.min.css') ?>">
	<link rel="stylesheet" href="<?php echo base_url('assets/css/main.css') ?>">
	
	<script src="<?php echo base_url('assets/js/jquery-2.2.3.min.js') ?>" type="text/javascript" charset="utf-8"></script>
	<script src="<?php echo base_url('assets/js/bootstrap.min.js') ?>" type="text/javascript" charset="utf-8"></script>
	

</head>
<body>
	<nav class="navbar navbar-default">
	  <div class="container-fluid">
	    
	    <div class="row">
	    	<div class="col-sm-4 hidden-xs">
	    		<table >		    		
	    			<tr>
	    				<td><a class="navbar-brand" href="#"><img src="<?php echo base_url('assets/img/cg_logo.png') ?>" alt=""></a></td>
	    				<td class="hidden-sm"><a class="navbar-brand" href="#"><img src="<?php echo base_url('assets/img/ou_logo.png') ?>" alt=""></a></td>
	    			</tr>
    		
    			</table>
	    	</div>

	    	<div class="col-sm-4 text-center">
	    		<h2>Video Library</h2>
	    	</div>

	    	<div class="col-sm-4">
		    	<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
			        <span class="sr-only">Toggle navigation</span>
			        <span class="icon-bar"></span>
			        <span class="icon-bar"></span>
			        <span class="icon-bar"></span>
			     </button>
	    		<div class="collapse navbar-collapse navbar-right" id="bs-example-navbar-collapse-1">
			      <ul class="nav navbar-nav">
			        <li id="nav_home" class="nav_link"><a href="<?php echo base_url('index.php/home') ?>">Home <span class="sr-only">(current)</span></a></li>
			        <li id="nav_configuration" class="nav_link"><a href="<?php echo base_url('index.php/configuration') ?>">Configuration</a></li>
			        
			        <li class="dropdown">
			          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><?php echo $current_user["first_name"] ?> <span class="caret"></span></a>
			          <ul class="dropdown-menu">
			            <li><a href="<?php echo base_url('index.php/account/change_password') ?>">Change Password</a></li>            
			            <li><a href="<?php echo base_url('index.php/account/logout') ?>">Logout</a></li>             
			          </ul>
			        </li>
			      </ul>
			      
			    </div><!-- /.navbar-collapse -->
	    	</div>
	    	
	    </div>


	    
	  </div><!-- /.container-fluid -->
	</nav>

	

