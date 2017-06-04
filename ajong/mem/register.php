<?php
session_start();
require_once('class.user.php');
$user = new USER();

if($user->is_loggedin()!="")
{
	$user->redirect('index.php');
}

if(isset($_POST['btn-signup']))
{	
	$uid= strip_tags($_POST['txt_uid']);
	$upass= strip_tags($_POST['txt_upass']);
	$upasscheck= strip_tags($_POST['txt_upasscheck']);
	$uname= strip_tags($_POST['txt_uname']);
	$uposi= strip_tags($_POST['txt_uposi']);
	$ubir= strip_tags($_POST['txt_ubir']);
	$uphone= strip_tags($_POST['txt_uphone']);
	
	if($uid=="")	{
		$error[] = "아이디를 입력해주세요!";
	}
	else if($upass=="")	{
		$error[] = "비밀번호를 입력해주세요!";
	}
	else if($upass !== $upasscheck){
		$error[] = "비밀번호가 일치하지 않습니다!";
	}
	else if($uname=="")	{
		$error[] = "이름을 입력해주세요!";
	}
	else if($uposi=="")	{
		$error[] = "정보를 선택해주세요!";
	}
	else if($uphone=="")	{
		$error[] = "휴대폰 번호를 입력해주세요!";
	}
	else if(strlen($upass) < 8){
		$error[] = "비밀번호를 8자리 이상 문자로 입력해 주세요";
	}
	else
	{
		try
		{
			$stmt = $user->runQuery("SELECT id, phone_number FROM personal_info WHERE id=:uid OR phone_number=:uphone");
			$stmt->execute(array(':uid'=>$uid, ':uphone'=>$uphone));
			$row=$stmt->fetch(PDO::FETCH_ASSOC);
			
			if($row['id']==$uid) {
				$error[] = "이미 존재하는 ID입니다.";
			}
			else if($row['phone_number']==$uphone) {
				$error[] = "이미 가입된 번호입니다.";
			}
			else
			{
				if($user->register($uid,$upass,$uname,$uposi,$ubir,$uphone)){
					$user->redirect('register.php?joined');
				}
			}
		}
		catch(PDOException $e)
		{
			echo $e->getMessage();
		}
	}
}

?>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<title>SNAL</title>

	<link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/3.0.0/css/bootstrap-datetimepicker.min.css" rel="stylesheet" /> 
	<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.8.2/moment-with-locales.min.js"></script> 
	<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/3.0.0/js/bootstrap-datetimepicker.min.js"></script>

	<link rel="stylesheet" type="text/css" href="css/datepicker.css" />
	<script type="text/javascript" src="js/bootstrap-datepicker.js"></script>
	<script type="text/javascript" src="js/bootstrap-datepicker.kr.js"></script>

	<link rel="stylesheet" href="css/bootstrap.min.css" />
	<link rel="stylesheet" href="css/bootstrap-theme.min.css" />

	
	<meta name="keywords" content="" />
	<meta name="description" content="" />
	
	<link href="http://fonts.googleapis.com/css?family=Source+Sans+Pro:200,300,400,600,700,900|Varela+Round" rel="stylesheet" />
	<link href="default.css" rel="stylesheet" type="text/css" media="all" />
	<link href="fonts.css" rel="stylesheet" type="text/css" media="all" />
	

<!--[if IE 6]>
<link href="default_ie6.css" rel="stylesheet" type="text/css" />
<![endif]-->
</head>
<body>
<div id="wrapper">
<?php include "menu.php"; ?>

<script type="text/javascript">
$(function () {
	$("#birthdate").datetimepicker({
		format: "yyyy-mm-dd",
        autoclose: true,
        todayBtn: false,
		minView: 2,
        pickerPosition: "bottom-left"
	});
});
</script>

