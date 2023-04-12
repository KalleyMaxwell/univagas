<?php 
    //log para visualizar erros
    function log_de_erros(){
        error_reporting(E_ALL); // Error/Exception engine, always use E_ALL
    
        ini_set('ignore_repeated_errors', TRUE); // always use TRUE
        
        ini_set('display_errors', true); // Error/Exception display, use FALSE only in production environment or real server. Use TRUE in development environment
        
        ini_set('log_errors', TRUE); // Error/Exception file logging engine.
        ini_set('error_log', 'log_erros.log'); // Logging file path
    }  
    //invoco a funçao para registrar erros no meu txt
    //log_de_erros();

    $nome_host = "localhost";
    $usuario = "root";
    $senha = "";
    $nome_banco = "univagas";

    $conexao = new mysqli($nome_host, $usuario, $senha, $nome_banco);

    if($conexao->connect_errno) {
        die("Falha na conexão com o banco de dados");
    }else{
        //echo 'conectou';
    }

?>