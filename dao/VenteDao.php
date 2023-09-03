<?php
namespace dao;

require __DIR__ . '/../vendor/autoload.php';
use config\Connection;
use controller\VenteController;
use MoncashEasy\SDK\MoncashAPI;


class VenteDao{

    public function save(){
        $con = new Connection();
        $venteController = new VenteController();
        $vente = $venteController->save();
        $con = $con->connection();
        $client = $vente->getClient();
        $type = $vente->getType();
        $montant = $vente->getMontant();
        $date=date("Y-m-d H:i:s");
        $name="abcdefghijklmnopqrstuvwxyz";
        $indice1 = mt_rand(0, strlen($name) - 1);
        $indice2 = mt_rand(0, strlen($name) - 1);
        // Utilisez les indices pour extraire les lettres
        $lettre1 = $name[$indice1];
        $lettre2 = $name[$indice2];
        do{
            $id = 'Vte-'.$lettre1.$lettre2.'-'.random_int(100,999);
            $query = $con->prepare("SELECT  * FROM Vente where Id=?");
            $query->execute(array($id));
            $query->store_result();
            $ventes = $query->num_rows();
        }while($ventes>0);
        $query2 = $con->prepare("INSERT INTO `Vente`(`Id`, `Produit`, `Client`, `Type`, `Montant`, `date`) VALUES (?,?,?,?,?,?)");
        $query2->execute(array($id,null,$client,$type,$montant,$date));
        $allProduct = $venteController->getProductForSale();
        foreach($allProduct as $idProduct){
            $query3 = $con->prepare("INSERT INTO `Produit_Vente`(`id`,`idProduit`, `idVente`) VALUES (?,?,?)");
            $query3->execute(array(null,$idProduct,$id));
        }
        $con->close();
        $venteController->updateProduct();
        header('location:../public/printSales.php');
    }

    public function selectSale($id){
        $con = new Connection();
        $con = $con->connection();
        if($id == null){
            $vente = $con->query("SELECT  * FROM Vente");
        }
        else{
            $vente = $con->prepare("SELECT  * FROM Vente where Id=?");
            $vente->execute(array($id));
            $vente = $vente->get_result();
        }
        
        return $vente;
    }

    public function selectProd_Sale($id){
        $con = new Connection();
        $con = $con->connection();
        $prod_vente = $con->prepare("SELECT * FROM `Produit_Vente` WHERE  idVente=?");
        $prod_vente->execute(array($id));
        $prod_vente = $prod_vente->get_result();
        return $prod_vente;
    }

    public function selectSaleForDay($date){
        $startDate = $date.' 00:00:00';
        $endDate = $date.' 23:59:59'; 
        $con = new Connection();
        $con = $con->connection();
        $vente = $con->prepare("SELECT * FROM `vente` WHERE `date` BETWEEN ? AND ? ");
        $vente->execute(array($startDate,$endDate));
        $vente = $vente->get_result();
        return $vente;
    }

    public function revenu(){
        $con = new Connection();
        $con = $con->connection();
        $revenu = $con->query("SELECT SUM(Montant) AS montanTotal FROM Vente");
        if ($revenu) {
            $revenu = $revenu->fetch_assoc();
            $revenu = $revenu['montanTotal'];
        }else{
            $revenu = 0;
        }
        return $revenu;
    }



}
$venteDao = new VenteDao();
if (isset($_POST['saveVente'])){
    $venteDao->save();
}