<!-- Los templates son las que vamos a estar utilizando durante toda la aplicacion -->
</main>
  <footer>
    <!-- place footer here -->
    <!-- Deyverson Herrera Valencia <br>
    2023 -->
  </footer>
  <!-- Bootstrap JavaScript Libraries  Librerias requeridas para el funcionamiento de Bootstrap-->
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"
    integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3" crossorigin="anonymous">
  </script>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.min.js"
    integrity="sha384-7VPbUDkoPSGFnVtYi0QogXtr74QeVeeIs99Qfg5YCF+TidwNdjvaKZX19NZ/e6oz" crossorigin="anonymous">
  </script>

  <script>
    $(document).ready( function(){
      $("#tabla_id").DataTable(
        {
          "pagesLength":3,
          lengthMenu:[
            [3,10,25,50],
            [3,10,25,50]
          ],
          "language":{
            "url": "https://cnd.datatables.net/plug-ins/1.13.6/i18n/es-ES.json"
          }
        }
      )
    }
    );

  </script>

<script>
function borrar(id){
  Swal.fire({
  title: '¿Desea borrar el registro?',
  showCancelButton: true,
  confirmButtonText: 'Si'
}).then((result) => {
  if (result.isConfirmed) {
    window.location="index.php?txtID="+id;
  }
})
}
</script> 

</body>

</html>