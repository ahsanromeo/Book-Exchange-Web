<?php
	//including config file
	include('configuration.php');
	
	//connecting with database
    $conn = new PDO("mysql:host=$host;dbname=$db",$user,$pw);

	//checking login id and password
	$login = 0;
	$success = 1;
	if (isset($_POST['submit'])) 
	{ 
		if($_POST['username'] != "" || $_POST['password'] != "") {
			$check = $conn->query("SELECT * FROM user WHERE username = '".$_POST['username']."'");
			$check2 = $check->rowCount();
			
			if ($check2 != 0) {
				foreach($check as $info) 	
				{
				 	$_POST['password'] = stripslashes($_POST['password']);
				 
					if ($_POST['password'] != $info['password']) {
						$login = 0;
						$success = 0;
					}
					else
					{
						$_POST['username'] = stripslashes($_POST['username']);
						$hour = time() + 3600;
						setcookie('P_username', $_POST['username'], $hour);
						setcookie('P_password', $_POST['password'], $hour);
						$login = 1;
					}
				}
			}
		}
	}
	
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
        <li><a href="index.php">Home</a></li>
        <li><a href="about.php">About us</a></li>
        <li><a href="contact.php">Contact us</a></li>
        <?php if ($login == 0) {?>
        <li><a href="registration.php">Registration</a></li>
        <li class="active"><a href="login.php">Login</a></li>
        <?php } else{ ?>
        <li><a href="user-profile.php">My Profile</a></li>
        <li><a href="logout.php">Logout</a></li>
        <?php } ?>
      </ul>     
    </div><!-- /.navbar-collapse -->
  </div><!-- /.container-fluid -->
</nav>

<?php
	if($login == 0)
	{
?>
<!-- Login Form start-->
<div id="loginForm">
	<h2>User Login</h2>
    <form class="form-horizontal" role="form" method="post">
        <div class="form-group">
            <label class="col-sm-2 control-label" for="username">Username</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" id="username" name="username" placeholder="Username">
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-2 control-label" for="Password">Password</label>
            <div class="col-sm-10">
            	<input type="password" class="form-control" id="Password" name="password" placeholder="Password">
            </div>
        </div>
        <?php if($success == 0){?>
		<p class="text-danger">Incorrent username or password</p>
        <?php }?>
        <div class="form-group">
        	<div class="col-sm-offset-2 col-sm-10">
        		<button type="submit" name="submit" class="btn btn-default">Login</button>
            </div>
        </div>
    </form>
</div>
<!-- Login form end -->
<?php include('include/footer.php'); ?>
<?php 
	} 
	else
	{
		header('Location:user-profile.php');
?>
</body>
</html>
<?php
	}
?>