<div id="portfolio-wrapper">
<div id="page" class="container">
            <div class="title">
					<h2><strong>JOIN</strong></h2> 
			</div>
			
			<form method="post" class="form-horizontal">
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
          <label class="col-sm-3 control-label" for="inputEmail">이메일</label>
          <div class="col-sm-6">
          <input class="form-control" id="inputEmail" type="email" placeholder="이메일">
          </div>
        </div>
        
			<div class="form-group">
				<label class="col-sm-3 control-label" for="inputEmail">YB OB</label>
				<div class="col-sm-6">
            	<input type="radio" name="txt_uposi" value="부원" checked="checked" /> 재학생&nbsp;
            	<input type="radio" name="txt_uposi" value="선배님" /> 선배님&nbsp;
            	</div>
            </div>
            
            <div class="form-group">
            	<label class="col-sm-3 control-label">ID</label>
            	<div class="col-sm-6">
            	<input type="text" class="form-control" name="txt_uid" placeholder="ID입력" value="<?php if(isset($error)){echo $uid;}?>" />
            	</div>
            </div>
            
            <div class="form-group">
            	<label class="col-sm-3 control-label">비밀번호</label>
            	<div class="col-sm-6">
            	<input type="password" class="form-control" name="txt_upass" placeholder="비밀번호" />
            	</div>
            </div>
            
            <div class="form-group">
            	<label class="col-sm-3 control-label">비밀번호 확인</label>
            	<div class="col-sm-6">
            	<input type="password" class="form-control" name="txt_upasscheck" placeholder="비밀번호 확인" />
            	</div>
            </div>  
                      
            <div class="form-group">
            	<label class="col-sm-3 control-label">이름</label>
           		<div class="col-sm-6">
            	<input type="text" class="form-control" name="txt_uname" placeholder="이름" value="<?php if(isset($error)){echo $uname;}?>" />
            	</div>
            </div>
            
            <div class="form-group">
            	<label class="col-sm-3 control-label">휴대폰번호</label>
            	<div class="col-sm-6">
           		<input type="text" class="form-control" name="txt_uphone" placeholder="휴대폰번호" value="<?php if(isset($error)){echo $uphone;}?>" />
            	</div>
            </div>
            
            <div class="form-group">
            	<label class="col-sm-3 control-label">생년월일</label>
            	<!--<input type="text" class="form-control" name="txt_ubir" placeholder="생년월일 ex)19990101" value="<?php if(isset($error)){echo $ubir;}?>" />-->
           		<div class="col-sm-6">
           		<input type="text" name="userbirth1" id="userbirth1" size="4"> 년
            	<span class="ps_box">
					<select id="mm" title="월" class="sel" >
						<option value="">월</option>
						<option value="1">1</option>
						<option value="2">2</option>
						<option value="3">3</option>
						<option value="4">4</option>
						<option value="5">5</option>
						<option value="6">6</option>
						<option value="7">7</option>
						<option value="8">8</option>
						<option value="9">9</option>
						<option value="10">10</option>
						<option value="11">11</option>
						<option value="12">12</option>
					</select>
				</span>
			 	<span class="ps_box">
					<select id="dd" title="일" class="sel">
						<option value="">일</option>
						<option value="1">1</option>
						<option value="2">2</option>
						<option value="3">3</option>
						<option value="4">4</option>
						<option value="5">5</option>
						<option value="6">6</option>
						<option value="7">7</option>
						<option value="8">8</option>
						<option value="9">9</option>
						<option value="10">10</option>
						<option value="11">11</option>
						<option value="12">12</option>
						<option value="13">13</option>
						<option value="14">14</option>
						<option value="15">15</option>
						<option value="16">16</option>
						<option value="17">17</option>
						<option value="18">18</option>
						<option value="19">19</option>
						<option value="20">20</option>
						<option value="21">21</option>
						<option value="22">22</option>
						<option value="23">23</option>
						<option value="24">24</option>
						<option value="25">25</option>
						<option value="26">26</option>
						<option value="27">27</option>
						<option value="28">28</option>
						<option value="29">29</option>
						<option value="30">30</option>
						<option value="31">31</option>
					</select>
				</span>
            	</div>
            </div>
            <div class="form-group">
	            <label class="col-sm-3 control-label">생년월일</label>
	            <div class="col-sm-6">
		            <div class="input-group">
		  				<span class="input-group-addon">
		    				<select name="birthday[month]" class="form-control input-sm"></select>
		  				</span>
		  				<span class="input-group-addon">
		    				<select name="birthday[day]" class="form-control input-sm"></select>
		  				</span>
		  				<span class="input-group-addon">
		    				<select name="birthday[year]" class="form-control input-sm"></select>
		  				</span>
					</div>
				</div>
			</div>
            
            
            
            
            <div class="form-group joinForm-birthdate">
							<label for="birthdate" class="col-sm-4 control-label"> 생년월일  </label>
							<div class="col-sm-6">
								<input id="birthdate" name="birthdate" type="text" class="form-control valid" placeholder="Click Here" readonly="" style="cursor:pointer;">
							</div>
			</div>
						
						
						
            <div class="clearfix"></div>
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
	<p>강원도 원주시 연세대길1 학관 313호</p>
</div>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
<script type="text/javascript" src="js/bootstrap.min.js"></script>

</body>
</html>