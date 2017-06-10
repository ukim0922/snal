<?php

if(!isset($_SESSION['user_session']))
{
	?>
 	<a href="../mem/login.php">로그인</a> | <a href="../mem/register.php">회원가입</a>
	<?php
}
else
{
	if($_SESSION['user_session']=="admin"){
	?>
	<a href="../mem/logout.php?logout=true">로그아웃</a> | <a href="../mem/manage.php">회원관리</a>
	<?php
	}
	else {
	?>
	<a href="../mem/logout.php?logout=true">로그아웃</a> | <a href="../mem/mypage.php">마이페이지</a>
	<?php
	}
}
?>