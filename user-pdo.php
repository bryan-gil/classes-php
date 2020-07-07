<?php
class userpdo{

    private $id;
    public $login;
    public $email;
    public $firstname;
    public $lastname;

    
    public function __construct($login, $email, $firstname, $lastname){
        $this->login=$login;
        $this->email=$email;
        $this->firstname=$firstname;
        $this->lastname=$lastname;
    }

    public function register($login, $password, $email, $firstname,
    $lastname){
       //Connection bdd
    $bdd = new PDO("mysql:host=localhost;dbname=classes; charset=utf8", "root", "");
    $password = password_hash($password, PASSWORD_BCRYPT, ['cost' => 15]);
    //insertion dans la bdd 
    $insert = $bdd->prepare("INSERT INTO utilisateurs (login, password, email, firstname, lastname) VALUES(?, ?, ?, ?, ?)");
    $insert->execute([$login, $password, $email, $firstname, $lastname]);
    //récupérationdes infos
    $select = $bdd->query("SELECT * FROM utilisateurs");
    $utilisateurs = $select->fetchAll();

        return $utilisateurs;
    }

    public function connect($login, $password){
    session_start();
         //Connection bdd
         $bdd = new PDO("mysql:host=localhost;dbname=classes; charset=utf8", "root", "");

    $select = $bdd->query("SELECT * FROM utilisateurs WHERE login = $login");
    $verify = $select->fetchAll();

    //Vérification si login & password == $_POST['login'] & $_POST['password']
    if (!empty($verify)) {

        if (password_verify($password, $verify['password'])) {

            $_SESSION['login']   = $verify['login'];

        }else echo "Impossible de vous authentifier correctement.";

    }else echo "Impossible de vous authentifier correctement.";

    $this->$login=$login;
    $this->$password=$password;
    }



    public function disconnect(){

        session_start();
        session_destroy();

    }

    public function delete(){
        session_start();
        //Connection bdd
        if ($_SESSION['login']) {
            $bdd = new PDO("mysql:host=localhost;dbname=classes; charset=utf8", "root", "");
            //delete
            $delete = $bdd->query("DELETE FROM utilisateurs WHERE id = '" . $this->id . "'");
        }

        session_destroy();
    }

    public function update($login, $password, $email, $firstname,
    $lastname){
         $bdd = new PDO("mysql:host=localhost;dbname=classes; charset=utf8", "root", "");
         //update
         $update = $bdd->query("UPDATE utilisateurs SET login=$login, password=$password, email=$email, firstname=$firstname,
         lastname=$lastname");
    }
    public function isConnected(){
        session_start();
        $is_connected = $_SESSION['login'] ? 'yes':'no' ;

        if($is_connected === true){
            return true;
        }else return false;
    }

    public function getAllInfos(){
        return $this->login;
        return $this->email;
        return $this->firstname;
        return $this->lastname;
    }

    public function getLogin(){
        return $this->login;
    }

    public function getEmail(){
        return $this->email;
    }

    public function getFirstname(){
        return $this->firstname;
    }

    public function getLastname(){
        return $this->lastname;
    }

    public function refresh(){
        //UPDATE
    }

}
$user = new userpdo("ididid", "hu", "hu@gmail.com", "pu");

var_dump($user);

?>