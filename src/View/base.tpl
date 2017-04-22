<!DOCTYPE html>

<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>{% block title %}{% endblock %}</title>

        <!-- Bootstrap -->
        <link href="css/bootstrap.min.css" rel="stylesheet" type="text/css"/>

    </head>
    <body>

        <nav class="navbar navbar-inverse">
            <div class="container-fluid">
                <div class="navbar-header">
                    <a class="navbar-brand" href="/">CONTROLE FINANCEIRO |</a>
                </div>
                <ul class="nav navbar-nav">
                    <li><a href="/categorias">Categorias de Custo</a></li>
                    <li class="dropdown">
                        <a class="dropdown-toggle" data-toggle="dropdown" href="#">Lançamentos
                            <span class="caret"></span></a>
                        <ul class="dropdown-menu">
                            <li><a href="#">Receitas</a></li>
                            <li><a href="#">Despesas</a></li>
                        </ul>
                    </li>
                    <li><a href="#">Extrato</a></li>
                    <li><a href="#">Gráfico</a></li>
                    <li><a href="#">Usuário</a></li>
                </ul>
                <ul class="nav navbar-nav navbar-right">
                    <li><a href="#"><span class="glyphicon glyphicon-user"></span> Registrar</a></li>
                    <li><a href="#"><span class="glyphicon glyphicon-log-in"></span> Entrar</a></li>
                </ul>
            </div>
        </nav>

        <div id="content">
            {% block body %}{% endblock %}
        </div>

        <div class="navbar navbar-inverse navbar-fixed-bottom" role="navigation">
            <div class="container">

                <div class="navbar-text pull-left">
                    <p > Sistema de Controle Financeiro - 2017</p>
                </div>
            </div>
            <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
            <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
            <!-- Include all compiled plugins (below), or include individual files as needed -->
            <script src="js/bootstrap.min.js"></script>
    </body>
</html>