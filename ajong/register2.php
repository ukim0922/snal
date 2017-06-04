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
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Coding Cage : Sign up</title>
<link href="css/bootstrap.min.css" rel="stylesheet" media="screen">
<link href="css/bootstrap-theme.min.css" rel="stylesheet" media="screen">
<link rel="stylesheet" href="style.css" type="text/css"  />
</head>
<body>

<div class="signin-form">

<div class="container">
    	
        <form method="post" class="form-signin">
            <h2 class="form-signin-heading">회원가입</h2><hr />
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
			</div>
	<div class="row">
		<div class="col-sm-offset-2 col-sm-8">
			<form class="form-horizontal" role="form" id="joinForm" method="post" action="" autocomplete="off">
				<div class="panel panel-default">
					<div class="panel-heading">
						Create Account
					</div> <!-- panel heading -->
					
					<div class="panel-body">
						<div class="form-group joinForm-id">
							<label for="id" class="col-sm-4 control-label"> 아이디 <br> <small class="text-danger">(필수입력)</small> </label>
							<div class="col-sm-6">
								<div class="input-group">
									<input id="id" name="id" type="text" class="form-control" placeholder="User ID" autofocus>
									<span class="input-group-btn">
										<button type="button" class="btn btn-default id2_btn">중복확인</button>
									</span>
								</div>
								<input id="id2" name="id2" type="text" class="hidden"/>
							</div>
						</div>
						<div class="form-group joinForm-pw">
							<label for="pw" class="col-sm-4 control-label"> 비밀번호 <br> <small class="text-danger">(필수입력)</small> </label>
							<div class="col-sm-6">
								<input id="pw" name="pw" type="password" class="form-control" placeholder="Password">
							</div>
						</div>
						<div class="form-group joinForm-pw2">
							<label for="pw2" class="col-sm-4 control-label"> 비밀번호 확인 <br> <small class="text-danger">(필수입력)</small> </label>
							<div class="col-sm-6">
								<input id="pw2" name="pw2" type="password" class="form-control" placeholder="Password (Re-type)">
							</div>
						</div>
						<div class="form-group joinForm-name">
							<label for="name" class="col-sm-4 control-label"> 이름 <br> <small class="text-danger">(필수입력)</small> </label>
							<div class="col-sm-6">
								<input id="name" name="name" type="text" class="form-control" placeholder="User name" value="">
							</div>
						</div>
						<div class="form-group joinForm-email">
							<label for="email" class="col-sm-4 control-label"> 이메일  주소 <br> <small class="text-danger">(필수입력)</small> </label>
							<div class="col-sm-6">
								<input id="email" name="email" type="text" class="form-control" placeholder="Email Address" value="">
							</div>
						</div>
					    						<div class="form-group joinForm-birthdate">
							<label for="birthdate" class="col-sm-4 control-label"> 생년월일  </label>
							<div class="col-sm-6">
								<input id="birthdate" name="birthdate" type="text" class="form-control" placeholder="Click Here" readonly style="cursor:pointer;">
							</div>
						</div>
					    						<div class="form-group joinForm-tel">
							<label for="tel" class="col-sm-4 control-label"> 전화번호  </label>
							<div class="col-sm-6">
								<input id="tel" name="tel" type="text" class="form-control" placeholder="000-0000-0000">
							</div>
						</div>
					    						<div class="form-group joinForm-zipcode">
							<label for="zip" class="col-sm-4 control-label"> 우편번호  </label>
							<div class="col-sm-6">
								<input id="zipcode" name="zipcode" type="text" class="form-control" placeholder="000-000">
							</div>
						</div>
												<div class="form-group joinForm-addr">
							<label for="addr" class="col-sm-4 control-label"> 주소  </label>
							<div class="col-sm-6">
								<input id="addr" name="addr" type="text" class="form-control" placeholder="">
							</div>
						</div>
					    						<div class="form-group joinForm-receive-email">
							<label for="receive_email" class="col-sm-4 control-label"> 이메일 수신 동의 </label>
							<div class="col-sm-6 form-control-static">
								<input id="receive_email" name="receive_email" type="checkbox" value="checked" >
							</div>
						</div>
                                                <input name="n_id" type="hidden" value="">
					</div><!-- panel body -->
					<div class="panel-footer">
						<div class="form-group" style="padding-top: 10px">
							<div class="col-sm-offset-3 col-sm-6">
								<button class="btn btn-lg btn-primary btn-block" type="submit">Create Account</button>
								<input type="hidden" name="do" value="user_add">
								<input type="hidden" name="join_priv_agree" value="1"/>
								<input type="hidden" name="join_user_agree" value="1"/>
							</div>
						</div>						
					</div>
				</div>
			</form>	
		</div>
	</div>

</div>
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

</body>
</html>
