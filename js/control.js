;
//  VARIABLE GLOBAL PARA MOVER IMG
var data;
//  VARIABLE GLOBAL PARA SABER SI SE HAN TOMADO FOTOS
var taken = 0;

var error = 1

/*************************/
/* Evento document ready */
/*************************/
$(document).ready(function(){

    $.fn.eventosColorBox();
     
  $.fn.camara();

});//Fin del document ready
/**************************/

/*********************/
/* EVENTOS COLORBOX */
/*********************/
$.fn.eventosColorBox = function(){
  
   
  $('#btnAceptar').click(function(){
    
    // VALIDACION DE SI SE TOMO UNA FOTO
    if(window.taken == 1){  
      parent.$('#fotoVisitante').attr('src', window.data);
	  parent.window.fotoUpd = 1;
    } 
    //parent.$.fn.colorbox.close();

    
  });// FIN CLICK BTN ACEPTAR
  
}//FIN EVENTOS 
/************/



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
    canvas.width = 198;
    canvas.height = 151;
    canvas.getContext('2d').drawImage(video, 0, 0, 198, 151);
    window.data = canvas.toDataURL('image/png');
    photo.setAttribute('src', window.data);
  }

  startbutton.addEventListener('click', function(ev){
    if(window.error == 0){
      takepicture();
      window.taken = 1;
    }
    ev.preventDefault();
  }, false);



}//Fin del function
