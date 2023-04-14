<?php
include_once "../conexao.php";
$mensagem = "Escolha o seu tipo de usuário";
$cor = "#001b39;";
$bold = "normal;";

/*
verificar se os dados foram submetidos através do método POST 
antes de processar as informações do formulário. Isso garante 
que apenas as informações enviadas através do formulário serão 
processadas e ajuda a prevenir ataques maliciosos
*/
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    //empresa
    $nome_empresa = $_POST["nome_empresa"];
    $email_empresa = $_POST["email_empresa"];
    $senha_empresa = $_POST["senha_empresa"];
    $estado = $_POST["estado"];
    $cidade = $_POST["cidade"];

    //candidato
    $nome_candidato = $_POST["nome_candidato"];
    $email_candidato = $_POST["email_candidato"];
    $senha_candidato = $_POST["senha_candidato"];
    $estado2 = $_POST["estado2"];
    $cidade2 = $_POST["cidade2"];
    $curso = $_POST["curso"];
    $matricula = $_POST["matricula"];

    $tipo_usuario = $_POST["tipo_usuario"];

    if ($tipo_usuario == "empresa") {
        // Verifica se todos os campos foram preenchidos
        if (
            !empty($nome_empresa) &&
            !empty($email_empresa) &&
            !empty($senha_empresa) &&
            !empty($estado) &&
            !empty($cidade)
        ) {
            // 1º Verifica se o endereço de e-mail é válido
            if (filter_var($email_empresa, FILTER_VALIDATE_EMAIL)) {
                // 2º verifica se a senha é forte ou não
                if (
                    preg_match(
                        '/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*#?&])[A-Za-z\d@$!%*#?&]{8,}$/',$senha_empresa
                    )
                ) {
                    // Criptografia da senha usando bcrypt
                    $ajuste = [
                        "cost" => 12, // ajuste de complexidade
                    ];
                    $senha_criptografada = password_hash(
                        $senha_empresa,PASSWORD_BCRYPT,$ajuste
                    );

                    // INSERIR BANCO DE DADOS
                    $sql_insert = "INSERT INTO empresa (nome_empresa,email_empresa,senha_empresa,estado,cidade)
                    VALUES ('$nome_empresa','$email_empresa','$senha_criptografada','$estado','$cidade')";
                    $roda_sql = mysqli_query($conexao, $sql_insert);

                    header("Location: carregando.html");
                } else {
                    $cor = "red;";
                    $bold = "bold;";
                    $mensagem = "Sua senha é muito fraca. <br> Exemplo de senha forte: <br> Aabc@123"; // Exibe uma mensagem de erro
                }
            } else {
                $cor = "red;";
                $bold = "bold;";
                $mensagem = "Por favor, informe e-mail válido."; // Exibe uma mensagem de erro
            }
        } else {
            $cor = "red;";
            $bold = "bold;";
            $mensagem = "Por favor, preencha todos os campos."; // Exibe uma mensagem de erro
        }
    } elseif ($tipo_usuario == "candidato") {
        //formulario de envio do candidato

        // Verifica se todos os campos foram preenchidos
        if (
            !empty($nome_candidato) &&
            !empty($email_candidato) &&
            !empty($senha_candidato) &&
            !empty($estado2) &&
            !empty($cidade2) &&
            !empty($curso) &&
            !empty($matricula)
        ) {
            // 1º Verifica se o endereço de e-mail é válido
            if (filter_var($email_candidato, FILTER_VALIDATE_EMAIL)) {
                // 2º verifica se a senha é forte ou não
                if (
                    preg_match(
                        '/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*#?&])[A-Za-z\d@$!%*#?&]{8,}$/',
                        $senha_candidato
                    )
                ) {
                    //3º por ultimo, verificamos se a matricula está com somente números
                    if (is_numeric($matricula)) {
                        // Criptografia da senha usando bcrypt
                        $ajuste = [
                            "cost" => 12, // ajuste de complexidade
                        ];
                        // Criptografia da senha usando bcrypt
                        $ajuste2 = [
                            "cost" => 12, // ajuste de complexidade
                        ];
                        $senha_criptografada2 = password_hash(
                            $senha_candidato,
                            PASSWORD_BCRYPT,
                            $ajuste2
                        );

                        // INSERIR BANCO DE DADOS
                        $sql_insert = "INSERT INTO candidato (matricula,curso,nome_candidato,email_candidato,senha_candidato,estado,cidade)
                            VALUES ('$matricula','$curso','$nome_candidato','$email_candidato','$senha_criptografada2','$estado2','$cidade2')";
                        $roda_sql = mysqli_query($conexao, $sql_insert);

                        header("Location: carregando.html");
                    } else {
                        $cor = "red;";
                        $bold = "bold;";
                        $mensagem =
                            "Informe um número <br> de matrícula válido."; // Exibe uma mensagem de erro
                    }
                } else {
                    $cor = "red;";
                    $bold = "bold;";
                    $mensagem =
                        "Sua senha é muito fraca. <br> Exemplo de senha forte: <br> Aabc@123"; // Exibe uma mensagem de erro
                }
            } else {
                $cor = "red;";
                $bold = "bold;";
                $mensagem = "Por favor, informe um endereço de e-mail válido."; // Exibe uma mensagem de erro
            }
        } else {
            $cor = "red;";
            $bold = "bold;";
            $mensagem = "Por favor, preencha todos os campos."; // Exibe uma mensagem de erro
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

    
    <!-- FONTES DAS LETRAS -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Raleway&display=swap" rel="stylesheet">
    <style> @import url('https://fonts.googleapis.com/css2?family=Raleway&display=swap'); </style>
    <link href="https://fonts.googleapis.com/css2?family=Raleway+Dots&display=swap" rel="stylesheet">

    <title>Cadastro</title>
</head>
<body>
<form action="<?=$_SERVER['PHP_SELF'];?>" method="POST">
    <div class="container-form-elements">
        <div class="body-form">
            <img src="../../imagens/logo.png" class="logo">
            <div class="espaco"></div>

            <!-- TIPO DE PERFIL QUE MUDA O FORMULARIO DE ACORDO COM O QUE O USUARIO ESCOLHE-->
            <div class="container_tipo_usuario">
                <label for="tipo-usuario" class="label1" style="color: <?= $cor ?> font-weight: <?= $bold ?>;" ><?= $mensagem; ?></label><br><br>
                <select id="tipo-usuario"class="tipo-usuario" name="tipo_usuario">
                    <option value="candidato">Candidato</option>
                    <option value="empresa">Empresa</option>
                </select><br><br>
            </div>
            
            <!-- Opções de formulário para a empresa -->
            <div id="empresa-form">
                <input type="text" class="input-text" name="nome_empresa" placeholder="Nome da empresa"><br><br>
                <input type="text" class="input-text" name="email_empresa" placeholder="E-mail da empresa"><br><br>
                <input type="password" class="input-text" name="senha_empresa" placeholder="Senha"><br><br>


                <!-- SELECIONA O ESTADO-->
                <select id="estado" class="tipo-usuario" name="estado">
                    <option value="">Selecione um estado</option>
                    <option value="AC">Acre</option>
                    <option value="AL">Alagoas</option>
                    <option value="AP">Amapá</option>
                    <option value="AM">Amazonas</option>
                    <option value="BA">Bahia</option>
                    <option value="CE">Ceará</option>
                    <option value="DF">Distrito Federal</option>
                    <option value="ES">Espírito Santo</option>
                    <option value="GO">Goiás</option>
                    <option value="MA">Maranhão</option>
                    <option value="MT">Mato Grosso</option>
                    <option value="MS">Mato Grosso do Sul</option>
                    <option value="MG">Minas Gerais</option>
                    <option value="PA">Pará</option>
                    <option value="PB">Paraíba</option>
                    <option value="PR">Paraná</option>
                    <option value="PE">Pernambuco</option>
                    <option value="PI">Piauí</option>
                    <option value="RJ">Rio de Janeiro</option>
                    <option value="RN">Rio Grande do Norte</option>
                    <option value="RS">Rio Grande do Sul</option>
                    <option value="RO">Rondônia</option>
                    <option value="RR">Roraima</option>
                    <option value="SC">Santa Catarina</option>
                    <option value="SP">São Paulo</option>
                    <option value="SE">Sergipe</option>
                    <option value="TO">Tocantins</option>
                </select><br><br>


                <!-- SELECIONA A CIDADE-->
                <select id="cidade" class="tipo-usuario"  name="cidade">
                    <option value="">Selecione um estado primeiro</option>
                </select><br><br>


            </div>


            <!-- Opções de formulário para o candidato -->
            <div id="candidato-form">
                <input type="text" class="input-text" name="nome_candidato" placeholder="Nome do candidato"><br><br>
                <input type="text" class="input-text" name="matricula" placeholder="ID da Matricula do candidato"><br><br>
                <input type="text" class="input-text" name="email_candidato" placeholder="E-mail do candidato"><br><br>
                <input type="password" class="input-text" name="senha_candidato" placeholder="Senha"><br><br>
            

                <!-- SELECIONA O ESTADO-->
                <select id="estado2" class="tipo-usuario" name="estado2">
                    <option value="">Selecione um estado</option>
                    <option value="AC">Acre</option>
                    <option value="AL">Alagoas</option>
                    <option value="AP">Amapá</option>
                    <option value="AM">Amazonas</option>
                    <option value="BA">Bahia</option>
                    <option value="CE">Ceará</option>
                    <option value="DF">Distrito Federal</option>
                    <option value="ES">Espírito Santo</option>
                    <option value="GO">Goiás</option>
                    <option value="MA">Maranhão</option>
                    <option value="MT">Mato Grosso</option>
                    <option value="MS">Mato Grosso do Sul</option>
                    <option value="MG">Minas Gerais</option>
                    <option value="PA">Pará</option>
                    <option value="PB">Paraíba</option>
                    <option value="PR">Paraná</option>
                    <option value="PE">Pernambuco</option>
                    <option value="PI">Piauí</option>
                    <option value="RJ">Rio de Janeiro</option>
                    <option value="RN">Rio Grande do Norte</option>
                    <option value="RS">Rio Grande do Sul</option>
                    <option value="RO">Rondônia</option>
                    <option value="RR">Roraima</option>
                    <option value="SC">Santa Catarina</option>
                    <option value="SP">São Paulo</option>
                    <option value="SE">Sergipe</option>
                    <option value="TO">Tocantins</option>
                </select><br><br>


                <!-- SELECIONA A CIDADE-->
                <select id="cidade2" class="tipo-usuario" name="cidade2">
                    <option value="">Selecione um estado primeiro</option>
                </select><br><br>


                 <!-- SELECIONA O CURSO-->
                 <select id="curso" class="tipo-usuario" name="curso">
                    <option value="">Selecione o seu curso</option>
                    <option value="1">Administração</option>
                    <option value="2">Ciência da Computação</option>
                    <option value="3">Ciências Atmosféricas</option>
                    <option value="4">Ciências Biológicas Licenciatura</option>
                    <option value="5">Engenharia Ambiental</option>
                    <option value="6">Engenharia Civil</option>
                    <option value="7">Engenharia de Bioprocessos</option>
                    <option value="8">Engenharia de Computação</option>
                    <option value="9">Engenharia de Controle e Automação</option>
                    <option value="10">Engenharia de Energia</option>
                    <option value="11">Engenharia de Materiais</option>
                    <option value="12">Engenharia de Produção</option>
                    <option value="13">Engenharia Elétrica</option>
                    <option value="14">Engenharia Eletrônica</option>
                    <option value="15">Engenharia Hídrica</option>
                    <option value="16">Engenharia Mecânica</option>
                    <option value="17">Engenharia Mecânica Aeronáutica</option>
                    <option value="18">Engenharia Química</option>
                    <option value="19">Física Bacharelado</option>
                    <option value="20">Física Licenciatura</option>
                    <option value="21">Matemática Bacharelado</option>
                    <option value="22">Matemática Licenciatura</option>
                    <option value="23">Química Bacharelado</option>
                    <option value="24">Química Licenciatura</option>
                    <option value="25">Sistemas de Informação</option>
                </select><br><br>  
            </div>


            <!-- ENVIAR -->
            <input type="submit" name="submit" value="Cadastrar" id="submit1" class="submit1">
        </div>


        <!-- IMAGENS DE FUNDO -->
        <div class="body-text">
            <h2>Conectando talentos</h2>
            <h3>com oportunidades!</h3>
            <img src="../../imagens/emprego.png" class="imagem-fundo">
            <img src="../../imagens/emprego2.png" class="imagem-fundo2">
        </div>

    </div>
    <!-- JAVASCRIPT -->
    <script src="../../js/script.js"></script>
    
</form>
</body>
</html>