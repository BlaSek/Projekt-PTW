$(document).ready(function() {
    $(".fav").on("click", function() {
        const img = $(this);
        $.post("changeFav.php", { idProjektu: img.data("projekt") }, function(data) {
            if (data == "sukces") {
                const newSrc = (img.attr("src") == "puste.png") ? "pelne.png" : "puste.png";
                img.attr("src", newSrc);
            } else {
                console.log("Błąd: " + data);
            }
        }).fail(function(xhr, status, error) {
            console.log("Błąd: " + xhr.responseText);
        });
    });
});
