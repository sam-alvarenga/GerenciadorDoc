<?php
session_start();

include 'conexao.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = $_POST['email'];
    $senha = $_POST['senha'];

    $sql = "SELECT * FROM usuarios WHERE email='$email'";
    $result = mysqli_query($conn,$sql);
    
    if (mysqli_num_rows($result)>0) {
        $user = mysqli_fetch_assoc($result);

        if (password_verify($senha,$user['senha'])) {
            $_SESSION['usuario_id'] = $user['id'];
            $_SESSION['usuario_nome'] = $user['nome'];

            header("Location: pagina_principal.php");
            exit;
        }else {
            echo"Senha Incorreta";
        }
    }else {
        echo"Usuário não encontrado";
    }
}
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="./css/style.css">
</head>
<body>
    <div class="container">
       <!--  <img src="imgs/login.jpg" alt="Login Imagem"class="imglogin"> -->
        <form method="POST">
            Email: <input type="email" name="email" required><br><br>
            Senha: <input type="password" name="senha" required><br><br>
            <input type="submit" value="Entrar">
        </form>
        <a href="cadastro.php" class="cadastro-link">Fazer Cadastro</a>
    </div>
</body>
</html>