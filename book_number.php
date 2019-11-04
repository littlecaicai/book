<?php

$servername = "129.28.185.23";
$username = "root";
$password = "wise123";
$dbname = 'books';
$port = 3306;
 
$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("连接失败: " . $conn->connect_error);
}
$page = isset($_GET['page']) ? $_GET['page'] : 1;
$pagenum = 2;
$begin = ($page - 1) * $pagenum;
$end = $begin + $pagenum;
$sql = 'select count(1) as count from book';
$res = $conn->query($sql);
$num = $res->num_rows;
if ($num > 0) {
    $row = $res->fetch_assoc();
    echo $row['count'];
}
?>
