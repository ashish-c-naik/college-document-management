<?php
session_start();
include_once('include/connection.php');
include_once('include/data.php');


$data  	= new Article();
$data1 = new display();
if(isset($_SESSION['logged_in'])){
	
	if($_GET['drop']=="logout")
    {
        session_destroy();
        header('Location:admin.php');
    }
     if($_GET['drop']=="upload")
        header('Location:upload.php');

    $article = $data->fetch_data($_SESSION['username']);

   	


}$_SESSION['page1'] =$_GET['name'];
$d = $data1->display_subject($_SESSION['page']);


?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>


<style>

ul.this li{
    float:left;
}li img{
    border-radius: 150px;
}
td{
  line-height: 150px;
  width:500px;
  border-bottom: 2px solid ;
}
a:link{
  color: blue;
  text-decoration: none;
}
a:hover,a:visited{
  color: blue;
  text-decoration: none;
}
span{
  color:red;
  font-size: 25px;
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

<!-- table 1 -->
<table  align="center" cellpadding="10">
<tr><?php
          foreach ($d as $key => $value) {
            foreach($value as $k => $v) {
            if(is_string($k)){
              ?>
              <?php if($k != 'sem'){?><td>
                <a href="file.php?sub=<?php echo $v; ?>"><?php echo $v; ?></a>
                </td>
                <?php }?>
              
              
                <?php if($k=="sem"){
                  ?> <td><?php 
                  echo '<span>'.'SEM '.$v.'</span>';
                
                ?>  
              </td>
            </tr>
            <tr>

              <?php 
            }}
          }
          }        
    ?>
</tr>
</table>




</table>
</body>
</html>