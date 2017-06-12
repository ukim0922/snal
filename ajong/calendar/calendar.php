<?php
session_start();
if(isset($_SESSION['$current_page']))
{
	unset($_SESSION['$current_page']);
}
$_SESSION['$current_page'] = 3;
require_once('../common/dbconnect.php');

$pdo = new PDO('mysql:host=localhost;dbname=sampledb;charset=utf8', 'root', '243146');

if(!isset($_SESSION['user_session'])){
	echo "<script>alert(\"로그인 해주세요!\");
	window.location.href='../mem/login.php';
	</script>";
}

if(isset($_REQUEST['yy']) && $_REQUEST['yy']!=""){
	$yy = $_REQUEST['yy'];
}
if(isset($_REQUEST['mm']) && $_REQUEST['mm']!=""){
	$mm = $_REQUEST['mm'];
}
if(!isset($yy)){ $yy = date('Y');}
if(!isset($mm)){ $mm = date('m');}

function sel_yy($yy, $func) {
	if($yy == '') $yy = date('Y');
	
	if($func=='') {
		$str = "<select class='form-control' name='yy'>\n<option value=''></option>\n";
	} else {
		$str = "<select class='form-control'name='yy' onChange='$func'>\n<option value=''></option>\n";
	}
	$gijun = date('Y');
	for($i=$gijun-5;$i<$gijun+2;$i++) {
		if($yy == $i) $str .= "<option value='$i' selected>$i</option>";
		else $str .= "<option value='$i'>$i</option>";
	}
	$str .= "</select>";
	return $str;
}

function sel_mm($mm, $func) {
	if($func=='') {
		$str = "<select class='form-control input-sm' name='mm'>\n";
	} else {
		$str = "<select class='form-control input-sm' name='mm' onChange='$func'>\n";
	}
	for($i=1;$i<13;$i++) {
		if($mm == $i) $str .= "<option value='$i' selected>{$i}</option>";
		else $str .= "<option value='$i'>{$i}</option>";
	}
	$str .= "</select>";
	return $str;
}


// 1. 총일수 구하기
$last_day = date("t", strtotime($yy."-".$mm."-01"));

// 2. 시작요일 구하기
$start_week = date("w", strtotime($yy."-".$mm."-01"));

// 3. 총 몇 주인지 구하기
$total_week = ceil(($last_day + $start_week) / 7);

// 4. 마지막 요일 구하기
$last_week = date('w', strtotime($yy."-".$mm."-".$last_day));
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<title>SNAL</title>
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
					<h2><strong>CALENDAR</strong></h2> 
			</div>
<form name="form" method="get">
<table width="100%" class="cal" cellpadding='0'  align="center" cellspacing='1'>
<tr align="center">
		<td height="50" align="center" colspan="7">
		<div style="width:50%" class="form-inline" align="center">
				<span  id="y"  style="width:30%" >
				<?php echo sel_yy($yy,'submit();');?>
				<label  for="y" class="label">년</label>
				</span>
				<span  id="m"  style="width:30%" >
				<?php echo sel_mm($mm,'submit();');?>
				<label  for="m" class="label">월</label>
				</span>	
		</div>
		</td>
</tr>
<tr bgcolor="#ccdde2">
<td  height="30" align="center" ><b>일</b></td>
<td  align="center"><b>월</b></td>
<td  align="center"><b>화</b></td>
<td align="center" ><b>수</b></td>
<td  align="center" ><b>목</b></td>
<td  align="center" ><b>금</b></td>
<td align="center" ><b>토</b></td>
</tr>

<?php 
$today_yy = date('Y');
$today_mm = date('m');
// 5. 화면에 표시할 화면의 초기값을 1로 설정
$day=1;

// 6. 총 주 수에 맞춰서 세로줄 만들기
for($i=1; $i <= $total_week; $i++){?>
<tr>
<?php 
	// 7. 총 가로칸 만들기
	for ($j=0; $j<7; $j++){
?>
<td height="120" align="left" valign="top" bgcolor="#FFFFFF">
  <?php 
	// 8. 첫번째 주이고 시작요일보다 $j가 작거나 마지막주이고 $j가 마지막 요일보다 크면 표시하지 않아야하므로
	//    그 반대의 경우 -  ! 으로 표현 - 에만 날자를 표시한다.
	if (!(($i == 1 && $j < $start_week) || ($i == $total_week && $j > $last_week))){

		if($j == 0){
			// 9. $j가 0이면 일요일이므로 빨간색
			echo "<font color='#FF0000'><b>";
		}else if($j == 6){
			// 10. $j가 0이면 일요일이므로 파란색
			echo "<font color='#0000FF'><b>";
		}else{
			// 11. 그외는 평일이므로 검정색
			echo "<font color='#000000'><b>";
		}

		// 12. 오늘 날자면 굵은 글씨
		if($today_yy == $yy && $today_mm == $mm && $day == date("j")){
			echo "<u>";
		}
		
		// 13. 날자 출력
		echo $day;

		if($today_yy == $yy && $today_mm == $mm && $day == date("j")){
			echo "</u>";
		}

		echo "</b></font> &nbsp;";

		//스케줄 출력
		if($yy!=null && $mm!=null && $day!=null ){
			$tdate = date("Y-m-d", mktime(0, 0, 0, $mm, $day, $yy));
		}
		if($tdate !=null){
			//공지사항 출력
			try{
				$res = $pdo->query("SELECT COUNT(*) FROM notice where date='$tdate' order by num desc");
				$total_record= $res->fetchColumn();// 전체 글 개수
				
				$result = $pdo->query("select * from notice where date='$tdate' order by num desc");
				
				$result_array = $result->fetchAll();
				for ($k=0; $k<$total_record; $k++){
					$row= $result_array[$k];
					$num = $row['num'];
					$item_title     = $row['title'];
					$item_place    = $row['place'];
					if($item_place){
					?>
						<li ><a href="../notice/view.php?table=notice&num=<?=$num?>&page=2"><?=$item_title?> / <?=$item_place?></a></li>
					<?php }
					else{
						?>
						<li ><a href="../notice/view.php?table=notice&num=<?=$num?>&page=2"><?=$item_title?></a></li>
					<?php
					}
				}
				$result->execute();
			} catch(PDOException $e)
			{
				echo $e->getMessage();
				return false;
			}
			////생일출력
			try{
				$tmp_day=substr($tdate, 5,5);
				$res = $pdo->query("SELECT COUNT(*) FROM personal_info where date_of_birth like '%$tmp_day'");
				$total_record= $res->fetchColumn();// 전체 회원 수 
				$result = $pdo->query("select * from personal_info where date_of_birth like '%$tmp_day'");
				
				$result_array = $result->fetchAll();
				for ($k=0; $k<$total_record; $k++){
					$row= $result_array[$k];					
					
					$birth_mm=substr($row['date_of_birth'], 5,2);
					$birth_dd=substr($row['date_of_birth'], 8,2);
					if($mm==$birth_mm && $day==$birth_dd){
					?>
						<li><a><?=$row['name']?> <?=$row['position']?>의 생일을 축하합니다!</a></li>
					<?php }
				}
				$result->execute();
			} catch(PDOException $e)
			{
				echo $e->getMessage();
				return false;
			}
			
		}
		// 14. 날짜증가
		$day++;
	}
	?>
</td>
<?php }?>
</tr>
<?php }?>
</table> 
</form>
</div>
       </div>
</div>

<div id="footer">
	<p>강원도 원주시 연세대길1 학관 4층</p>
</div>
</body>
</html>