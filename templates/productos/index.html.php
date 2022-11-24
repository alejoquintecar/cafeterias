<?php include_once __DIR__."/../app/header.html.php"; ?>

<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/bs5/jq-3.6.0/dt-1.13.1/b-2.3.3/fh-3.3.1/kt-2.8.0/sc-2.0.7/sb-1.4.0/sp-2.1.0/sl-1.5.0/datatables.min.css"/>

<table id="my-datatable" class="display my-datatable table-bordered bg-white" style="width:100%">
  <tfoot>
    <tr>
      <th class="bg-light" id="my-datatable-tfoot-buttons" colspan="7"></th>
    </tr>
  </tfoot>
</table>

<!-- --- --- --- Js --- --- --- -->
<script>
  $("#loading").hide();
  var aRoutesUrls = {};
  aRoutesUrls.indexJson = 'productos-json';
  aRoutesUrls.indexNew = 'productos-new';
  aRoutesUrls.indexEdit = 'productos-edit';
  aRoutesUrls.indexEliminar = 'productos-eliminar';
  var oMyDatatable = {};
</script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.1.3/js/bootstrap.bundle.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/v/bs5/jq-3.6.0/dt-1.13.1/b-2.3.3/fh-3.3.1/kt-2.8.0/sc-2.0.7/sb-1.4.0/sp-2.1.0/sl-1.5.0/datatables.min.js"></script>
<script src="assets/datatables/jquery-datatables.js"></script>
<!-- --- --- --- Controlador --- --- --- -->
<script src="assets/controllers/productos/index.js"></script>