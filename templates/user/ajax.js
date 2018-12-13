$(document).ready(function () { //je prend mon bouton
    //2-/j'associe ma div action a mon event click


//     $('#action').click(function(e) { //equivalent document.getElementById('submit').addEventListener('click', function(e)
//         e.preventDefault();
//         //3-dans laquelle j'effectue un envoie ajax
// console.log("j'affiche bien dans le formulaire")

    let url = "http://api.themoviedb.org/";
    let key = 'f9966f8cc78884142eed6c6d4710717a';

    $.ajax({
        type: 'GET',
        url: url + key,
        jsonCallback: 'testing',
        contentType: 'application/json',
        dataType: 'jsonp',
        success: function (json) {
            console.dir(json);
        }

});


})
; //fin du document ready
