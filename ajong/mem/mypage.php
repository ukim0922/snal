<?php 
session_start();

if(isset($_SESSION['$current_page']))
{
	unset($_SESSION['$current_page']);
}
$_SESSION['$current_page'] = 0;

if(!isset($_SESSION['user_session'])){
	echo "<script>alert(\"로그인 해주세요!\");
	window.location.href='../mem/login.php';
	</script>";
}

?>


<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Coding Cage : Sign up</title>
<link href="../css/bootstrap.min.css" rel="stylesheet" media="screen">
<link href="../css/bootstrap-theme.min.css" rel="stylesheet" media="screen">
<link rel="stylesheet" href="style.css" type="text/css"  />
</head>
<body>

<div class="signin-form">

<div class="container">
    	
        <form method="post" class="form-signin">
            <h2 class="form-signin-heading">마이페이지</h2><hr />
            <?php
			if(isset($error))
			{
			 	foreach($error as $error)
			 	{
					 ?>
                     <div class="alert alert-danger">
                        <i class="glyphicon glyphicon-warning-sign"></i> &nbsp; <?php echo $error; ?>
                     </div>
                     <?php
				}
			}
			else if(isset($_GET['joined']))
			{
				 ?>
                 <div class="alert alert-info">
                      <i class="glyphicon glyphicon-log-in"></i> &nbsp; Successfully registered <a href='login.php'>login</a> here
                 </div>
                 <?php
			}
			?>
			<div class="form-group">
            <input type="radio" name="txt_uposi" value="부원" checked="checked" /> 재학생&nbsp;
            <input type="radio" name="txt_uposi" value="선배님" /> 선배님&nbsp;
            </div>
            <div class="form-group">
            
            <input type="text" class="form-control" name="txt_uid" placeholder="ID입력" value="<?php if(isset($error)){echo $uid;}?>" />
            </div>
            <div class="form-group">
            	<input type="password" class="form-control" name="txt_upass" placeholder="비밀번호" />
            </div>
            <div class="form-group">
            	<input type="password" class="form-control" name="txt_upasscheck" placeholder="비밀번호 확인" />
            </div>            
            <div class="form-group">
            <input type="text" class="form-control" name="txt_uname" placeholder="이름" value="<?php if(isset($error)){echo $uname;}?>" />
            </div>
            <div class="form-group">
            <input type="text" class="form-control" name="txt_uphone" placeholder="휴대폰번호" value="<?php if(isset($error)){echo $uphone;}?>" />
            </div>
            <div class="form-group">
            <input type="text" class="form-control" name="txt_ubir" placeholder="생년월일 ex)19990101" value="<?php if(isset($error)){echo $ubir;}?>" />
            </div>
            
            <div class="clearfix"></div><hr />
            <div class="form-group">
            	<button type="submit" class="btn btn-primary" name="btn-signup">
                	<i class="glyphicon glyphicon-open-file"></i>가입
                </button>
            </div>
            <br />
            <label>이미 가입되어 있다면 <a href="login.php">로그인</a></label>
        </form>
       </div>
</div>

</div>
<div id="footer">
	<p>강원도 원주시 연세대길1 학관 4층</p>
</div>
</body>
</html>