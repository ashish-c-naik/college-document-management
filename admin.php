<!-- 
  Created by : Ashish Chandrakant Naik
  2013 - 2017
  St. francis Institute of tech
-->
<?php
session_start();
include_once('include/connection.php');
if(isset($_SESSION['logged_in'])){

header('Location:myclassmate.php');
}
else{
if(isset($_POST['username'] , $_POST['password'])  ){
		$username = $_POST['username'];
		$password = md5($_POST['password']);
		$_SESSION["username"] = $username;
	
		if(empty($username) or empty($password)){

		$error = 'All fields are Reqiured';
		}else{
			$query = $pdo->prepare("select * from user where username =? and password =?");
			$query->bindValue(1,$username);
			$query->bindValue(2,$password);

			$query->execute();
				
			$num = $query->rowCount();
			if($num == 1){
				//user entered right details 
				$_SESSION['logged_in'] = True;
				header('Location:myclassmate.php');
				exit(0);
			}else{
				//user entered wrong details
				$error = 'Incorrect Details';
			}
		}	
	}
?>
	<html>
		<head>
			<title>Cms trials</title>
			<link href="../assets/style.css" rel="stylesheet"/>
		</head>

		<body>
				<div class="container">
					<a href="myclassmate.php"  id="logo"> classmate </a>
					<br /><br />
					<?php if(isset($error)){  
						
						?>
						<span>
							<?php echo $error; ?>
						</span>
						<?php  }?> <br><br>
					<form action="admin.php" method="post"autocomplete="off" >
						<input type = "text" name="username" placeholder="Username">
						<input type = "password" name="password" placeholder="Password">
						<input type="submit" value="Login" />
					</form>
				</div>
		</body>


	</html>

<?php
}
?>
