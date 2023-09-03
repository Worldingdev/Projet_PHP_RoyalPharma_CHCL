<?php
namespace app;

class Produit{

    //--------------- Attribut ----------------//

    private $id;
    private $nom;
    private $prix;
    private $type;
    private $quantite;
    private $etat;
    
    //----------------- Constructor -------------//

    public function __construct($id,
    $nom,$prix,$type,$quantite,$etat){
        $this->id = $id;
        $this->nom = $nom;
        $this->prix = $prix;
        $this->type = $type;
        $this->quantite = $quantite;
        $this->etat = $etat;

    }

    //-------------- Getter -----------------//

    public function getId(){
        return $this->id;
    }

    public function getNom(){
        return $this->nom;
    }

    public function getprix(){
        return $this->prix;
    }

    public function getType(){
        return $this->type;
    }

    public function getQte(){
        return $this->quantite;
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

    public function setPrix($prix){
        $this->prix = $prix;
    }

    public function setType($type){
        $this->type = $type;
    }

    public function setQte($quantite){
        $this->quantite = $quantite;
    }

    public function setEtat($etat){
        $this->etat = $etat;
    }
}