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
        <li><a href="index.php">Home</a></li>
        <li class="active"><a href="about.php">About us</a></li>
        <li><a href="contact.php">Contact us</a></li>
        <?php if ($login == 0) {?>
        <li><a href="registration.php">Registration</a></li>
        <li><a href="login.php">Login</a></li>
        <?php } else{ ?>
        <li><a href="user-profile.php">My Profile</a></li>
        <li><a href="logout.php">Logout</a></li>
        <?php } ?>
      </ul>   
    </div><!-- /.navbar-collapse -->
  </div><!-- /.container-fluid -->
</nav>

<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <h2>About Us</h2>

            <h3>Khulna University</h3>
            <p>Khulna University was established in 1991.</p>

            <h3>CSE Discipline</h3>
            <p>CSE Discipline is one of the starting discipline of Khulna University</p>

            <h3>Web Programming Lab</h3>
            <p>Web Programming Lab is a course for web programming in CSE KU syllebus.</p>
        </div>
    </div>
</div>
<?php include('include/footer.php'); ?>
</body>
</html>
