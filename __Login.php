<?php
    session_start();
    include "./__Encrypt.php";

    $CookiesChecker = new Credential_Submitter();
    $Result = isset($_SESSION["Result"]) ? $_SESSION["Result"] : "";
    $Status = isset($_SESSION["Status"]) ? $_SESSION["Status"] : "";

    $Color = "";

    if($Status == false)
    {
        $Color = "orange";
    }

    else
    {
        $Color = "green";
    }

    unset($_SESSION["Result"]);
    unset($_SESSION['Status']);

    $Cookie = isset($_COOKIE['sess_id']) ? $_COOKIE['sess_id'] : "";
    $Session_id = isset($_COOKIE['id']) ? $_COOKIE['id'] : "";

    if($Cookie != null)
    {
        $CookieSet = new DateTime($CookiesChecker->getCookie($Cookie));
    }
?>
<?php if($Cookie == "" || $Session_id == ""){?>
    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width,initial-scale=1.0">
        <title>Login</title>
        <link rel="stylesheet" href="./Styles/__Signup.css" >
    </head>
    <body>
        <?php if($Result != ""){ ?>
            <div class="response-message" style="background-color:<?php echo $Color ;?>;">
                <p><?php echo $Result; ?></p>
            </div>
        <?php } ?>

        <div class="container">
            <form action="./__Authentication.php" method="post">
                <h3>Log In</h3>
                <input type="text" placeholder="Username" name="User">
                <input type="password" placeholder="Password" name="password">
                <input type="hidden" name="loginreq">
                <input type="submit" value="submit">
                <a href="./__Signup.php">Sign In</a>
            </form>
        </div>
    </body>
    </html>
<?php } else {?>
     <?php header("Location: ./index.php"); ?>
     <?php echo "Got it"; ?>
<?php } ?>