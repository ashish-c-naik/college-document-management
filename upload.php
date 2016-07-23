<?php
session_start();
include_once('include/connection.php');
include_once('include/data.php');





$data  	= new Article();
$data1 	= new fetchsubject();
$data_1 = new fetch_subject();
$data2 	= new fetchbelonging();
$file = new file_upload();
$file_db = new file_db();
if(isset($_SESSION['logged_in'])){
	
	if($_GET['drop']=="logout")
    {
        session_destroy();
        header('Location:admin.php');
    }


    $article = $data->fetch_data($_SESSION['username']);
    $article_subject = $data1->fetch_sub($article['PID']);
   	$_SESSION['pid']=$article['PID'];
   	
   	$subject_name = $_POST['id'];

	if(isset($_POST['id'])){
	$selected = $_POST['id'];

	
	$article_user = $data_1->fetch_sub_($selected,$_SESSION['pid']);
	


	//class selected from 2nd dropdown 
	$class_selected = $_POST['id2'];
	

	
	$serial = $article_user[0]['serial'];
	$class = $article_user[0]['class'] ;
	$article_user_ = $data2->fetch_bel($serial,$class_selected,$_SESSION['pid']);
	



	$division_selected = $_POST['id3'];
	
	
	
	//we renewed the array
	
	$array_ = $article_user_;
	
}	

	if($_POST['id'] !="none" ){
	$_SESSION["spy_subject"] = $_POST['id'];
	//store
	$_SESSION["spy_class"]= $article_user[0]['class'];

	
}if( $_POST['id1'] != "none"){//STORE
	

	$_SESSION["spy_type"] = $_POST['id1'];}

if( $_POST['id3'] != "none"){
	$row = count($article_user_,COUNT_RECURSIVE);
	try{$column = count($article_user_,COUNT_RECURSIVE)/count($article_user_);
	}
	catch(Exception $e){
		echo "error";
	}
	for ($i=0; $i < count($article_user_); $i++) { 
		
		
				# code...
				
				if($article_user_[$i]["division"]==$division_selected){
					$_SESSION["spy_div"] = $article_user_[$i]['serial_division'];
					$_SESSION['spy_'] = $article_user_[$i]['division'];
					
			}	
	}
}
	
	

	
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>


<style>
/* unvisited link */
a:link {
    color: #000000;
}

/* visited link */
a:visited {
    color: #0000FF;
}

/* mouse over link */
a:hover {
    color: #FF00FF;
}

/* selected link */
a:active {
    color: #FF00FF;
}
ul.this li{
    float:left;
}li img{
    border-radius: 150px;
}
</style>

<!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.2/css/bootstrap.min.css">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <link href="http://s3.amazonaws.com/codecademy-content/courses/ltp/css/shift.css" rel="stylesheet">
    
    <link rel="stylesheet" href="http://s3.amazonaws.com/codecademy-content/courses/ltp/css/bootstrap.css">
    <link rel="stylesheet" href="main.css">
    
<title>My-Classmate</title>
</head>

<body link="#000000">
    <div class="nav">
      <div class="container">
        <ul class="pull-left">
          <li class="active"><a href="myclassmate.php">Home</a></li>
          <li><a href="#">Status</a></li>
          <li><a href="#">Class</a></li>
        </ul>
        <ul class="pull-right col-lg-5 this">
            <?php if(! $_SESSION['logged_in']){?>

          <li><a href="#">Sign Up</a></li>
          
            <?php } ?>
          <?php if($_SESSION['logged_in']){?>
          <li><a href="#"><img src="<?php echo $article['photo']; ?>" width="100"></a></li><?php } ?>
          <li>
            <?php
            if(isset($_SESSION['logged_in'])){
          ?>
          <form action="Myclassmate.php" method='get'>
                        <select onchange='this.form.submit();' name ='drop'>
                            
                                <option value="user"style="background:url(<?php echo $article['photo']; ?>);">
                                     <?php echo $_SESSION["username"]; ?></option>
                                
                                <option value="logout">
                                    Log out</option>

                                                         
                        </select>
                    </form>
                    <?php }
                    else{ ?><a href="admin.php">Log In</a></li><?php }?> 

          <li><a href="#">Help</a></li>
        </ul>
      </div>
    </div>
<form action="" method="post" enctype="multipart/form-data">

<br>
<?php
	if(isset($_SESSION['logged_in'])){ ?>

 Select Subject:
	<select onchange="this.form.submit();" name="id" id="id">
		<option value="none">---select---</option>
		<?php foreach ($article_subject as $article1) { ?>
								<option value="<?php echo $article1['name'];?>" >
									<?php echo $article1['name'];?></option>

        <?php } ?> 
            </select>
             <?php } ?> 


             <br>
             <?php
	if(isset($_SESSION['logged_in'])){ ?>

 Select class:
	<select onchange="this.form.submit();" name="id2" id="id2">
		<option value="none">---select---</option>
		<?php foreach ($article_user as $article1) { ?>
								<option value="<?php echo $article1['class'];?>" >
									<?php echo $article1['class'];?></option>

        <?php } ?> 
            </select>
             <?php } ?> 


  <br>
  Select division:
	<select onchange="this.form.submit();" name="id3" id="id3">
		<option value="none">---select---</option>
		<?php foreach ($article_user_ as $article1) { ?>
								<option value="<?php echo $article1['division'];?>" >
									<?php echo $article1['division'];?></option>

        <?php } ?> 
            </select>
    


  <br>


  <br> Select type of document:
	<select onchange="this.form.submit();" name="id1" id="id1">
		<option value="none">---select---</option>
			<?php 
				
				$i = 0;
				foreach ($array_ as $article => $article_value) {
					if($article_value[0] == $division_selected)
				{  
				foreach ($article_value as $key => $value) {
				if($value == $_SESSION['pid'] and ctype_alpha($key)){ 
				?>
				<option value="<?php echo $key; ?>">
						<?php echo $key; ?></option>

		<?php }}}} ?>
	</select>


<br>

Enter the name: <input type="text"name="file_name">
<br>
Select Image: <input type="file" name="image">

<input type="submit" name="upload" value="Upload Now">
</form>
<?php
if(isset($_POST['upload'],$_SESSION['logged_in']) )
	{		if(!isset($_POST['id'],$_POST['id1'])){
			echo "All fields Required!";
			}

			
$serial_array=$data->fetch_data($_SESSION['username']);
$serial_upload = $serial_array['serial'];
			

$serial_sub_array = $file->fetch_sub_div($_SESSION['spy_subject'],$_SESSION['pid'],$_SESSION['spy_class']);
$serial_sub = $serial_sub_array[0]['serial_sub_div'];

			$image_name = $_FILES['image']['name'];
			$image_type = $_FILES['image']['type'];
			$image_size = $_FILES['image']['size'];
			$image_tmp_name = $_FILES['image']['tmp_name'];
			$name = $_POST['file_name'];
			$info = pathinfo($_FILES['image']['name']);
 			$ext = $info['extension'];
			$name_ext = $name.".".$ext;
			$url=
"photo/files/".$_SESSION['spy_type']."/".$_SESSION['spy_class']."".$_SESSION['spy_']."/".$subject_name."/".$name_ext;	

			if(empty($image_name))
				echo "Select one file";
			else
				{	move_uploaded_file($image_tmp_name,$url);

			$url_detail = $_SESSION['spy_type']."_url";
			//$file->upload_db('ppt_url',2,2,2,"photo");
			echo $url;
			$file_db->upload_db($url_detail,$serial_upload,$serial_sub,$_SESSION['spy_div'],$url);	
			
		}
	}
?>

<script type="text/javascript" link=" https://cdnjs.cloudflare.com/ajax/libs/1140/2.0/1140.css">
	document.getElementById('id').value = "<?php echo $_POST['id'];?>";
	document.getElementById('id1').value = "<?php echo $_POST['id1'];?>";
	document.getElementById('id2').value = "<?php echo $_POST['id2'];?>";
	document.getElementById('id3').value = "<?php echo $_POST['id3'];?>";
</script>
</body>
</html>
<?php echo $url;

}

else{
	header('Location:admin.php');
} ?>