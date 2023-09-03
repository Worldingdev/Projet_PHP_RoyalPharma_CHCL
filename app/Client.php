<?php
namespace app;

class Client{

    //--------------- Attribut ----------------//

    private $id;
    private $nom;
    private $prenom;
    private $sexe;
    private $adresse;
    private $telephone;
    private $email;
    private $dob;
    private $etat;

    //----------------- Constructor -------------//

    public function __construct($id,
    $nom,$prenom,$sexe,$adresse,$telephone,
    $email,$dob,$etat){
        $this->id = $id;
        $this->nom = $nom;
        $this->prenom = $prenom;
        $this->sexe = $sexe;
        $this->adresse = $adresse;
        $this->telephone = $telephone;
        $this->email = $email;
        $this->dob = $dob;
        $this->etat = $etat;
    }

    //-------------- Getter -----------------//

    public function getId(){
        return $this->id;
    }

    public function getNom(){
        return $this->nom;
    }

    public function getPrenom(){
        return $this->prenom;
    }

    public function getSexe(){
        return $this->sexe;
    }

    public function getAdresse(){
        return $this->adresse;
    }

    public function getTelephone(){
        return $this->telephone;
    }

    public function getEmail(){
        return $this->email;
    }

    public function getDob(){
        return $this->dob;
    }

    public function getEtat(){
        return $this->etat;
    }

    //------------------- Setter ----------------//

    public function setId($id){
        $this->id = $id;
    }

    public function setNom($nom){
        $this->nom = $nom;
    }

    public function setPrenom($prenom){
        $this->prenom = $prenom;
    }

    public function setSexe($sexe){
        $this->sexe = $sexe;
    }

    public function setAdresse($adresse){
        $this->adresse = $adresse;
    }

    public function setTelephone($telephone){
        $this->telephone = $telephone;
    }

    public function setEmail($email){
        $this->email = $email;
    }

    public function setDob($dob){
        $this->dob = $dob;
    }

    public function setEtat($etat){
        $this->etat = $etat;
    }


}