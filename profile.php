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
        <li><a href="about.php">About us</a></li>
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
      <?php  
        if(isset($_REQUEST['user'])){
          $user = $_REQUEST['user'];
        }
        $check = $conn->query("SELECT * from user WHERE username = '$user'");
        foreach ($check as $info) {
      ?>
      <div class="col-md-8">
        <h2><?php echo $info['name']; ?>'s Recent Post</h2>
        <?php  
          $check1 = $conn->query("SELECT * from post WHERE u_name = '$user'");
          foreach ($check1 as $post) {
        ?>
          <article>
            <h3><?php echo $post['title']; ?></h3>
            <span class="publish-info"><i>Published On:</i> <?php echo $post['date']; ?></span>
            <div class="wrapper-block">
              <img src="upload/<?php echo $post['image']; ?>" alt="">
              <div class="book-des">
                <p>Book Name: <strong><?php echo $post['book_name']; ?></strong><br>Writter: <strong><?php echo $post['writter']; ?></strong><br>Category: <strong><?php echo $post['category']; ?></strong><br>Description: <strong><?php echo $post['des']; ?></strong><br>Rate: <strong><?php echo $post['rate']; ?></strong>
              </div>
            </div>
          </article>
        <?php  
          }
        ?>
      </div>
      <div class="col-md-4 sidebar">
        <h2>Bio of '<?php echo $info['name']; ?>'</h2>
        <p><?php echo $info['bio']; ?></p>
        <br>
        <h3>Contact</h3>
        <p><?php echo $info['address']; ?><br><?php echo $info['mobile']; ?><br><?php echo $info['email']; ?></p>
      </div>
      <?php 
        } 
      ?>
    </div>
</div>
<?php include('include/footer.php'); ?>
<script type="text/javascript" src="js/jquery-1.11.1.min.js"></script>
<script type="text/javascript" src="js/bootstrap.min.js"></script>
<script src="js/custom.js"></script>
</body>
</html>
