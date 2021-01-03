<?php 
include 'config.php';
//获得get数据
$id=(int)$_GET['id'];
//开启事务处理
$pdo->beginTransaction();
try{
	//准备sql语句
	$sql="delete from student where id={$id}";
	$smt=$pdo->prepare($sql);
	$smt->execute();
	$pdo->commit();
}catch(PDOException $e){
	$pdo->rollBack();
}
echo "<script>location='print.php?sortid=0&whereid=-1&wherename='</script>";
 ?>

