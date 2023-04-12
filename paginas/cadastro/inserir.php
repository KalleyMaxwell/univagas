<?php 
    include_once('../conexao.php');

    if (isset($_POST['submit'])) {

        
        $tipo_usuario = $_POST['tipo_usuario']; 


        if ($tipo_usuario == 'empresa') {
            //form empresa
            $nome_empresa = $_POST['nome_empresa']; 
            $email_empresa = $_POST['email_empresa']; 
            $senha_empresa = $_POST['senha_empresa'];
            $estado = $_POST['estado'];
            $cidade = $_POST['cidade'];


            // Criptografia da senha usando bcrypt
            $ajuste = [
                'cost' => 12, // ajuste de complexidade
            ];
            $senha_criptografada = password_hash($senha_empresa, PASSWORD_BCRYPT, $ajuste);

            // INSERIR BANCO DE DADOS
            $sql_insert = "INSERT INTO empresa (nome_empresa,email_empresa,senha_empresa,estado,cidade)
            VALUES ('$nome_empresa','$email_empresa','$senha_criptografada','$estado','$cidade')";
            $roda_sql = mysqli_query($conexao,$sql_insert);

            header('Location: carregando.html');

        } else if ($tipo_usuario == 'candidato') {
            //form candidato
            $nome_candidato = $_POST['nome_candidato']; 
            $email_candidato = $_POST['email_candidato']; 
            $senha_candidato = $_POST['senha_candidato'];
            $estado2 = $_POST['estado2'];
            $cidade2 = $_POST['cidade2'];
            $curso = $_POST['curso'];
            $matricula = $_POST['matricula'];


            // Criptografia da senha usando bcrypt
            $ajuste2 = [
                'cost' => 12, // ajuste de complexidade
            ];
            $senha_criptografada2 = password_hash($senha_candidato, PASSWORD_BCRYPT, $ajuste2);

            // INSERIR BANCO DE DADOS
            $sql_insert = "INSERT INTO candidato (matricula,curso,nome_candidato,email_candidato,senha_candidato,estado,cidade)
            VALUES ('$matricula','$curso','$nome_candidato','$email_candidato','$senha_criptografada2','$estado2','$cidade2')";
            $roda_sql = mysqli_query($conexao,$sql_insert);

            header('Location: carregando.html');
        }
    }

?>
