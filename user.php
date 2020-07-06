<?php
class utilisateurs{

    private $id;
    public $login;
    public $email;
    public $firstname;
    public $lastname;

    public function register($login, $password, $email, $firstname,
    $lastname){
       //Connection bdd
    $bdd = mysqli_connect('localhost', 'root', '', 'classes');
    $password = password_hash($password, PASSWORD_BCRYPT, ['cost' => 15]);
    //insertion dans la bdd 
    $insert = mysqli_query($bdd, "INSERT INTO utilisateurs (login, password, email, firstname, lastname) VALUES('$login', '$password', '$email', '$firstname', '$lastname')");
    //récupérationdes infos
    $select = mysqli_query($bdd, "SELECT * FROM utilisateurs");
    $utilisateurs = mysqli_fetch_array($select);

        return $utilisateurs;
    }

    public function connect($login, $password){
    session_start();
         //Connection bdd
    $bdd = mysqli_connect('localhost', 'root', '', 'classes');

    $select = mysqli_query($bdd, "SELECT * FROM utilisateurs WHERE login = $login");
    $verify = mysqli_fetch_array($select);

    //Vérification si login & password == $_POST['login'] & $_POST['password']
    if (!empty($verify)) {

        if (password_verify($password, $verify['password'])) {

            $_SESSION['login']   = $verify['login'];

        }else echo "Impossible de vous authentifier correctement.";

    }else echo "Impossible de vous authentifier correctement.";

    $this->$login;
    $this->$password;
    $this->$email;
    $this->$firstname;
    $this->$lastname;
    }



    public function disconnect(){

        session_start();
        session_destroy();

    }
    
    public function delete(){
        session_start();
        //Connection bdd
        if ($_SESSION['login']) {
            $bdd = mysqli_connect('localhost', 'root', '', 'classes');
            //delete
            $delete = mysqli_query($bdd, "DELETE FROM utilisateurs WHERE id = '" . $this->id . "'");
        }

        session_destroy();
    }
    
    public function update($login, $password, $email, $firstname,
    $lastname){
        $bdd = mysqli_connect('localhost', 'root', '', 'classes');
         //update
         $update = mysqli_query($bdd, "UPDATE utilisateurs SET login=$login, password=$password, email=$email, firstname=$firstname,
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

    }
    
}
?>