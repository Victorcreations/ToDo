<?php
    session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign Up</title>
    <link rel="stylesheet" href="./Styles/__Signup.css" >
</head>
<body>
    <!-- <div class="response-message">
        <p>Message</p>
    </div> -->
    <div class="container">
        <form action="./__Authentication.php" method="post">
            <h3>Sign Up</h3>
            <input type="text" placeholder="Username" name="User">
            <input type="password" placeholder="Password" name="password">
            <input type="hidden" name="signinreq">
            <input type="submit" value="submit">
            <a href="./__Login.php">Log In</a>
        </form>
    </div>
</body>
</html>