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
        <li class="active"><a href="index.php">Home</a></li>
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
      <div class="col-md-8">
        <?php  
          $check = $conn->query("SELECT * from post ORDER BY id DESC");
          if(isset($_REQUEST['cat'])){
            $cat = $_REQUEST['cat'];
            $check = $conn->query("SELECT * from post WHERE category LIKE '%$cat%' ORDER BY id DESC");
          }
          if($check->rowCount() == 0){
            echo "<h2>No post yet</h2>";
          }
          else{
            foreach ($check as $post) {
        ?>
        <article>
          <h2 style="color: green;"><?php echo $post['title']; ?></h2>
          <span class="publish-info">
            <i>Posted by:</i> 
            <?php  
              $u_name = $post['u_name'];
              $u_info = $conn->query("SELECT * from user WHERE username = '$u_name'");
              foreach ($u_info as $info) {
                $user = $info['name'];
                $phone = $info['mobile'];
                $mail = $info['email'];
              }
              echo '<a href="profile.php?user='.$u_name.'">'.$user.'</a>';
            ?> 
            <i>Posted On:</i> <?php echo $post['date']; ?>
          </span>
          <div class="wrapper-block">
            <img src="upload/<?php echo $post['image']; ?>" alt="">
            <div class="book-des">
              <p>Book Name: <strong><?php echo $post['book_name']; ?></strong><br>Writter: <strong><?php echo $post['writter']; ?></strong><br>Category: <strong><?php echo $post['category']; ?></strong><br>Description: <strong><?php echo $post['des']; ?></strong><br>Rate: <strong><?php echo $post['rate']; ?></strong><br>Cell: <strong><?php echo $phone; ?></strong><br>Mail: <a href="mailto:<?php echo $mail; ?>"><strong><?php echo $mail; ?></strong></a>
            </div>
          </div>
        </article>
        <?php 
            }
          } 
        ?>
      </div>
      <div class="col-md-4 sidebar">
        <h2>Category</h2>
        <ul>
          <?php  
            $cats = $conn->query("SELECT * from category");
            foreach ($cats as $cat) {
              echo '<li><a href="index.php?cat='.$cat['cat_name'].'">'.$cat['cat_name'].'</a></li>';
            }
          ?>
        </ul>
      </div>
    </div>
</div>
<?php include('include/footer.php'); ?>
<script type="text/javascript" src="js/jquery-1.11.1.min.js"></script>
<script type="text/javascript" src="js/bootstrap.min.js"></script>
<script src="js/custom.js"></script>
</body>
</html>
