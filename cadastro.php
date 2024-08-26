<?php 
include 'conexao.php';

if ($_SERVER['REQUEST_METHOD']=='POST') {
    $nome = $_POST['nome'];
    $email = $_POST['email'];
    $senha = password_hash($_POST['senha'], PASSWORD_DEFAULT);

    $sql = "INSERT INTO usuarios (nome, email, senha) VALUES ('$nome','$email','$senha')";

    if (mysqli_query($conn,$sql)) {
        echo '<p class="echo">Cadastro realizado com sucesso <a href="index.php">Voltar para a página de login</a></p>';
    }else {
        echo "Erro:".$sql."<br>".mysqli_error($conn);
    }
}
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro</title>
    <link rel="stylesheet" href="css/style.css">
</head>

<body>
    <div class="cadastro-form">
        <form method="POST">
            Nome: <input type="text" name="nome" required><br><br>
            Email: <input type="email" name="email" required><br><br>
            Senha: <input type="password" name="senha" required><br><br>
            <input type="submit" value="Cadastrar">
        </form>
    </div>
</body>

</html>