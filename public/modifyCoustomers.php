<?php
use dao\ClientDao;
session_start();
if($_SESSION['Type'] == 'Admin'){
  include("header.php");
}elseif($_SESSION['Type'] == 'Vendeur'){
  include("headerSaler.php");
}else{
  header("location:index.php");
}   
$clientDao = new ClientDao();
?>
<main id="main" class="main">

<div class="pagetitle">
  <h1>Modifier Client</h1>
  <nav>
    <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="dashboard.php">Acceuil</a></li>
      <li class="breadcrumb-item">Gestion Client</li>
      <li class="breadcrumb-item active">Modifier</li>
    </ol>
  </nav>
</div><!-- End Page Title -->

<section class="section">
  <div class="row">
    <div class="col-lg-8">

      <div class="card">
        <div class="card-body">
          <h5 class="card-title">Formulaire de modification</h5>

          <form class="d-flex" method="post" action="">
                <div class="col-sm-8">
                    <input class="form-control" name="id" type="search" placeholder="Entrer l'Id du client" aria-label="Search">
                </div>
                <button class="btn btn-outline-success" name="search" type="submit">Search</button>
          </form>

          <?php
              if(isset($_POST['id']) && isset($_POST['search'])){
                $allClients = $clientDao->selectClient(htmlentities($_POST['id']));
                $client = $allClients->fetch_assoc();
                if($client != null){
            ?>

          <!-- General Form Elements -->
          <form method="post" action="../dao/ClientDao.php" >
            <div class="row mb-3">
              <label for="inputText" class="col-sm-4 col-form-label">Nom</label>
              <div class="col-sm-10">
                <input type="text" name="nom" value="<?php echo htmlentities($client['Nom']);?>" class="form-control" required>
              </div>
            </div>
            <div class="row mb-3">
              <label for="inputText" class="col-sm-4 col-form-label">Prenom</label>
              <div class="col-sm-10">
                <input type="text" name="prenom" value="<?php echo htmlentities($client['Prenom']);?>" class="form-control" required>
              </div>
            </div>
            <fieldset class="row mb-3">
              <legend class="col-form-label col-sm-4 pt-0">Sexe</legend>
              <div class="col-sm-10">
                <div class="form-check">
                  <input class="form-check-input" type="radio" name="sexe" id="gridRadios1" value="M" <?php echo ($client['Sexe'] == 'M') ? "checked" : "";?>>
                  <label class="form-check-label" for="gridRadios1">
                    Masculin
                  </label>
                </div>
                <div class="form-check">
                  <input class="form-check-input" type="radio" name="sexe" id="gridRadios2" value="F" <?php echo ($client['Sexe'] == 'F') ? "checked" : "";?>>
                  <label class="form-check-label" for="gridRadios2">
                    Feminin
                  </label>
                </div>
              </div>
            </fieldset>
            <div class="row mb-3">
              <label for="inputText" class="col-sm-4 col-form-label">Adresse</label>
              <div class="col-sm-10">
                <input type="text" name="adresse" value="<?php echo htmlentities($client['Adresse']);?>" class="form-control" required>
              </div>
            </div>
            <div class="row mb-3">
              <label for="inputNumber" class="col-sm-4 col-form-label">Telephone</label>
              <div class="col-sm-10">
                <input type="text" id="telephone" name="telephone" placeholder="Ex: +509 xxxx xxxx" value="<?php echo htmlentities($client['Telephone']);?>" class="form-control" onchange="validerNumero()" required>
              </div>
            </div>
            <div class="row mb-3">
              <label for="inputNumber" class="col-sm-4 col-form-label">Email</label>
              <div class="col-sm-10">
                <input type="text" name="email" id="email" placeholder="Ex: email@gmail.com" value="<?php echo htmlentities($client['Email']);?>" class="form-control" onchange="validerEmail()" required>
              </div>
            </div>
            <div class="row mb-3">
              <label for="inputNumber" class="col-sm-4 col-form-label">Date de naissance</label>
              <div class="col-sm-10">
                <input type="date" id="birthdate" name="dob" value="<?php echo htmlentities($client['Dob']);?>" class="form-control" required>
              </div>
            </div>
            
            <div class="row mb-10">
                <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                    <input type="text" name="id" value="<?php echo htmlentities($client['Id']);?>"  class="form-control" hidden>
                    <button class="btn btn-secondary me-md-2" name="modifier" type="submit">Modifier</button>
                    <button class="btn btn-outline-secondary" type="reset">Annuler</button>
                </div>
            </div>

          </form>
          <?php
                }else{
                  ?>
                   <div class="alert alert-warning alert-dismissible fade show col-sm-10" role="alert">
                Aucun correspondant pour cet ID !!!
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
              </div>
              <?php
                }
          }?>
        </div>
      </div>

    </div>
  </div>
</section>
<script src="control.js"></script>

</main><!-- End #main -->
<?php
include("footer.php");
 
?>