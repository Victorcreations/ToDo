<?php
session_start();

require './__Encrypt.php';

$AuthFunctions = new Credential_Submitter();

function signInSubmit()
{
    $Auth = $GLOBALS['AuthFunctions'];
    $Username = $_POST['User'];
    $Password = $_POST['password'];
    $Auth->session_clearer();

    if($Auth->signUp($Username,$Password))
    {
        return "Sign up success";
    }

    else
    {
        return "Sigin failed";
    }
}

function logInSubmit()
{
    $Auth = $GLOBALS['AuthFunctions'];
    $Username = $_POST['User'];
    $Password = $_POST['password'];
    $Auth->session_clearer();

    return $Auth->Login($Username,$Password);
}

function cookieSetter($Key,$Value,$User_id)
{
    $time = time()+86400;
    $CookieTime = new DateTime('+24 hours');
    $Auth = $GLOBALS['AuthFunctions'];
    $Auth->cookieStore($Value,$User_id,$CookieTime->format("Y-m-d H:i:s"));
    setcookie($Key,$Value,$time,'/');
}

if($_SERVER['REQUEST_METHOD'] == "POST" && isset($_POST['signinreq']))
{
        $Result = signInSubmit();
        $_SESSION["Result"] = $Result;
        header("Location: ./__Signup.php");
        exit();
}

if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['loginreq']))
{
    $Result = logInSubmit();

    if($Result[0] == true)
    {
        $id_box = bin2hex(random_bytes(32));
        $id_box .= $Result[2];
        setcookie('id',$id_box,time()+86400,'/');
        $_SESSION["Result"] = $Result[1];
        $session_id = bin2hex(random_bytes(32));
        cookieSetter('sess_id',$session_id,$Result[2]);
        header("Location: ./index.php");
        exit();
    }

    elseif($Result[0] == false)
    {
        $_SESSION["Result"] = $Result[1];
        $_SESSION["Status"] = $Result[0];
        header("Location: ./__Login.php");
        exit();
    }
}