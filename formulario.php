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
                         <input type="text" name="nome" class="form-control" id="nome">
                    </div>
                    <div class="form-group">
                         <label for="idade">Idade:</label>
                         <input type="text" name="idade" class="form-control" id="idade">
                    </div>
               </div>
          </fieldset>
          
          <fieldset class="form-group card">
               <h2 class="card-header">Dados profissionais</h2>
               <div class="card-body">
                    <div class="form-group">
                         <label id="escolaridade">Escolaridade:</label>
                         <select name="escolaridade" id="escolaridade" class="custom-select">
                              <option value="em">Ensino Médio</option>
                              <option value="nt">Nível Técnico</option>
                              <option value="ns">Nível Superior</option>
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
                         <label class="mr-3"><input type="radio" name="interesse" value="Computação" checked> Computação</label>
                         <label class="mr-3"><input type="radio" name="interesse" value="Biologia" > Biologia</label>
                         <label class="mr-3"><input type="radio" name="interesse" value="Meio Ambiente" > Meio Ambiente</label>
                         <label class="mr-3"><input type="radio" name="interesse" value="Engenharia" > Engenharia</label>
                         <label class="mr-3"><input type="radio" name="interesse" value="História" > História</label>
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