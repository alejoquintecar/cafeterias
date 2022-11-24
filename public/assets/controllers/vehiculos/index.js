
$(function(){

  console.log( aDfColumnsButtons );

  oMyDatatable = {
    idDiv: "div-datatable",
    idTable: "my-datatable",
    ajaxGetData: {
      urlAjax: aRoutesUrls.indexJson, ORDER_SORD: "DESC", ORDER_SIDX: "id"
    },
    datatableOption:{
      defsColumn: aDfColumnsButtons.columns
    },
    buttons:{
      'plugins': ['refresh', 'search'],
      'add': aDfColumnsButtons.buttons
    }
  };
  iniciarGrilla();

  // $('#nav-profile').on('click', '.btn-movimientos-tapa', function(){
  //   let oBtn = $(this);
  //   // Loading Hide
  //   $("#loader").show();
  //   $('.modal-dialog').addClass('modal-lg');
  //   $('#tituloModalGlobal').html('Movimientos Tapa:&nbsp;');
  //   $('#contenidoModalGlobal').empty().load( aRoutesUrls.mdlMovimientosTapa, {registroId: oBtn.data('registro-id') }, function (){
  //     $('#modalGlobal').modal({backdrop: true,keyboard: false});
  //     $('#modalGlobal').modal('show');
  //     // oMdlCrud.init();
  //     $("#loader").hide();
  //   });
  // });

});

