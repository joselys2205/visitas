//General Script
function someMethodIThinkMightBeSlow() {
    const startTime = performance.now();
    const duration = performance.now() - startTime;
    console.log(`someMethodIThinkMightBeSlow took ${duration}ms`);
    setTimeout(functionToRunVerySoonButNotNow);
    
Promise.resolve().then(functionToRunVerySoonButNotNow);
}

//Modal for materialize
$(document).ready(function () { 
    $('#target-hidden').hide();
    $('.modal').modal();
    $('select').material_select();
    $('.datepicker').pickadate({
        selectMonths: true,
        selectYears: 15 
    });
    $('#setTimeExample').timepicker();
    $('#setTimeButton').on('click', function () {
        $('#setTimeExample').timepicker('setTime', new Date());      
    });

    $.fn.camara();

    $("#tomar-foto").on( "click", function() {
			$('#target-2').show();
            $('#target-1').hide();
    });
    $("#borrar-foto").on( "click", function() {
			$('#target-1').show();
            $('#target-2').hide(); 
    });
});

//Datepicker for materileze

$('.datepicker').pickadate({
    selectMonths: true, 
    selectYears: 15, 
    today: 'Today',
    clear: 'Clear',
    close: 'Ok',
    closeOnSelect: false 
  });

$('.timepicker').pickatime({
    default: 'now', // Set default time: 'now', '1:30AM', '16:30'
    fromnow: 0,       // set default time to * milliseconds from now (using with default = 'now')
    twelvehour: false, // Use AM/PM or 24-hour format
    donetext: 'OK', // text for done-button
    cleartext: 'Clear', // text for clear-button
    canceltext: 'Cancel', // Text for cancel-button
    autoclose: false, // automatic close timepicker
    ampmclickable: true, // make AM PM clickable
    aftershow: function(){} //Function for after opening timepicker
  });

//Table Spanish
$(document).ready(function() {
 
    $('#Jtabla').dataTable( {
 
        "language": {
 
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
 
} 
    } );
 
} );

/*  FUNCION PARA ACTIVACION Y FUNCIONAMIENTO DE LA CAMARA  */
$.fn.camara = function(){
 var streaming = false,
      video        = document.querySelector('#target-1'),
      canvas       = document.querySelector('#canvas'),
      photo        = document.querySelector('#target-2'),
      startbutton  = document.querySelector('#tomar-foto'),
      width = 150,
      height = 150;

  navigator.getMedia = ( navigator.getUserMedia || 
                         navigator.webkitGetUserMedia ||
                         navigator.mozGetUserMedia ||
                         navigator.msGetUserMedia);

  navigator.getMedia(
    { 
      audio: false,
      video: { width: 60, height: 60 }
    },
    function(stream) {
      if (navigator.mozGetUserMedia) { 
        video.mozSrcObject = stream;
      } else {
        var vendorURL = window.URL || window.webkitURL;
        video.src = vendorURL ? vendorURL.createObjectURL(stream) : stream;
      }
      window.error = 0;
      video.play();
    },
    function(err) {
      //parent.$.fn.colorbox.close();
      //parent.$.fn.dialogo(1,"Dispositivo de Video no Encontrado! ",'Error','', '', 300,150); //Ejecucion del mensaje
    }
  );

  video.addEventListener('canplay', function(ev){
    if (!streaming) {
      streaming = true;
    }
  }, false);

  function takepicture() {
   // canvas.width = 198;
   // canvas.height = 151;
    //canvas.getContext('2d').drawImage(video, 30, 0, 500, 500 , 0, 0, 350, 315);
    canvas.width = 200;
    canvas.height = 200;
    canvas.getContext('2d').drawImage(video, 0, 0, 200, 200);
    window.data = canvas.toDataURL('image/png');
    photo.setAttribute('src', window.data);
  }


  startbutton.addEventListener('click', function(ev){
    if(window.error == 0){
      takepicture();
      $('#target-hidden').val($('#target-2').attr('src'));
    }
    ev.preventDefault();
  }, false);



}//Fin del function
