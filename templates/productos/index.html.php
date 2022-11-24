<?php include_once __DIR__."/../app/header.html.php"; ?>

<table id="my-datatable" class="display my-datatable bg-white" style="width:100%">
  <tfoot>
    <tr>
      <th class="bg-light" id="my-datatable-tfoot-buttons" colspan="7"></th>
    </tr>
  </tfoot>
</table>

<!-- --- --- --- Js --- --- --- -->
<script>
  var aRoutesUrls = {};
  aRoutesUrls.indexJson = 'productos-json';
  aRoutesUrls.indexNew = 'productos-new';
  aRoutesUrls.indexEdit = 'productos-edit';
  aRoutesUrls.indexEliminar = 'productos-eliminar';
  var oMyDatatable = {};
</script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.1.3/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.datatables.net/v/bs5/jq-3.6.0/dt-1.12.1/datatables.min.js"></script>
<script src="assets/datatables/jquery-datatables.js"></script>
<!-- --- --- --- Controlador --- --- --- -->
<script src="assets/controllers/productos/index.js"></script>