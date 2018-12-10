$(document).ready(function (){

    // appel ajax

    /*var settings = {
    "async": true,
        "crossDomain": true,
        "url": "https://api.themoviedb.org/3/tv/30675?language=en-US&api_key=f9966f8cc78884142eed6c6d4710717a",
        "method": "GET",
        "headers": {},
    "data": "{}"
}

$.ajax(settings).done(function (response) {
    console.log(response);
});*/

    $('#recherche').on('input', function (e) {
        e.preventDefault();
        // on test la validité du champ
        console.log('suis-je une champ ?');
        // on récupère la valeur du champ
        let research = $(this).val();
        // on transmet la variable dans le get
        let parameters = {'rechercher': research};

        // appel ajax
        $.post(
            '/user/test',
            parameters,
            function (retour) {
                $(this).html(retour);
            }
        , 'json');

    });




}); // Fin du DOM