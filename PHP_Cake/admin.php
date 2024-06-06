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

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $title = $_POST['title'];
    $content = $_POST['content'];

    // Server-side validation
    if (empty($title) || empty($content)) {
        $error = "Title and content are required.";
    } else {
        // Sanitize inputs
        $title = htmlspecialchars($title);
        $content = htmlspecialchars($content);

        $stmt = $conn->prepare("INSERT INTO posts (title, content) VALUES (?, ?)");
        $stmt->bind_param("ss", $title, $content);

        if ($stmt->execute()) {
            $success = "New post created successfully.";
        } else {
            $error = "Error: " . $stmt->error;
        }

        $stmt->close();
    }
}

// $conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add New Post</title>
    <style>
        body { font-family: Arial, sans-serif; background-color: #f8f8f8; color: #333; }
        .container { max-width: 600px; margin: 0 auto; padding: 20px; background-color: #fff; box-shadow: 0 0 10px rgba(0, 0, 0, 0.1); }
        .form-group { margin-bottom: 15px; }
        label { display: block; margin-bottom: 5px; font-weight: bold; }
        input, textarea { width: 100%; padding: 8px; box-sizing: border-box; }
        input[type="submit"] { background-color: #5cb85c; color: white; border: none; padding: 10px 20px; font-size: 16px; border-radius: 4px; cursor: pointer; }
        input[type="submit"]:hover { background-color: #4cae4c; }
        .error { color: red; }
        .success { color: green; }
    </style>
    <script>
        function validateForm() {
            let title = document.forms["postForm"]["title"].value;
            let content = document.forms["postForm"]["content"].value;
            if (title == "" || content == "") {
                alert("Title and content must be filled out.");
                return false;
            }
            return true;
        }
    </script>
</head>
<!-- <div class="centrallyAligned">
<span class="menuSpan"><a class="menuAnchor btn btn-outline-success btn-md" href="displaycake.php"  size="35"><i class="fa-solid fa-table-list"></i> &nbsp; Cake List</a>
<br/>
    </div> -->
    <br/>
<body>
    <div class="container">
        <h1>Add New Post</h1>
        <?php
        if (isset($error)) {
            echo "<p class='error'>$error</p>";
        }
        if (isset($success)) {
            echo "<p class='success'>$success</p>";
        }
        ?>
        <form name="postForm" action="admin.php" method="post" onsubmit="return validateForm()">
            <div class="form-group">
                <label for="title">Title:</label>
                <input type="text" id="title" name="title" required>
            </div>
            <div class="form-group">
                <label for="content">Content:</label>
                <textarea id="content" name="content" rows="10" required></textarea>
            </div>
            <input type="submit" value="Submit">
        </form>
    </div>
</body>
<?php
echo  "<br>";
echo  "<hr>";
include 'footer.php';
echo'<br>';
?>
</html>
