export default class MdlCrud {

  constructor(){}
  init(){

    $('#form-crud').submit(function (){

      let sMensaje = '';
      if( ($('#users_password').val().trim() == '' || $('#users_confirm_password').val().trim() == '') && action == 'new' )
        sMensaje = 'Contraseña o Confirmar contraseña no diligenciado.';
      if( $('#form-crud').find('.form-check-input-form:checked').length == 0 )
        sMensaje = 'No ha asignado los roles al usuario.';

      if( sMensaje != '' ){
        Swal.fire({
          icon: 'info',
          title: sMensaje,
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
      }else{
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
            if( data.status == 1 || data.status == 2 ) location.reload();
          },
          error: function(data){
            $('#loading').hide();
          }
        });
      }

      return false;
    });
  }
}