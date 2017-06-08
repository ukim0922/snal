<?php
session_start();
$pdo = new PDO('mysql:host=localhost;dbname=sampledb;charset=utf8', 'root', '243146');	
$table = $_GET['table'];
$num = $_GET['num'];

$sql = "select * from $table where num=$num";
$result = $pdo->query($sql);
$row = $result->fetch();


$sql = "delete from $table where num = $num";
$result = $pdo->query($sql);
$row = $result->fetch();
//mysql_query($sql, $connect);


if($pdo){
	$pdo= NULL;
}
//mysql_close();
echo "
<script>
location.href = '../community/community.php?table=$table';
</script>
";
?>

	