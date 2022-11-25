<?php include_once __DIR__."/../app/header.html.php"; ?>

<?php $appVar = $_SESSION['app']->html; ?>

<nav aria-label="breadcrumb">
  <ol class="breadcrumb h5">
    <li class="breadcrumb-item">
      <a href="/productos">Productos</a>
    </li>
    <li class="breadcrumb-item active" aria-current="page">Nuevo Producto</li>
  </ol>
</nav>

<form id="form-crud" action="#" class="border-top border-primary pt-2">

  <div class="row">

    <!-- Producto -->
    <div class="col-6 col-md-4">
      <label for="producto" class="form-label fw-bold">Producto:</label>
      <input type="text" class="form-control" id="producto" name="producto[producto]" required value="<?php if( isset($appVar['producto']) ) echo $appVar['producto']['nombre']; ?>">
    </div>
    <!-- Referencia -->
    <div class="col-6 col-md-4">
      <label for="referencia" class="form-label fw-bold">Referencia:</label>
      <input type="text" class="form-control" id="referencia" name="producto[referencia]" required value="<?php if( isset($appVar['producto']) ) echo $appVar['producto']['referencia']; ?>">
    </div>
    <!-- Precio -->
    <div class="col-6 col-md-4">
      <label for="precio" class="form-label fw-bold">Precio:</label>
      <input type="number" class="form-control" id="precio" name="producto[precio]" required value="<?php if( isset($appVar['producto']) ) echo $appVar['producto']['precio']; ?>">
    </div>
    <!-- Peso -->
    <div class="col-6 col-md-4">
      <label for="peso" class="form-label fw-bold">Peso:</label>
      <input type="number" class="form-control" id="peso" name="producto[peso]" required value="<?php if( isset($appVar['producto']) ) echo $appVar['producto']['peso']; ?>">
    </div>
    <!-- Categoria -->
    <div class="col-6 col-md-4">
      <label for="categoria" class="form-label fw-bold">Categoría:</label>
      <input type="text" class="form-control" id="categoria" name="producto[categoria]" required value="<?php if( isset($appVar['producto']) ) echo $appVar['producto']['categoria']; ?>">
    </div>
    <!-- Stock -->
    <div class="col-6 col-md-4">
      <label for="stock" class="form-label fw-bold">Stock:</label>
      <input type="number" class="form-control" id="stock" name="producto[stock]" required value="<?php if( isset($appVar['producto']) ) echo $appVar['producto']['stock']; ?>">
    </div>
  </div>

  <div class="row">
    <div class="col-12 text-center mt-3">
      <button type="submit" class="btn btn-outline-success">
        Guardar <i class="fas fa-save"></i>
      </button>
      <button type="button" class="btn btn-outline-warning">
        Cancelar <i class="far fa-times-circle"></i>
      </button>
      <input type="hidden" name="producto[id]" value="<?php if( isset($appVar['producto']) ) echo $appVar['producto']['id']; ?>">
    </div>
  </div>

</form>

<script type="text/javascript">

  var aRoutesUrls = {};
  aRoutesUrls.indexCrud = "<?php if( $appVar['action'] == 'new' ) echo 'productos-new'; else echo 'productos-edit'; ?>";
  // aRoutesUrls.indexNew = 'productos-new';
  // aRoutesUrls.indexEdit = 'productos-edit';

  $("#loading").hide();
  $('#form-crud').submit(function (e){
    $.ajax({
      url: aRoutesUrls.indexCrud,
      data: $('#form-crud').serialize(), // '&' + $.param({}),
      type: 'post',
      beforeSend: function(){
        $('#loading').show();
      },
      success: function(data){
        $("#loading").hide();
        Swal.fire({
          icon: ( data.status == 1 ) ? 'success' : 'warning',
          title: data.message,
          toast: true,
          timer: 4500,
          position: 'top-end',
          showConfirmButton: false,
          showCloseButton: true,
          timerProgressBar: true,
          didOpen: (toast) => {
            toast.addEventListener('mouseenter', Swal.stopTimer),
            toast.addEventListener('mouseleave', Swal.resumeTimer)
          }
        });
        if( data.status == 1 ) window.location.href = "http://transportes-acme.com/productos";
      },
      error: function(data){
        // $('#loading').hide();
      }
    });
    return false;    
  });

</script>