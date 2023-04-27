<?php
// iniciar sessao e colocar conexao
include_once("../conexao.php");
// Definir a validade do cookie da sessão para 1 dia
session_set_cookie_params(86400);
session_start();

// a variavel abaixo usarei dentro do <h1></h1>, para exibir mensagens de senha incorreta e outras
$erro = "Faça seu login no perfil de aluno!";

// empresa
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    /* 
    trim é uma função para remover espaços em brancos.
    Essa função é para evitar que um usuário 
    acidentalmente insira espaços em branco antes ou depois 
    do endereço de e-mail, o que poderia impedir a autenticação
    correta do usuário.
    */
    $email_aluno = trim($_POST["email_aluno"]);
    $senha_aluno = trim($_POST["senha_aluno"]);

    // Verifica se os campos não estão vazios
    if (empty($email_aluno) && empty($senha_aluno)) {
        $erro = "ERRO! Preencha todos os campos.";
    } else {
        // Consulta o banco de dados para verificar se o email existe

        /*o bloco de código abaixo faz o mesmos que:
        $sql_select = "query select";
        $result = mysqliquery($conexao, $sql_select);
        porém faz isso, de uma forma mais segura*/


        // o código abaixo cria prepara a query e cria um marcador de posição para o email_aluno, "?". 
        $stmt = $conexao->prepare("SELECT id_aluno, senha_aluno FROM aluno WHERE email_aluno = ?");
        // o código abaixo associa o marcador de posição do código acima, a variavel de email.
        // usamos "s" para mostrar que é uma string
        $stmt->bind_param("s", $email_aluno);
        // o código abaixo, executa a query e faz a consulta
        $stmt->execute();
        // armazenamos o resultado em result 
        $result = $stmt->get_result();
        //se o numero de resultados for 1, blz, existe esse cadastro
        if ($result->num_rows === 1) {
            $row = $result->fetch_assoc();

            // verifica se a senha digitada bate com a senha criptografada no banco de dados
            if (password_verify($senha_aluno, $row["senha_aluno"])) {
                // Senha está correta
                $_SESSION["logged_in"] = true;

                //pegar o id para usar na sessao
                $id_aluno = $row["id_aluno"];

                // importante, usaremos isso em outras páginas quando logado
                $_SESSION["id_sessao"] = $id_aluno;

                header(
                    "Location: ../perfil/perfil_aluno.php?id=" . $id_aluno
                );
                exit();
            } else {
                // password_verify retornou falso
                $erro = "ERRO! Senha incorreta.";
            }
        } else {
            // Se o total de registro for diferente de 1, significa que o email não está cadastrado ou tem mais de um registro com o mesmo email
            $erro = "ERRO! E-mail não cadastrado.";
        }
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
    <link rel="stylesheet" type="text/css" href="../../css/normalize.css" media="screen"/>

    
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

            <h1 class="h1-textos"><?php echo $erro; ?></h1><br>
            <!-- Opções de formulário para o aluno -->
            <div id="aluno-form">
                <input type="text" class="input-text" name="email_aluno" placeholder="E-mail do aluno"><br><br>
                <input type="password" class="input-text" name="senha_aluno" placeholder="Senha"><br><br>
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