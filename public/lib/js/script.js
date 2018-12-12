
$(document).ready(function(){

    $('#refSerie').click(function (e) {
        e.preventDefault();
        let id = $(this).data('id');
        let parameters = {'id' : id};

        $.post('/series',
            parameters,
            function(retour){
            $(this).html(retour);
            },'json');
    })
});