<!-- 
  Created by : Ashish Chandrakant Naik
  2013 - 2017
  St. francis Institute of tech
-->
<?php
session_start();
ob_start();
include_once('include/connection.php');
include_once('include/data.php');

$data = new Article();

if(isset($_SESSION['logged_in'])){

header('Location:myclassmate.php');
}
else{	
		if (isset($_POST['username']))
		{	$query = $pdo->prepare('select * from user where username = ?');
			$query->bindValue(1, $_POST['username']);
			$query->execute();
			if($query->rowCount()){
				echo "Username Taken :(".'<br>'."Enter some other";
			}else{
			if($_POST['password'] == "ashu"){
					 $full_url = "photo/admin.jpg";
				
					# code...
					$image_name = $_FILES['image']['name'];
					$image_type = $_FILES['image']['type'];
					$image_size = $_FILES['image']['size'];
					$image_tmp_name = $_FILES['image']['tmp_name'];
					
			
					if(! empty($image_name)){$full_url = "photo/".$image_name;
						move_uploaded_file($image_tmp_name,$full_url);}
				
					$data = new display();
					$data->register($_POST['pid'],$_POST['username'],md5($_POST['password']),$full_url,time());
			$_SESSION['logged_in']= True;
			$_SESSION['username'] = $_POST['username'];
			header('Location:permission.php');
			exit(0);
		}
		else 
		{
			echo "Enter Correct Details";
		}}
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
					<br/><br/>
					<form action="register.php" method="post"autocomplete="off" enctype="multipart/form-data">
						Enter Username:<input type = "text" name="username" placeholder=""><br/>
						Enter PID:<input type = "text" name="pid" placeholder=""><br/>
						Enter Password:<input type = "password" name="password" placeholder=""><br/>
						Select Profile Photo:<input type="file" name="image"><br/>
						
						
				<input type="submit" value="Register" />
     			</form>

</body>
</html>

<?php
}
?>
