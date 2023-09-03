<?php
  session_start();
  if($_SESSION['Type'] == 'Admin'){
    include("header.php");
  }elseif($_SESSION['Type'] == 'Vendeur'){
    include("headerSaler.php");
  }else{
    header("location:index.php");
  }   
  use dao\ClientDao;
  use dao\VenteDao;

  $clients = new ClientDao();
  $ventes = new VenteDao();
  $allClients = $clients->selectClient(null);
  $allVente = $ventes->selectSale(null);
  
  
?>

  <main id="main" class="main">

    <div class="pagetitle">
      <h1>Dashboard</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="dashboard.php">Home</a></li>
          <li class="breadcrumb-item active">Dashboard</li>
        </ol>
      </nav>
    </div><!-- End Page Title -->

    <section class="section dashboard">
      <div class="row">

        <!-- Left side columns -->
        <div class="col-lg-8">
          <div class="row">

            <!-- Sales Card -->
            <div class="col-xxl-4 col-md-6">
              <div class="card info-card sales-card">

                <div class="filter">
                  <a class="icon" href="#" data-bs-toggle="dropdown"><i class="bi bi-three-dots"></i></a>
                </div>

                <div class="card-body">
                  <h5 class="card-title">Sales <span>| all</span></h5>

                  <div class="d-flex align-items-center">
                    <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                      <i class="bi bi-cart"></i>
                    </div>
                    <div class="ps-3">
                      <h6><?php echo $allVente->num_rows ?></h6>
                    </div>
                  </div>
                </div>

              </div>
            </div><!-- End Sales Card -->

            <!-- Revenue Card -->
            <div class="col-xxl-4 col-md-6">
              <div class="card info-card revenue-card">

                <div class="filter">
                  <a class="icon" href="#" data-bs-toggle="dropdown"><i class="bi bi-three-dots"></i></a>
                </div>

                <div class="card-body">
                  <h5 class="card-title">Revenue <span>| all</span></h5>

                  <div class="d-flex align-items-center">
                    <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                      <i class="bi bi-currency-dollar"></i>
                    </div>
                    <div class="ps-3">
                      <h6><?php echo '$ '.$ventes->revenu(); ?></h6>
                    </div>
                  </div>
                </div>

              </div>
            </div><!-- End Revenue Card -->

            <!-- Customers Card -->
            <div class="col-xxl-4 col-xl-12">

              <div class="card info-card customers-card">

                <div class="filter">
                  <a class="icon" href="#" data-bs-toggle="dropdown"><i class="bi bi-three-dots"></i></a>
                </div>

                <div class="card-body">
                  <h5 class="card-title">Customers <span>| all</span></h5>

                  <div class="d-flex align-items-center">
                    <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                      <i class="bi bi-people"></i>
                    </div>
                    <div class="ps-3">
                      <h6><?php echo $allClients->num_rows ?></h6>
                    </div>
                  </div>

                </div>
              </div>

            </div><!-- End Customers Card -->
            <!-- Recent Sales -->
            <div class="col-12">
              <div class="card recent-sales overflow-auto">

                <div class="filter">
                  <a class="icon" href="#" data-bs-toggle="dropdown"><i class="bi bi-three-dots"></i></a>
                  
                </div>

                <div class="card-body">
                  <h5 class="card-title">Recent Sales <span>| Today</span></h5>

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
                        
                        $allVentes = $ventes->selectSaleForDay(htmlentities(date("Y-m-d")));
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

                </div>

              </div>
            </div><!-- End Recent Sales -->

          </div>
        </div><!-- End Left side columns -->

        <!-- Right side columns -->
        

      </div>
    </section>

  </main><!-- End #main -->
<?php
include("footer.php");
?>