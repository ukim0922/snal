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
	
	if ($mode=="modify")
	{
// 		$num_checked = count($_POST['del_file']);
// 		$position = $_POST['del_file'];

// 		for($i=0; $i<$num_checked; $i++)                      // delete checked item
// 		{
// 			$index = $position[$i];
// 			$del_ok[$index] = "y";
// 		}

		$sql = "select * from $table where num=$num";   // get target record
		$result = $pdo->query($sql);
		$row = $result->fetch();

// 		for ($i=0; $i<$count; $i++)					// update DB with the value of file input box
// 		{

// 			$field_org_name = "file_name_".$i;
// 			$field_real_name = "file_copied_".$i;

// 			$org_name_value = $upfile_name[$i];
// 			$org_real_value = $copied_file_name[$i];
// 			if ($del_ok[$i] == "y")
// 			{
// 				$delete_field = "file_copied_".$i;
// 				$delete_name = $row[$delete_field];
				
// 				$delete_path = "./data/".$delete_name;

// 				unlink($delete_path);

// 				$sql = "update $table set $field_org_name = '$org_name_value', $field_real_name = '$org_real_value'  where num=$num";
// 				$pdo->query($sql);// $sql 에 저장된 명령 실행
// 			}
// 			else
// 			{
// 				if (!$upfile_error[$i])
// 				{
// 					$sql = "update $table set $field_org_name = '$org_name_value', $field_real_name = '$org_real_value'  where num=$num";
// 					$pdo->query($sql);// $sql 에 저장된 명령 실행					
// 				}
// 			}

// 		}
		$sql = "update $table set title='$utitle', content='$ucontent' where num=$num";
		$pdo->query($sql);// $sql 에 저장된 명령 실행
	}
	else
	{
		$sql = "insert into $table (title, content, regist_day)";
		$sql .= "values('$utitle', '$ucontent', '$regist_day')";
		$pdo->query($sql);// $sql 에 저장된 명령 실행
	}
	if($pdo)
		$pdo = NULL;                // DB 연결 끊기
	echo "
	   <script>
	   location.href ='notice.php?table=$table&page=$page';
	   </script>
	";
?>

  
