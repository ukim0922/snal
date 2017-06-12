<?php
session_start();
$table = $_GET['table'];
$pdo = new PDO('mysql:host=localhost;dbname=sampledb;charset=utf8', 'root', '243146');
if(isset($_GET['mode'])){
	$mode = $_GET['mode'];
}else{
	$mode=null;
}
$item_title="";
$item_content="";
$item_file_0 =null;
$item_file_1 =null;
$item_file_2 =null;

$copied_file_0 =null;
$copied_file_1 =null;
$copied_file_2 =null;

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
	
	$item_file_0 = $row['file_name_0'];
	$item_file_1 = $row['file_name_1'];
	$item_file_2 = $row['file_name_2'];
	
	$copied_file_0 = $row['file_copied_0'];
	$copied_file_1 = $row['file_copied_1'];
	$copied_file_2 = $row['file_copied_2'];
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
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta charset="euc-kr">
<link href="../css/bootstrap.min.css" rel="stylesheet">
<link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:200,300,400,600,700,900|Varela+Round" rel="stylesheet" />
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
		<form  name="board_form" method="post" action="../gallery/insert.php?mode=modify&num=<?=$num?>&page=<?=$page?>&table=<?=$table?>" enctype="multipart/form-data"> 
<?php
	}
	else
	{
?>
		<form  name="board_form" method="post" action="../gallery/insert.php?table=<?=$table?>" enctype="multipart/form-data"> 
<?php
	}
?>						
			<div class="title">
					<h2><strong>gallery 작성 페이지</strong></h2> 
				</div>
			<div class="write_line"></div>
			<div id="write_row1"><div class="col1"> 제목   </div>
			                     <div class="col2"><input type="text" name="title" value="<?=$item_title?>"></div>
			</div>
			<div class="write_line"></div>
			<div id="write_row2"><div class="col1"> 내용   </div>
			                     <div class="col2"><textarea rows="15" cols="79" name="content"><?=$item_content?></textarea></div>
			</div>
			<div class="write_line"></div>
			<div id="write_row4"><div class="col1"> 이미지파일1   </div>
			                     <div class="col2"><input type="file" name="upfile[]"></div>
			</div>
			<div class="clear"></div>
			<?php if ($mode=="modify" && $item_file_0)
				{
			?>
				
				<div class="delete_ok"><?=$item_file_0?> 파일이 등록되어 있습니다. <input type="checkbox" name="del_file[]" value="0"> 삭제</div>
				<div class="clear"></div>
			<?php
				}
			?>
				<div class="write_line"></div>
				<div id="write_row5"><div class="col1"> 이미지파일2  </div>
			                     <div class="col2"><input type="file" name="upfile[]"></div>
				</div>
			<?php if ($mode=="modify" && $item_file_1)
				{
			?>
				<div class="delete_ok"><?=$item_file_1?> 파일이 등록되어 있습니다. <input type="checkbox" name="del_file[]" value="1"> 삭제</div>
				<div class="clear"></div>
			<?php
				}
			?>
				<div class="write_line"></div>
				<div class="clear"></div>
				<div id="write_row6"><div class="col1"> 이미지파일3   </div>
				                     <div class="col2"><input type="file" name="upfile[]"></div>
				</div>
			<?php if ($mode=="modify" && $item_file_2)
				{
			?>
				<div class="delete_ok"><?=$item_file_2?> 파일이 등록되어 있습니다. <input type="checkbox" name="del_file[]" value="2"> 삭제</div>
				<div class="clear"></div>
			<?php
				}
			?>
			<div class="write_line"></div>

			<div class="clear"></div>
		
		<div id="write_button"><a type="submit" href="#" onclick="check_input()" class="button">ok</a>&nbsp;
								<a href="../gallery/gallery.php?table=<?=$table?>&page=<?=$page?>" class="button">목록</a></div>
		</div>
		</form>
	</div> <!-- end of col2 -->
  </div> <!-- end of content -->
</div> <!-- end of wrap -->

<div id="footer">
	<p>강원도 원주시 연세대길1 학관 4층</p>
</div>
</body>
</html>
