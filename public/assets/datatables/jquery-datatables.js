var localeText = {
  "sProcessing":     "Procesando...",
  "sLengthMenu":     "Mostrar _MENU_ registros",
  "sZeroRecords":    "No se encontraron resultados",
  "sEmptyTable":     "Ningún dato disponible en esta tabla",
  "sInfo":           "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
  "sInfoEmpty":      "Mostrando registros del 0 al 0 de un total de 0 registros",
  "sInfoFiltered":   "(filtrado de un total de _MAX_ registros)",
  "sInfoPostFix":    "",
  "sSearch":         "Buscar:",
  "sUrl":            "",
  "sInfoThousands":  ",",
  "sLoadingRecords": "Cargando...",
  "oPaginate": {
      "sFirst":    "Primero",
      "sLast":     "Último",
      "sNext":     "Siguiente",
      "sPrevious": "Anterior"
  },
  "oAria": {
      "sSortAscending":  ": Activar para ordenar la columna de manera ascendente",
      "sSortDescending": ": Activar para ordenar la columna de manera descendente"
  }
};

function iniciarGrilla(){
  // Altura Automatica
  let buttons = oMyDatatable.buttons;
  let ajaxGetData = oMyDatatable.ajaxGetData;
  let datatableOption = oMyDatatable.datatableOption;
  console.log( oMyDatatable );

  // Renderizar Columnas
  datatableOption.defsColumn.forEach( function( element, index ){
    if( element.cellRender ){
      // Botones
      if( element.cellRender.render == 'buttons' ){
        let aButtons = element.cellRender.buttons;
        aDfColumnsButtons.columns.columns[index].mRender = function ( data, type, row ){
          let sButtonsColumn = '';
          $.each(aButtons, function( indexButtons, elementButtons ){
            let sClass = '';
            switch( indexButtons ){
              case 'permisos': sClass = 'btn btn-outline-warning btn-sm fw-bold ms-2'; break;
              default: sClass = 'btn btn-light btn-sm'; break;
            }
            sButtonsColumn += `<button id="${oMyDatatable.idTable + '-' + elementButtons.id}" type="button" class="${sClass}">`;
            elementButtons.icons.forEach( icon =>{ sButtonsColumn += `<i class="${icon}"></i>`; });
            // if( elementButtons.text ) sButtonsColumn += `&nbsp;${elementButtons.text}`;
            sButtonsColumn += `</button>`;
          });
          return sButtonsColumn;
        }
      }
    }
  });

  let sButtonsAdd = '';
  if( $(buttons.add).length > 0 ){
    let sClass = '';
    if( buttons.plugins ){
      console.log( buttons.plugins );
      $.each(buttons.plugins, function( indexPlugins, elementPlugins){
        sClass = '';
        let sIcono = '';
        switch( elementPlugins ){
          case 'refresh':
            sClass = 'btn btn-outline-primary btn-sm fw-bold ms-1';
            sIcono = 'fas fa-sync-alt';
          break;
          case 'search':
            sClass = 'btn btn-outline-info btn-sm fw-bold ms-1';
            sIcono = 'fas fa-search';
          break;
          default: sClass = 'btn btn-light btn-sm'; break;
        }
        sButtonsAdd += `<button id="${oMyDatatable.idTable + '-' + elementPlugins}" type="button" class="${sClass}">`;
        sButtonsAdd += `<i class="${sIcono}"></i>`;
        sButtonsAdd += `</button>`;
      });
    }

    // sButtonsAdd += '<div class="d-flex flex-wrap">';
    $.each(buttons.add, function(indexButtons, elementButtons){
      sClass = '';
      // console.log( indexButtons );
      switch( indexButtons ){
        case 'crear': sClass = 'btn btn-outline-success btn-sm fw-bold ms-1'; break;
        case 'editar': sClass = 'btn btn-outline-warning btn-sm fw-bold ms-1'; break;
        case 'eliminar': sClass = 'btn btn-outline-danger btn-sm fw-bold ms-1'; break;
        case 'descargar': sClass = 'btn btn-outline-success btn-sm fw-bold ms-1'; break;
        case 'ver': sClass = 'btn btn-outline-info btn-sm fw-bold ms-1'; break;
        case 'volver': sClass = 'btn btn-outline-primary btn-sm fw-bold ms-1'; break;
        default: sClass = 'btn btn-light btn-sm'; break;
      }
      // sButtonsAdd += '<div class="bd-highlight">';
      sButtonsAdd += `<button id="${oMyDatatable.idTable + '-' + elementButtons.id}" type="button" class="${sClass}">`;
      elementButtons.icons.forEach( function( elementIcon, indexIcon ){
        sButtonsAdd += `<i class="${elementIcon}"></i>`;
        if( indexIcon < (elementButtons.icons.length-1) ) sButtonsAdd += '&nbsp;';
      });
      if( elementButtons.text ) sButtonsAdd += `&nbsp;${elementButtons.text}`;
      sButtonsAdd += `</button>`;
      // sButtonsAdd += '</div>';
    });
    // sButtonsAdd += '</div>';
    $(`#${oMyDatatable.idTable}-tfoot-buttons`).append(sButtonsAdd);
  }

  var objTable = $(`#${oMyDatatable.idTable}`).DataTable({
    columns: datatableOption.defsColumn,
    ajax: {
      url: ajaxGetData.urlAjax,
      type: 'POST',
      data: (ajaxGetData.dataAjax) ? ajaxGetData.dataAjax : {},
    },
    language: localeText,
    select: {
      style: 'single'
    },
    fixedHeader: {
      header: true,
      footer: true
    },
  });

  console.log( objTable );

  setTimeout(() => {
    oMyDatatable = objTable;
  }, 250);
}