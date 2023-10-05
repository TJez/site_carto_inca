// On ajoute les top 100, top 250, top 500
$("#selectProduit").append( "<option value='Top100'>Top100</option>");
$("#selectProduit").append( "<option value='Top250'>Top250</option>");
$("#selectProduit").append( "<option value='Top500'>Top500</option>");
$("#selectProduit").append( "<option value='Top1G'>1/1 000 000</option>");

// Carte régionale
$("#selectProduit").append( "<option value='regionale'>Carte régionale</option>");

// ajout du téléchargement par default
$(document).ready(function () {
    $("#lienTelechargement").click(function (e) {
        e.preventDefault();
        window.location.href = "../../PDF/PDF.7z";
    });
});

// Si le selecteur change
$("#selectProduit").on('change', function() {
    // affichage de la valeur
    console.log($(this).val())


    // attribution des liens de téléchargement :
    if ($('#selectProduit').val() == 'default') {
        $(document).ready(function () {
            $("#lienTelechargement").click(function (e) {
                e.preventDefault();
                window.location.href = "../../PDF/PDF.7z";
            });
        });
    }
    else if ($('#selectProduit').val() == 'top100') {
        $(document).ready(function () {
            $("#lienTelechargement").click(function (e) {
                e.preventDefault();
                window.location.href = "../../PDF/Modele-TOP100-vers-INCA-millésime_20210608.pdf";
            });
        });
    }
    else if ($('#selectProduit').val() == 'Top250') {
        $(document).ready(function () {
            $("#lienTelechargement").click(function (e) {
                e.preventDefault();
                window.location.href = "../../PDF/Modele-250K-vers-INCA-millésime_20210531.pdf";
            });
        });
    }
    else if ($('#selectProduit').val() == 'regionale') {
        $(document).ready(function () {
            $("#lienTelechargement").click(function (e) {
                e.preventDefault();
                window.location.href = "../../PDF/SP_Specifications-fonds-cartographique_Carte-Regionale.pdf";
            });
        });
    }})