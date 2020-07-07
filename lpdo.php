<?php
class lpdo{

    private $host;
    private $username;
    private $password;
    private $db;

    public function __construct($host, $username, $password, $db){

    }

    public function connect($host, $username, $password, $db){
        $bdd = mysqli_connect($host, $username,$password,$db);
        if (isset($host)) {
            mysqli_close($bdd);
        }else mysqli_connect($host, $username,$password,$db);
    }

    public function __destruct(){

    }

    public function close($host, $username, $password, $db){
            mysqli_close($host);
    }

    public function close($query){
            $bdd = mysqli_connect($host, $username,$password,$db);
            $sql="";
            $query = mysqli_query($bdd, $sql);
            var_dump($query);
    }
}
?>