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
$data1 =new display();
$data2 = new display();
if(isset($_SESSION['logged_in'])){
    if($_GET['drop']=="logout")
    {
        session_destroy();
        header('Location:admin.php');
    }
    if($_GET['drop']=="upload")
        header('Location:upload.php');
     
     $article = $data->fetch_data($_SESSION['username']);
    #MISTAKE 
      if(isset($_POST['submit1'])){
       # code...
      $fetch_sub = $data2->fetch_sub($_POST['class']);
      
     }
      
    
    if (isset($_POST['submit'])) {
      # code...
      $get_serial = $data1->get_serial($_POST['sub'],$_SESSION['username']);
      $serial = $get_serial[0]['serial'];
      $pid =$get_serial[0]['PID'];
      
      $data1->per_relation($serial,$pid,$_POST['class']);

      $get_serial_sub_div = $data1->get_serial_sub($serial,$pid);
      $serial_sub_div = $get_serial_sub_div[0]['serial_sub_div'];
      
      $data1->per_fe($serial_sub_div,$_POST['div'],$_POST['type'],$pid);
      header('Location:permission.php');
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
                                  

                                                         
                        </select>
                    </form>
                    <?php }
                    else{ ?><a href="admin.php">Log In</a></li><?php }?> 

          <li><a href="#">Help</a></li>
        </ul>
      </div>
    </div>
<form action="permission.php"method="post">
    
                Select Class:
                <select name="class" id="id" onchange="this.form.submit();">
                  <option value="">----select----</option>
                  <option value="fe">FE</option>
                  <option value="seit">SEIT</option>
                  <option value="teit">TEIT</option>
                  <option value="beit">BEIT</option>
                  <option value="secmpn">SECMPN</option>
                  <option value="tecmpn">TECMPN</option>
                  <option value="becmpn">BECMPN</option>
                  <option value="seextc">SEEXTC</option>
                  <option value="teextc">TEEXTC</option>
                  <option value="beextc">BEEXTC</option>
                </select>
                <input type="Submit" value="Get Subjects" name="submit1"/>
                <br>
                Select Division:
                        <select name="div"id="id2" >
                          <option value="NULL"></option>
                          <?php if($_POST['class'] == "fe"){?>
                          <option value="1">1</option>
                          <option value="2">2</option>
                          <option value="3">3</option>
                          <option value="4">4</option>
                          <option value="5">5</option>
                          <option value="6">6</option>
                          <option value="7">7</option><?php 
                        }else{ ?>
                          <option value="a">a</option>
                          <option value="b">b</option><?php }?>
                        </select>
                        <br>
              
                
            </div>
            Select Subject:
                    <select name="sub" id="id3" >
                      <?php foreach ($fetch_sub as $key => $value) {
                        foreach ($value as $k => $v) {
                          # code...
                        if(is_string($k)){
                      ?>
                      <option value"<?php echo $v?>">
                                         <?php echo $v ?></option>
                                  <?php }}}?>
                    </select>
                    <br>
                    Select Document Permission For:
                      <select name="type" id="id4">
                      <option value="NULL">----select----</option>
                      <option value="assignment">Assignment</option>
                      <option value="practical">Practical</option>
                      <option value="ppt">PPT</option>
                      <option value="qb">Question Bank</option>
                      </select>
                    <br>
            <br>
            
          
        
        <input type="submit" value="Submit" name="submit" />
</form>
        <?php if (isset($msg)) {
          # code...
          echo $msg;
        }?>
        <center><a href="myclassmate.php">skip&rarr;</a></center>
<script type="text/javascript" >
  document.getElementById('id').value = "<?php echo $_POST['class'];?>";
  document.getElementById('id2').value = "<?php echo $_POST['div'];?>";
  document.getElementById('id3').value = "<?php echo $_POST['sub'];?>";
  document.getElementById('id4').value = "<?php echo $_POST['type'];?>";
</script>
</body>
</html>
<?php } else

  header('Location:myclassmate.php');?>