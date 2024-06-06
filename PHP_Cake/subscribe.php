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
include 'header.php';
include 'database.php';


if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $firstName = $_POST['firstName'];
    $lastName = $_POST['lastName'];
    $email = $_POST['email'];
    $favoriteCake = $_POST['favoriteCake'];

    // Server-side validation
    if (empty($firstName) || empty($lastName) || empty($email) || empty($favoriteCake)) {
        $error = "All fields are required.";
    } else {
        // Sanitize inputs
        $firstName = htmlspecialchars($firstName);
        $lastName = htmlspecialchars($lastName);
        $email = htmlspecialchars($email);
        $favoriteCake = htmlspecialchars($favoriteCake);

        // Check if email already exists
        $stmt = $conn->prepare("SELECT email FROM subscribers WHERE email = ?");
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $stmt->store_result();

        if ($stmt->num_rows > 0) {
            $error = "Email is already subscribed.";
        } else {
            $stmt->close();
            // Insert new subscriber
            $stmt = $conn->prepare("INSERT INTO subscribers (firstName, lastName, email, favoriteCake) VALUES (?, ?, ?, ?)");
            $stmt->bind_param("ssss", $firstName, $lastName, $email, $favoriteCake);

            if ($stmt->execute()) {
                $success = "Subscription successful!";
            } else {
                $error = "Error: " . $stmt->error;
            }

            $stmt->close();
        }
    }

    $conn->close();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Subscribe</title>
    <style>
        body { font-family: Arial, sans-serif; background-color: #f8f8f8; color: #333; }
        .container { max-width: 600px; margin: 0 auto; padding: 20px; background-color: #fff; box-shadow: 0 0 10px rgba(0, 0, 0, 0.1); }
        .form-group { margin-bottom: 15px; }
        label { display: block; margin-bottom: 5px; font-weight: bold; }
        input { width: 100%; padding: 8px; box-sizing: border-box; }
        input[type="submit"] { background-color: #5cb85c; color: white; border: none; padding: 10px 20px; font-size: 16px; border-radius: 4px; cursor: pointer; }
        input[type="submit"]:hover { background-color: #4cae4c; }
        .error { color: red; }
        .success { color: green; }
    </style>
    <script>
        function validateForm() {
            let firstName = document.forms["subscribeForm"]["firstName"].value;
            let lastName = document.forms["subscribeForm"]["lastName"].value;
            let email = document.forms["subscribeForm"]["email"].value;
            let favoriteCake = document.forms["subscribeForm"]["favoriteCake"].value;
            if (firstName == "" || lastName == "" || email == "" || favoriteCake == "") {
                alert("All fields must be filled out.");
                return false;
            }
            return true;
        }
    </script>
</head>
<body>

    <div class="container">
        <h2>Subscribe to Our Cake Blog</h2>
        <?php
        if (isset($error)) {
            echo "<p class='error'>$error</p>";
        }
        if (isset($success)) {
            echo "<p class='success'>$success</p>";
        }
        ?>
        <form name="subscribeForm" action="subscribe.php" method="post" onsubmit="return validateForm()">
            <div class="form-group">
                <label for="firstName">First Name:</label>
                <input type="text" id="firstName" name="firstName" required>
            </div>
            <div class="form-group">
                <label for="lastName">Last Name:</label>
                <input type="text" id="lastName" name="lastName" required>
            </div>
            <div class="form-group">
                <label for="email">Email:</label>
                <input type="email" id="email" name="email" required>
            </div>
            <div class="form-group">
                <label for="favoriteCake">Favorite Cake:</label>
                <input type="text" id="favoriteCake" name="favoriteCake" required>
            </div>
            <input type="submit"  value="Subscribe">
        </form>
    </div>
    <!-- <br/>
    <div class="centrallyAligned">
<a class="btn btn-outline-success btn-md" href="index.php"  size="35"><i class="fa-solid fa-pencil"></i> &nbsp; Blog page</a>
</div> -->
</body>
<br/>
<hr/>
<br/>
<?php
include"footer.php";
?>
<br/>
</html>
