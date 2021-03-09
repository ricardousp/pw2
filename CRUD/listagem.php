<?php

// IMPORTANTE: Sempre validar as informações antes de passar para a instrução sql
// Exemplo de SQL Injection
//$nome = "Ricardo%' OR '%";
//$nome = "Ricardo%'; DROP TABLE clientes; #"; // # comenta tudo o que vem depois para não dar erro de sintax no sql.
//"SELECT * FROM clientes WHERE nome LIKE '%Ricardo%'; DROP TABLE clientes; #%'";

$conn = mysqli_connect('localhost', 'root', '', 'crud');
// Todas as operaçoes realizadas aqui utilizarão a codificação utf-8
mysqli_set_charset($conn, 'utf-8');
if(mysqli_connect_errno()){
    die('Não foi possível se conectar com o banco de dados: ' . mysqli_connect_error());
}


$msg = array();

$sql_busca = "SELECT * FROM clientes";

try 
{
    // Verifica se tem dados via GET e existi o dado excluir
    if ($_GET && isset($_GET['excluir'])){

        // Se usar apenas o $id = $_GET['excluir']; ocasiona falha de SQL Injection
        $id = filter_var($_GET['excluir'], FILTER_VALIDATE_INT);

        if($id === false){
            throw new Exception("ID inválido para exclusão");
        }

        // Exemplo de SQL Injection - $sql = "DELETE FROM clientes WHERE cliente_id = 2 OR 1 = 1";
        // Exemplo de SQL Injection - $sql = "DELETE FROM clientes WHERE cliente_id = 2; DROP TABLE clientes; se for um usuário com permissão de root";
        $sql = "DELETE FROM clientes WHERE cliente_id = $id";
        $resultado = mysqli_query($conn, $sql);

        if ($resultado === false || mysqli_errno($conn)) {
            throw new Exception('Erro ao realizar a exclusão no banco de dados: ' . mysqli_error($conn));
        }

         // operação de exclusão na base
         $msg = array(
            'classe' => 'alert-success',
            'mensagem' => 'Cliente excluído com sucesso!'
        );
    }
    
    // Verifica se tem alguma informação dentro do GET e se está setado na url o parâmetro busca
    if ($_GET && isset($_GET['busca']))
    {
        $termo = filter_var($_GET['busca'], FILTER_SANITIZE_STRING, FILTER_FLAG_NO_ENCODE_QUOTES);
        if (!empty($termo)) {
            $sql_busca = "SELECT * FROM clientes WHERE nome LIKE '%$termo%'";
        }
    }
    
}
catch(Exception $ex)
{
    $msg = array(
        'classe' => 'alert-danger',
        'mensagem' => $ex->getMessage()
    );
}
finally {
    // A função mysqli_query() executa a query no banco a partir da conexão fornecida.
    $resultado = mysqli_query($conn, $sql_busca);
    // Se retornou algum dado na consulta
    if ($resultado) {
         // mysqli_fetch_all() pega todos os resultados e cria um array (matriz)
        // Cada resultado é um array associativo
        // MYSQLI_NUM é o padrão numérico
        $lista_clientes = mysqli_fetch_all($resultado, MYSQLI_ASSOC);
    }
}

// Se a estrutura da tabela mudar a posição dos indícies da matriz também mudará
// print '<pre>';
// print_r($lista_clientes);
// print '</pre>';

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <title>Clientes</title>
</head>
<body>

    <div class="container py-5">
        <h1>
            Clientes
            <a href="cadastrar.php" class="btn btn-success float-right">Cadastrar</a>
        </h1>
        <p>Veja na listagem abaixo os clientes cadastrados:</p>
        
        <!-- Se tiver alguma msg de erro para ser exibida -->
        <?php if ($msg) : ?>
            <div class="alert <?= $msg['classe'] ?>">
                <?= $msg['mensagem']; ?>
            </div>
        <?php endif; ?>

        <form method="GET">
            <div class="row">
                <div class="form-group col-md-10">
                    <input type="search" name="busca" class="form-control" value="<?= $termo ?? '' ?>" placeholder="Buscar cliente por nome" />
                </div>
                <div class="form-group col-md-2">
                    <button class="btn btn-primary w-100">
                        Buscar
                    </button>
                </div>
            </div>
        </form>

        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Id</th>
                    <th>Nome</th>
                    <th>E-mail</th>
                    <th>Status</th>
                    <th colspan="2"></th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($lista_clientes as $cliente) : ?>
                    <tr>
                        <td><?= $cliente['cliente_id'] ?></td>
                        <td><?= $cliente['nome'] ?></td>
                        <td><?= $cliente['email'] ?></td>
                        <td><?= ($cliente['status']) ? 'ATIVO' : 'INATIVO' ?></td>
                        <td>
                            <a href="editar.php?id=<?= $cliente['cliente_id'] ?>" class="btn btn-primary">Editar</a>
                        </td>
                        <td>
                            <a href="listagem.php?excluir=<?= $cliente['cliente_id'] ?>" class="btn btn-danger">Excluir</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</body>
</html>