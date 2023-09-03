<?php
namespace dao;

require __DIR__ . '/../vendor/autoload.php';
use config\Connection;
use controller\ClientController;

class ClientDao{

    public function save(){
        $con = new Connection();
        $clientController = new ClientController();
        $client = $clientController->save();
        $con = $con->connection();
        $name = $client->getNom();
        $prenom = $client->getPrenom();
        $sexe = $client->getSexe();
        $adresse = $client->getAdresse();
        $phone = $client->getTelephone();
        $email = $client->getEmail();
        $dob = $client->getDob();
        $etat = true;
        do{
            $id = 'Cust-'.substr($name, 0,2).'-'.random_int(100,999);
            $query = $con->prepare("SELECT  * FROM Client where Id=?");
            $query->execute(array($id));
            $query->store_result();
            $clients = $query->num_rows();
        }while($clients>0);
        $query2 = $con->prepare("INSERT INTO `Client`(`Id`, `Nom`, `Prenom`, `Sexe`, `Adresse`, `Telephone`, `Email`, `Dob`,`etat`) VALUES (?,?,?,?,?,?,?,?,?)");
        $query2->execute(array($id,$name,$prenom,$sexe,$adresse,$phone,$email,$dob,$etat));
        $con->close();
        header('location:../public/printCoustomers.php');
    }

    public function delete(){
        $con = new Connection();
        $clientController = new ClientController();
        $client = $clientController->delete();
        $con = $con->connection();
        $id = $client->getId();
        $query2 = $con->prepare("UPDATE Client SET  etat= false WHERE Id=? ");
        $query2->bind_param("s",$id);
        $query2->execute();
        $con->close();
        header('location:../public/printCoustomers.php');
    }

    public function modifier(){
        $con = new Connection();
        $clientController = new ClientController();
        $client = $clientController->modifier();
        $con = $con->connection();
        $id = $client->getId();
        $name = $client->getNom();
        $prenom = $client->getPrenom();
        $sexe = $client->getSexe();
        $adresse = $client->getAdresse();
        $phone = $client->getTelephone();
        $email = $client->getEmail();
        $dob = $client->getDob();
        $query2 = $con->prepare("UPDATE Client SET Nom=?, Prenom=?, Sexe=?, Adresse=?, Telephone=?, Email=?, Dob=? WHERE Id=? ");
        $query2->bind_param("ssssssss",$name,$prenom,$sexe,$adresse,$phone,$email,$dob,$id);
        $query2->execute();
        $con->close();
        header('location:../public/printCoustomers.php');
    }

    public function selectClient($id){
        $con = new Connection();
        $con = $con->connection();
        if($id == null){
            $clients = $con->query("SELECT  * FROM Client");
        }
        else{
            $clients = $con->prepare("SELECT  * FROM Client where Id=?");
            $clients->execute(array($id));
            $clients = $clients->get_result();
        }
        
        return $clients;
    }
}
$clientDao = new ClientDao();
if (isset($_POST['save'])){
    $clientDao->save();
}
if (isset($_POST['delete'])){
    $clientDao->delete();
}
if (isset($_POST['modifier'])){
    $clientDao->modifier();
}