//JS DO MODAL PARA EDITAR CATEGORIA
$('#modal-edita').on('show.bs.modal', function (event) {
    var button = $(event.relatedTarget);// Button that triggered the modal
    var idEdita = button.data('editid');
    var editaDescricao = button.data('editdescricao');
    var editaNome = button.data('editnome');// Extract info from data-* attributes
    // If necessary, you could initiate an AJAX request here (and then do the updating in a callback).
    // Update the modal's content. We'll use jQuery here, but you could use a data binding library or other methods instead.
    var modal = $(this);

    $("#formEdita").attr("action", '/editaCategoria/id=' + idEdita);

    modal.find('.modal-title').text('Categoria: ' + editaNome);
    modal.find('.modal-body input').val(editaNome);
    modal.find('.modal-body textarea').val(editaDescricao);

});

//JS DO MODAL PARA EXCLUIR CATEGORIA
$('#modal-exclui').on('show.bs.modal', function (event) {
    var button = $(event.relatedTarget);// Button that triggered the modal
    var idexclui = button.data('excidcategoria');
    var excluiDescricao = button.data('excdescricao');
    var excluiNome = button.data('excnome');// Extract info from data-* attributes
    // If necessary, you could initiate an AJAX request here (and then do the updating in a callback).
    // Update the modal's content. We'll use jQuery here, but you could use a data binding library or other methods instead.
    var modal = $(this);
    modal.find('.modal-title').text('Categoria : ' + excluiNome);
    modal.find('.modal-body input').val(excluiNome);
    modal.find('.modal-body textarea').val(excluiDescricao);
    
    $("#formExclui").attr("action", '/excluiCategoria/id=' + idexclui);
});

