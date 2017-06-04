<?php
session_start();
require_once("class.user.php");
$login = new USER();

if(isset($_SESSION['user_session']))
{
	header("Location: index.php");
}

if(isset($_POST['btn-login']))
{
	$uid = strip_tags($_POST['txt_uid']);
	$upass = strip_tags($_POST['txt_password']);
	
	if($login->login($uid,$upass))
	{
		$login->redirect('index.php');
	}
	else
	{
		$error = "올바른 정보를 입력하세요.";
	}
}
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Login : cleartuts</title>
<link rel="stylesheet" href="css/bootstrap.min.css" type="text/css"  />
<link rel="stylesheet" href="style.css" type="text/css"  />
</head>
<body>
<div class="container">
     <div class="form-container">
        <form method="post">
            <h2>로그인</h2><hr />
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
             <button type="submit" name="btn-login" class="btn btn-block btn-primary">
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