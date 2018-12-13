$(document).ready(function (){


    $("#refSerie").click(function (e) {
        e.preventDefault();
        let id = $(this).data('id');
        let parameters = {"id": id};

        $.post("/series",
            parameters,
            function (retour) {
                $(this).html(retour);
            }, 'json');
    });

    $('.btn-addSerie').on('click' , function(e) {
        e.preventDefault();

        /*$.ajax(
            "series?id=" + $(this).data('id') )
            .done(function () {
                alert('success');
            })
            .fail(function () {
                alert('error');
            });*/
        let id = $(this).data('id');

        $.ajax({
           url: "?id=" + id,
            dataType: 'json',
            success: function (res) {
               console.log(res);

            },
            fail: function (err) {
                console.log(err);
            }
        });



    });




}); // Fin du DOM