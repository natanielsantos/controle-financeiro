/* global button, google */

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

//JS DO MODAL PARA EDITAR RECEITAS
$('#modal-edita-rec').on('show.bs.modal', function (event) {
    var button = $(event.relatedTarget);// Pega o evento do botao no modal
    var idEditaRec = button.data('recid');
    var editaTipo = button.data('rectipo');
    var editaValor = button.data('recvalor');
    var editaData = button.data('recdata');
    //var editaStatus = button.data('rec-status');

    var modal = $(this);

    modal.find('.modal-title').text('Receita: ' + editaTipo);
    modal.find('.modal-body input[name="tipo"]').val(editaTipo);
    modal.find('.modal-body input[name="valor"]').val(editaValor);
    modal.find('.modal-body input[name="data"]').val(editaData);
    //modal.find('.modal-body input').val(editaStatus);

    $("#formEditaRec").attr("action", '/editaReceita/id=' + idEditaRec);


});

//JS DO MODAL PARA EXCLUIR RECEITAS
$('#modal-exclui-rec').on('show.bs.modal', function (event) {
    var button = $(event.relatedTarget);
    var idExcluiRec = button.data('recid');
    var excluiTipo = button.data('rectipo');
    var excluiValor = button.data('recvalor');
    var excluiData = button.data('recdata');
    //var editaStatus = button.data('rec-status');

    var modal = $(this);

    modal.find('.modal-title').text('Receita: ' + excluiTipo);
    modal.find('.modal-body input[name="tipo"]').val(excluiTipo);
    modal.find('.modal-body input[name="valor"]').val(excluiValor);
    modal.find('.modal-body input[name="data"]').val(excluiData);
    //modal.find('.modal-body input').val(editaStatus);

    $("#formExcluiRec").attr("action", '/excluiReceita/' + idExcluiRec);

});

//JS DO MODAL PARA EDITAR DESPESAS
$('#modal-edita-desp').on('show.bs.modal', function (event) {
    var button = $(event.relatedTarget);
    var idEditaDesp = button.data('despid');
    var editaTipo = button.data('desptipo');
    var editaValor = button.data('despvalor');
    var editaData = button.data('despdata');
    var editaCategoria = button.data('categoria');
    var editaPagamento = button.data('pagamento');
    //var editaStatus = button.data('rec-status');

    var modal = $(this);

    modal.find('.modal-title').text('Despesa: ' + idEditaDesp);
    modal.find('.modal-body input[name="tipo"]').val(editaTipo);
    modal.find('.modal-body input[name="valor"]').val(editaValor);
    modal.find('.modal-body input[name="data"]').val(editaData);
    // modal.find('.modal-body select[name="categoria"]').val(editaCategoria);
    // modal.find('.modal-body select[name="pagamento"]').val(editaPagamento);
    //modal.find('.modal-body input').val(editaStatus);

    $("#formEditaDesp").attr("action", '/editaDespesa/' + idEditaDesp);

});

//JS DO MODAL PARA EXCLUIR DESPESAS
$('#modal-exclui-desp').on('show.bs.modal', function (event) {
    var button = $(event.relatedTarget);
    var idExcluiDesp = button.data('despid');
    var excluiTipo = button.data('desptipo');
    var excluiValor = button.data('despvalor');
    var excluiData = button.data('despdata');
    //var editaStatus = button.data('rec-status');

    var modal = $(this);

    modal.find('.modal-title').text('Despesa: ' + idExcluiDesp);
    modal.find('.modal-body input[name="tipo"]').val(excluiTipo);
    modal.find('.modal-body input[name="valor"]').val(excluiValor);
    modal.find('.modal-body input[name="data"]').val(excluiData);
    //modal.find('.modal-body input').val(editaStatus);

    $("#formExcluiDesp").attr("action", '/excluiDespesa/' + idExcluiDesp);
   
});



function filtra(id) {

    var mes = id;
    var ano = $('#ano').val(); // não usar o DOM
    var rota = mes + "&" + ano;

    $("#filtraRec").attr("action", '/receitasMesAno/' + rota);
    $("#filtraDesp").attr("action", '/despesasMesAno/' + rota);
    $("#filtraVisao").attr("action", '/visaoMesAno/' + rota);
}
;

var progressBar = $(".progress-bar");

setInterval(addProgress, 100);

function addProgress() {
    var width = progressBar.width() + 10;
    progressBar.width(width);

}




