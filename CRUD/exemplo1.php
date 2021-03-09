<?php

$conn = mysqli_connect('localhost', 'root', '', 'crud');
if(mysqli_connect_errno()){
    die('Não foi possível se conectar com o banco de dados: ' . mysqli_connect_error());
}


// A função mysqli_query() executa a query no banco a partir da conexão fornecida.
$resultado = mysqli_query($conn, "SELECT * FROM clientes");

// Se retornou algum dado na consulta
if($resultado){
    // mysqli_fetch_all() pega todos os resultados e cria um array (matriz)
    $lista_clientes = mysqli_fetch_all($resultado, MYSQLI_ASSOC);
}

// Se a estrutura da tabela mudar a posição dos indícies da matriz também mudará
print '<pre>';
print_r($lista_clientes);
print '</pre>';

print '<table border="1">
        <tr>
            <th>Id</th>
            <th>Nome</th>
            <th>E-mail</th>
            <th>Status</th>
        </tr>';

foreach($lista_clientes as $cliente){
    echo '<tr>';
    echo '<td>' . $cliente['cliente_id'] . '</td>';
    echo '<td>' . $cliente['nome'] . '</td>';
    echo '<td>' . $cliente['email'] . '</td>';
    echo '<td>' . $cliente['status'] . '</td>';
    echo '</tr>';
}

print '</table>';

?>