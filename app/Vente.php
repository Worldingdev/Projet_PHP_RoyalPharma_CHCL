<?php
namespace app;

class Vente{

    //--------------- Attribut ----------------//

    private $id;
    private $produit = [];
    private $client;
    private $type;
    private $montant;
    private $date;
    
    //----------------- Constructor -------------//

    public function __construct($id,
    $produit,$client,$type,$montant, $date){
        $this->id = $id;
        $this->produit = $produit;
        $this->client = $client;
        $this->type = $type;
        $this->montant = $montant;
        $this->date = $date;
    }

    //-------------- Getter -----------------//

    public function getId(){
        return $this->id;
    }

    public function getProduit(){
        return $this->produit;
    }

    public function getClient(){
        return $this->client;
    }

    public function getType(){
        return $this->type;
    }

    public function getMontant(){
        return $this->montant;
    }

    public function getDate(){
        return $this->date;
    }

    //------------------- Setter ----------------//

    public function setId($id){
        $this->id = $id;
    }

    public function setProduit($produit){
        $this->produit = $produit;
    }

    public function setClient($client){
        $this->client = $client;
    }

    public function setType($type){
        $this->type = $type;
    }

    public function setMontant($montant){
        $this->montant = $montant;
    }

    public function setDate($date){
        $this->date = $date;
    }
}