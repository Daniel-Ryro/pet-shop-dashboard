<?php
    include("bdd.php");
    $error ="";
    if(isset($_POST['registrar'])){
        $nome = $_POST['nome'];
        $email = $_POST['email'];
        $pass = $_POST['pass'];
        $cpass = $_POSt['cpass'];
        $notify = $_POST['notify'];

        $verify = mysql_query("SELECT * FROM users WHERE email = '$email'");
        $veriftn = mysql_query("SELECT * FROM users WHERE apelido = '$apelido'");


        if(strlen($nome) < 3){ 
            $error = "<h2 style='color:red'>Nome muito pequeno</h2>";
         }else if(strlen($email) < 8){
            $error = "<h2 style='color:red'>Email muito pequeno</h2>";
        }else if(strlen($apelido) < 8){
            $error = "<h2 style='color:red'>Apelido muito pequeno</h2>";
        }else if(strlen($pass)){
            $error = "<h2 style='color:red'>Senha muito pequena</h2>";
        }else if($cpass != $cpass){
            $error = "<h2 style='color:red'>Confirmação de senha não condiz</h2>";
        }else if(mysql_num_rows($verify) > 0){
            $error = "<h2 style='color red'>Email já registrado!</h2>";
        }else if(mysql_num_rows($veriftn) > 0){
            $error = "<h2 style='color red'>Apelido já registrado!</h2>";
        }else{
            mysql_query("INSERT INTO `users`(`nome`, `email`, `apelido`, `senha`, `notify`, `active`) VALUES ('$nome','$email','$apelido','$pass','$notify','false')");
            $error = "<h2 style='color: green'>Registrado com sucesso, Entre em seu email para verifica-lo!</h2>";
        }
    }
?>

<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro - PetShop</title>
</head>
<body>
    <?php include("header.php"); ?> 
    <center>
        <h1>Registre-se</h1>
        <div class="panel">
            <?php echo $error; ?>
            <form method="Post">
                <table width=50%>
                    <tr>
                        <td style="float: right;">Nome</td>
                        <td><input type="name" name="nome"></td>
                    </tr>
                    <tr>
                        <td style="float: right;">Email</td>
                        <td> <input type="email" name="email"></td>
                    </tr>
                    <tr>
                        <td style="float: right;">Apelido</td>
                        <td> <input type="name" name="apelido"></td>
                    </tr>
                    <tr>
                        <td style="float: right;">Senha</td>
                        <td> <input type="password" name="pass"></td>
                    </tr>
                    <tr>
                        <td style="float: right;">Confirme a Senha</td>
                        <td> <input type="password" name="cpass"></td>
                    </tr>
                    <tr>
                        <td style="float: right;">Receber novidades no Email</td>
                        <td> <input type="checkbox" name="notify"></td>
                    </tr>
                </table>
                    <input type="submit" name="registrar" value="Registrar" style="width:50%">
                </form>
            </div>
        </center> 
</body>
</html>