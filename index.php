    <?php include("templates/header.php"); ?> 
    <!-- //inserta por medio de php un archivo de codigo desde otro documento -->
    <br>
    <div class="p-5 mb-4 bg-light rounded-3">
        <div class="container-fluid py-5">
          <h1 class="display-5 fw-bold">Bienvenido al sistema</h1>
          <p class="col-md-8 fs-4">Usuario: <?php echo $_SESSION['usuario'];?></p>
          <button class="btn btn-primary btn-lg" type="button">Example button</button>
        </div>
      </div>
      <?php include("templates/footer.php"); ?> 
      <!-- Insertando el footer -->