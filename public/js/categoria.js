//JS DO MODAL PARA EDITAR CATEGORIA
$('#modal-edita').on('show.bs.modal', function (event) {
    var button = $(event.relatedTarget);// Pega o evento do botao no modal
    var idEdita = button.data('editid'); // Pega o id da categoria
    var editaDescricao = button.data('editdescricao'); //  Pega a descrição
    var editaNome = button.data('editnome');// Pega o nome

    var modal = $(this);

    modal.find('.modal-title').text('Categoria: ' + editaNome);
    modal.find('.modal-body input').val(editaNome);
    modal.find('.modal-body textarea').val(editaDescricao);

    $("#formEdita").attr("action", '/editaCategoria/id=' + idEdita);

});

//JS DO MODAL PARA EXCLUIR CATEGORIA
$('#modal-exclui').on('show.bs.modal', function (event) {
    var button = $(event.relatedTarget);
    var idexclui = button.data('excidcategoria');
    var excluiDescricao = button.data('excdescricao');
    var excluiNome = button.data('excnome');

    var modal = $(this);

    modal.find('.modal-title').text('Categoria : ' + excluiNome);
    modal.find('.modal-body input').val(excluiNome);
    modal.find('.modal-body textarea').val(excluiDescricao);

    $("#formExclui").attr("action", '/excluiCategoria/id=' + idexclui);

});

//JS DO MODAL PARA EDITAR FORMA DE PAGAMENTO
$('#modal-edita-form').on('show.bs.modal', function (event) {
    var button = $(event.relatedTarget);// Pega o evento do botao no modal
    var idEdita = button.data('editid'); // Pega o id da categoria
    var editaDescricao = button.data('editdescricao'); //  Pega a descrição
    var editaNome = button.data('editnome');// Pega o nome

    var modal = $(this);

    modal.find('.modal-title').text('Pagamento: ' + editaNome);
    modal.find('.modal-body input').val(editaNome);
    modal.find('.modal-body textarea').val(editaDescricao);

    $("#formEdita").attr("action", '/editaPagamento/id=' + idEdita);

});

//JS DO MODAL PARA EXCLUIR FORMA DE PAGAMENTO
$('#modal-exclui-form').on('show.bs.modal', function (event) {
    var button = $(event.relatedTarget);
    var idexclui = button.data('excidcategoria');
    var excluiDescricao = button.data('excdescricao');
    var excluiNome = button.data('excnome');

    var modal = $(this);

    modal.find('.modal-title').text('Pagamento : ' + excluiNome);
    modal.find('.modal-body input').val(excluiNome);
    modal.find('.modal-body textarea').val(excluiDescricao);

    $("#formExclui").attr("action", '/excluiPagamento/id=' + idexclui);

});

var progressBar = $(".progress-bar");

setInterval(addProgress, 100);

function addProgress() {
  var width = progressBar.width() + 10;
  progressBar.width(width);
  
}
