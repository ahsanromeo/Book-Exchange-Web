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
        <li class="active"><a href="post.php">Post Ad</a></li>
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
		$title = $_POST['title'];
		$bookName = $_POST['bookName'];
		$writter = $_POST['writter'];
		$rate = $_POST['rate'];
		$des = $_POST['des'];
        $cat = implode(',',$_POST['cat']);
        $cat2 = $_POST['newCat'];
        if($cat2 != ''){
            $cat = $cat.','.$cat2;
        }
        $date = date('j M, Y');
        $file = $_FILES['bookImage']['name'];
        $folder = 'upload';
        move_uploaded_file($_FILES['bookImage']['tmp_name'],$folder.'/'.$file);

		$sql = "INSERT INTO `post`(`title`,`book_name`,`writter`,`rate`,`des`,`category`,`u_name`,`date`,`image`) VALUES ('$title','$bookName','$writter','$rate','$des','$cat','$username','$date','$file')";
		if($conn->exec($sql)){
			echo "<p>Successfully Post.</p>";
		}

        if($cat2 != ''){
            $cat3 = explode(',',$cat2);
            for($i = 0; $i < sizeof($cat3); $i++){
                $sql1 = "INSERT INTO `category`(`cat_name`) VALUES ('".$cat3[$i]."')";
                $conn->exec($sql1);
            }
        }
	}

    
?>
</div>

<?php
	if($login != 0)
	{
?>
<!-- Login Form start-->
<div id="loginForm">
	<h2>Post For Exchange</h2>
    <form class="form-horizontal" role="form" method="post" enctype="multipart/form-data">
        <div class="form-group">
            <label class="col-sm-2 control-label">Title</label>
            <div class="col-sm-10">
                <input type="text" class="form-control"  name="title">
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-2 control-label" >Book Name</label>
            <div class="col-sm-10">
                <input type="text" class="form-control"  name="bookName">
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-2 control-label" >Writter</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" name="writter">
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-2 control-label">Rate</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" name="rate">
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-2 control-label">Description</label>
            <div class="col-sm-10">
                <textarea class="form-control" cols="30" rows="4" name="des"></textarea>
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-2 control-label" for="address">Category</label>
            <div class="col-sm-10">
                <div class="checkbox catList">
                  <label>
                    <input type="checkbox" name="cat[]" checked value="Uncategorised">Uncategorised
                  </label>
                </div>
                <?php  
                    $check = $conn->query("SELECT * FROM category");
                    foreach ($check as $val) {
                ?>
                <div class="checkbox catList">
                  <label>
                    <input type="checkbox" name="cat[]" value="<?php echo $val['cat_name']; ?>"><?php echo $val['cat_name']; ?>
                  </label>
                </div>
                <?php } ?>
                <br>
                <button class="btn btn-success addNew">Add New</button>
                <input type="text" class="form-control" placeholder="Please use comma (,) for multiple" name="newCat">
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-2 control-label" for="age">Image</label>
            <div class="col-sm-10">
                <input type="file" name="bookImage">
            </div>
        </div>
                
        <div class="form-group">
        	<div class="col-sm-offset-2 col-sm-10">
        		<button type="submit" name="update" class="btn btn-default">Post</button>
            </div>
        </div>
    </form>
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