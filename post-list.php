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
        <li><a href="bio.php">My Bio</a></li>
        <li><a href="post.php">Post Ad</a></li>
        <li class="active"><a href="post-list.php">View My List</a></li>
        <li><a href="logout.php">Logout</a></li>
        <?php } ?>
      </ul>      
    </div><!-- /.navbar-collapse -->
  </div><!-- /.container-fluid -->
</nav>


<?php
	if($login != 0)
	{
?>
<div class="container">
    <h2>My LIST</h2>

    <?php  
      //Code for delete
      if(isset($_REQUEST['delId'])){
        $delId = $_REQUEST['delId'];

        $conn->exec("DELETE from post WHERE id = '$delId'");
      }

      $check = $conn->query("SELECT * from post WHERE u_name = '$username' ORDER BY id DESC");
      if($check->rowCount() == 0){
        echo "<h2>No post yet</h2>";
      }
      else{
        foreach ($check as $post) {
    ?>
    <div class="row">
      <div class="col-md-7">
        <article>
          <h2 style="color: green;"><?php echo $post['title']; ?></h2>

          <span class="publish-info"><i>Published On:</i> <?php echo $post['date']; ?></span>
          <div class="wrapper-block">
            <img src="upload/<?php echo $post['image']; ?>" alt="">
            <div class="book-des">
              <p>Book Name: <strong><?php echo $post['book_name']; ?></strong><br>Writter: <strong><?php echo $post['writter']; ?></strong><br>Category: <strong><?php echo $post['category']; ?></strong><br>Description: <strong><?php echo $post['des']; ?></strong><br>Rate: <strong><?php echo $post['rate']; ?></strong>
            </div>
          </div>
        </article>
      </div>
      <div class="col-md-5">
        <br><a href="post-edit.php?editId=<?php echo $post['id']; ?>" class="btn-action">Edit</a><br>
        <a href="post-list.php?delId=<?php echo $post['id']; ?>" class="btn-action btn-delete">Delete</a>
      </div>
      <?php 
          }
        } 
      ?>
    </div>
</div>
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