<?php
use dao\UtilisateurDao;
session_start();
if($_SESSION['Type'] == 'Admin'){
  include("header.php");

$userDao = new UtilisateurDao();
?>
<main id="main" class="main">

<div class="pagetitle">
  <h1>Modifier Utilisateur</h1>
  <nav>
    <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="dashboard.php">Acceuil</a></li>
      <li class="breadcrumb-item">Gestion Utilisateur</li>
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
                    <input class="form-control" name="id" type="search" placeholder="Entrer l'Id de l'utilisateur" aria-label="Search" required>
                </div>
                <button class="btn btn-outline-success" name="search" type="submit">Search</button>
            </form>


            <?php
              if(isset($_POST['id']) && isset($_POST['search'])){
                $allUsers = $userDao->selectUser(htmlentities($_POST['id']));
                $user = $allUsers->fetch_assoc();
                if($user != null){
            ?>

          <!-- General Form Elements -->
          <form method="post" action="../dao/UtilisateurDao.php" >
            <div class="row mb-3">
              <label for="inputText" class="col-sm-4 col-form-label">Nom</label>
              <div class="col-sm-10">
                <input type="text" name="name" value="<?php echo htmlentities($user['Nom']);?>" class="form-control">
              </div>
            </div>
            <div class="row mb-3">
              <label for="inputText" class="col-sm-4 col-form-label">Nom utilisateur</label>
              <div class="col-sm-10">
                <input type="text" name="username" value="<?php echo htmlentities($user['Username']);?>" class="form-control">
              </div>
            </div>
            <div class="row mb-3">
              <label for="inputNumber" class="col-sm-4 col-form-label">Telephone</label>
              <div class="col-sm-10">
                <input type="text" name="tel" id="telephone" placeholder="Ex: +509 xxxx xxxx" onchange="validerNumero()" value="<?php echo htmlentities($user['Telephone']);?>" class="form-control">
              </div>
            </div>
            <div class="row mb-3">
              <label for="inputNumber" class="col-sm-4 col-form-label">NIF/CIN</label>
              <div class="col-sm-10">
                <input type="number" name="NUNI" value="<?php echo htmlentities($user['NINU']);?>" class="form-control">
              </div>
            </div>
            <div class="row mb-3">
              <label for="inputPassword" class="col-sm-4 col-form-label">Mot de passe</label>
              <div class="col-sm-10">
                <input type="password" name="password"  class="form-control" required>
              </div>
            </div>
            
            
            <fieldset class="row mb-3">
              <legend class="col-form-label col-sm-4 pt-0">Type</legend>
              <div class="col-sm-10">
                <div class="form-check">
                  <input class="form-check-input" type="radio" name="gridRadios" id="gridRadios1" value="Admin" <?php echo ($user['Type'] == 'Admin') ? "checked" : "";?>>
                  <label class="form-check-label" for="gridRadios1">
                    Admin
                  </label>
                </div>
                <div class="form-check">
                  <input class="form-check-input" type="radio" name="gridRadios" id="gridRadios2" value="Vendeur" <?php echo ($user['Type'] == 'Vendeur') ? "checked" : "";?>>
                  <label class="form-check-label" for="gridRadios2">
                    Vendeur
                  </label>
                </div>
              </div>
            </fieldset>
            
            <div class="row mb-10">
                <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                    <input type="text" name="id" value="<?php echo htmlentities($user['Id']);?>"  class="form-control" hidden>
                    <button class="btn btn-secondary me-md-2" name="modifier"  type="submit">Modifier</button>
                    <button class="btn btn-outline-secondary"  type="reset">Annuler</button>
                </div>
            </div>

          </form><!-- End General Form Elements -->
                <?php
                }else{
                  ?>
                   <div class="alert alert-warning alert-dismissible fade show col-sm-10" role="alert">
                Aucun correspondant pour cet ID !!!
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
              </div>
                  <?php
                }
        }
        ?>
        </div>
      </div>

    </div>
  </div>
</section>
<script src="control.js"></script>

</main><!-- End #main -->
<?php
include("footer.php");
}else{
  header("location:index.php");
}    
?>
