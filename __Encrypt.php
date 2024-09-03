<?php

include './__DBconfig.php';


class Credential_Submitter
{
    private $connector = null; 
    private $connection = null;  

    public function __construct()
    {
        $this->connector = new Configuration();

        $this->connection = $this->connector->getConnection();
    }

    private function encrypt($hash)
    {
        $Shift = rand(1,9);

        $enc_hash = "";

        $length = strlen($hash);

        for($i=0;$i<$length;$i++)
        {
            $move = ord($hash[$i]);
            $shifted = chr($move+$Shift);

            $enc_hash .= $shifted;
        }

        $enc_hash .= $Shift;

        return base64_encode($enc_hash);
    }

    private function decrypt($hash)
    {
        $hash = base64_decode($hash);

        $length = strlen($hash);

        $Shift = substr($hash,-1);

        $dec_hash = "";

        for($i=0;$i<$length-1;$i++)
        {
            $move = ord($hash[$i]);
            $char = chr($move-$Shift);

            $dec_hash .= $char;
        }
        return $dec_hash;
    }

    public function cookieStore($session_id,$user_id,$expiry)
    {
        $stmt = $this->connection->prepare("INSERT INTO sessions(session_id,user_id,expiry) VALUES (:session_id,:user_id,:expiry)");
        $stmt->bindParam(":session_id",$session_id);
        $stmt->bindParam(":user_id",$user_id);
        $stmt->bindParam(":expiry",$expiry);
        
        $stmt->execute();
    }

    public function getCookie($Cookie_Value)
    {
        $stmt  = $this->connection->prepare("SELECT expiry FROM sessions WHERE session_id = :session_id");
        $stmt->bindParam(":session_id",$Cookie_Value);

        $stmt->execute();

        $expiry = "";

        while($res = $stmt->fetch(PDO::FETCH_ASSOC))
        {
            $expiry = $res['expiry'];
        }

        return $expiry;
    }

    public function signUp($username,$password)
    {
        $options=[
            'cost'=>10,
            ];

        $pass_hash = password_hash($password,PASSWORD_DEFAULT,$options);

        $encrypted_hash = $this->encrypt($pass_hash);

        $stmt = $this->connection->prepare("INSERT INTO USERS(username,password) VALUES (:username,:password)");

        $username = mb_convert_encoding($username,'UTF-8','auto');
        $stmt->bindParam(":username",$username);
        $stmt->bindParam(":password",$encrypted_hash);
        
        $stmt->execute();

        return true;
    }

    public function Login($Username,$Password)
    {
        $stmt = $this->connection->prepare("SELECT * FROM users WHERE username = :username");

         $stmt->bindParam(":username",$Username);

        $User_Found =  $stmt->execute();

        $Count = $stmt->rowCount();

        $Found_Password = "";
        $User_Id = "";

        $Result = [];

        if($Count > 0)
        { 
            while($row = $stmt->fetch(PDO::FETCH_ASSOC))
            {
                $Found_Password = $row['password'];
                $User_Id = $row['id'];
            }

            $decrypt_password = $this->decrypt($Found_Password);

            if(password_verify($Password,$decrypt_password))
            {
                $Result[0] = true;
                $Result[1] = "Password match";
                $Result[2] = $User_Id;
            }

            else
            {
                $Result[0] = false;
                $Result[1] = "Oops! Password doesn't match";
            }
        }

        else
        {
            $Result[0] = false;
            $Result[1] = "User not found";
        }
        return $Result;
    }

    public function session_clearer()
    {
        $query = "DELETE FROM sessions WHERE expiry < NOW()";

        $stmt = $this->connection->prepare($query);

        $stmt->execute();
    }

    public function getData($id)
    {
        $sql = "SELECT * FROM tasks WHERE user_id = :user_id";

        $stmt = $this->connection->prepare($sql);

        $stmt->bindParam(":user_id",$id);

        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}