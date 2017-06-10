<?php
session_start();

if(isset($_SESSION['$current_page']))
{
	unset($_SESSION['$current_page']);
}
$_SESSION['$current_page'] = 0;

require_once('class.crud.php');
$user = new crud();
if(isset($_GET['edit_id']))
{
	$id = $_GET['edit_id'];
	extract($user->getID($id));
}

if(isset($_POST['btn-update']))
{
	$uid= $_GET['edit_id'];
	$upass= strip_tags($_POST['txt_upass']);
	$upasscheck= strip_tags($_POST['txt_upasscheck']);
	$uname= $_POST['txt_uname'];
	$uposi= $_POST['txt_uposi'];
	$uphone= $_POST['txt_uphone'];
	
	$yyyy=$_POST['yyyy'];
	$mm=$_POST['mm'];
	$dd=$_POST['dd'];
	$date = date("Y-m-d", mktime(0, 0, 0, $mm, $dd, $yyyy)); 
	
	$uphone = preg_replace("/[^0-9]/", "", $uphone);
	
	if($uname=="")	{
		$error[] = "이름을 입력해주세요!";
	}
	else if($upass=="")	{
		$error[] = "비밀번호를 입력해주세요!";
	}
	else if($upass !== $upasscheck){
		$error[] = "비밀번호가 일치하지 않습니다!";
	}
	else if(!preg_match("/^01[0-9]{8,9}$/", $uphone)){
		$error[] = "휴대폰 번호를 올바르게 입력해주세요!";
	}
	else if($uphone=="")	{
		$error[] = "휴대폰 번호를 입력해주세요!";
	}
	else if(!checkdate($mm, $dd, $yyyy)){
		$error[] = "생년월일을 확인해 주세요";
	}
	
	else
	{
		try
		{
			$stmt = $user->runQuery("SELECT id, phone_number FROM personal_info WHERE id=:uid OR phone_number=:uphone");
			$stmt->execute(array(':uid'=>$uid, ':uphone'=>$uphone));
			$row=$stmt->fetch(PDO::FETCH_ASSOC);
			
			if($row['phone_number']==$uphone && $uphone!=$phone_number) {
				
				$error[] = "이미 가입된 번호입니다.";
			}
			else
			{
				if($user->editmy($uid,$upass,$uname,$uposi,$date,$uphone))
				{
					$msg= "수정이 완료되었습니다!";
				}
				else
				{
					$error[]= "다시 수정해주세요!";
				}
			}
			
		}
		catch(PDOException $e)
		{
			echo $e->getMessage();
		}
	}
}
if(isset($_GET['edit_id']))
{
	$id = $_GET['edit_id'];
	extract($user->getID($id));
}

