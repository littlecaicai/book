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
$pagenum = 12;
$begin = ($page - 1) * $pagenum;
$end = $begin + $pagenum;
$sql = 'select *  from book order by id desc limit ' . $begin . ',' . $pagenum;
$result = $conn->query($sql);
if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        $id = $row['id'];
        $detail = '<a href="/book/detail.php?&id=' . strval($id) . '" target="_blank"><li>';
        $title = '<div class="hanghang-list-name">' . $row['title'] . '</div>';
        $score = '<div class="hanghang-list-num">' . strval($row['score']) . '</div>';
        $author = '<div class="hanghang-list-zuozhe">' . $row['author'] . '</div><div class="clearFloat"></div></li></a>';
        echo $detail . $title . $score . $author;
    }
}
?>
