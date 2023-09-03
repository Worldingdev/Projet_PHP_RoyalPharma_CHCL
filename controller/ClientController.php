<?php
namespace controller;

use app\Client;

class ClientController{
    private $client;

    public function Save(){
        $this->client = new Client(null,
        null,null,null,null,null,
        null,null,null);
        
        if (isset($_POST['nom'])) {
            $this->client->setNom( htmlentities($_POST['nom']));
        }
        if (isset($_POST['prenom'])) {
            $this->client->setPrenom( htmlentities($_POST['prenom']));
        }
        if (isset($_POST['sexe'])) {
            $this->client->setSexe( htmlentities($_POST['sexe']));
        }
        if (isset($_POST['adresse'])) {
            $this->client->setAdresse( htmlentities($_POST['adresse']));
        }
        if (isset($_POST['telephone'])) {
            $this->client->setTelephone($_POST['telephone']);
        }
        if (isset($_POST['email'])) {
            $this->client->setEmail( $_POST['email']);
        }
        if (isset($_POST['dob'])) {
            $this->client->setDob( $_POST['dob']);
        }

        return $this->client;
    }

    public function modifier(){
        $this->client = new Client(null,
        null,null,null,null,null,
        null,null,null);
        
        if (isset($_POST['id'])) {
            $this->client->setId( htmlentities($_POST['id']));
        }
        if (isset($_POST['nom'])) {
            $this->client->setNom( htmlentities($_POST['nom']));
        }
        if (isset($_POST['prenom'])) {
            $this->client->setPrenom( htmlentities($_POST['prenom']));
        }
        if (isset($_POST['sexe'])) {
            $this->client->setSexe( htmlentities($_POST['sexe']));
        }
        if (isset($_POST['adresse'])) {
            $this->client->setAdresse( htmlentities($_POST['adresse']));
        }
        if (isset($_POST['telephone'])) {
            $this->client->setTelephone($_POST['telephone']);
        }
        if (isset($_POST['email'])) {
            $this->client->setEmail( $_POST['email']);
        }
        if (isset($_POST['dob'])) {
            $this->client->setDob( $_POST['dob']);
        }

        return $this->client;
    }

    public function delete(){
        $this->client = new Client(null,
        null,null,null,null,null,
        null,null,null);
        
        if (isset($_POST['id'])) {
            $this->client->setId( htmlentities($_POST['id']));
        }
        return $this->client;
    }
}