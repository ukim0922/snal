<?php
session_start();
if(isset($_SESSION['$current_page']))
{
	unset($_SESSION['$current_page']);
}
$_SESSION['$current_page'] = 6;
$table = "gallery";

$scale = 9;
$pdo = new PDO('mysql:host=localhost;dbname=sampledb;charset=utf8', 'root', '243146');

if(isset($_GET['mode'])){
	$mode = $_GET['mode'];
}else{
	$mode = "";
}
if(!isset($_SESSION['user_session'])){
	echo "<script>alert(\"로그인 해주세요!\");
	window.location.href='../mem/login.php';
	</script>";
}
//검색 기능
if ($mode=="search")
{
	$usearch= $_POST['search'];
	if(!$usearch)
	{
		echo("
				<script>
				 window.alert('검색할 단어를 입력해 주세요!');
			     history.go(-1);
				</script>
			");
		exit;
	}
	$ufind= $_POST['find'];
	$sql = "select * from $table where $ufind like '%$usearch%' order by num desc";
	$res = $pdo->query("SELECT COUNT(*) FROM $table where $ufind like '%$usearch%' order by num desc");
}
else
{
	$sql = "select * from $table order by num desc";
	$res = $pdo->query("SELECT COUNT(*) FROM $table");
}

//$res = $pdo->query("SELECT COUNT(*) FROM $table");
$total_record= $res->fetchColumn();// 전체 글 개수

$result = $pdo->query($sql);

//전체 페이지 수 계산
if($total_record % $scale == 0){
	$total_page = floor($total_record/$scale);
}
else{
	$total_page = floor($total_record/$scale) + 1;
}

if(!isset($_GET['page']) || !($_GET['page'])) {
	$page = 1;
} else {
	$page = $_GET['page'];
}


//페이지 번호에 따른 시작 레코드 계산
$start = ($page - 1) * $scale;
$number = $total_record - $start;
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html xmlns="https://www.w3.org/1999/xhtml">
<head>
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title></title>
<link href="../css/bootstrap.min.css" rel="stylesheet">
<meta name="keywords" content="" />
<meta name="description" content="" />
<link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:200,300,400,600,700,900|Varela+Round" rel="stylesheet" />
<link href="../css/default.css" rel="stylesheet" type="text/css" media="all" />
<link href="../css/fonts.css" rel="stylesheet" type="text/css" media="all" />
<!--[if IE 6]>
<link href="default_ie6.css" rel="stylesheet" type="text/css" />
<![endif]-->
</head>
<body>
<div id="wrapper">
		<?php include "../common/menu.php"; ?>
		
		<div id="portfolio-wrapper">
		<div id="page" class="container">
				<div class="title">
					<h2><strong>gallery</strong></h2> 
				</div>
				<form  name="board_form" method="post" action="../gallery/gallery.php?table=<?=$table?>&mode=search"> 
				<div id="list_search">
					<div id="list_search1" class="byline"> 총 <?= $total_record ?> 개의 게시물이 있습니다.</div>
					<div class="form-group">
					<div class="col-sm-2" >
								<select class="form-control" name="find">
				                    <option value='title'>제목</option>
				                    <option value='content'>내용</option>
								</select>
								</div>
					        <div class="col-sm-4" ><input type="text" class="form-control" name="search"></div>
					        <input type="image" src="../images/search.png"></ul.style2>
					</div>
				</div>
				</form>
				<div class="clearfix"></div>
				<br>
				<div style="width:100%;" align="center">
						<?php	
							$result_array = $result->fetchAll();
							for ($i=$start; $i<$start+$scale && $i < $total_record; $i++){
									$row= $result_array[$i];
									$item_image	=	$row['file_copied_0'];
									$item_num     = $row['num'];
									$item_id     = $row['id'];
							      	$item_date    = $row['regist_day'];
								  	$item_date = substr($item_date, 0, 10);  
								  	$item_title= str_replace(" ", "&nbsp;", $row['title']);
								  	$res = $pdo->query("SELECT * FROM personal_info where id = '$item_id'");
								  	$rlt = $res->fetch();
								  	$item_name = $rlt['name']; 
							?>
															<div class="gallery" style="width:300px; float:left; margin:20px;" >
															  <a target="_blank" href="../gallery/view.php?table=<?=$table?>&num=<?=$item_num?>&page=<?=$page?>">
															    <img src="../gallery/data/<?=$item_image?>" alt="Fjords" width="300px" height="200px">
															  </a>
															  <div class="desc"><?= $item_title?></div>
															  <div style="height:30px"></div>
															</div>								
														<div style="width:30px;"> </div>		
		
														<?php $number--; } ?>
				</div>
				<br>
            	<div class="clearfix"></div>
					<div id="page_button">
						<div id="page_num"> ◀ 이전 &nbsp;&nbsp;&nbsp;&nbsp; 
		<?php
		   // 게시판 목록 하단에 페이지 링크 번호 출력
		   for ($i=1; $i<=$total_page; $i++)
		   {
				if ($page == $i)     // 현재 페이지 번호 링크 안함
				{
					echo "<b> $i </b>";
				}
				else
				{ 
					echo "<a href='../gallery/gallery.php?table=$table&page=$i'> $i </a>";
				}      
		   }
		?>			
					&nbsp;&nbsp;&nbsp;&nbsp;다음 ▶
						</div>
						<div id="button">
							<a href="../gallery/gallery.php?table=<?=$table?>&page=<?=$page?>" class="button">목록</a>&nbsp;
		<?php
		if(isset($_SESSION['user_session'])){
		?>
				<a href="../gallery/write_form.php?table=<?=$table?>" class="button">글쓰기</a>
		<?php
			}
		?>
						</div>
					</div> <!-- end of page_button -->		
		        </div> <!-- end of list content -->
				<div class="clear"></div>
		
			
		  </div> <!-- end of content -->
	</div>
</div>
<div id="footer">
	<p>강원도 원주시 연세대길1 학관 4층</p>
</div>
</body>
</html>
