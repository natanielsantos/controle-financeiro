
{% extends 'base.tpl' %}

{% block title %}{{titulo}}{% endblock %}

{% block body %}
<div class="container">
  <h3>GERENCIAR CATEGORIAS</h3>
 <div class="alert alert-info alert-dismissable fade in ">
     <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
  <strong>Importante!</strong> Os gráficos são gerados com base nas categorias.
</div>       
  <table class="table table-hover">
    <thead class="thead-inverse">
      <tr>
        <th>Firstname</th>
        <th>Lastname</th>
        <th>Email</th>
      </tr>
    </thead>
    <tbody>
      <tr>
        <td>John</td>
        <td>Doe</td>
        <td>john@example.com</td>
      </tr>
      <tr>
        <td>Mary</td>
        <td>Moe</td>
        <td>mary@example.com</td>
      </tr>
      <tr>
        <td>July</td>
        <td>Dooley</td>
        <td>july@example.com</td>
      </tr>
    </tbody>
  </table>
</div>
{% endblock %}


