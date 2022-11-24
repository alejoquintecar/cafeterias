// // --- --- --- Css --- --- ---
// // import './../../../styles/app/header.css';
// // --- --- END Css --- --- ---

// // --- --- --- Js --- --- ---
// import swal from 'sweetalert2';
// // import IMask from 'imask';
// // import '../../globales/datatables/jquery-config';
// import '../../globales/datatables/jquery-datatables';
// // import { Tooltip, Modal } from "bootstrap/dist/js/bootstrap.min.js";
// import MdlCrud from "./mdlCrud";
// import MdlPermisos from "./mdlPermisos";
// // --- --- END Js --- --- ---

// // --- --- --- Variables globales --- --- ---
// oSwal = swal;
// let oMdlCrud = new MdlCrud();
// let oMdlPermisos = new MdlPermisos();
// var _btn = {
//   'themeIcon': 'square',
//   'plugins': ['refresh', 'search'],
//   'add': []
// };
// // --- --- END Variables globales --- --- ---

$(function(){

  let aDfButtons = {
    'crear': {
      'id'   : 'crear-registro',
      'text' : 'Crear',
      'title': 'Crear Registro',
      'icons': ['fas fa-plus'],
      'class': ''
    },
    'editar': {
      'id'   : 'editar-registro',
      'text' : 'Editar',
      'title': 'Crear Registro',
      'icons': ['fas fa-edit'],
      'class': ''
    },
    'eliminar': {
      'id'   : 'eliminar-registro',
      'text' : 'Eliminar',
      'title': 'Crear Registro',
      'icons': ['far fa-trash-alt'],
      'class': ''
    }
  };

  let aDfColumns = [
    {'width': 150, 'data': 'nombre',         'title': 'Nombre' },
    {'width': 150, 'data': 'referencia',     'title': 'Referencia' },
    {'width': 120, 'data': 'precio',         'title': 'Precio' },
    {'width': 120, 'data': 'peso',           'title': 'Peso' },
    {'width': 100, 'data': 'categoria',      'title': 'Categoría' },
    {'width': 100, 'data': 'stock',          'title': 'Stock' },
    {'width': 100, 'data': 'fecha_creacion', 'title': 'Fecha Creación' },
  ];

  oMyDatatable = {
    idDiv: "div-datatable",
    idTable: "my-datatable",
    ajaxGetData: {
      urlAjax: aRoutesUrls.indexJson, ORDER_SORD: "DESC", ORDER_SIDX: "id"
    },
    datatableOption:{ defsColumn: aDfColumns },
    buttons:{
      'plugins': ['refresh', 'search'],
      'add': aDfButtons
    }
  };
  iniciarGrilla();

  // Crear Registro
  $('#my-datatable').on('click', '#my-datatable-crear-registro', function(){

    let oBtn = $(this);
    window.location.href = "http://transportes-acme.com/productos-new";
    // // Loading Hide
    // $("#loader").show();
    // $('.modal-dialog').removeClass('modal-xl');
    // $('.modal-dialog').addClass('modal-lg');
    // $('#tituloModalGlobal').html( 'Nuevo Producto:&nbsp;'+ oBtn.find('i').map(function( index, icon ){ return icon }) );
    // $('#contenidoModalGlobal').empty().load(aRoutesUrls.indexNew, function (){
    //   $('#modalGlobal').modal({backdrop: true,keyboard: false});
    //   $('#modalGlobal').modal('show');
    //   // oMdlCrud.init();
    //   $("#loader").hide();
    // });
  });

  $('#my-datatable').on('click', '#my-datatable-editar-registro', function(){
    
    let aRowsSelected = oMyDatatable.rows('.selected').data();    
    if( aRowsSelected[0] ){
      document.cookie = "registroId="+aRowsSelected[0].id;
      window.location.href = "http://transportes-acme.com/productos-edit";
    }else{
      Swal.fire({
        icon: 'info',
        toast: true,
        timer: 4500,
        position: 'top-end',
        text: 'Por favor seleccione una fila de la tabla.',
        showConfirmButton: false,
        showCloseButton: true,
        timerProgressBar: true,
        didOpen: (toast) => {
          toast.addEventListener('mouseenter', Swal.stopTimer),
          toast.addEventListener('mouseleave', Swal.resumeTimer)
        }
      });
    }
  });

  // Eliminar registro
  $('#my-datatable').on('click', '#my-datatable-eliminar-registro', function(){

    let aRowsSelected = oMyDatatable.rows('.selected').data();    
    if( aRowsSelected[0] ){
      aRowsSelected = aRowsSelected[0];
      console.log( aRowsSelected );
      Swal.fire({
        icon: 'warning',
        title: "Desea eliminar este producto?",
        html: `<b>Nombre:</b> ${aRowsSelected.nombre}<br><b>Referencia:</b> ${aRowsSelected.referencia}`,
        confirmButtonText: 'Si',
        cancelButtonText: 'No',
        showCancelButton: true,
        cancelButtonColor: '#d33',
        confirmButtonColor: '#198754',
        position: 'center',
        showConfirmButton: true,
        showCloseButton: true,
        showCancelButton: true
      }).then((result) => {
        if( result.isConfirmed ){
          $.ajax({
            url: aRoutesUrls.indexEliminar,
            data: { registroId: aRowsSelected.id },
            type: 'post',
            beforeSend: function(){
              $('#loading').show();
            },
            success: function(data){
              $("#loading").hide();
              Swal.fire({
                icon: ( data.status == 1 ) ? 'success' : 'info',
                title: data.message,
                toast: true,
                timer: 6000,
                position: 'top-end',
                showConfirmButton: false,
                showCloseButton: true,
                timerProgressBar: true,
                didOpen: (toast) => {
                  toast.addEventListener('mouseenter', Swal.stopTimer),
                  toast.addEventListener('mouseleave', Swal.resumeTimer)
                }
              });
              if( data.status == 1 || data.status == 2 ) location.reload();
            },
            error: function(data){
              $('#loading').hide();
            }
          });
        }
      });
    }else{
      Swal.fire({
        icon: 'info',
        toast: true,
        timer: 4500,
        position: 'top-end',
        text: 'Por favor seleccione una fila de la tabla.',
        showConfirmButton: false,
        showCloseButton: true,
        timerProgressBar: true,
        didOpen: (toast) => {
          toast.addEventListener('mouseenter', Swal.stopTimer),
          toast.addEventListener('mouseleave', Swal.resumeTimer)
        }
      });
    }
  });

  // $('#my-datatable').on('click', '#my-datatable-permisos-registro', function(){

  //   let oBtn = $(this);
  //   $("#loader").show();
  //   setTimeout(() => {
  //     let aRowsSelected = oMyDatatable.getRowsSelect()[0];
  //     if( aRowsSelected ){
  //       // Loading Hide
  //       $('.modal-dialog').removeClass('modal-lg');
  //       $('.modal-dialog').addClass('modal-xl');
  //       $('#tituloModalGlobal').html( 'Permisos Usuario:&nbsp;'+ oBtn.find('i').map(function( index, icon ){ return icon }) );
  //       $('#contenidoModalGlobal').empty().load(aRoutesUrls.indexPermisos, { registroId: aRowsSelected.id }, function (){
  //         $('#modalGlobal').modal({backdrop: true,keyboard: false});
  //         $('#modalGlobal').modal('show');
  //         oMdlPermisos.init();
  //         $("#loader").hide();
  //       });
  //     }else{
  //       $("#loader").hide();
  //       Swal.fire({
  //         icon: 'info',
  //         toast: true,
  //         timer: 4500,
  //         position: 'top-end',
  //         text: 'Por favor seleccione una fila de la tabla.',
  //         showConfirmButton: false,
  //         showCloseButton: true,
  //         timerProgressBar: true,
  //         didOpen: (toast) => {
  //           toast.addEventListener('mouseenter', Swal.stopTimer),
  //           toast.addEventListener('mouseleave', Swal.resumeTimer)
  //         }
  //       });
  //     }
  //   }, 120);

  // });

  
});