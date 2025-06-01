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
	          VALUES ('" . get_class($exception) . "', '" . $message . "', '" . @$_SERVER['REQUEST_URI'] . "', '" . date('Y-m-d H:i:s') . "', '" . (@$_SESSION['user_id']) . "', '" . $exception->getLine() . "')"; 
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
      			
			<h4>An uncaught Exception was encountered</h4>

			<p>User Account: <?php echo @$user['name']; ?></p>
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
			  		<td><?php echo get_class($exception); ?></td>
			  		<td><?php echo $message; ?></td>
			  		<td><?php echo @$_SERVER['REQUEST_URI']; ?></td>
			  		<td><?php echo $exception->getLine(); ?></td>
			  	</tr>
			  </tbody>
			</table>
 

			<!-- <p>Type: <?php echo get_class($exception); ?></p>
			<p>Message: <?php echo $message; ?></p>
			<p>Filename: <?php echo $exception->getFile(); ?></p>
			<p>Line Number: <?php echo $exception->getLine(); ?></p> -->



			<?php if (defined('SHOW_DEBUG_BACKTRACE') && SHOW_DEBUG_BACKTRACE === TRUE): ?>

				<p>Backtrace:</p>
				<?php foreach ($exception->getTrace() as $error): ?>

					<?php if (isset($error['file']) && strpos($error['file'], realpath(BASEPATH)) !== 0): ?>

						<p style="margin-left:10px">
						File: <?php echo $error['file']; ?><br />
						Line: <?php echo $error['line']; ?><br />
						Function: <?php echo $error['function']; ?>
						</p>
					<?php endif ?>

				<?php endforeach ?>

			<?php endif ?>
 

		</div>
	</div>
</div>
</body>