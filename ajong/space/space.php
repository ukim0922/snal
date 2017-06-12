<?php
session_start();
if(isset($_SESSION['$current_page']))
{
	unset($_SESSION['$current_page']);
}
$_SESSION['$current_page'] = 4;
if(!isset($_SESSION['user_session'])){
	echo "<script>alert(\"로그인 해주세요!\");
	window.location.href='../mem/login.php';
	</script>";
}
?>

<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title></title>
<link href="../css/bootstrap.min.css" rel="stylesheet"/>
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
	<iframe class="iframe" src="http://space.yonsei.ac.kr" >
	</iframe>
</div>
<div id="footer">
	<p>강원도 원주시 연세대길1 학관 4층</p>
</div>
</body>
</html>