<!-- 
  Created by : Ashish Chandrakant Naik
  2013 - 2017
  St. francis Institute of tech
-->
<?php

class Article {
	public function fetch_all(){
		global $pdo;

		$query = $pdo->prepare('select * from user');
		$query->execute();

		return $query->fetchAll();
	}
	public function fetch_data($username) {
		global $pdo;
		$query = $pdo->prepare('select * from user where username = ?');
		$query->bindValue(1, $username);
		$query->execute();
		return $query->fetch();

	}
}
class fetchsubject{
	public function fetch_sub($pid){
		global $pdo;
		$query = $pdo->prepare('select s.name,r.serial from relation as r, subject as s where PID = ? and s.serial = r.serial');
		$query->bindValue(1,$pid);
		$query->execute();
		return $query->fetchAll();
	}

}
class fetch_subject{
	public function fetch_sub_($name,$pid){
		global $pdo;
		$query = $pdo->prepare('select r.serial,r.class,r.serial_sub_div from relation as r, subject as s where  s.name = ? and s.serial = r.serial and PID=?');
		$query->bindValue(1,$name);
		$query->bindValue(2,$pid);
		$query->execute();
		return $query->fetchAll();
	}
}

class fetchbelonging{
	public function fetch_bel($serial,$class,$pid){
		global $pdo;
		//make resp changes in for loop 
		$query = $pdo->prepare('select c.division,c.practical,c.assignment,c.ppt,c.qb,c.serial_division from fe as c, relation as r where r.serial = ? and r.serial_sub_div = c.serial_sub_div and r.class=? and r.PID=?');
		
		$query->bindValue(1,$serial);
		$query->bindValue(2,$class);
		$query->bindValue(3,$pid);
		$query->execute();
		return $query->fetchAll();
	}
}
class file_upload{
	public function fetch_sub_div($subject,$pid,$class){
		global $pdo;
		$query = $pdo->prepare('select r.serial_sub_div from relation as r where r.serial = (select s.serial from subject as s where s.name=?) and r.class=? and r.PID = ?');
		
		$query->bindValue(1,$subject);
		$query->bindValue(2,$class);
		$query->bindValue(3,$pid);
		$query->execute();
		return $query->fetchAll();

	}
	}
class file_db{
	 public function upload_db($url_detail,$serial,$serial_sub_div,$serial_division,$url){
		global $pdo;

		try{
		$query = $pdo->prepare('insert into files(serial,serial_sub_div,serial_division,'.$url_detail.') values(?,?,?,?)');
		


		
		$query->bindValue(1,$serial);
		$query->bindValue(2,$serial_sub_div);
		$query->bindValue(3,$serial_division);
		$query->bindValue(4,$url);
		$query->execute();
		return NULL;
	}
	catch(Exception $e){echo $e;}
		}

}


















class display{
	 public function display_file($serial_sub_div,$type,$sub){
		global $pdo;

		
		$query = $pdo->prepare('select f.'.$type.'_url from files as f,relation as r,fe as s, subject as sub where f.serial_sub_div = r.serial_sub_div and r.class=? and f.serial_division=s.serial_division and s.division=? and r.serial=sub.serial and sub.name = ?');
		
		$serial_division=substr($serial_sub_div, -1);
		$serial_sub_div = substr_replace($serial_sub_div ,"",-1);	
		
		$query->bindValue(1,$serial_sub_div);
		$query->bindValue(2,$serial_division);
		$query->bindValue(3,$sub);
		$query->execute();
		return $query->fetchAll();

}
	public function display_subject($class){
		global $pdo;
		$query = $pdo->prepare('select name,sem from subject where yrdiv = ?');
		
		$class = substr_replace($class ,"",-1);	
		
		$query->bindValue(1,$class);
		
		
		$query->execute();
		return $query->fetchAll();
	}
	public function register($pid,$username,$pass,$photo,$time){

				global $pdo;
		$query = $pdo->prepare('insert into user(PID,username,password,photo,timestamp) values(?,?,?,?,?)');
		
		$query->bindValue(1,$pid);
		$query->bindValue(2,$username);
		$query->bindValue(3,$pass);
		$query->bindValue(4,$photo);
		$query->bindValue(5,$time);
		
		$query->execute();
		return NULL;



	}
	public function fetch_sub($class){
		global $pdo;
		$query = $pdo->prepare('select name from subject where yrdiv = ?');
		
		
		$query->bindValue(1,$class);
		
		
		$query->execute();
		return $query->fetchAll();
	}
	public function get_serial($sub,$user){
		global $pdo;
		$query = $pdo->prepare('select s.serial,u.PID from subject as s, user as u where s.name = ? and u.username = ?');
		
		
		$query->bindValue(1,$sub);
		$query->bindValue(2,$user);
		
		$query->execute();
		return $query->fetchAll();
	}

	public function per_relation($serial,$pid,$class){
		global $pdo;
		$query = $pdo->prepare('insert into relation(serial,PID,class)values(?,?,?)');
		
		
		$query->bindValue(1,$serial);
		$query->bindValue(2,$pid);
		$query->bindValue(3,$class);
		$query->execute();
		return $query->fetchAll();
}	
public function get_serial_sub($serial,$pid){
		global $pdo;
		$query = $pdo->prepare('select serial_sub_div from relation  where serial = ? and PID=?');
		
		
		$query->bindValue(1,$serial);
		$query->bindValue(2,$pid);
		
		$query->execute();
		return $query->fetchAll();
	}
	public function per_fe($serial_sub,$div,$type,$pid){
		global $pdo;
		$query = $pdo->prepare('insert into fe(division,serial_sub_div,'.$type.')values(?,?,?)');
		
		
		$query->bindValue(1,$div);
		$query->bindValue(2,$serial_sub);
		$query->bindValue(3,$pid);
		$query->execute();
		return NULL;
}
}

?>
