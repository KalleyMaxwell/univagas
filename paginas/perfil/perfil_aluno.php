<?php 
  include_once("../conexao.php");
  // Definir a validade do cookie da sessão para 1 dia
  session_set_cookie_params(86400);
  session_start();

  //verifica se o usuario está logado
  if (!$_SESSION['logged_in']) {

    // redirecionar o usuário para a página de login
    header("Location: ../login/login_aluno.php");

  }else{
    
    $id_sessao = $_SESSION['id_sessao'];
    $id_perfil = $_GET['id'];

    $stmt = $conexao->prepare(
      "SELECT * FROM aluno 
      WHERE id_aluno = ?"
    );
    $stmt->bind_param("s", $id_perfil);
    //executa a query
    $stmt->execute();
    // armazenamos o resultado em result 
    $result = $stmt->get_result();
    //
    $row = $result->fetch_assoc();
    //pegar dados do DB
    $nome_aluno = $row["nome_aluno"];
    $sobrenome_aluno = $row['sobrenome_aluno'];
    $id_curso = $row['curso'];
    $cidade = $row['cidade'];
    $estado = $row['estado'];
    $telefone = $row['telefone'];
    $email_contato = $row['email_contato'];
    $sobre = $row['sobre'];
    $id_aluno = $row['id_aluno'];
 

    //selecionar curso
    $sql_select_curso = "SELECT curso FROM cursos 
    WHERE id_curso = $id_curso";
    $result = mysqli_query($conexao, $sql_select_curso);
    $row = $result->fetch_assoc();

    $curso = $row['curso'];

    //selecionar social
    $sql_social = "SELECT * FROM social 
    WHERE id_aluno = $id_aluno";
    $result = mysqli_query($conexao, $sql_social);
    $row = $result->fetch_assoc();

    $exibicao_projeto = $row['exibicao_projeto'];
    $avaliacao = $row['avaliacao'];
    $seguidores = $row['seguidores'];
    $seguindo = $row['seguindo'];
  }

?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- CSS -->
    <link rel="stylesheet" type="text/css" href="../../css/perfil.css" media="screen"/>
    <link rel="stylesheet" type="text/css" href="../../css/normalize.css" media="screen"/>

    
    <!-- FONTES DAS LETRAS -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Raleway&display=swap" rel="stylesheet">
    <style> @import url('https://fonts.googleapis.com/css2?family=Raleway&display=swap'); </style>
    <link href="https://fonts.googleapis.com/css2?family=Raleway+Dots&display=swap" rel="stylesheet">

    <title>Perfil</title>
</head>
<body>
  <header>
    <!-- BARRA SUPERIOR DE NAVEGAÇAO -->
    <nav>
      <a href="#">
        <img src="../../imagens/logo2.png" class="logo-barra-superior">
      </a>
      <ul class="nav-links">
        <li>
          <a href="#" class="link-barra-superior">Link 1</a>
        </li>
        <li>
          <a href="#" class="link-barra-superior">Link 2</a>
        </li>
        <li>
          <a href="#" class="link-barra-superior">Link 3</a>
        </li>
        <li>
          <a href="#" class="link-barra-superior">Link 4</a>
        </li>
        <li>
          <a href="deslogar.php" class="link-barra-superior">Sair</a>
        </li>
      </ul>
      <div class="burger">
        <div class="line"></div>
        <div class="line"></div>
        <div class="line"></div>
      </div>
    </nav>


    <!-- FOTO DE CAPA E FOTO DE PERFIL -->
    <div class="foto-capa">
      <div class="foto-perfil"></div>
    </div>


    <div class="container-perfil">
      <div class="container-block"> 

        <!-- BARRA INFERIOR ESQUERDA, ONDE FICA OS DADOS PESSOAIS E OPÇÕES PARA EDITAR O PERFIL-->
        <div class="barra-esquerda-1">
          <br>
          <br>
          <br>
          <br>
          <h1 class="nome-user"> <?= $nome_aluno, ' ', $sobrenome_aluno; ?> </h1>
          <br>
          <h2 class="dados-user"> <?= $curso;?> </h2>
          <br>
          <h2 class="dados-user"> <?= $cidade, ' - ', $estado;?> </h2>
          <br>
          <a href="#">
            <input type="button" value="Editar Perfil" class="botao">
          </a>
          <br>
          <br>
          <a href="#">
            <input type="button" value="Mensagens" class="botao">
          </a>
          <br>
          <br>
          <a href="#">
            <input type="button" value="Currículo" class="botao">
          </a>
          <br>
          <br>
        </div>


        <!-- FOI NECESSARRIO DIVIDIR EM 2 DIVS POIS ESTAVA TENDO PROBLEMAS COM O MOZILLA FIREFOX -->
        <div class="barra-esquerda-2">
          <!-- REDES SOCIAIS, ONDE IRÁ APARECER SOMENTE SE O USUARIO JÁ TIVER COLOCADO NO PERFIL-->
          <ul class="lista-centralizada">
            <li>
              <h2 class="dados-user">Redes Sociais</h2>
            </li>
            <br>
            <li>
              <a href="#" class="link-redes-sociais">Facebook</a>
            </li>
            <li>
              <a href="#" class="link-redes-sociais">Instagram</a>
            </li>
            <li>
              <a href="#" class="link-redes-sociais">Linkedin</a>
            </li>
            <br>


            <!-- CONTATO -->
            <li>
              <h2 class="dados-user">Contato</h2>
            </li>
            <br>
            <li class="li-dados"> Email: <?= $email_contato; ?> </li>
            <li class="li-dados"> Telefone: <?= $telefone; ?> </li>
            <br>
            <li>
              <h2 class="dados-user">Sobre mim</h2>
            </li>
            <br>
            <li>
              <div class="sobre-mim"> <?= $sobre;?> </div>
            </li>
            <br>
            <li>
              <h2 class="dados-user">Exibições de projetos: <?= $exibicao_projeto ?> </h2>
            </li>
            <li>
              <h2 class="dados-user">Avaliações: <?= $avaliacao ?> </h2>
            </li>
            <li>
              <h2 class="dados-user">Seguidores: <?= $seguidores ?> </h2>
            </li>
            <li>
              <h2 class="dados-user">Seguindo: <?= $seguindo ?> </h2>
            </li>
          </ul>
          <br>
        </div>
      <!-- encerra o container-block -->  
      </div>
      <!-- PORTFÓLIO -->
      <div class="container-portfolio">

      </div>
    <!-- encerra o container-perfil -->  
    </div>
   <div class="rodape"></div>
  </header>
  <!-- script da barra superior de navegaçao no mobile -->
  <script src="../../js/side-bar.js"></script>
  <script>
    // Obtém a altura das barras esquerda 1, 2 e container-portfolio
    var alturaBarraEsquerda1 = parseInt(getComputedStyle(document.querySelector('.barra-esquerda-1')).height);
    var alturaBarraEsquerda2 = parseInt(getComputedStyle(document.querySelector('.barra-esquerda-2')).height);
    var container_portfolio = parseInt(getComputedStyle(document.querySelector('.container-portfolio')).height);
    // Soma as alturas das barras esquerda 1, 2 e container-portfolio
    var alturaTotal = alturaBarraEsquerda1 + alturaBarraEsquerda2;
    // Aplica a altura total à div espaco, para assim termos uma sombra completa, pois precisa dividir a barra em 3 por conta de incompatibilidade com o mozilla
    document.querySelector('.container-portfolio').style.height = alturaTotal + 'px';
  </script>
</body>
</html>