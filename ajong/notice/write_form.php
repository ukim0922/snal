<?php
session_start();
$table = $_GET['table'];
$pdo = new PDO('mysql:host=localhost;dbname=sampledb;charset=utf8', 'root', '243146');
$mode = $_GET['mode'];
$item_title=null;
$item_content=null;
$item_place=null;
$yyyy=null;
$mm=null;
$dd=null;

$check_date=null;		//일시 란 사용유무
$check_place=null;		//장소 란 사용유무
if(isset($_GET['num'])){
	$num = $_GET['num'];
}else{
	$num = null;
}

if ($mode=="modify")
{
	$sql = "select * from $table where num=$num";
	$result = $pdo->query($sql);
	
	$row = $result->fetch();
	
	$yyyy=substr($row['date'], 0,4);
	$mm=substr($row['date'], 5,2);
	$dd=substr($row['date'], 8,2);
	
	$item_title     = $row['title'];
	$item_place     = $row['place'];
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
	  if(document.board_form.check_date.checked){
	      if((!document.board_form.yyyy.value)||(!document.board_form.mm.value)||(!document.board_form.dd.value)){
	    	  alert("일시를 입력하세요!"); 
	          document.board_form.yyyy.focus();
	          return;
	  		}
	  }
	  if(!document.board_form.check_date.checked){
		  document.board_form.yyyy.value = null;
		  document.board_form.mm.value = null;
		  document.board_form.dd.value = null;
	  }
	  if(document.board_form.check_place.checked){
	      if((!document.board_form.place.value)){
	    	  alert("장소를 입력하세요!"); 
	          document.board_form.place.focus();
	          return;
	  		}
	  }
	  if(!document.board_form.check_place.checked){
		  document.board_form.place.value = null;
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
			                     <div class="col2"><input type="text" name="title" value="<?=$item_title?>"></div>
			</div>
			<div class="write_line"></div>
			<div id="write_row2"><div class="col1"> 일시  (<input type="checkbox" name="check_date" value=""> 사용할 경우 체크)</div>
					<div class="col2"><span class="input-group-addon">
		            	<?php		            	
		            	$yearRange = 60;
		            	// 선택되어질 년도 - 현재년 기준 60년전의 년도가 선택되어집니다.
		            	$currentYear = date('Y');
		            	$startYear = ($currentYear-$yearRange);
		            	?>
		            	<select name="yyyy" class="form-control input-sm">
		            	<option value="">년</option>
		            	<?php 
		            	foreach (range($currentYear, $startYear)as $selected){        		
		            	?>
		            		<option value="<?php echo $selected;?>"<?php if($yyyy!=null && $selected==$yyyy){echo "selected";} else echo ""; ?> > <?php echo $selected;?></option>
		            	<?php 	
		            	}
		            	?>
		            	</select>
		  				</span>
		  				<span class="input-group-addon">
		            	<select name="mm" class="form-control input-sm">
		            	<option value="">월</option>
		            	<?php 
		            	$selected = "";
		            	foreach (range(1, 12) as $selected){    		
		            	?>
		            		<option value="<?php echo $selected;?>"<?php if($mm!=null && $selected==$mm){echo "selected";} else echo "";?> > <?php echo $selected;?></option>
		            	<?php 	
		            	}
		            	?>
		            	</select>
		  				</span>
		  				<span class="input-group-addon">
	    				<select name="dd" class="form-control input-sm" value="<?php if(isset($error)){echo $dd;}?>">
    					<option value=""<?php if($dd==""){echo "selected";} else echo "";?>>일</option>
    					<?php 
    					$selected = "";
		            	foreach (range(1, 31) as $selected){    		
		            	?>
		            		<option value="<?php echo $selected;?>"<?php if($dd!=null && $selected==$dd){echo "selected";} else echo "";?> > <?php echo $selected;?></option>
		            	<?php 	
		            	}
		            	?>
						</select>
		  				</span>
					</div>
			<div class="write_line"></div>
			<div id="write_row3"><div class="col1"> 장소  (<input type="checkbox" name="check_place" value=""> 사용할 경우 체크)</div> </div>
			                     <div class="col2"><input type="text" name="place" value="<?=$item_place?>"></div>
			<div class="write_line"></div>
			<div id="write_row4"><div class="col1"> 내용   </div>
			                     <div class="col2"><textarea rows="15" cols="79" name="content"><?=$item_content?></textarea></div>
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
