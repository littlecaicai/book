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
$pagenum = 20;
$begin = ($page - 1) * $pagenum + 1;
$end = $begin + $pagenum;
$sql = 'select *  from book where id between ' . strval($begin) . ' and ' . strval($end) . ' order by id desc';
$result = $conn->query($sql);
echo '<ul class="hanghang-list"><li class="hanghang-list-first"><div class="hanghang-list-name">书籍</div><div class="hanghang-list-num">豆瓣评分</div><div class="hanghang-list-zuozhe">作者</div><div class="clearFloat"></div></li>';
if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        $id = $row['id'];
        $detail = '<a href="/detail.php?&id=' . strval($id) . '"><li>';
        $title = '<div class="hanghang-list-name">' . $row['title'] . '</div>';
        $score = '<div class="hanghang-list-num">' . strval($row['score']) . '</div>';
        $author = '<div class="hanghang-list-zuozhe">' . $row['author'] . '</div><div class="clearFloat"></div></li></a>';
        echo $detail . $title . $score . $author;
    }
}
?>
