$(document).ready(function(){
    $('#formNewHardware').on('submit', function(event){
        event.preventDefault();
        //RECEBE OS DADOS DO FORMULÁRIO
      var data =  $("#formNewHardware").serialize();
      $.post("")
    });
});