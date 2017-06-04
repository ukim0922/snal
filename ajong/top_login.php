<?php

if(!isset($_SESSION['user_session']))
{
	?>
 	<a href="login.php">로그인</a> | <a href="register.php">회원가입</a>
	<?php
}
else
{
	?>
	<a href="logout.php?logout=true">로그아웃</a> | <a href="mypage.php">마이페이지</a>
	<?php
}
?>