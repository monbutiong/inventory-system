<?php
defined('BASEPATH') OR exit('No direct script access allowed');

$host = "localhost";
$username = "root";
$password = "";
$database = "ventum";

// Create a connection
$connection = mysqli_connect($host, $username, $password, $database);

// Check the connection
if (!$connection) {
    echo'Log Error : Failed<br/>';
}else{

	$query = "SELECT name FROM account WHERE id=".(@$_SESSION['user_id']+0);
	$result = mysqli_query($connection, $query);
	$user = mysqli_fetch_assoc($result);
	 
	$query = "INSERT INTO error_logging (type, message, filename, error_dt, user_id, line_number) 
	          VALUES ('404', '".strip_tags($message)."', '" .(@$_SERVER['REQUEST_URI']). "', '" . date('Y-m-d H:i:s') . "', '" . (@$_SESSION['user_id']) . "', '0')"; 
	$result = mysqli_query($connection, $query);
}
 
$protocol = isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? 'https' : 'http'; 
$host = $_SERVER['HTTP_HOST']; 
$path = dirname($_SERVER['PHP_SELF']); 
$baseUrl = $protocol . '://' . $host . $path;


?>
<!-- Bootstrap -->
<link href="<?php echo $baseUrl;?>/assets/themes/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
<!-- Custom Theme Style -->
<link href="<?php echo $baseUrl;?>/assets/themes/build/css/custom.css?34" rel="stylesheet">

<body class="nav-side">
  <div id="loading_progress"></div>
  <div class="container body">
    <div class="main_container"> 

      	<div class="right_col" style="margin: 10px; padding: 10px; background-color: #fff;"> 

      		<p style="position: fixed; right: 10; padding: 20px;"><a class="btn btn-warning" href="Javascript:history.back();">Go Back</a></p>

      		<img class="img_logo" src="<?php echo $baseUrl;?>/assets/images/c_logo.png?2"/> 
 
      		<hr/>
      			
			<h4>404 Page Not Found</h4>
 
			<p>Date and Time: <?php echo date('M d, Y H:i'); ?></p>

			<table id="datatable" class="table table-striped table-bordered table-hover">
			   
			  <thead>
			    <tr style="font-size: 12px;">
			    	<th>Type</th>
			    	<th>Message</th>
			    	<th>Filename</th>
			    	<th>Line Number</th>
			    </tr>
			  </thead>
			  <tbody>
			  	<tr>
			  		<td>404</td>
			  		<td><?php echo strip_tags($message); ?></td>
			  		<td><?php echo @$_SERVER['REQUEST_URI']; ?></td>
			  		<td>0</td>
			  	</tr>
			  </tbody>
			</table>
 

			 

		</div>
	</div>
</div>
</body>