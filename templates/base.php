<!DOCTYPE html>
<html>

  <?php $app = $_SESSION['app']; ?>

  <head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>.: Titulo :.</title>
    <!-- --- --- --- Css --- --- --- -->
    <link rel="stylesheet" href="assets/styles/preload.scss">
    <link rel="stylesheet" href="assets/libraries/fonts/kanit/index.css">
    <link rel="stylesheet" href="assets/libraries/bootstrap-5.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/libraries/fontawesome-free-5.15-web/css/all.css">
    <!-- <link rel="stylesheet" href="assets/libraries/fontawesome-free-5.15-web/css/all.css"> -->
    <!-- --- --- END Css --- --- --- -->
  </head>

  <body>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>

    <!-- LOADER -->
    <div id="loading">
      <div id="loader-wrapper">
        <div id="loader"></div>
      </div>
    </div>

    <!-- --- --- --- Body --- --- --- -->
    <div class='ms-3 mt-5 w-100'>
      <?php print $app->block['body'] ?>
    </div>
    <!-- --- --- --- Print Modal --- --- --- -->
    <div class="modal fade" id="modalGlobal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="modalGlobalLabel" aria-hidden="true">
      <div class="modal-dialog modal-dialog modal-dialog-scrollable">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title text-primary" id="tituloModalGlobal">Modal title</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body" id='contenidoModalGlobal'>...</div>
          <div class="modal-footer">
            <button type="button" class="btn btn-outline-warning btn-sm" data-bs-dismiss="modal">
              Cerrar&nbsp;<i class="fa-solid fa-circle-xmark"></i>
            </button>
            <button type="button" class="btn btn-outline-success btn-sm" id='btn-save-modalGlobal'>
              Guardar&nbsp;<i class="fa-solid fa-floppy-disk"></i>
            </button>
          </div>
        </div>
      </div>
    </div>

    <!-- <script src="assets/libraries/jquery-3.6.0.min.js" ></script> -->
    <script src="assets/libraries/bootstrap-5.1/js/bootstrap.min.js"></script>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
      $("#navbar").hover(function(){
        // $(this).css("background-color", "yellow");
        // console.log("yellow");
      }, function(){
        let sDisplay = $('#header-toggle').css('display');
        if( sDisplay == 'none' || sDisplay == 'flex' ){
          $('.accordion-collapse').collapse('hide');
          setTimeout(() => {
            $('.accordion-collapse').collapse('hide');
          }, 400 );
        }
      }); 
    </script>

  </body>

</html>