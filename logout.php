<?php 
	 $past = time() - 3600; 
	 setcookie('P_username', 'gone', $past); 
	 setcookie('P_password', 'gone', $past); 
	 header("Location: index.php"); 
 ?> 