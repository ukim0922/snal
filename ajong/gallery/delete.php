<?php
session_start();
$pdo = new PDO('mysql:host=localhost;dbname=sampledb;charset=utf8', 'root', '243146');	
$table = $_GET['table'];
$num = $_GET['num'];

$sql = "select * from $table where num=$num";
$result = $pdo->query($sql);
$row = $result->fetch();

$copied_name[0] = $row[file_copied_0];
$copied_name[1] = $row[file_copied_1];
$copied_name[2] = $row[file_copied_2];

for ($i=0; $i<3; $i++)
{
	if ($copied_name[$i])
	{
		$image_name = "./data/".$copied_name[$i];
		unlink($image_name);
	}
}

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
location.href = '../gallery/gallery.php?table=$table';
</script>
";
?>

	