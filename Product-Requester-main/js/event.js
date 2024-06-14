$(document).ready(function() {
    $("#buttonVote").on("click", function() {
        var selectedProduct = $("#product-select").val();

        // Atualiza imediatamente o valor dos votos
        var currentVotes = parseInt($("#product-votes").text());
        $("#product-votes").text(currentVotes + 1);

        // Envie uma requisição para adicionar um voto ao produto
        $.ajax({
            url: "PHP/addVote.php",
            type: "POST",
            data: {
                product: selectedProduct
            },
            dataType: "json",
            success: function(response) {
                // O voto foi adicionado com sucesso
                console.log("Voto adicionado com sucesso!");
                // Se necessário, você pode atualizar novamente o valor dos votos com a resposta do servidor
                // $("#product-votes").text(response.votes);
            },
            error: function(xhr, status, error) {
                // Ocorreu um erro ao adicionar o voto
                console.error("Erro ao adicionar o voto:", error);
            }
        });
    });
});

$(document).ready(function() {
    // Evento quando selecionar um produto
    $("#product-select").on("change", function() {
        var productName = $(this).val();

        if (productName === "add_product") {
            $("#add-product-card").show();
            $("#product-card").hide();
        } else {
            $("#add-product-card").hide();
            $("#product-card").show();
        }
    });
});

