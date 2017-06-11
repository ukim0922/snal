<?php

if(!isset($_SESSION['user_session']))
{
	?>
 	<a id="top" href="../mem/login.php">로그인</a> | <a id="top" href="../mem/register.php">회원가입</a>
	<?php
}
else
{
	if($_SESSION['user_session']=="admin"){
	?>
	<a id="top" href="../mem/logout.php?logout=true">로그아웃</a> | <a id="top" href="../mem/manage.php">회원관리</a>
	<?php
	}
	else {
	?>
	<a id="top" href="../mem/logout.php?logout=true">로그아웃</a> | <a id="top" href="../mem/mypage.php">마이페이지</a>
	<?php
	}
}
?>