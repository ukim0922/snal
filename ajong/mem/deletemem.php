<?php
session_start();

if(isset($_SESSION['$current_page']))
{
	unset($_SESSION['$current_page']);
}
$_SESSION['$current_page'] = 0;

require_once('class.crud.php');
$user = new crud();

if(isset($_POST['btn-del']))
{
	$id = $_GET['delete_id'];
	$user->delete($id);
	header("Location: deletemem.php?deleted");
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
			<h2><strong>Member delete</strong></h2> 
	</div>
	<div class="container">

	<?php
	if(isset($_GET['deleted']))
	{
		?>
        <div class="alert alert-success">
    	<i class="glyphicon glyphicon-info-sign"></i>&nbsp;<strong>성공!</strong> 회원이 삭제되었습니다. 
		</div>
        <?php
	}
	else
	{
		?>
        <div class="alert alert-danger">
    	<i class="glyphicon glyphicon-warning-sign"></i>&nbsp; <strong>정말로 지우시겠습니까?</strong>
		</div>
        <?php
	}
	?>	
</div>
	<div class="container">
 	
	 <?php
	 if(isset($_GET['delete_id']))
	 {
		 ?>
         <table class='table table-bordered'>
         <tr>
	     <th>id</th>
	     <th>name</th>
	     <th>position</th>
	     <th>phone</th>
	     <th>Birth Day</th>
         </tr>
         <?php
         $stmt = $user->runQuery("SELECT * FROM personal_info WHERE id=:id");
         $stmt->execute(array(":id"=>$_GET['delete_id']));
         while($row=$stmt->fetch(PDO::FETCH_BOTH))
         {
             ?>
             <tr>
                <td><?php print($row['id']); ?></td>
                <td><?php print($row['name']); ?></td>
                <td><?php print($row['position']); ?></td>
                <td><?php print($row['phone_number']); ?></td>
                <td><?php print($row['date_of_birth']); ?></td>
             </tr>
             <?php
         }
         ?>
         </table>
         <?php
	 }
	 ?>
	</div>
	
	<div class="container">
	<p>
	<?php
	if(isset($_GET['delete_id']))
	{
		?>
	  	<form method="post">
	    <input type="hidden" name="id" value="<?php echo $row['id']; ?>" />
	    <button class="btn btn-large btn-primary" type="submit" name="btn-del"><i class="glyphicon glyphicon-trash"></i> &nbsp; 네</button>
	    <a href="manage.php" class="btn btn-large btn-success"><i class="glyphicon glyphicon-backward"></i> &nbsp; 아니오</a>
	    </form>  
		<?php
	}
	else
	{
		?>
	    <a href="manage.php" class="btn btn-large btn-success"><i class="glyphicon glyphicon-backward"></i> &nbsp; 뒤로</a>
	    <?php
	}
	?>
	</p>
	</div>	
	</div>
	</div>
</div>