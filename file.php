<?php
session_start();
ob_start();
include_once('include/connection.php');
include_once('include/data.php');


$data  	= new Article();
if(isset($_SESSION['logged_in'])){
	if($_GET['drop']=="logout")
    {
        session_destroy();
        header('Location:admin.php');
    }
     if($_GET['drop']=="upload")
        header('Location:upload.php');
    $article = $data->fetch_data($_SESSION['username']);
    

}$_SESSION['page2']=$_GET['sub'];
?>
<!DOCTYPE html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <link href="http://s3.amazonaws.com/codecademy-content/courses/ltp/css/shift.css" rel="stylesheet">
    
    <link rel="stylesheet" href="http://s3.amazonaws.com/codecademy-content/courses/ltp/css/bootstrap.css">
<link rel="stylesheet" href="class.css">


    <link rel="stylesheet" href="main.css">
<title>**My Classmate**</title>
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
}ul.this li img{
    border-radius: 150px;
}
</style>
</head>
<body>
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
                            
                                <option value="user"style="background:url(<?php echo $article['photo']; ?>);" class="this2">
                                     <?php echo $_SESSION["username"]; ?></option>
                                <option value="upload">
                                    Upload Files</option>
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

<div class = "FEdiv">
<h1><br>Select an option for <?php echo strtoupper($_SESSION['page']);?><br></br></h1>
<div class="row">
<div class=col-md-3>
<ul>
<li>Assignment<br><a href = "filedisplay1.php?name=assignment" ><img src="download.jpg"  width="184" height="184"></li>
<li>Tutorial<br><a href = "filedisplay1.php?name=tutorial"><img src="download.jpg"  width="184" height="184"></li>
</ul>
</div>
<div class=col-md-3>
<ul>
<li>Question bank<br><a href = "filedisplay1.php?name=qb" ><img src="download.jpg"  width="184" height="184"></li>

</ul>
</div>
<div class=col-md-3>
<ul>
<li>Practicals<br><a href = "filedisplay1.php?name=practical"><img src="download.jpg"  width="184" height="184"></li>
</ul>
</div>
</div>
</body>
</html>
<?php
	
?>