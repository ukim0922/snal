<?php
session_start();
$table = $_GET['table'];
$pdo = new PDO('mysql:host=localhost;dbname=sampledb;charset=utf8', 'root', '243146');
$mode = $_GET['mode'];
$item_title="";
$item_content="";
if(isset($_GET['num'])){
	$num = $_GET['num'];
}else{
	$num = "";
}

if ($mode=="modify")
{
	$sql = "select * from $table where num=$num";
	$result = $pdo->query($sql);
	
	$row = $result->fetch();
	
	$item_title     = $row['title'];
	$item_content   = $row['content'];
}

if(isset($_GET['page'])) {
	$page = $_GET['page'];
} else {
	$page = 1;
}
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head> 
<meta charset="euc-kr">
<link href="http://fonts.googleapis.com/css?family=Source+Sans+Pro:200,300,400,600,700,900|Varela+Round" rel="stylesheet" />
<link href="../css/default.css" rel="stylesheet" type="text/css" media="all" />
<link href="../css/fonts.css" rel="stylesheet" type="text/css" media="all" />
<script>
  function check_input()
   {
      if (!document.board_form.title.value)
      {
          alert("제목을 입력하세요!");    
          document.board_form.title.focus();
          return;
      }

      if (!document.board_form.content.value)
      {
          alert("내용을 입력하세요!");    
          document.board_form.content.focus();
          return;
      }
      document.board_form.submit();
   }
</script>
</head>
<body>
<div id="wrapper">
	<?php include "../common/menu.php"; ?>
	
	<div id="portfolio-wrapper">
		<div id="page" class="container">
		

<?php
	if($mode=="modify")
	{

?>
		<form  name="board_form" method="post" action="../notice/insert.php?mode=modify&num=<?=$num?>&page=<?=$page?>&table=<?=$table?>" enctype="multipart/form-data"> 
<?php
	}
	else
	{
?>
		<form  name="board_form" method="post" action="../notice/insert.php?table=<?=$table?>" enctype="multipart/form-data"> 
<?php
	}
?>						
			<div class="title">
					<h2><strong>NOTICE 작성 페이지</strong></h2> 
				</div>
			<div class="write_line"></div>
			<div id="write_row1"><div class="col1"> 제목   </div>
			                     <div class="col2"><input type="text" name="title" value="<?=$item_title?>" ></div>
			</div>
			<div class="write_line"></div>
			<div id="write_row2"><div class="col1"> 내용   </div>
			                     <div class="col2"><textarea rows="15" cols="79" name="content"><?=$item_content?></textarea></div>
			                     
			<div class="write_line"></div>
			<div class="clear"></div>
		</div>
		<div id="write_button"><a type="submit" href="#" onclick="check_input()" class="button">ok</a>&nbsp;
								<a href="../notice/notice.php?table=<?=$table?>&page=<?=$page?>" class="button">목록</a></div>
		</form>
	</div> <!-- end of col2 -->
  </div> <!-- end of content -->
</div> <!-- end of wrap -->
<div id="footer">
	<p>강원도 원주시 연세대길1 학관 4층</p>
</div>
</body>
</html>
