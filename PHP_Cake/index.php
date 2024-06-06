<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "cakesdb";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>
<?php
include 'database.php';
include 'header.php';
// Handle the search query
$search = '';
if (isset($_GET['search'])) {
    $search = htmlspecialchars($_GET['search']);
    $sql = $conn->prepare("SELECT * FROM posts WHERE title LIKE CONCAT('%', ?, '%') ORDER BY created_at DESC");
    $sql->bind_param('s', $search);
} else {
    $sql = $conn->prepare("SELECT * FROM posts ORDER BY created_at DESC");
}

$sql->execute();
$result = $sql->get_result();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cake Blog</title>
    <style>
        body { font-family: Arial, sans-serif; background-color: #f8f8f8; color: #333; }
        .container { max-width: 800px; margin: 0 auto; padding: 20px; background-color: #fff; box-shadow: 0 0 10px rgba(0, 0, 0, 0.1); }
        .post { border-bottom: 1px solid #eee; padding: 20px 0; }
        .title { font-size: 24px; font-weight: bold; color: #555; }
        .content { margin-top: 10px; line-height: 1.6; }
        .created_at { font-size: 14px; color: #aaa; }
        .search-bar { margin-bottom: 20px; }
        .search-bar input[type="text"] { padding: 10px; width: 80%; }
        .search-bar input[type="submit"] { padding: 10px; }
    </style>
</head>
<body>
    <!-- <div><a href="search.php">search page</a></div> -->
    <!-- <div class="centrallyAligned">
<span class="menuSpan"><a class="menuAnchor btn btn-outline-success btn-md" href="admin.php"  size="35"><i class="fa-solid fa-table-list"></i> &nbsp; New Post</a>
</div> -->

    <div class="container">
        <h1>Cake Blog</h1>
        <div class="search-bar">
            <form action="index.php" method="get">
                <input type="text" name="search" placeholder="Search posts..." value="<?php echo $search; ?>">
                <input type="submit" value="Search">
            </form>
        </div>
        <?php
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                echo "<div class='post'>";
                echo "<div class='title'>" . htmlspecialchars($row['title']) . "</div>";
                echo "<div class='content'>" . nl2br(htmlspecialchars($row['content'])) . "</div>";
                echo "<div class='created_at'>" . $row['created_at'] . "</div>";
                echo "</div>";
            }
        } else {
            echo "No posts found.";
        }
        $sql->close();
        $conn->close();
        ?>
    </div>
</body>
</html>
<?php
    echo  "<br>";
   echo  "<hr>";
include 'footer.php';
echo'<br>';
?>