<?php
session_start();
if(isset($_SESSION['$current_page']))
{
	unset($_SESSION['$current_page']);
}
$_SESSION['$current_page'] = 5;
$table = "community";

$scale = 10;
$pdo = new PDO('mysql:host=localhost;dbname=sampledb;charset=utf8', 'root', '243146');

if(isset($_GET['mode'])){
	$mode = $_GET['mode'];
}else{
	$mode = "";
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
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title></title>
<meta name="keywords" content="" />
<meta name="description" content="" />
<link href="http://fonts.googleapis.com/css?family=Source+Sans+Pro:200,300,400,600,700,900|Varela+Round" rel="stylesheet" />
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
					<h2><strong>Community</strong></h2> 
				</div>
				<form  name="board_form" method="post" action="../community/community.php?table=<?=$table?>&mode=search"> 
				<div id="list_search">
					<div id="list_search1" class="byline"> 총 <?= $total_record ?> 개의 게시물이 있습니다.</div>
					<ul.style2 id="list_search3">
						<select name="find">
		                    <option value='title'>제목</option>
		                    <option value='content'>내용</option>
						</select></ul.style2>
					<ul.style2 id="list_search4"><input type="text" name="search"></ul.style2>
					<ul.style2 id="list_search5"><input type="image" src="../images/search.png"></ul.style2>
					
				</div>
				</form>
				<div class="clear"></div>
		
				<div id="list_top_title">
					
					<table class="type09" style="vertical-align:center; " >
					    <thead>
					    <tr>
      					  <th scope="cols">글번호</th>
 					      <th scope="cols">제목</th>
 					      <th scope="cols">작성자</th>
 					      <th scope="cols">등록일</th>
 						</tr>
					    </thead>
				
		<?php	
		$result_array = $result->fetchAll();
		for ($i=$start; $i<$start+$scale && $i < $total_record; $i++){
				$row= $result_array[$i];
				//$result->fetch(PDO::FETCH_ASSOC, PDO::FETCH_ORI_ABS, $i);
				$item_num     = $row['num'];
				$item_id     = $row['id'];
		      	$item_date    = $row['regist_day'];
			  	$item_date = substr($item_date, 0, 10);  
			  	$item_title= str_replace(" ", "&nbsp;", $row['title']);
		?>
			
   						<tbody>
   							<tr>
   								<th style="width:10%;" align="center" scope="row"><?=$number?></th>
        						<td style="width:50%;" align="center"><a href="../community/view.php?table=<?=$table?>&num=<?=$item_num?>&page=<?=$page?>"><?= $item_title?></a></td>
   								<td style="width:20%;" align="center"><?= $item_id ?></td>
        						<td style="width:20%;" align="center"><?= $item_date ?></td>
					        </tr>
					    </tbody>
		<?php $number--; } ?>
					</table>
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
					echo "<a href='../community/community.php?table=$table&page=$i'> $i </a>";
				}      
		   }
		?>			
					&nbsp;&nbsp;&nbsp;&nbsp;다음 ▶
						</div>
						<div id="button">
							<a href="../community/community.php?table=<?=$table?>&page=<?=$page?>" class="button">목록</a>&nbsp;
		<?php
		if(isset($_SESSION['user_session'])){
		?>
				<a href="../community/write_form.php?table=<?=$table?>&mode=0" class="button">글쓰기</a>
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
