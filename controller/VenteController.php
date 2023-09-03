<?php
namespace controller;

use app\Vente;
use dao\ProduitsDao;
use config\Connection;

class VenteController{
    private $vente;

    public function Save(){
        $this->vente = new Vente(null,
        null,null,null,null, null);
        
        if (isset($_POST['idClient'])) {
            $this->vente->setClient( htmlentities($_POST['idClient']));
        }
        if (isset($_POST['montant'])) {
            $this->vente->setMontant( $_POST['montant']);
        }
        if (isset($_POST['typeVente'])) {
            $this->vente->setType( htmlentities($_POST['typeVente']));
        }
        
        return $this->vente;
    }

    public function getProductForSale(){

        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            // Récupérez les valeurs des cases à cocher sélectionnées
            if (isset($_POST['selectionnes']) && is_array($_POST['selectionnes'])) {
                // Le tableau $_POST['selectionnes'] contient les valeurs des cases à cocher sélectionnées
                $casesCochees = $_POST['selectionnes'];
                return $casesCochees;
            }
           
        }
    }

    public function updateProduct(){
        $produitDao = new ProduitsDao();
        $allProduits = $produitDao->selectProduit(null);
        while ($produits = $allProduits->fetch_assoc()) {
            if ($produits['etat'] == true && $produits['quantite'] > 0) {
                $quantiteChoisie = isset($_POST['qte' . $produits['Id']]) ? intval($_POST['qte' . $produits['Id']]) : 0;
                $connect = new Connection();
                $connect = $connect->connection();
                $query_ = $connect->prepare("UPDATE Produit SET quantite= quantite - ? WHERE Id=?");
                $query_->bind_param("is",$quantiteChoisie,$produits['Id']);
                $query_->execute();
                $connect->close();
            }
        }
    }


}