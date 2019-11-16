<?php
session_start();
?>
<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <meta charset="UTF-8">
        <title>formulario de contato</title>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
        <script src="js/jquery.validate.min.js"></script> <!-- Importação do Jquery Validation -->
        <script src="js/localization/messages_pt_BR.js"></script> <!--  -->

        <script type="text/javascript">

            /* CADASTRO COM AJAX */

            // $(function(){
            //     $("#btn").click(function(){
            //     var nome = $("#nome").val();
            //        var email = $("#email").val();
            //        var assunto = $("#assunto").val();
            //        var mensagem = $("#mensagem").val();
            //        $.post('proc_cad_msg.php', {nome : nome, email : email, assunto : assunto, mensagem : mensagem}, function(retorno){
            //            if(retorno != null){
            //                 alert("Cadastrado!");
            //            }else{
            //                alert("resultado nulo");
            //            }
            //        });
            //     });
            // });


            /* Validação dos Campos com Jquery Validation */
            $(function(){
                $("#formulario").validate({
                    rules:{  // Regras de validação
                        nome: { /* referência pelo name da tag */
                            required: true,
                            maxlength: 100,
                            minlength: 2
                        },
                        email: {
                            required: true,
                            email: true

                        },
                        assunto: {
                            required: true,
                            maxlength: 150,
                            minlength: 1
                        },
                        mensagem: {
                            required: true,
                            minlength: 2,
                            maxlength: 1000
                        }
                    },
                    // submitHandler: function(form){
                    //     /* CADASTRO COM AJAX */
                    //     var nome = $("#nome").val();
                    //     var email = $("#email").val();
                    //     var assunto = $("#assunto").val();
                    //     var mensagem = $("#mensagem").val();
                    //     $.post('proc_cad_msg.php', {nome : nome, email : email, assunto : assunto, mensagem : mensagem}, function(retorno){
                    //         if(retorno != null){
                    //             alert("Cadastrado!");
                    //         }else{
                    //             alert("resultado nulo");
                    //         }
                    //     });
                    // }
                });
            });
        </script>
    </head>

    <body>
        <h1>Cadastrar Mensagem</h1>
        <?php
if (isset($_SESSION['msg'])) {
    echo $_SESSION['msg'];
    unset($_SESSION['msg']);
}
?>
        <form id="formulario" method="post" action="proc_cad_msg.php">
            <label>Nome: </label>
            <input type="text" name="nome" id="nome" placeholder="Inserir o nome completo"><br><br>

            <label>E-mail: </label>
            <input type="email" name="email" id="email" placeholder="Seu melhor e-mail"><br><br>

            <label>Assunto: </label>
            <input type="text" name="assunto" id="assunto" placeholder="Assunto da mensagem"><br><br>

            <label>Mensagem: </label>
            <textarea name="mensagem" id="mensagem" rows="3" cols="50"></textarea><br><br>

            <input name="SendCadCont"  type="submit"  value="Cadastrar">
        </form>
    </body>
</html>
