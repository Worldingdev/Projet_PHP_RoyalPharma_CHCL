<?php
  session_start();
  if($_SESSION['Type'] == 'Admin'){
    include("header.php");
  }elseif($_SESSION['Type'] == 'Vendeur'){
    include("headerSaler.php");
  }else{
    header("location:index.php");
  }   
  use dao\VenteDao;
  use dao\ClientDao;

  $ventes = new VenteDao();
$allVentes = $ventes->selectSale(null);

?>
<main id="main" class="main">

<div class="pagetitle">
  <h1>Affichage de toutes les ventes</h1>
  <nav>
    <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="dashboard.php">Acceuil</a></li>
      <li class="breadcrumb-item">Gestion Ventes</li>
      <li class="breadcrumb-item active">Afficher</li>
    </ol>
  </nav>
</div><!-- End Page Title -->

<section class="section">
    <div class="row">
        <div class="col-lg-10">
            <div class="card">
                <div class="card-body">
                <h5 class="card-title">Liste des ventes</h5>

                <!-- Table with stripped rows -->
                <table class="table table-striped">
                    <thead>
                    <tr>
                        <th scope="col">Id</th>
                        <th scope="col">Id Produit(s)</th>
                        <th scope="col">CLient</th>
                        <th scope="col">Type de Vente</th>
                        <th scope="col">Montant</th>
                        <th scope="col">Date</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php
                        while($vente = $allVentes->fetch_assoc()){
                          $allProd_Vente = $ventes->selectProd_Sale(htmlentities($vente['Id']));
                        ?>
                    <tr>
                        <th><?php echo htmlentities($vente['Id']);?></th>
                        <td>
                            <table>
                              <tbody>
                                <?php  while($product_vente = $allProd_Vente->fetch_assoc() ){?>
                                <tr>
                                  <td><?php echo htmlentities($product_vente['idProduit']);?></td>
                                </tr>
                                <?php } ?>
                              </tbody>
                            </table>
                        </td>
                        <?php
                        $clients = new ClientDao();
                        $allClients = $clients->selectClient(htmlentities($vente['Client']));
                        $client = $allClients->fetch_assoc();
                        ?>
                        <td><?php echo htmlentities($client['Nom']).' '.htmlentities($client['Prenom']);?></td>
                        <td><?php echo htmlentities($vente['Type']);?></td>
                        <td><?php echo htmlentities($vente['Montant']);?></td>
                        <td><?php echo htmlentities($vente['date']);?></td>
                    </tr>
                    <?php
                        }?>
                    </tbody>
                </table>
                <!-- End Table with stripped rows -->

                </div>
            </div>
        </div>  
    </div>
</section>

</main><!-- End #main -->

<?php
include("footer.php");
?>