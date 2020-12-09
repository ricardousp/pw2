<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulário em PHP</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">    
</head>
<body>
    
    <form action="" class="container" method="POST">

        <div class="form-group">
            <label for="nome">Nome:</label>
            <input type="text" name="nome" id="nomeCompleto" class="form-control" value=""/>
        </div>
        <div class="form-group">
            <label for="email">E-mail</label>
            <input type="text" name="email" class="form-control" value=""/>
        </div>
        <div class="form-group">
            <label for="nome">Telefone Fixo</label>
            <input type="text" name="telefone" class="form-control" value=""/>
        </div>
        <div class="form-group">
            <label for="nome">Idade</label>
            <input type="text" name="idade" class="form-control" value=""/>
        </div>
        <div class="form-group">
            <label for="nome">Endereço</label>
            <input type="text" name="endereco" class="form-control" value=""/>
        </div>
        <div class="form-group">
            <button class="btn btn-primary">
                Enviar
            </button>
        </div>
    </form>

</body>
</html>