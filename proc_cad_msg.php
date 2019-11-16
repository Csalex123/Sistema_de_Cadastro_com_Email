<?php
session_start();
include_once 'conexao.php';
// require_once 'vendor/autoload.php';

//Verificar se o usuário clicou no botão, clicou no botão acessa o IF e tenta cadastrar, caso contrario acessa o ELSE
// $SendCadCont = filter_input(INPUT_POST, 'SendCadCont', FILTER_SANITIZE_STRING);

if (isset($_POST['nome']) && isset($_POST['email']) && isset($_POST['assunto']) && isset($_POST['mensagem'])) {

    //Receber os dados do formulário
    $nome = addslashes($_POST['nome']); /*$_REQUEST  p/ ajax */
    $email = addslashes($_POST['email']);
    $assunto = addslashes($_POST['assunto']);
    $mensagem = addslashes($_POST['mensagem']);

    //Inserir no BD
    $result_msg_cont = "INSERT INTO mensagem_contato (nome, email, assunto, mensagem) VALUES (:nome, :email, :assunto, :mensagem)";

    $insert_msg_cont = $conn->prepare($result_msg_cont);
    $insert_msg_cont->bindParam(':nome', $nome);
    $insert_msg_cont->bindParam(':email', $email);
    $insert_msg_cont->bindParam(':assunto', $assunto);
    $insert_msg_cont->bindParam(':mensagem', $mensagem);

    if ($insert_msg_cont->execute()) {

        /* SUCESSO */
        // $_SESSION['msg'] = "<p style='color:green;'>Mensagem enviada com sucesso</p>";
        // header("Location: index.php"); /* REDIRECIONAR PARA ESSA PÁGINA */

         if (isset($_POST['email']) && !empty($_POST['email'])){
            $to = "cslt436@gmail.com";
            $subject = "Contato - Formulário";
            $body = "Olá Alex Ricardo, "."\r\n".
            "Você tem uma nova mensagem de contato"."\r\n".
            "Nome:$nome"."\r\n".
            "Email: $email"."\r\n".
            "Mensagem: $mensagem";
            $header = "From: alex.ricardo1999@hotmail.com"."\r\n"."Reply-to:".$email."\e\n"."X=Mailer:PHP/".phpversion();

            if(mail($to,$subject,$body,$header)){
                 echo "funciou";
            }else{
                 echo "erro";
            }
         }

    } else {
        /* FALHA */
        $_SESSION['msg'] = "<p style='color:red;'>Mensagem não foi enviada com sucesso</p>";
        header("Location: index.php");
    }
} else {
    $_SESSION['msg'] = "<p style='color:red;'>Mensagem não foi enviada com sucesso</p>";
    header("Location: index.php");
}
