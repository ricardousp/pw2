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
        $id = filter_var($_POST['id'], FILTER_VALIDATE_INT, [
            'options' => array(
                'min_range' => 1
            )
        ]) ?: throw new Exception('ID informado é inválido!');
        $nome = filter_var($_POST['nome'], FILTER_SANITIZE_STRING, FILTER_FLAG_NO_ENCODE_QUOTES) ?: throw new Exception('Por favor, preencha o campo Nome!');
        $email = filter_var($_POST['email'], FILTER_VALIDATE_EMAIL) ?: throw new Exception('E-mail inválido!');
        $status = isset($_POST['status']) ? 1 : 0;

        $nome = mysqli_real_escape_string($conn, $nome);
        $email = mysqli_real_escape_string($conn, $email);

        // Faz o update onde o cliente_id = $id enviado pelo POST
        $sql = "UPDATE clientes SET nome = '$nome', email = '$email', status = $status WHERE cliente_id = $id";
        $resultado = mysqli_query($conn, $sql);

        if ($resultado === false || mysqli_errno($conn)) {
            throw new Exception('Erro ao realizar operação no banco de dados: ' . mysqli_error($conn));
        }

        // operação de inserção na base
        $msg = array(
            'classe' => 'alert-success',
            'mensagem' => 'Cliente atualizado com sucesso!'
        );
    }

    // Valida se é um id válido
    if (isset($_GET['id']) && !empty($_GET['id']) && is_numeric($_GET['id']))
    {
        $id = filter_var($_GET['id'], FILTER_VALIDATE_INT, [
            'options' => array(
                'min_range' => 1
            )
        ]);

        if ($id === false) {
            throw new Exception('ID fornecido é inválido!');
        }

        // Validou o ID agora rezaliza o SELECT
        // A consulta com clásula WHERE retorna nenhum ou apenas um único resultado
        $sql = "SELECT * FROM clientes WHERE cliente_id = $id";
        $resultado = mysqli_query($conn, $sql);

        if (!$resultado || mysqli_errno($conn)) {
            throw new Exception('Erro ao buscar informações na base de dados: ' . mysqli_error($conn));
        }

        // mysqli_fetch_assoc() transforma o resultado em um array associativo
        // Caso queira usar os indíces de forma numérica basta usar mysqli_fetch_array()
        $cliente = mysqli_fetch_assoc($resultado);
        if (!$cliente) {
            throw new Exception('Dados do cliente não foram encontrados!');
        }
    }
    else 
    {
        // Faz o redirecionamento para a página de listagem.php e caso não exista o id de um cliente para edição
        header('Location: listagem.php');
        // Encerra o processamento do PHP.
        exit;
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
    <title>Clientes | Edição</title>
</head>

<body>

    <div class="container py-5">
        <h1>
            Clientes
      
            <a href="listagem.php" class="btn btn-success float-right">Listagem</a>
        </h1>
        <p>Use o formulário abaixo para atualizar um cliente:</p>

        <?php if ($msg) : ?>
            <div class="alert <?= $msg['classe'] ?>">
                <?= $msg['mensagem']; ?>
            </div>
        <?php endif; ?>

        <form method="POST">
            <div class="form-group">
                <label for="">ID:</label>
                <input type="text" name="id" class="form-control" readonly value="<?= $cliente['cliente_id'] ?? '' ?>">
            </div>
            <div class="form-group">
                <label for="">Nome:</label>
                <input type="text" name="nome" class="form-control" value="<?= $cliente['nome'] ?? '' ?>">
            </div>
            <div class="form-group">
                <label for="">E-mail:</label>
                <input type="email" name="email" class="form-control" value="<?= $cliente['email'] ?? '' ?>">
            </div>
            <div class="form-group">
                <label for="">Status:</label> <br>
                <input type="checkbox" name="status" <?= (isset($cliente['status']) && $cliente['status'] == 1) ? 'checked' : '' ?> /> Ativo
            </div>
            <div class="form-group">
                <button type="submit" class="btn btn-primary">
                    Atualizar
                </button>
            </div>
        </form>
    </div>

</body>

</html>