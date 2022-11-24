export default class MdlPermisos {

  constructor(){}
  init(){

    $('.form-check-input').submit(function (){
      let o
    });


    $('#form-permisos').submit(function (){
      $.ajax({
        url: aRoutesUrls.indexPermisos,
        data: $('#form-permisos').serialize(), // '&' + $.param({}),
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
          // if( data.status == 1 ) location.reload();
        },
        error: function(data){
          $('#loading').hide();
        }
      });
      return false;
    });
  }
}