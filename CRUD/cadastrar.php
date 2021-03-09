<?php

$conn = mysqli_connect('localhost', 'root', '', 'crud');
if (mysqli_connect_errno()) {
    die('Não foi possível se conectar com o banco de dados: ' . mysqli_connect_error());
}

$msg = array();

try 
{
    if ($_POST)
    {
        // PHP 8 = Aceita expressões throw num operador ternário / binário
        // FILTER_FLAG_NO_ENCODE_QUOTES muda o comportamento do filtro FILTER_SANITIZE_STRING
        // Aplica tudo o que está no FILTER_SANITIZE_STRING menos a codificação de QUOTES (aspas)
        $nome = filter_var($_POST['nome'], FILTER_SANITIZE_STRING, FILTER_FLAG_NO_ENCODE_QUOTES) ?: throw new Exception('Por favor, preencha o campo Nome!');
        $email = filter_var($_POST['email'], FILTER_VALIDATE_EMAIL) ?: throw new Exception('E-mail inválido!');
        // Considera 1 se o dado foi enviado e 0 caso contrário
        $status = isset($_POST['status']) ? 1 : 0;

        //var_dump($nome); - Remover o FILTER_FLAG_NO_ENCODE_QUOTES
        //exit;

        // mysqli_real_escape_string() trata (coloca o escape nas aspas) todas as aspas dentro da string para não dar problema na instrução sql
        // Se remover o mysqli_real_escape_string(), entende que o apostrofo do nome fecha/encerra a consulta sql
        // É recomendado usar o mysqli_real_escape_string() com todas as strings mesmo quando não esperamos aspas
        $nome = mysqli_real_escape_string($conn, $nome);
        $email = mysqli_real_escape_string($conn, $email);
        $sql = "INSERT INTO clientes (nome, email, status) VALUES('$nome', '$email', $status)";

        //print $sql;

        $resultado = mysqli_query($conn, $sql);

        // mysqli_errno() retorna o número do erro da operação (SELECT, INSERT, UPDATE e DELETE) executada dentro do banco de dados
        if ($resultado === false || mysqli_errno($conn)) {
            throw new Exception('Erro ao realizar operação no banco de dados: ' . mysqli_error($conn));
        }

        // operação de inserção na base
        $msg = array(
            'classe' => 'alert-success',
            'mensagem' => 'Cliente cadastrado com sucesso!'
        );
    }
}
catch(Exception $ex)
{
    $msg = array(
        'classe' => 'alert-danger',
        'mensagem' => $ex->getMessage()
    );
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <title>Clientes | Cadastro</title>
</head>

<body>

    <div class="container py-5">
        <h1>
            Clientes
            <a href="listagem.php" class="btn btn-success float-right">Listagem</a>
        </h1>
        <p>Use o formulário abaixo para cadastrar um cliente:</p>

        <!-- Se tiver alguma msg de erro para ser exibida -->
        <?php if ($msg) : ?>
            <div class="alert <?= $msg['classe'] ?>">
                <?= $msg['mensagem']; ?>
            </div>
        <?php endif; ?>

        <form method="POST">
            <div class="form-group">
                <!-- O atributo for é usado em labels. Refere-se ao id do elemento ao qual este label está associado. -->
                <label for="nome">Nome:</label>
                <input type="text" name="nome" id="nome" class="form-control" value="<?= $_POST['nome'] ?? '' ?>">
            </div>
            <div class="form-group">
                <label for="email">E-mail:</label>
                <input type="email" name="email" id="email" class="form-control" value="<?= $_POST['email'] ?? '' ?>">
            </div>
            <div class="form-group">
                <label for="status">Status:</label> <br>
                <input type="checkbox" name="status" id="status" checked /> Ativo
            </div>
            <div class="form-group">
                <button type="submit" class="btn btn-primary">
                    Cadastrar
                </button>
            </div>
        </form>
    </div>

</body>

</html>