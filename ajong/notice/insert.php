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
	$mode = $_GET['mode'];
	$table = $_GET['table'];
	$page = $_GET['page'];
	$num = $_GET['num'];
	$utitle= $_POST['title'];
	$ucontent= $_POST['content'];
	$yyyy=$_POST['yyyy'];
	$mm=$_POST['mm'];
	$dd=$_POST['dd'];
	if(!($yyyy||$mm||$dd)){
		$udate = null;
	}else{
		$udate = date("Y-m-d", mktime(0, 0, 0, $mm, $dd, $yyyy));
	}
	$uplace= $_POST['place'];
	$ucheck_date= $_POST['check_date'];
	$ucheck_place= $_POST['check_place'];
	
	if ($mode=="modify")
	{
		$sql = "select * from $table where num=$num";   // get target record
		$result = $pdo->query($sql);
		$row = $result->fetch();

		$sql = "update $table set title='$utitle', date='$udate', place='$uplace', content='$ucontent'  where num=$num";
		$pdo->query($sql);// $sql 에 저장된 명령 실행
	}
	else
	{
		$sql = "insert into $table (title, date, place, content, regist_day)";
		$sql .= "values('$utitle', '$udate', '$uplace', '$ucontent', '$regist_day')";
		$pdo->query($sql);// $sql 에 저장된 명령 실행
	}
	if($pdo)
		$pdo = NULL;                // DB 연결 끊기
	echo "
	   <script>
	   location.href ='../notice/notice.php?table=$table&page=$page';
	   </script>
	";
?>

  
