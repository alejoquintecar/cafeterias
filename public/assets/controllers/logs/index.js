// --- --- --- Css --- --- ---
// import './../../../styles/app/header.css';
// --- --- END Css --- --- ---

// --- --- --- Js --- --- ---
import swal from 'sweetalert2';
// import IMask from 'imask';
// import '../../globales/datatables/jquery-config';
import '../../globales/datatables/jquery-datatables';
// import { Tooltip, Modal } from "bootstrap/dist/js/bootstrap.min.js";
// --- --- END Js --- --- ---

// --- --- --- Variables globales --- --- ---
oSwal = swal;
var _btn = {
  'themeIcon': 'square',
  'plugins': ['refresh', 'search'],
  'add': []
};
// --- --- END Variables globales --- --- ---

$(function(){

  oMyDatatable = $.fn.ALEJO_Datatable({
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
  });
  
});