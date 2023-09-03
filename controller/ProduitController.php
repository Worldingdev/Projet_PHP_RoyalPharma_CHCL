<?php
namespace controller;

use app\Produit;

class ProduitController{
    private $produit;

    public function Save(){
        $this->produit = new Produit(null,
        null,null,null,null,null);
        
        if (isset($_POST['nom'])) {
            $this->produit->setNom( htmlentities($_POST['nom']));
        }
        if (isset($_POST['prix'])) {
            $this->produit->setPrix( $_POST['prix']);
        }
        if (isset($_POST['type'])) {
            $this->produit->setType( htmlentities($_POST['type']));
        }
        if (isset($_POST['quantite'])) {
            $this->produit->setQte( $_POST['quantite']);
        }
        
        return $this->produit;
    }

    public function modifier(){
        $this->produit = new Produit(null,
        null,null,null,null,null);
        if (isset($_POST['id'])) {
            $this->produit->setId( htmlentities($_POST['id']));
        }
        if (isset($_POST['nom'])) {
            $this->produit->setNom( htmlentities($_POST['nom']));
        }
        if (isset($_POST['prix'])) {
            $this->produit->setPrix( $_POST['prix']);
        }
        if (isset($_POST['type'])) {
            $this->produit->setType( htmlentities($_POST['type']));
        }
        if (isset($_POST['quantite'])) {
            $this->produit->setQte( $_POST['quantite']);
        }
        
        return $this->produit;
    }

    public function delete(){
        $this->produit = new Produit(null,
        null,null,null,null,null);
        
        if (isset($_POST['id'])) {
            $this->produit->setId( htmlentities($_POST['id']));
        }
        return $this->produit;
    }

}