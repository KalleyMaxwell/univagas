<?php 
// iniciar sessao e colocar conexao
include_once('../conexao.php');
session_start();

// a variavel abaixo usarei dentro do <h1></h1>, para exibir mensagens de senha incorreta e outras
$erro = 'Faça seu login no perfil de candidato!';
// candidato
if (isset($_POST['submit'])) {
    $email_candidato = $_POST['email_candidato'];
    $senha_candidato = $_POST['senha_candidato'];

    // Consulta o banco de dados para verificar se o email existe
    $consulta_senha = "SELECT senha_candidato FROM candidato WHERE email_candidato = '$email_candidato'";
    $consulta_senha_resultado = mysqli_query($conexao, $consulta_senha);
    $total_regitro = mysqli_num_rows($consulta_senha_resultado);

    if ($total_regitro > 0) {
        $senha_criptografada = mysqli_fetch_assoc($consulta_senha_resultado)['senha_candidato'];

        // verifica se a senha digitada bate com a senha criptografada no banco de dados
        if (password_verify($senha_candidato, $senha_criptografada)) {
            // Senha está correta
            $_SESSION['logged_in'] = true;

            //pegar o id para usar na sessao
            $select_id = "SELECT id_candidato FROM candidato WHERE email_candidato = '$email_candidato'";
            $id_candidato_resultado = mysqli_query($conexao, $select_id);
            $id_candidato = mysqli_fetch_assoc($id_candidato_resultado)['id_candidato'];

            // importante, usaremos isso em outras páginas quando logado
            $_SESSION['id_sessao'] = $id_candidato;

            header('Location: ../perfil/perfil_candidato.php?id='.$id_candidato.''); 
            exit;
        } else {
            // password_verify retornou falso
            $erro = 'ERRO! senha ou e-mail incorreto.';
        }
    } else {
        // se o total de registro NÃO for > 0, significa que ainda não foi cadastrado o email.
        $erro = 'E-mail não cadastrado.';
    }
}  
?>


<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- CSS -->
    <link rel="stylesheet" type="text/css" href="../../css/estilo.css" media="screen"/>

    
    <!-- FONTES DAS LETRAS -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Raleway&display=swap" rel="stylesheet">
    <style> @import url('https://fonts.googleapis.com/css2?family=Raleway&display=swap'); </style>
    <link href="https://fonts.googleapis.com/css2?family=Raleway+Dots&display=swap" rel="stylesheet">

    <title>Entrar</title>
</head>
<body>
    <!-- utili -->
<form action="<?=$_SERVER['PHP_SELF'];?>" method="POST">
    <div class="container-form-elements">
        <div class="body-form">
            <img src="../../imagens/logo.png" class="logo-login">

            <h1><?php echo $erro; ?></h1><br>
            <!-- Opções de formulário para o candidato -->
            <div id="candidato-form">
                <input type="text" class="input-text" name="email_candidato" placeholder="E-mail do candidato"><br><br>
                <input type="password" class="input-text" name="senha_candidato" placeholder="Senha"><br><br>
            </div>


            <!-- ENVIAR -->
            <input type="submit" name="submit" value="Entrar" id="submit1" class="submit1">
        </div>


        <!-- IMAGENS DE FUNDO -->
        <div class="body-text">
            <img src="../../imagens/candidato.png" class="imagem-fundo3">
        </div>

    </div>
</form>
</body>
</html>