// --- --- --- Css --- --- ---
import './styles/app.scss';
// --- --- END Css --- --- ---

// --- --- --- Js --- --- ---
// Import
import $ from 'jquery';
import swal from 'sweetalert2';
// import MdlCambioPasswords from './controllers/app/mdlCambioPasswords';
import { Tooltip, Modal, Bootstrap } from "bootstrap/dist/js/bootstrap.min.js";

// --- --- END Js --- --- ---


// --- --- --- Variables --- --- ---
global.$ = global.jQuery = $;
global.Modal = Modal;
global.Tooltip = Tooltip;
global.Bootstrap = Tooltip;
// let oMdlCambioPasswords = new MdlCambioPasswords();
// Modal Global
global.modalGlobal = new Modal(document.getElementById('modalGlobal'), {
  backdrop: true, keyboard: false
});
// --- --- END Variables --- --- ---

// start the Stimulus application
// import './bootstrap';

// Acciones por defecto
$(document).ready(function(){

  $('#btn-save-modalGlobal').on('click', function(){

    let nInputEmpty = 0;
    $('#form-crud').find('input').each(function( index, element ){
      if( $(element).attr('required') == 'required' && 
        $(element).attr('type') != 'checkbox' && $(element).attr('type') != 'password' && $(element).val().trim() == ''
      ) nInputEmpty++;
    });

    $('#contenidoModalGlobal').find('#btn-mdl-submit').trigger('click');
    if( nInputEmpty > 0 ){
      Swal.fire({
        icon: 'info',
        title: 'Diligencie todos los campos.',
        toast: true,
        position: 'top-end',
        showConfirmButton: false,
        timer: 4500,
        timerProgressBar: true,
        didOpen: (toast) => {
          toast.addEventListener('mouseenter', Swal.stopTimer),
          toast.addEventListener('mouseleave', Swal.resumeTimer)
        }
      });
    }
  });

  $('#btn-cerrar-sesion').on('click', function(){
    swal.fire({
      icon: 'warning',
      toast: false,
      position: 'center',
      buttonShowConfirm: true,
      buttonShowCancel: true,
      html: '<b class="pl-1 h5">Confirma el cierre de sesión.</b>',
      showCancelButton: true,
      confirmButtonColor: '#198754',
      cancelButtonColor: '#d33',
      confirmButtonText: 'Si',
      cancelButtonText: 'No',
      showCloseButton: true,
      focusConfirm: true
    }).then((result) => {
      if( result.isConfirmed ) window.location.href = aRoutesUrls.appLogout;
    });
  });

  // --- Loading Hide
  $('#loading').hide();
  $('[data-bs-toggle="tooltip"]').tooltip() // to enable tooltips, with default configuration

});
