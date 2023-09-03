<?php
namespace dao;
require_once __DIR__ .'/../vendor/composer/autoload_real.php';
require __DIR__ . '/../vendor/autoload.php';

use config\Connection;
use controller\ControlUtilisateur;


class UtilisateurDao{

    private $userController;
    private $con;
    
    public function login(){
        session_start();
        $con = new Connection();
        $userController = new ControlUtilisateur();
        $con = $con->connection();
        $user = $userController->login();
        $username = $user->getUsername();
        $password = $user->getPassword();
        //$etat = true;
        $query = $con->prepare("SELECT  * FROM Utilisateur where Username=? and motDePasse=? and etat=1 ");
        $query->bind_param("ss", $username, $password);
        $query->execute();
        $result = $query->get_result();
        $users = $result->num_rows;
        
        if($users > 0){
            $users1 = $result->fetch_assoc();
            $_SESSION['email'] = $users1['email'];
            $_SESSION['Type'] = $users1['Type'];
            $_SESSION['Username'] = $users1['Username'];
            $con->close();
            header('location:../public/dashboard.php');
        }
        else{
        header('location:../public/index.php');
        }
    }

    public function save(){
        $con = new Connection();
        $userController = new ControlUtilisateur();
        $user = $userController->save();
        $con = $con->connection();
        $name = $user->getNom();
        $username = $user->getUsername();
        $phone = $user->getTelephone();
        $nuni = $user->getNinu();
        $password = $user->getPassword();
        $type = $user->getType();
        $etat = true;
        do{
            $uuid = 'User-'.substr($name, 0,2).'-'.random_int(100,999);
            $query = $con->prepare("SELECT  * FROM Utilisateur where Id=?");
            $query->execute(array($uuid));
            $query->store_result();
            $users = $query->num_rows();
        }while($users>0);
        $query2 = $con->prepare("INSERT INTO `Utilisateur`(`Id`, `Nom`, `Username`, `Telephone`, `NINU`, `motDePasse`, `Type`, `etat`) VALUES (?,?,?,?,?,?,?,?)");
        $query2->execute(array($uuid,$name,$username,$phone,$nuni,sha1($password),$type,$etat));
        $con->close();
        header('location:../public/printUser.php');
    }

    public function modifier(){
        $con = new Connection();
        $userController = new ControlUtilisateur();
        $user = $userController->modifier();
        $con = $con->connection();
        $id = $user->getId();
        $name = $user->getNom();
        $username = $user->getUsername();
        $phone = $user->getTelephone();
        $nuni = $user->getNinu();
        $password = $user->getPassword();
        $type = $user->getType();
        $query2 = $con->prepare("UPDATE Utilisateur SET Nom=?, Username=?, Telephone=?, NINU=?, motDePasse=?, Type=? WHERE Id=? ");
        $query2->bind_param("sssisss",$name,$username,$phone,$nuni,$password,$type,$id);
        $query2->execute();
        $con->close();
        header('location:../public/printUser.php');
    }

    public function delete(){
        $con = new Connection();
        $userController = new ControlUtilisateur();
        $user = $userController->delete();
        $con = $con->connection();
        $id = $user->getId();
        $query2 = $con->prepare("UPDATE Utilisateur SET  etat= false WHERE Id=? ");
        $query2->bind_param("s",$id);
        $query2->execute();
        $con->close();
        header('location:../public/printUser.php');
    }

    public function selectUser($id){
        $con = new Connection();
        $con = $con->connection();
        if($id == null){
            $users = $con->query("SELECT  * FROM Utilisateur");
        }
        else{
            $users = $con->prepare("SELECT  * FROM Utilisateur where Id=?");
            $users->execute(array($id));
            $users = $users->get_result();
        }
        
        return $users;
    }
    
}
$userDao = new UtilisateurDao();
if (isset($_POST['login'])){
    $userDao->login();
}
if (isset($_POST['save'])){
    $userDao->save();
}
if (isset($_POST['modifier'])){
    $userDao->modifier();
}
if (isset($_POST['delete'])){
    $userDao->delete();
}




?>