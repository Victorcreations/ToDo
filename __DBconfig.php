<?php

include './__ConfigGetter.php';

$getter = new Configer();

class Configuration
{
    private $HOST = null;
    private $PORT = null;
    private $DB = null;
    private $USERNAME = null;
    private $PASSWORD = null;

    private $Connection = null;

    public function getHost()
    {
        return $this->HOST;
    }

    public function setHost($config)
    {
        $this->HOST = $config;
    }

    public function getPort()
    {
        return $this->PORT;
    }

    public function setPort($config)
    {
        $this->PORT = $config;
    }

    public function getDb()
    {
        return $this->DB;
    }

    public function setDb($config)
    {
        $this->DB = $config;
    }

    public function getUsername()
    {
        return $this->USERNAME;
    }

    public function setUsername($config)
    {
        $this->USERNAME = $config;
    }

    public function getPassword()
    {
        return $this->PASSWORD;
    }

    public function setPassword($config)
    {
        $this->PASSWORD = $config;
    }



    public function ConfigSetter()
    {
        $getter = $GLOBALS['getter'];

        $this->setHost($getter->getConfig('HOST'));
        $this->setPort($getter->getConfig('PORT'));
        $this->setDb($getter->getConfig('DBNAME'));
        $this->setUsername($getter->getConfig('USERNAME'));
        $this->setPassword($getter->getConfig('PASSWORD'));
    }

    public function getConnection()
    {
        $this->ConfigSetter();

        if($this -> Connection == null)
        {
            $host = $this->getHost();
            $port = $this->getPort();
            $dbname = $this->getDb();

            $dbstr = "pgsql:host=$host;port=$port;dbname=$dbname";
            $Username = $this->getUsername();
            $Password = $this->getPassword();

            try
            {
                $this->Connection = new PDO($dbstr,$Username,$Password);
                $this->Connection->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
            }

            catch(PDOException $e)
            {
                echo $e->getMessage();
            }

            return $this->Connection;
        }

        else
        {
            return $this->Connection;
        }
    }

}