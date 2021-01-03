<?php
    include 'config.php';
    $sort=(int)$_GET['sortid'];
    $whereid=(int)$_GET['whereid'];
    $wherename=$_GET['wherename'];
    if ($whereid==0) {
        $sql="select * from student where name='{$wherename}'";
    } else if ($whereid==-1) {
        $sql='select * from student';
    }else{
//        $sql="select * from student where id=?";
        $sql="select * from student where id='{$whereid}'";
    }
    switch ($sort) {
        case 0:$sql=$sql.' order by id';break;
        case 1:$sql=$sql.' order by id desc';break;
        case 2:$sql=$sql.' order by score';break;
        case 3:$sql=$sql.' order by score desc';break;
    }

    $smt=$pdo->prepare($sql);
//    if ($whereid>=0) {
//        $smt->bindValue(1,$whereid,PDO::PARAM_INT);
//    }
    $smt->execute();
    $result=$smt->fetchAll();
 ?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>index</title>
	<link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
	<script src="bootstrap/js/bootstrap.min.js"></script>
	<script src="bootstrap/js/jquery.min.js"></script>
	<script>
		function conFirm() {
			if (confirm("确定要删除吗?")) return true;
			else return false;
		}
	</script>
</head>
<body>
		<h1 class="page-header">
			所有学生信息如下:
		</h1>
		<table class="table table-striped table-hover table-bordered ">
			<tr>
				<th style="text-align: center;">ID</th>
				<th style="text-align: center;">用户名</th>
				<th style="text-align: center;">性别</th>.
				<th style="text-align: center;">班级ID</th>
				<th style="text-align: center;">分数</th>
				<th style="text-align: center;">出生日期</th>
				<th style="text-align: center;">删除</th>
				<th style="text-align: center;">修改</th>
			</tr>
			<?php 
				foreach ($result as $key => $value) {
					$birthday=$value['birthday'];
					echo "<tr id='{$value['id']}'>";
					echo "<td class='danger' align='center'><b>{$value['id']}</b></td>";
					echo "<td class='success' align='center'><b>{$value['name']}</b></td>";
					echo "<td class='info' align='center'><b>{$value['sex']}</b></td>";
					echo "<td class='warning' align='center'><b>{$value['class']}</b></td>";
					echo "<td class='warning' align='center'><b>{$value['score']}</b></td>";
					echo "<td class='warning' align='center'><b>".date('Y-m-d',$birthday)."</b></td>";
					echo "<td><a href='delete.php?id={$value['id']}'onclick='return conFirm()' class='btn btn-danger btn-block' >删除</td>";
					echo "<td><a href='update_view.php?id={$value['id']}' class='btn btn-primary btn-block' >修改</td>";
					echo "</tr>";
				}
			 ?>
		</table>
</body>
</html>