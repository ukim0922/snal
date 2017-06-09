<?php
session_start();
if(isset($_SESSION['$current_page']))
{
	unset($_SESSION['$current_page']);
}
$_SESSION['$current_page'] = 0;

require_once("../mem/class.user.php");
$login = new USER();

if(isset($_SESSION['user_session']))
{
	header("Location: ../common/index.php");
}

if(isset($_POST['btn-login']))
{
	$uid = strip_tags($_POST['txt_uid']);
	$upass = strip_tags($_POST['txt_password']);
	
	if($login->login($uid,$upass))
	{
		$login->redirect('../common/index.php');
	}
	else
	{
		$error = "올바른 정보를 입력하세요.";
	}
}
?>

<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<title>SNAL</title>
	<link href="../css/bootstrap.min.css" rel="stylesheet">
		
	<meta name="keywords" content="" />
	<meta name="description" content="" />
	
	<link href="http://fonts.googleapis.com/css?family=Source+Sans+Pro:200,300,400,600,700,900|Varela+Round" rel="stylesheet" />
	<link href="../css/default.css" rel="stylesheet" type="text/css" media="all" />
	<link href="../fonts/fonts.css" rel="stylesheet" type="text/css" media="all" />
	

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
					<h2><strong>LOGIN</strong></h2> 
			</div>
        <form method="post">
            <?php
            if(isset($error))
            {
                  ?>
                  <div class="alert alert-danger">
                      <i class="glyphicon glyphicon-warning-sign"></i> &nbsp; <?php echo $error; ?> !
                  </div>
                  <?php
            }
            ?>
            <div class="form-group">
             <input type="text" class="form-control" name="txt_uid" placeholder="ID" required />
            </div>
            <div class="form-group">
             <input type="password" class="form-control" name="txt_password" placeholder="비밀번호" required />
            </div>
            <div class="clearfix"></div><hr />
            <div class="form-group">
             <button type="submit" name="btn-login" class="button">
                 <i class="glyphicon glyphicon-log-in"></i>&nbsp;로그인
                </button>
            </div>
            <br />
            <label> 스날 회원이라면?! <a href="register.php"> 회원가입</a></label>
        </form>
       </div>
</div>

</body>
</html>