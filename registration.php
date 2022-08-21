<?php
	//including config file
	include('configuration.php');
	
	//connecting with database
    $conn = new PDO("mysql:host=$host;dbname=$db",$user,$pw);

	//checking login id and password
	$login = 0;
	$success = 1;
	
	//Checking login id with cookie
	if(isset($_COOKIE['username']))
	{ 	
		$username = $_COOKIE['username']; 	
		$pass = $_COOKIE['password']; 	 	
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
        <li class="active"><a href="registration.php">Registration</a></li>
        <li><a href="login.php">Login</a></li>
        <?php } else{ ?>
        <li><a href="user-profile.php">My Profile</a></li>
        <li><a href="logout.php">Logout</a></li>
        <?php } ?>
      </ul>      
    </div><!-- /.navbar-collapse -->
  </div><!-- /.container-fluid -->
</nav>
<div class="container error">
<?php  
	
	if(isset($_REQUEST['reg'])){
		$uUname = $_POST['pUsername'];	
		$uPass = $_POST['pPass'];
		$uFname = $_POST['pname'];
		$uAdd = $_POST['address'];
		$uMobile = $_POST['mobile'];
		$uSex = $_POST['sex'];
		$uEmail = $_POST['email'];

		$sql = "INSERT INTO user(`name`,`address`,`mobile`,`sex`,`email`,`username`,`password`) VALUES ('$uFname','$uAdd','$uMobile','$uSex','$uEmail','$uUname','$uPass')";
		if($uUname != ""){
			$check = $conn->query("SELECT * FROM user WHERE username = '$uUname'");
			if($check->rowCount() == 0){
				if($uPass != "" && $uEmail != ""){
					if($uPass != "" && $uEmail != ""){
					$conn->exec($sql);
					$hour = time() + 3600;
					setcookie('U_username', $uUname, $hour);
					setcookie('U_password', $uPass, $hour);
					header('Location:user-profile.php');
				}
				}
				else{
					echo "<p>Please fillup the required field.</p>";
				}
			}
			else{
				echo "<p>Username already exists</p>";
			}
		}else{
			echo "<p>Username empty</p>";
		}
	}
?>
</div>

<?php
	if($login == 0)
	{
?>
<!-- Login Form start-->
<div id="loginForm">
	<h2>User Registration</h2>
    <form class="form-horizontal" role="form" method="post">
        <div class="form-group">
            <label class="col-sm-2 control-label" for="username">Username*</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" id="username" name="pUsername">
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-2 control-label" for="pass">Password*</label>
            <div class="col-sm-10">
                <input type="password" class="form-control" id="username" name="pPass">
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-2 control-label" for="name">Full Name</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" id="name" name="pname">
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-2 control-label" for="address">Address</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" id="address" name="address">
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-2 control-label" for="age">Mobile</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" id="age" name="mobile">
            </div>
        </div>
        
        <div class="form-group">
            <label class="col-sm-2 control-label" for="sex">Sex</label>
            <div class="col-sm-10">
                <div class="radio">
				  <label>
				    <input type="radio" name="sex" id="sex1" value="male" checked>
				    Male
				  </label>
				  <label>
				    <input type="radio" name="sex" id="sex2" value="female">
				    Female
				  </label>
				</div>
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-2 control-label" for="age">Email*</label>
            <div class="col-sm-10">
                <input type="email" class="form-control" id="mail" name="email">
            </div>
        </div>
        
        <div class="form-group">
        	<div class="col-sm-offset-2 col-sm-10">
        		<button type="submit" name="reg" class="btn btn-default">Register</button>
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
?>

<script type="text/javascript" src="js/jquery-1.11.1.min.js"></script>
<script type="text/javascript" src="js/bootstrap.min.js"></script>
</body>
</html>
<?php
	}
?>