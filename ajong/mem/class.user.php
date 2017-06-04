<?php
require_once('../common/dbconnect.php');
class USER
{
	private $conn;
	
	public function __construct()
	{
		$database = new Database();
		$db = $database->dbConnection();
		$this->conn = $db;
	}
	
	public function runQuery($sql)
	{
		$stmt = $this->conn->prepare($sql);
		return $stmt;
	}
	
	public function register($uid,$upass,$uname,$uposi,$ubir,$uphone)
	{
		try
		{
			$new_password = password_hash($upass, PASSWORD_DEFAULT);
			$stmt = $this->conn->prepare("INSERT INTO personal_info(id,password, name,
												position, date_of_birth, phone_number)
                                         VALUES(:uid, :upass, :uname, :uposi, :ubir, :uphone)");
			$stmt->bindparam(":uid", $uid);
			$stmt->bindparam(":upass", $new_password);
			$stmt->bindparam(":uname", $uname);
			$stmt->bindparam(":uposi", $uposi);
			$stmt->bindparam(":ubir", $ubir);
			$stmt->bindparam(":uphone", $uphone);
			
			$stmt->execute();
			
			return $stmt;
		}
		catch(PDOException $e)
		{
			echo $e->getMessage();
		}
	}
	
	public function login($uid,$upass)
	{
		try
		{
			$stmt = $this->conn->prepare("SELECT * FROM personal_info WHERE id=:uid LIMIT 1");
			$stmt->execute(array(':uid'=>$uid));
			$userRow=$stmt->fetch(PDO::FETCH_ASSOC);
			if($stmt->rowCount() == 1)
			{
				if(password_verify($upass, $userRow['password']))
				{
					$_SESSION['user_session'] = $userRow['id'];
					return true;
				}
				else
				{
					return false;
				}
			}
		}
		catch(PDOException $e)
		{
			echo $e->getMessage();
		}
	}
	
	public function is_loggedin()
	{
		if(isset($_SESSION['user_session']))
		{
			return true;
		}
	}
	
	public function redirect($url)
	{
		header("Location: $url");
	}
	
	public function logout()
	{
		session_destroy();
		unset($_SESSION['user_session']);
		return true;
	}
}
?>