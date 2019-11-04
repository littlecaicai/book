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
$data = json_decode(file_get_contents("php://input"), true);
$title = isset($data['title']) ? $data['title'] : '';
if (empty($title)) {
    $title = isset($_POST['title']) ? $_POST['title'] : '';
}
$sql = 'select *  from book where title like "%' . $title . '%"order by id desc limit 10';
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
