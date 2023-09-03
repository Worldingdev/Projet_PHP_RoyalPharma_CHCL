<?php
namespace config;


class Connection{
   
// Informations d'accès à la base de données
private $serveur = "localhost"; // Le nom du serveur MySQL
private $utilisateur = "root"; // Le nom d'utilisateur MySQL
private $motdepasse = "root"; // Le mot de passe MySQL
private $base_de_donnees = "gestionPharmacie"; // Le nom de la base de données
private $connexion;

// Methode de la Création d'une connexion
public function connection(){
    
    $this->connexion = new \mysqli($this->serveur, $this->utilisateur, $this->motdepasse, $this->base_de_donnees);
    // Vérifier la connexion
    if ($this->connexion->connect_error) {
        die("Échec de la connexion : " . $this->connexion->connect_error);
    }
    return $this->connexion;
}

}
