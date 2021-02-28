<?php

try{ 
     if($_POST){
          
          $nome = filter_var($_POST['nome'], FILTER_SANITIZE_STRING) ?: throw new Exception('Nome é obrigatório!');
          $idade = filter_var($_POST['idade'], FILTER_VALIDATE_INT) ?: throw new Exception('Idade inválida!');
          $escolaridade = filter_var($_POST['escolaridade'], FILTER_SANITIZE_STRING) ?: throw new Exception('Selecione um escolaridade!');
          $cargo = filter_var( $_POST['cargo'], FILTER_SANITIZE_STRING) ?: throw new Exception('Cargo é obrigatório');
          // Perguntando se a variável interesse existe e não é nula
          // Para o PHP inexistente ou nulo é a mesma coisa

          // Variável do tipo misto que pode ser um array ou do tipo String
          // Caso a variável interesse exista vai ser aplicado o tipo array, para a variável interesse
          // caso contrário será uma variável do tipo String
          $interesse = $_POST['interesse'] ?? throw new Exception('Selecione ao menos uma área de interesse!');
          $minicurriculo = filter_var($_POST['minicurriculo'], FILTER_SANITIZE_STRING) ?: throw new Exception('Minicurrículo é obrigatório!');

          if(is_array($interesse)){
               // Pega os valores desse array e une todos valores em uma únca String separando os valores por vírgula
               $interesse = join(', ', $interesse);
          }
     // Join concatena todos os valores de um array em apenas uma única String separada por vírgula 


          echo "
               <div class=\"alert alert-success\">
                    <strong>Nome:</strong> $nome <br>
                    <strong>Idade:</strong> $idade <br>
                    <strong>Escolaridade:</strong> $escolaridade <br>
                    <strong>Cargo:</strong> $cargo <br>
                    <strong>Nome:</strong> $interesse <br>
                    $minicurriculo
               </div>
          ";

     }
     
}
catch(Exception $exec){
     $mensagem = $exec->getMessage();
     echo "
         <div class=\"alert alert-danger\">
             $mensagem
         </div>
     ";
 }

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulário PHP</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
   

     <form class="container w-50" method="POST">
          
          <h1>Formulário</h1>

          <hr/>

          <fieldset class="form-group card">
               <h2 class="card-header">Dados pessoais</h2>
               <div class="card-body">
                    <div class="form-group">
                         <label for="nome">Nome:</label>
                         <input type="text" name="nome" class="form-control" id="nome"  value="<?= $_POST['nome'] ?? '' ?>"/>
                    </div>
                    <div class="form-group">
                         <label for="idade">Idade:</label>
                         <input type="text" name="idade" class="form-control" id="idade" value="<?= $_POST['idade'] ?? '' ?>"/>
                    </div>
               </div>
          </fieldset>
          
          <fieldset class="form-group card">
               <h2 class="card-header">Dados profissionais</h2>
               <div class="card-body">
                    <div class="form-group">
                         <label id="escolaridade">Escolaridade:</label>
                         <select name="escolaridade" id="escolaridade" class="custom-select">
                              <option value="">Selecione</option>
                              <option value="Ensino Médio">Ensino Médio</option>
                              <option value="Nível Técnico">Nível Técnico</option>
                              <option value="Nível Superior">Nível Superior</option>
                         </select>
                    </div>
                    <div class="form-group">
                         <label>Área de atuação</label> <br>
                         <label class="mr-3"><input type="radio" name="cargo" value="Gerência" checked> Gerência</label>
                         <label class="mr-3"><input type="radio" name="cargo" value="Financeiro" > Financeiro</label>
                         <label class="mr-3"><input type="radio" name="cargo" value="Recepção" > Recepção</label>
                         <label class="mr-3"><input type="radio" name="cargo" value="Administrativo" > Administrativo</label>
                         <label class="mr-3"><input type="radio" name="cargo" value="Jurídico" > Jurídico</label>
                    </div>
                    <div class="form-group">
                         <label>Áreas de Interesse</label> <br>
                         <label class="mr-3"><input type="checkbox" name="interesse[]" value="Computação" checked> Computação</label>
                         <label class="mr-3"><input type="checkbox" name="interesse[]" value="Biologia" > Biologia</label>
                         <label class="mr-3"><input type="checkbox" name="interesse[]" value="Meio Ambiente" > Meio Ambiente</label>
                         <label class="mr-3"><input type="checkbox" name="interesse[]" value="Engenharia" > Engenharia</label>
                         <label class="mr-3"><input type="checkbox" name="interesse[]" value="História" > História</label>
                    </div>
                    <div class="form-group">
                         <label for="minicurriculo">Mini-currículo:</label>
                         <textarea name="minicurriculo" id="minicurriculo" class="form-control"></textarea>
                    </div>
                    <div class="form-group">
                         <button class="btn btn-primary">
                              Enviar
                         </button>
                         <button class="btn btn-secondary" type="reset">
                              Limpar
                         </button>
                    </div>
               </div>
          </fieldset>
     </form>
</body>
</html>