$yyyy=substr($date_of_birth, 0,4);
$mm=substr($date_of_birth, 5,2);
$dd=substr($date_of_birth, 8,2);

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
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
			<h2><strong>Member edit</strong></h2> 
	</div>
	<form method="post" class="form-horizontal">
            <?php
            if(isset($error))
			{
				foreach($error as $error){
					 ?>
                     <div class="alert alert-danger">
                        <i class="glyphicon glyphicon-warning-sign"></i> &nbsp; <?php echo $error; ?>
                     </div>
                     <?php
				}
			}
			if(!isset($error)&&isset($msg)){
				?>
                     <div class="alert alert-info">
                        <i class="glyphicon glyphicon-info-sign"></i> &nbsp; <?php echo $msg; ?>
                     </div>
                    <?php
			}
			
			?>
			       
			<div class="form-group">
				<label class="col-sm-2 control-label" for="inputEmail"></label>
				<div class="col-sm-6">
				<?php 
				if(!strcmp($position,"선배님")){
				?>
					<input type="radio" name="txt_uposi" value="부원" /> 재학생&nbsp;
					<input type="radio" name="txt_uposi" value="선배님" checked="checked"/> 선배님&nbsp;
				<?php 
				}
				else if(!strcmp($position,"부원")){
					?>
					<input type="radio" name="txt_uposi" value="부원" checked="checked" /> 재학생&nbsp;
					<input type="radio" name="txt_uposi" value="선배님" /> 선배님&nbsp;
				<?php 
				}
				?>
            	</div>
            </div>
            <div class="form-group">
            	<label class="col-sm-2 control-label">ID</label>
            	<div class="col-sm-6">
            	<input type="text" class="form-control" name="edit_id" value="<?php echo $id;?>" disabled />
            	</div>
            </div>
            <div class="form-group">
            	<label class="col-sm-2 control-label">비밀번호</label>
            	<div class="col-sm-6">
            	<input type="password" class="form-control" name="txt_upass" placeholder="비밀번호" required/>
            	</div>
            </div>
            
            <div class="form-group">
            	<label class="col-sm-2 control-label">비밀번호 확인</label>
            	<div class="col-sm-6">
            	<input type="password" class="form-control" name="txt_upasscheck" placeholder="비밀번호 확인" required />
            	</div>
            </div>  
                 
            <div class="form-group">
            	<label class="col-sm-2 control-label">이름</label>
           		<div class="col-sm-6">
            	<input type="text" class="form-control" name="txt_uname" value="<?php echo $name;?>" required />
            	</div>
            </div>
            
            <div class="form-group">
            	<label class="col-sm-2 control-label">휴대폰번호</label>
            	<div class="col-sm-6">
           		<input type="text" class="form-control" name="txt_uphone" size="11" value="<?php echo $phone_number;?>" />
            	</div>
            </div>
         
            <div class="form-group">
	            <label class="col-sm-2 control-label">생년월일</label>
	            <div class="col-sm-6">
		            <div class="input-group">
		            	<span class="input-group-addon">
		            	<?php
		            	$yearRange = 60;
		            	// 선택되어질 년도 - 현재년 기준 60년전의 년도가 선택되어집니다.
		            	$currentYear = date('Y');
		            	$startYear = ($currentYear-$yearRange);
		            	?>
		            	<select name="yyyy" class="form-control input-sm">
		            	<option value="">년</option>
		            	<?php 
		            	foreach (range($currentYear, $startYear)as $selected){        		
		            	?>
		            		<option value="<?php echo $selected;?>"<?php if($yyyy!=null && $selected==$yyyy){echo "selected";} else echo ""; ?> > <?php echo $selected;?></option>
		            	<?php 	
		            	}
		            	?>
		            	</select>
		  				</span>
		  				<span class="input-group-addon">
		            	<select name="mm" class="form-control input-sm">
		            	<option value="">월</option>
		            	<?php 
		            	$selected = "";
		            	foreach (range(1, 12) as $selected){    		
		            	?>
		            		<option value="<?php echo $selected;?>"<?php if($mm!=null && $selected==$mm){echo "selected";} else echo "";?> > <?php echo $selected;?></option>
		            	<?php 	
		            	}
		            	?>
		            	</select>

		  				</span>
		  				<span class="input-group-addon">
	    				<select name="dd" class="form-control input-sm" value="<?php if(isset($error)){echo $dd;}?>">
    					<option value=""<?php if($dd==""){echo "selected";} else echo "";?>>일</option>
    					<?php 
    					$selected = "";
		            	foreach (range(1, 31) as $selected){    		
		            	?>
		            		<option value="<?php echo $selected;?>"<?php if($dd!=null && $selected==$dd){echo "selected";} else echo "";?> > <?php echo $selected;?></option>
		            	<?php 	
		            	}
		            	?>
						</select>
		  				</span>
					</div>
				</div>
			</div>
            <div class="clearfix"></div>
            <div class="form-group">
            <div class="col-sm-2">
            </div>
            	<div class="col-sm-6">
            	<a href="manage.php" class="button">
                	뒤로
                </a>
            	<button type="submit" class="button" name="btn-update">
                	수정
                </button>
                </div>
                
            	
            </div>
           
        </form>
	
	</div>
	
	</div>
</div>
<div id="footer">
	<p>강원도 원주시 연세대길1 학관 4층</p>
</div>
</body>
</html>

