<?php
session_start();
if(isset($_SESSION['$current_page']))
{
	unset($_SESSION['$current_page']);
}
$_SESSION['$current_page'] = 1;
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title></title>
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

	<div id="page" class="container">
		<div><a href="#" class="image image-full"><img src="../images/snal2.png" alt=""></img></a></div>
			<div class="title">
				<h2><strong>SNAL</strong> : Yonsei University Badminton Club</h2>
				<span class="byline">쉽게 접할 수 있고, 남녀노소 즐길 수 있는 배드민턴! 연세대학교 동아리 스날 웹페이지에 오신것을 환영합니다.</span>
			</div>
	</div>
	<div id="portfolio-wrapper">
		<div id="portfolio" class="container">
			<div class="title">
				<h2>CONTACT US</h2>
				<span class="byline">welcome to badminton world</span> 
			<img src="../images/snal_logo.jpg" alt="" ></img>
			</div>
				<div class="box">
					<h3>가입 문의</h3>
					<p> 회장 : 서명인 (010-8620-1491)</p>
				</div>
	</div>
	</div>
</div>
<div id="footer">
	<p>강원도 원주시 연세대길1 학관 4층</p>
</div>
</body>
</html>