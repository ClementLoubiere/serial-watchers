$(document).ready(function() { //je prend mon bouton
    //2-/j'associe ma div action a mon event click
//     $('#action').click(function(e) { //equivalent document.getElementById('submit').addEventListener('click', function(e)
//         e.preventDefault();
//         //3-dans laquelle j'effectue un envoie ajax
// console.log("j'affiche bien dans le formulaire")


        $.get({
            url: 'fichier.txt', //de ce fichier que je veux charger
            dataType: 'api', //avec ce type de données
            success: function(reponse) { //en cas de succes tu executes la fonction reponse
                $('#api').html(reponse);
            }
        });
    });

}); //fin du document ready
