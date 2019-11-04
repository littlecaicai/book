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
$sql = 'select *  from book where title like "%' . $title . '%"order by id desc limit 1';
$result = $conn->query($sql);
if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $title = $row['title'];
    $author = $row['author'];
    $score = $row['score'];
    $cover = 'data/upload/' . $row['cover'];
    $category = $row['category'];
    $description = $row['description'];
    $url = $row['download_url'];
    echo '<div class="hanghang-content"><div class="hanghang-za"><div class="hanghang-za-title">' . $title . '</div><div class="hanghang-shu-content"><div class="hanghang-shu-content-img"><img src=\'' . $cover . '\'/></div><div class="hanghang-shu-content-font"><p>书名：' . $title . '</p><p>作者：' . $author .  '</p><p>分类：' . $category . '</p><p>豆瓣评分：' . strval($score) . '</p><p>简介：' . $description . '</p></div><div class="clearFloat"></div></div>';
    $download_url = '<div class="hanghang-box" style="margin-bottom:15px;"><div class="hanghang-shu-content-btn"><H4 style="font-size:16px;">下载地址 ↓</H4><br><a href="' . $url . '" class="downloads"target="_blank"><div class="hanghang-shu-content-btns">城通网盘</div></a></div><div class="clearFloat"></div></div></div></div>';
    echo $download_url;
}
$conn->close();

?>
