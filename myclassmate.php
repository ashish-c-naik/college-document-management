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
    if($_GET['drop']=="logout")
    {
        session_destroy();
        header('Location:admin.php');
    }
    if($_GET['drop']=="upload")
        header('Location:upload.php');
    if($_GET['drop']=="permission")
        header('Location:permission.php');
    if($_GET['drop']=="changepass")
        header('Location:profile.php');
    $article = $data->fetch_data($_SESSION['username']);
 
}
?>
<html >
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
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css">
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

          <li><a href="register.php">Sign Up</a></li>
          
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
                                <option value="upload">
                                    Upload Files</option>
                                <option value="logout">
                                    Log out</option>
                                <option value="permission">
                                    Permission</option>
                                    <option value="changepass">
                                    Edit Profile</option>     
                                                         
                        </select>
                    </form>
                    <?php }
                    else{ ?><a href="admin.php">Log In</a></li><?php }?> 

          <li><a href="#">Help</a></li>
        </ul>
      </div>
    </div>
<div class="jumbotron">
    <div class="container">
        <h1>Welcome to my Class-mate</h1>
        <p>A one place stop for all your college documents.</p>
        <a href="#">Learn More</a>
    </div>
</div>
    
    <div class="Select-class">
    <div class="container">
    <h2>Classrooms</h2>
    <p>Select your class.</p>
    <div class="row">
    <div class="col-md-3">
    <div class="FE" ontouchstart="this.classList.toggle('hover');">
    <div class= "flipper">
    <div class="front">
    <p>First year</p>
    </div>
    <div class="back">
        <form action="" method="GET">
            <select name="fe" id="fe" onchange="this.form.submit();">
                <option value="fe1">FE1</option>
                <option value="fe2">FE2</option>
                <option value="fe3">FE3</option>
                <option value="fe4">FE4</option>
                <option value="fe5">FE5</option>
                <option value="fe6">FE6</option>
                <option value="fe7">FE7</option>
            </select>
        </form>
    </div>
    </div>
    </div>
    </div>

    <div class="col-md-3">
    <div class="SE" ontouchstart="this.classList.toggle('hover');">
    <div class= "flipper">
    <div class="front">
    <p><font-size="18px">Second year</font></p>
    </div>
    <div class="back">
        <form action="" method="GET">
            <select name="se" id="se"onchange="this.form.submit();">
                <option value="seita">SE IT-A</option>
                <option value="seitb">SE IT-B</option>
                <option value="secmpna">SECMPN-A</option>
                <option value="secmpnb">SECMPN-B</option>
                <option value="seextca">SEEXTC-A</option>
                <option value="seextcb">SEEXTC-B</option>
            </select>
        </form>
    </div>
    </div>
    </div>
    </div>

    <div class="col-md-3">
     <div class="TE" ontouchstart="this.classList.toggle('hover');">
     <div class= "flipper">
    <div class="front">
     <p>Third year</p>
     </div>
    <div class="back">
        <form action="" method="GET">
            <select name="te" id="te"onchange="this.form.submit();">
                <option value="teita">TE IT-A</option>
                <option value="teitb">TE IT-B</option>
                <option value="tecmpna">TECMPN-A</option>
                <option value="tecmpnb">TECMPN-B</option>
                <option value="teextca">TEEXTC-A</option>
                <option value="teextcb">TEEXTC-B</option>
            </select>
        </form>
    </div>
    </div>
    </div>
    </div>
    
    <div class="col-md-3">
    <div class="BE" ontouchstart="this.classList.toggle('hover');">
    <div class= "flipper">
    <div class="front">
    <p>Fourth year</p>
    </div>
    <div class="back">
    <form action="" method="GET">
            <select name="be" id="be"onchange="this.form.submit();">
                <option value="beita">BE IT-A</option>
                <option value="beitb">BE IT-B</option>
                <option value="becmpna">BECMPN-A</option>
                <option value="becmpnb">BECMPN-B</option>
                <option value="beextca">BEEXTC-A</option>
                <option value="beextcb">BEEXTC-B</option>
            </select>
        </form>
    </div>
    </div>
    </div>
    </div>
    
    </div>
    </div>
    </div>
<?php 
    if(isset($_GET['fe'])){
        $_SESSION['page']=$_GET['fe'];
        header('Location:filedisplay.php');
    }
    if(isset($_GET['se'])){
        $_SESSION['page']=$_GET['se'];
        header('Location:filedisplay.php');
    }if(isset($_GET['te'])){
        $_SESSION['page']=$_GET['te'];
        header('Location:filedisplay.php');
    }if(isset($_GET['be'])){
        $_SESSION['page']=$_GET['be'];
        header('Location:filedisplay.php');
    }
?>


</body>
</html>
