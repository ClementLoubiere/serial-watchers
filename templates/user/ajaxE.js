$(document).ready(function (e) { //je prend mon bouton
    //2-/j'associe ma div action a mon event click
    e.preventDefault();

//     $('#action').click(function(e) { //equivalent document.getElementById('submit').addEventListener('click', function(e)
//         e.preventDefault();
//         //3-dans laquelle j'effectue un envoie ajax
// console.log("j'affiche bien dans le formulaire")

    // let url = "http://api.themoviedb.org/";
    // let key = 'f9966f8cc78884142eed6c6d4710717a';
    //
    // $.ajax({
    //     type: 'GET',
    //     url: url + key,
    //     jsonCallback: 'testing',
    //     contentType: 'application/json',
    //     dataType: 'jsonp',
    //     success: function (json) {
    //         console.dir(json);
//     //
//     //     }
//     // });
//     //
//     // //4
//     // goAjax();
//
//
//     var settings = {
//         "async": true,
//         "crossDomain": true,
//         "url": "https://api.themoviedb.org/3/tv/%7Btv_id%7D/season/%7Bseason_number%7D/episode/%7Bepisode_number%7D?language=en-US&api_key=%3C%3Capi_key%3E%3E",
//         "method": "GET",
//         "headers": {},
//         "data": "{}"
//     }
//
//     $.ajax(settings).done(function (response) {
//         console.log(response);
//     });
//
// });
//
//
//
//
//
//


    function goAjax() {
        alert('hello');
        //6 je récupere ce qui est saisi dans le nom et je récupere ce qui est saisi dans le prenom


        nom = $("#nom").val();
        prenom = $("#prenom").val();
        //7 je définie mes parametres:
        parameters = 'nom=' + nom + '&prenom=' + prenom;
        //8 $.post(destination, parametres, function(retour){}, format); il s'agit de la syntaxe:
        $.post('ajax.php', parameters, function (data) { //function(data) j'aurai directement accés aux données que j'ai appelée 'retour'
            //9
            $('#resultat').html(data.retour); //j'associe la donnée collecté à au donnée de ma table

        }, 'json');

    }


})
; //fin du document ready
