$(function () {
    $('#cadastro').on('submit', function (e) {
        e.preventDefault();

        var email = $('#email').val().trim();
        var login = $('#login').val().trim();
        var senha = $('#senha').val().trim();

        if (email == '') {
            alert('Email vazio');
        } else if (email.length < 5 || email.length > 100) {
            alert('O email deve conter entre 5 e 100 caracteres');
        } else if (login == '') {
            alert('Login vazio');
        } else if (login.length < 5 || login.length > 20) {
            alert('O login deve conter entre 5 e 20 caracteres');
        } else if (senha == '') {
            alert('Senha vazia');
        } else if (senha.length < 5 || senha.length > 50) {
            alert('A senha deve conter entre 5 e 50 caracteres');
        } else {
            $('#cadastro')[0].submit();
            return true;
        }
        return false;
    });
});

$(function verificarSenha() {
    var s1 = document.getElementById("senha").value;
    var s2 = document.getElementById("confirmarsenha").value;

    alert('teste');
    if (s1 != s2) {
        var msg = document.getElementById("mensagem");
        msg.innerHTML = "As senhas não conferem";
        msg.className = "alert alert-danger";
        return false;
    }
    return true;
});

