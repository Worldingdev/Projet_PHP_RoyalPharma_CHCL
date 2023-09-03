<?php
namespace app;


class Utilisateur{

    //--------------- Attribut ----------------//

    private $id;
    private $nom;
    private $username;
    private $telephone;
    private $ninu;
    private $password;
    private $type;

    //----------------- Constructor -------------//

    public function __construct($id,
    $nom,$username,$telephone,$ninu,$password,
    $type){
        $this->id = $id;
        $this->nom = $nom;
        $this->username = $username;
        $this->telephone = $telephone;
        $this->ninu = $ninu;
        $this->password = $password;
        $this->type = $type;
    }

    //-------------- Getter -----------------//

    public function getId(){
        return $this->id;
    }

    public function getNom(){
        return $this->nom;
    }

    public function getUsername(){
        return $this->username;
    }

    public function getTelephone(){
        return $this->telephone;
    }

    public function getNinu(){
        return $this->ninu;
    }

    public function getPassword(){
        return $this->password;
    }

    public function getType(){
        return $this->type;
    }


    //------------------- Setter ----------------//

    public function setId($id){
        $this->id = $id;
    }

    public function setNom($nom){
        $this->nom = $nom;
    }

    public function setUsername($username){
        $this->username = $username;
    }

    public function setTelephone($telephone){
        $this->telephone = $telephone;
    }

    public function setNinu($ninu){
        $this->ninu = $ninu;
    }

    public function setPassword($password){
        $this->password = $password;
    }

    public function setType($type){
        $this->type = $type;
    }
}