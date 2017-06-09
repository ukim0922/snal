<?php
session_start();
$pdo = new PDO('mysql:host=localhost;dbname=sampledb;charset=utf8', 'root', '243146');
$table = $_GET['table'];
$num = $_GET['num'];
$sql = "select * from $table where num=$num";
$result = $pdo->query($sql);
$page =  $_GET['page'];
$row = $result->fetch();
// 하나의 레코드 가져오기

$item_num     = $row['num'];
$item_id     = $row['id'];
$item_date    = $row['regist_day'];
$item_title = str_replace(" ", "&nbsp;", $row['title']);
$item_content = $row['content'];

$pdo->query($sql);
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title></title>
<meta name="keywords" content="" />
<meta name="description" content="" />
<link href="http://fonts.googleapis.com/css?family=Source+Sans+Pro:200,300,400,600,700,900|Varela+Round" rel="stylesheet" />
<link href="../css/default.css" rel="stylesheet" type="text/css" media="all" />
<link href="../css/fonts.css" rel="stylesheet" type="text/css" media="all" /><!--[if IE 6]>
<link href="default_ie6.css" rel="stylesheet" type="text/css" />
<![endif]-->
<script>
    function del(href) 
    {
        if(confirm("한번 삭제한 자료는 복구할 방법이 없습니다.\n\n정말 삭제하시겠습니까?")) {
                document.location.href = href;
        }
    }
</script>
</head>

<body>
<div id="wrapper">
<?php include "../common/menu.php"; ?>
	<div id="portfolio-wrapper">
		<div id="page" class="container">
        <div class="title">
					<h2><strong>Community</strong></h2> 
		</div>		
		<div id="view_comment"> &nbsp;</div>

		<div id="view_title">
			<div id="view_title1"><strong><?= $item_title ?></strong></div>
			<div id="view_title2">작성자 : <?= $item_id ?></div>	
			<div id="view_title3">등록일 : <?= $item_date ?></div>	
		</div>

		<div id="view_content">
			<?= $item_content ?>
		</div>

		<div id="view_button">
				<a href="../community/community.php?table=<?=$table?>&page=<?=$page?>" class="button">목록</a>&nbsp;
<?php
if(isset($_SESSION['user_session'])){
	$userid = $_SESSION['user_session'];
}else{
	$userid = "";
}
if($userid==$item_id || $userid=="admin")
	{
?>
				<?=$userid, $item_id?>
				<a href="../community/write_form.php?table=<?=$table?>&mode=modify&num=<?=$num?>&page=<?=$page?>" class="button">수정</a>&nbsp;
				<a href="javascript:del('delete.php?table=<?=$table?>&num=<?=$num?>')" class="button">삭제</a>&nbsp;
<?php
	}
?>
		</div>

		<div class="clear"></div>

	</div> <!-- end of page -->
  </div> <!-- end of portfolio-wrapper -->
</div> <!-- end of wrapper -->
<div id="footer">
	<p>강원도 원주시 연세대길1 학관 313호</p>
</div>
</body>
</html>
