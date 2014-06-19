<!DOCTYPE html> 
<html lang="en-US">
<head>
  <title>Namwolf</title>
  <meta charset="utf-8">
  <link href="<?php echo base_url(); ?>assets/css/admin/global.css" rel="stylesheet" type="text/css">
</head>
<body>

<?php //	echo base_url(); exit;?>
	<div class="navbar navbar-fixed-top">
	  <div class="navbar-inner">
	    <div class="container">
	      
	      <ul class="nav">
	        <li <?php if($this->uri->segment(2) == 'products'){echo 'class="active"';}?>>
	          <!-- <a href="<?php echo base_url(); ?>admin/products">Field Management</a> -->
	          <a href="#">Field Management</a>
	        </li>
	        <li <?php if($this->uri->segment(2) == 'manufacturers'){echo 'class="active"';}?>>
	          <!-- <a href="<?php echo base_url(); ?>admin/manufacturers">Configuration</a> -->
	          <a href="#">Configuration</a>
	        </li>
	        <li class="dropdown">
	        <!-- <a href="logout">Logout</a> -->
	          <a href="#" class="dropdown-toggle" data-toggle="dropdown">System Management<b class="caret"></b></a>
	         <!--  <ul class="dropdown-menu">
	            <li>
	              <a href="logout">Logout</a>
	            </li>
	          </ul> -->
	        </li>

	            <li class="position">
	              <a href="logout">Logout</a>
	            </li>
	          
	      </ul>


	    </div>
	  </div>
	</div>	
