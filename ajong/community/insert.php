<?php session_start(); ?>

<meta charset="euc-kr">
<?php
	if(!isset($_SESSION['user_session'])) {
		echo("
		<script>
	     window.alert('로그인 후 이용해 주세요.')
	     history.go(-1)
	   </script>
		");
		exit;
	}

	$regist_day = date("Y-m-d");  // 현재의 '년-월-일-시-분'을 저장
	
	$pdo = new PDO('mysql:host=localhost;dbname=sampledb;charset=utf8', 'root', '243146');
	if(isset($_GET['mode'])){
		$mode = $_GET['mode'];
	}else{
		$mode = null;
	}
	if(isset($_GET['page'])){
		$page= $_GET['page'];
	}else{
		$page= 1;
	}
	if(isset($_GET['num'])){
		$num= $_GET['num'];
	}else{
		$num= 0;
	}
	$table = $_GET['table'];
	//$page = $_GET['page'];
	//$num = $_GET['num'];
	$utitle= $_POST['title'];
	$uid = $_SESSION['user_session'];
	$ucontent= $_POST['content'];
	
	if ($mode=="modify")
	{
		$sql = "select * from $table where num=$num";   // get target record
		$result = $pdo->query($sql);
		$row = $result->fetch();
		
		$sql = "update $table set id='$uid', title='$utitle', content='$ucontent' where num=$num";
		$pdo->query($sql);// $sql 에 저장된 명령 실행
	}
	else
	{
		echo "<script>alert(\"안녕\",$uid, $utitle, $ucontent', '$regist_day')</script>";
		$sql = "insert into community (id, title, content, regist_day)";
		$sql .= "values('$uid', '$utitle', '$ucontent', '$regist_day')";
		$pdo->query($sql);// $sql 에 저장된 명령 실행
	}
	if($pdo)
		$pdo = NULL;                // DB 연결 끊기
	echo "
	   <script>
	   location.href ='../community/community.php?table=$table&page=1';
	   </script>
	";
?>

  
