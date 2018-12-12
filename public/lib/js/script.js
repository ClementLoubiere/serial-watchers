
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
    });

    $('.btn-addSerie').click(function (e) {
        $.ajax( "series?id=" + $(this).data("id") )
            .done(function( msg ) {
                alert( "success" + msg );
            })
            .fail(function() {
                alert( "error" );
            });
    });
});
