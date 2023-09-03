<?php
  session_start();
  if($_SESSION['Type'] == 'Admin'){
    include("header.php");
  }
  if($_SESSION['Type'] == 'Vendeur'){
    include("headerSaler.php");
  }
  use dao\ClientDao;
  use dao\ProduitsDao;

$clientDao = new ClientDao();
$produits = new ProduitsDao();

$allProduits = $produits->selectProduit(null);
?>
<main id="main" class="main">

<div class="pagetitle">
  <h1>Enregistrer Clients</h1>
  <nav>
    <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="dashboard.php">Acceuil</a></li>
      <li class="breadcrumb-item">Gestion Vente</li>
      <li class="breadcrumb-item active">Enregistrer</li>
    </ol>
  </nav>
</div><!-- End Page Title -->

<section class="section">
  <div class="row">
    <div class="col-lg-8">

    <?php
              if(!isset($_POST['search']) ){ ?>
      <div class="card">
        <div class="card-body">
          <h5 class="card-title">Etape 1 : Identification  & type de vente</h5>

          <!-- General Form Elements -->
          <form method="post" action="">
            
            <div class="row mb-3">
              <label for="inputText" class="col-sm-4 col-form-label">Id Client</label>
              <div class="col-sm-10">
                <input type="text" name="id" class="form-control">
              </div>
            </div>
            
            <fieldset class="row mb-3">
              <legend class="col-form-label col-sm-4 pt-0">Type de vente</legend>
              <div class="col-sm-10">
                <div class="form-check">
                  <input class="form-check-input" type="radio" name="type" id="gridRadios1" value="Cash" checked>
                  <label class="form-check-label" for="gridRadios1">
                    Cash
                  </label>
                </div>
                <div class="form-check">
                  <input class="form-check-input" type="radio" name="type" id="gridRadios2" value="Credit">
                  <label class="form-check-label" for="gridRadios2">
                    Credit
                  </label>
                </div>
              </div>
            </fieldset>
            
            <div class="row mb-10">
                <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                    <button class="btn btn-secondary me-md-2" name="search" type="submit">Suivant ></button>
      
                </div>
            </div>

          </form><!-- End General Form Elements -->

        </div>
      </div>

      <?php }
              if(isset($_POST['id']) && isset($_POST['search'])){
                $typeVente = htmlentities($_POST['type']);
                $allClient = $clientDao->selectClient(htmlentities($_POST['id']));
                $client = $allClient->fetch_assoc();
                if($client != null){ ?>

            <div class="card">
        <div class="card-body">
          <h5 class="card-title">Etape 2 : Choix des produits</h5>
          <h5 class="card-title"><span>Liste des Produits disponible</span></h5>

          <!-- General Form Elements -->
          <form method="post" action="../dao/VenteDao.php">

          <table class="table table-striped">
                    <thead>
                    <tr>
                        <th scope="col">Id</th>
                        <th scope="col">Nom</th>
                        <th scope="col">Type</th>
                        <th scope="col">Prix</th>
                        <th scope="col">Qte disponible</th>
                        <th scope="col">Ajouter au panier</th>
                        <th scope="col">Qte choisit</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php
                        while($produits = $allProduits->fetch_assoc()){
                            if($produits['etat'] == true && $produits['quantite'] > 0){
                        ?>
                    <tr>
                        <th><?php echo htmlentities($produits['Id']);?></th>
                        <td><?php echo htmlentities($produits['Nom']);?></td>
                        <td><?php echo htmlentities($produits['Type']);?></td>
                        <td><?php echo htmlentities($produits['Prix']);?></td>
                        <td><?php echo htmlentities($produits['quantite']);?></td>
                        <td>
                          <input class="form-check-input" type="checkbox" name="selectionnes[]" value="<?php echo htmlentities($produits['Id']);?>" id="flexCheck_<?php echo htmlentities($produits['Id']);?>" onchange="toggleInputValidation(this);" <?php echo (htmlentities($produits['quantite']) == 0)? 'disabled': ''; ?> >
                        </td>
                        <td>
                          <input type="number" max="<?php echo htmlentities($produits['quantite']);?>" name="<?php echo 'qte'.htmlentities($produits['Id']);?>" class="form-control" id="qte_<?php echo htmlentities($produits['Id']);?>" oninput="calculateTotal();" required disabled>
                        </td>
                    </tr>
                    <?php
                        }}?>
                    </tbody>
                </table>
                
            
            <div class="row mb-3 justify-content-md-end">
              
            </div>
            
            <div class="row mb-10">
                <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                    <label for="inputNumber" class="col-form-label">Montant total</label>
                    <div class="col-sm-2">
                      <input  type="number" max="<?php echo ($typeVente == 'Credit')? 5000 : '' ;?>" id="montantTotal" name="montant" class="form-control " readonly required>
                    </div>
                    <input type="text" name="typeVente" id="typeVenteInput" value="<?php echo $typeVente; ?>"  class="form-control" hidden >
                    <input type="text" name="idClient" value="<?php echo htmlentities($client['Id']);?>"  class="form-control" hidden>
                    <button class="btn btn-secondary me-md-2" id="button" name="saveVente" type="submit" disabled>Terminer</button>
                </div>
            </div>

          </form><!-- End General Form Elements -->

        </div>
      </div>
    <?php }
    else{
      ?>
      <div class="card">
        <div class="card-body">
          <div class="alert alert-warning alert-dismissible fade show col-sm-10 mt-3" role="alert">
            Aucun correspondant pour cet ID !!!
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
          </div>
          <h5 class="card-title">Etape 1 : Identification  & type de vente</h5>

          <!-- General Form Elements -->
          <form method="post" action="">
            
            <div class="row mb-3">
              <label for="inputText" class="col-sm-4 col-form-label">Id Client</label>
              <div class="col-sm-10">
                <input type="text" name="id" class="form-control">
              </div>
            </div>
            
            <fieldset class="row mb-3">
              <legend class="col-form-label col-sm-4 pt-0">Type de vente</legend>
              <div class="col-sm-10">
                <div class="form-check">
                  <input class="form-check-input" type="radio" name="type" id="gridRadios1" value="Cash" checked>
                  <label class="form-check-label" for="gridRadios1">
                    Cash
                  </label>
                </div>
                <div class="form-check">
                  <input class="form-check-input" type="radio" name="type" id="gridRadios2" value="Credit">
                  <label class="form-check-label" for="gridRadios2">
                    Credit
                  </label>
                </div>
              </div>
            </fieldset>
            
            <div class="row mb-10">
                <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                    <button class="btn btn-secondary me-md-2" name="search" type="submit">Suivant ></button>
      
                </div>
            </div>

          </form><!-- End General Form Elements -->
          

        </div>
        
      </div>
       
      <?php
    }
  }?>
    </div>
  </div>
</section>
<script src="control.js"></script>


</main><!-- End #main -->
<?php
include("footer.php");
?>