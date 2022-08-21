<?php
	//including config file
	include('configuration.php');
	
	//connecting with database
    $conn = new PDO("mysql:host=$host;dbname=$db",$user,$pw);

	//checking login id and password
	$login = 0;
	$success = 1;
	
	
	//Checking login id with cookie
	if(isset($_COOKIE['P_username']))
	{ 	
		$username = $_COOKIE['P_username']; 	
		$pass = $_COOKIE['P_password']; 	 	
		$check = $conn->query("SELECT * FROM user WHERE username = '$username'"); 	
		foreach($check as $info) 	 		
		{ 		
			if ($pass != $info['password']) 			
			{
				$login = 0;
			} 		
			else 			
			{ 			
				$login = 1; 
			} 		
		} 
	}
?>


<?php include('include/header.php'); ?>

<nav class="navbar">
  <div class="container">
    <!-- Brand and toggle get grouped for better mobile display -->
    <div class="navbar-header">
      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
    </div>

    <!-- Collect the nav links, forms, and other content for toggling -->
    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
      <ul class="nav navbar-nav">
        <li><a href="http://localhost/bew/">Home</a></li>
        <li><a href="user-profile.php">Profile</a></li>
        
        <?php if($login !=0) {?>
        <li class="active"><a href="bio.php">My Bio</a></li>
        <li><a href="post.php">Post Ad</a></li>
        <li><a href="post-list.php">View My List</a></li>
        <li><a href="logout.php">Logout</a></li>
        <?php } ?>
      </ul>      
    </div><!-- /.navbar-collapse -->
  </div><!-- /.container-fluid -->
</nav>
<div class="container error">
<?php  
	
	if(isset($_REQUEST['update'])){
		$bio = $_POST['bio'];

		$sql = "UPDATE user SET bio = '$bio' WHERE username = '$username'";
		$conn->exec($sql);
	}

    
?>
</div>

<?php
	if($login != 0)
	{
?>
<!-- Login Form start-->
<div id="loginForm">
	<h2>My Bio</h2>
	<?php  
		$check = $conn->query("SELECT * FROM user WHERE username = '$username'");
		foreach ($check as $val) {
	?>
    <form class="form-horizontal" role="form" method="post">
        <div class="form-group">
            <textarea class="form-control" cols="30" rows="8" name="bio"><?php echo $val['bio'] ?></textarea>
        </div>
        
        <div class="form-group">
        	<button type="submit" name="update" class="btn btn-default">Update</button>
        </div>
    </form>
    <?php  
    	}
    ?>
</div>
<!-- Login form end -->
<?php include('include/footer.php'); ?>
<?php 
	} 
	else{
		header('location:login.php');
	}
?>
<script type="text/javascript" src="js/jquery-1.11.1.min.js"></script>
<script type="text/javascript" src="js/bootstrap.min.js"></script>
<script src="js/custom.js"></script>
</body>
</html>