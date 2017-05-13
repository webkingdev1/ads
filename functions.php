<?php

	function db($host,$user,$pass,$db_name){
		$db = mysql_connect($host,$user,$pass);
		
		if (!$db){
			exit(mysql_error());
		} 

		if(!mysql_select_db($db_name,$db)){
			exit(mysql_error());
		} 

		mysql_query("SET NAMES UTF8");
	}

	function clear_string($str) {
		return trim(strip_tags($str));
	}

	function render($path, $param = array()) {
		extract($param);
		ob_start();

		if(!include($path.".php")) {
			exit("Problemo render!!!");
		}
		return ob_get_clean();
	}

	function registration($post) {
		$login = clear_string($post['reg_login']);
		$password = trim($post['reg_password']);
		$conf_pass= trim($post['reg_password_confirm']);
		$name = clear_string($post['reg_name']);
		$msg = '';
		
		if(empty($login)) {
			$msg .= "Введите логин <br />";
		}
		if(empty($password)) {
			$msg .= "Введите пароль <br />";
		}
		if(empty($name)) {
			$msg .= "Введите имя <br />";
		}
		
		if($msg) {
			$_SESSION['reg']['login'] = $login;
			$_SESSION['reg']['name'] = $name;
			return $msg;
		}
		
		if($conf_pass == $password) {
			$sql = "SELECT user_id
					FROM ".PREF."user
					WHERE login='%s'";
			$sql = sprintf($sql,mysql_real_escape_string($login));
			
			$result = mysql_query($sql);
			
			if(mysql_num_rows($result) > 0) {
				$_SESSION['reg']['name'] = $name;
			
				return "Problemo!!!";
			}
					
			$password = md5($password);
			$hash = md5(microtime());
			$query = "INSERT INTO ".PREF."user (name, password, login, hash) 
										VALUES ('$name', '$password', '$login', '$hash')";
			$result2 = mysql_query(sprintf($query,
							mysql_real_escape_string($name),
							$password,
							mysql_real_escape_string($login)
							));
			
			if(!$result2) {
				$_SESSION['reg']['login'] = $login;
				$_SESSION['reg']['name'] = $name;
				return "Error adding user in DB".mysql_error();
			}								
		}
		else {
			$_SESSION['reg']['login'] = $login;
			$_SESSION['reg']['name'] = $name;
			return "Not correctly confirmed the password";
		}
	}

	function login($post) {
		$login = clear_string($post['login']);
		$password = md5(trim($post['password']));
		$sql = "SELECT * FROM ".PREF."user
				WHERE login = '$login'
				AND password = '$password'";
		$sql = sprintf($sql,mysql_real_escape_string($login),$password);
		$result = mysql_query($sql);
		if(!$result) {
			return "Problemo!!!";
		}
		if(empty($post['login']) || empty($post['password'])) {
			return "Input login & password";
		}
				
		$sess = md5(microtime());
		$sql_update = "UPDATE ".PREF."user SET sess='$sess' WHERE login='$login'";
		$sql_update = sprintf($sql_update,mysql_real_escape_string($login));
		if(!mysql_query($sql_update)) {
			return "Problemo!!!";
		}
		
		$_SESSION['sess'] = $sess;
		if($post['member'] == 1) {
			$time = time() + 10*24*3600;
			setcookie('login',$login,$time);
			setcookie('password',$password,$time);
		}
		return TRUE;
	}

	function logout() {
		unset($_SESSION['sess']);
		setcookie('login','',time()-3600);
		setcookie('password','',time()-3600);
		
		return TRUE;
		session_unset();
		session_destroy();
	}

	function check_user() {
		if(isset($_SESSION['sess'])) {
			$sess = $_SESSION['sess'];
			$sql = "SELECT user_id,name,id_role
					FROM ".PREF."user
					WHERE sess='$sess'";
			$result = mysql_query($sql);
				if(!$result || mysql_num_rows($result) < 1) {
				return FALSE;
			}
			
			return mysql_fetch_assoc($result);	
		}
		else {
			return FALSE;
		}
	}

	function add_new_car(){
		$car = $_POST["car"];
		$result = mysql_query("INSERT INTO ".PREF."car (car) VALUES ('$car')");
			if(!$result){
			 	return mysql_error();
			}
	}

	function get_edit_car($id){
		$result = mysql_query("SELECT * FROM ".PREF."car WHERE id= '$id' ");
		$row = get_result($result);
		return $row[0];
	}

	function get_ads(){
		$sorting = $_GET['sort'];
		switch ($sorting) {
		case 'asc':
			$sorting = "price ASC";
			break;
		case 'desc':
			$sorting = "price DESC";
			break;
		default:
			$sorting = "date_registration";
			break;
		}
		$result = mysql_query("SELECT * FROM ".PREF."ads AS ad LEFT JOIN ".PREF."car AS c ON c.id_car=ad.id_car
												LEFT JOIN ".PREF."model AS m ON m.id_model=ad.id_model
												LEFT JOIN ".PREF."city AS ci ON ci.id_city=ad.id_city
												LEFT JOIN ".PREF."region AS r ON r.id_region=ad.id_region
												WHERE confirm = '0' ORDER BY $sorting ");
		
		return get_result($result);
	}

	function get_ads_limit($start, $limit){
		$sorting = $_GET['sort'];
		switch ($sorting) {
		case 'asc':
			$sorting = "price ASC";
			break;
		case 'desc':
			$sorting = "price DESC";
			break;
		default:
			$sorting = "date_registration";
			break;
		}
		$result = mysql_query("SELECT * FROM ".PREF."ads AS ad LEFT JOIN ".PREF."car AS c ON c.id_car=ad.id_car
												LEFT JOIN ".PREF."model AS m ON m.id_model=ad.id_model
												LEFT JOIN ".PREF."city AS ci ON ci.id_city=ad.id_city
												LEFT JOIN ".PREF."region AS r ON r.id_region=ad.id_region
												WHERE confirm = '0' ORDER BY $sorting LIMIT ".$start.", ".$limit."");
		
		return get_result($result);
	}

	function get_array($result){
		$array = array();
		while($row = mysql_fetch_assoc(result))
		$array[] = $row;
		return $array;
	}
	
	function get_your_ads($id){
		
		$result = mysql_query("SELECT * FROM ".PREF."ads AS ad LEFT JOIN ".PREF."car AS c ON c.id_car=ad.id_car
												LEFT JOIN ".PREF."model AS m ON m.id_model=ad.id_model
												LEFT JOIN ".PREF."city AS ci ON ci.id_city=ad.id_city
												LEFT JOIN ".PREF."region AS r ON r.id_region=ad.id_region
												WHERE confirm = '0' AND ad.id_user = '$id'");
		
		return get_result($result);
	}

	function get_result($result){
			if (!$result){
				exit(mysql_error());
			}
			if (mysql_num_rows($result) == 0) {
				return FALSE;
			}
			$row = array();
			for ($i=0; mysql_num_rows($result) > $i; $i++){
				$row[] = mysql_fetch_array($result,MYSQL_ASSOC); 
			}
			return $row;
	}

	function get_car(){
		$result = mysql_query("SELECT * FROM ".PREF."car");
		return get_result($result);
	}

	function get_city(){
		$result = mysql_query("SELECT * FROM ".PREF."city");
		return get_result($result);
	}

	function get_model(){
		$sql = "SELECT * FROM ".PREF."model";
		$result = mysql_query($sql);
		return get_result($result);
	}

	function get_price(){
		$sql = "SELECT price FROM ".PREF."ads GROUP BY price";
		$result = mysql_query($sql);
		return get_result($result);
	}

	function get_year(){
		$sql = "SELECT year FROM ".PREF."ads GROUP BY year";
		$result = mysql_query($sql);
		return get_result($result);
	}

	function get_mileage(){
		$result = mysql_query("SELECT mileage FROM ".PREF."ads GROUP BY mileage");
		return get_result($result);
	}


	function get_all_view($id){
		$result = mysql_query("SELECT * FROM ".PREF."user");
		return get_result($result);
	}

	function get_view_ads($id_view){
		$sql = "SELECT * FROM ".PREF."ads AS ad LEFT JOIN ".PREF."car AS c ON c.id_car=ad.id_car
												LEFT JOIN ".PREF."city AS ci ON ci.id_city=ad.id_city
												LEFT JOIN ".PREF."region AS r ON r.id_region=ad.id_region
												WHERE ad.id='$id_view' ";
		$result = mysql_query($sql);
		$row = get_result($result);
		return $row[0];
	}

	function get_edit_ads($id){
		$row = get_result(mysql_query("SELECT * FROM ".PREF."ads AS ad LEFT JOIN ".PREF."car AS c ON c.id_car=ad.id_car
												LEFT JOIN ".PREF."model AS m ON m.id_model=ad.id_model
												LEFT JOIN ".PREF."city AS ci ON ci.id_city=ad.id_city
												LEFT JOIN ".PREF."region AS r ON r.id_region=ad.id_region WHERE id='$id'"));
		return $row[0];
	}

	function edit_goods($POST,$id){
		if (isset($_POST['submit'])){		
			$id 			= $_POST['id'];
			$goodsName 		= $_POST["goods_name"];
			$price 			= $_POST["goods_price"];
			$description	= $_POST["goods_description"];
			$goodsCat		= $_POST["id_cat"];
			$image 			= $_POST['goods_img'];
			
			$sql = "UPDATE z9_goods SET goods_price = '$price', goods_name = '$goodsName', goods_description = '$description', id_cat = '$goodsCat', goods_img = '$image'
										 WHERE id = '$id' ";
			$result = mysql_query($sql);

			return $result;
		}
	}

	function add_new_ads($_POST){
		$id_user		= $_POST["id_user"];
		$id_car			= $_POST["id_user"];
		$id_model 		= $_POST["id_model"];
		$year 			= $_POST["year"];
		$mileage 		= $_POST["milesge"];
		$engine_capacity= $_POST["engine_capacity"];
		$date_registration= date("Y-m-d");;
		$id_region 		= $_POST["id_region"];
		$id_city 		= $_POST["id_city"];
		$price 			= $_POST["goods_price"];
		$description	= $_POST["goods_description"];
		$confirm		= 0;
		$msg 			= "";
		$img_types		= array('jpeg'=>'image/jpeg', 'png'=>'image/png', 'jpg'=>'image/jpg');
		$name_img		= $id_car.'_'.$price;
		$rash 			= mb_strtolower(substr($_FILES['img']['name'], strripos($_FILES['img']['name'],".")));
		$name_img 		.=$rash;
		$car_img		= FILES.$name_img;
		
		if (!empty($msg)){
			return $msg;
		}
		else {
			$sql = "INSERT INTO ".PREF."ads (id_user, id_car, id_model, year, mileage, engine_capacity, date_registration,
											id_region, id_city, price, car_img, confirm)
 		 								VALUES ('$id_user', '$id_car', '$id_model', '$year', '$mileage', '$engine_capacity', '$date_registration',
 		 									'$id_region', '$id_city', '$price', '$car_img', '$confirm')";
 		 	$result = mysql_query($sql);
			
			if(!$result){
			 	return mysql_error();
		 	}
	 	}
	}

	function get_img(){
		$width = 400;
		$height = 300;
		$imgages = imagecreatetruecolor($width, $height);

		header("Content-Type:image/png");
		imagepng($images);
		imagedestroy($images);
	}

	function delete_ads($id){
		$id = $_GET['id'];
		$result = mysql_query("UPDATE ".PREF."ads SET confirm = '1' WHERE id = '$id' ");

		return $result;
	}

	function count_all_ads(){
		$result = mysql_query("SELECT COUNT('id')  FROM ".PREF."ads");
		$row =  mysql_fetch_row($result);

		return $row[0];
	}

	function count_ads($id){
		$result = mysql_query("SELECT COUNT(*) as count_row FROM ".PREF."ads WHERE confirm = '0' AND  id_user = '$id'");
		$row =  get_result($result);

		return $row[0]['count_row'];
	}

	function get_start ($page, $limit){

		return $limit*($page - 1);
	}

	function pagination ($page, $limit){
		$count_ads = count_all_ads();
		$count_pages = round($count_ads/$limit);
		if($page>$count_pages) $page = $count_pages;
		$next = $page + 1;
		$prev = $page - 1;
		if($next > $count_pages) $next = $count_pages;
		if($prev < 1) $prev = 1;
		$pagination = "";
		if($count_pages > 1) {
			for ($i=1; $i<=$count_pages; $i++){
				if($i==1) $pagination .= "<a href='index.php'>".$i."</a>";
				elseif ($i == $pages) $pagination .= "<span>".$i."</span>";
				else $pagination .= "<a href='index.php?page=".$i."'>".$i."</a>";
			}
		}
		return $pagination;
	}


?>