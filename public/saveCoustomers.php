<?php
session_start();
if($_SESSION['Type'] == 'Admin'){
  include("header.php");
}elseif($_SESSION['Type'] == 'Vendeur'){
  include("headerSaler.php");
}else{
  header("location:index.php");
}   
?>
<main id="main" class="main">

<div class="pagetitle">
  <h1>Enregistrer Clients</h1>
  <nav>
    <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="dashboard.php">Acceuil</a></li>
      <li class="breadcrumb-item">Gestion Clients</li>
      <li class="breadcrumb-item active">Enregistrer</li>
    </ol>
  </nav>
</div><!-- End Page Title -->

<section class="section">
  <div class="row">
    <div class="col-lg-8">

      <div class="card">
        <div class="card-body">
          <h5 class="card-title">Formulaire d'enregistrement</h5>

          <!-- General Form Elements -->
          <form method="post" action="../dao/ClientDao.php" >
            <div class="row mb-3">
              <label for="inputText" class="col-sm-4 col-form-label">Nom</label>
              <div class="col-sm-10">
                <input type="text" name="nom" class="form-control" required>
              </div>
            </div>
            <div class="row mb-3">
              <label for="inputText" class="col-sm-4 col-form-label">Prenom</label>
              <div class="col-sm-10">
                <input type="text" name="prenom" class="form-control" required>
              </div>
            </div>
            <fieldset class="row mb-3">
              <legend class="col-form-label col-sm-4 pt-0">Sexe</legend>
              <div class="col-sm-10">
                <div class="form-check">
                  <input class="form-check-input" type="radio" name="sexe" id="gridRadios1" value="M" checked>
                  <label class="form-check-label" for="gridRadios1">
                    Masculin
                  </label>
                </div>
                <div class="form-check">
                  <input class="form-check-input" type="radio" name="sexe" id="gridRadios2" value="F">
                  <label class="form-check-label" for="gridRadios2">
                    Feminin
                  </label>
                </div>
              </div>
            </fieldset>
            <div class="row mb-3">
              <label for="inputText" class="col-sm-4 col-form-label">Adresse</label>
              <div class="col-sm-10">
                <input type="text" name="adresse" class="form-control" required>
              </div>
            </div>
            <div class="row mb-3">
              <label for="inputNumber" class="col-sm-4 col-form-label">Telephone</label>
              <div class="col-sm-10">
                <input type="text" id="telephone" name="telephone" placeholder="Ex: +509 xxxx xxxx" onchange="validerNumero()" class="form-control" required>
              </div>
            </div>
            <div class="row mb-3">
              <label for="inputNumber" class="col-sm-4 col-form-label">Email</label>
              <div class="col-sm-10">
                <input type="text" id="email" placeholder="Ex: email@gmail.com" name="email" class="form-control" onchange="validerEmail()" required>
              </div>
            </div>
            <div class="row mb-3">
              <label for="inputNumber" class="col-sm-4 col-form-label">Date de naissance</label>
              <div class="col-sm-10">
                <input type="date" id="birthdate" name="dob" class="form-control" required>
              </div>
            </div>
            
            <div class="row mb-10">
                <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                    <button class="btn btn-secondary me-md-2" name="save" type="submit">Enregistrer</button>
                    <button class="btn btn-outline-secondary" type="reset">Annuler</button>
                </div>
            </div>

          </form><!-- End General Form Elements -->

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