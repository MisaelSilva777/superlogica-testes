<?php
/**
 * View of the user form.
 */
?>

<h1 class="text-center mt-5">Formulário SuperLógica</h1>
<div class="container d-flex justify-content-center mt-5">

    <form method="post" class="register-user">

        <div class="form-group">
            <label for="name">Nome completo:</label>
            <input type="text" id="name" name="name" class="form-control">
        </div>

        <div class="form-group">
            <label for="userName">Nome de login:</label>
            <input type="text" id="userName" name="username" class="form-control" >
        </div>

        <div class="form-group">
            <label for="zipCode">CEP</label>
            <input type="text" id="zipCode" name="zipcode" class="form-control" >
        </div>

        <div class="form-group">
            <label for="email">Email:</label>
            <input type="text" id="email" name="email" class="form-control" >
        </div>

        <div class="form-group">
            <label for="password">
                Senha (8 caracteres mínimo, contendo pelo menos 1 letra e 1 número):
            </label>
            <input type="password" id="password" name="password" class="form-control" >
        </div>

        <input type="submit" value="Cadastrar" class="btn btn-primary mt-3">

    </form>

</div>

<h4 class="text-center mt-5">Usuários já cadastrados</h4>
<div class="container d-flex justify-content-center my-5">
    <table class='table table-users col-6'>
        <thead>
            <tr>
            <th scope='col'>#</th>
            <th scope='col'>Nome</th>
            <th scope='col'>Usuário</th>
            <th scope='col'>CEP</th>
            <th scope='col'>e-mail</th>
            </tr>
        </thead>
        <tbody>
           
        </tbody>
    </table>
</div>