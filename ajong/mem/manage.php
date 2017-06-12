<?php 
session_start();
require_once("../mem/class.crud.php");
$crud = new crud();

if(isset($_SESSION['$current_page']))
{
	unset($_SESSION['$current_page']);
}
$_SESSION['$current_page'] = 0;

if($_SESSION['user_session'] !="admin"){
	echo "<script>
	window.location.href='../common/index.php';
	</script>";
}
if(!isset($_SESSION['user_session'])){
	echo "<script>alert(\"로그인 해주세요!\");
	window.location.href='../mem/login.php';
	</script>";
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<title>SNAL</title>
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

<div id="portfolio-wrapper">
<div id="page" class="container">

<div class="title">
		<h2><strong>Member</strong></h2> 
</div>
<table class='table table-bordered'>
     <tr>
     <th>id</th>
     <th>name</th>
     <th>position</th>
     <th>phone</th>
     <th>Birth Day</th>
     <th colspan="2" align="center">Actions</th>
     </tr>
     <?php
		$query = "SELECT * FROM personal_info";       
		$records_per_page=10;
		$newquery = $crud->paging($query,$records_per_page);
		$crud->dataview($newquery);
	 ?>
    <tr>
        <td colspan="7" align="center">
 			<div class="pagination-wrap">
            <?php $crud->paginglink($query,$records_per_page); ?>
        	</div>
        </td>
    </tr>
 
</table>

</div>

</div>
</div>
<div id="footer">
	<p>강원도 원주시 연세대길1 학관 4층</p>
</div>
</body>
</html>