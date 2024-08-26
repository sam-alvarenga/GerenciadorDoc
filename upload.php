<?php 
session_start();
include 'conexao.php';

if (!isset($_SESSION['usuario_id'])) {
    header("Location: index.php");
    exit;
}

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_FILES['image'])) {
    if ($_FILES['image']['error'] == UPLOAD_ERR_OK) {
        $usuario_id = $_SESSION['usuario_id'];
        $target_dir = "uploads/";
        $target_file = $target_dir . basename($_FILES["image"]["name"]);
        $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
        
        // Verificar se o arquivo é uma imagem
        $check = getimagesize($_FILES["image"]["tmp_name"]);
        if ($check !== false) {
            if (move_uploaded_file($_FILES["image"]["tmp_name"], $target_file)) {
                // Inserir o caminho do arquivo e ID do usuário no banco de dados
                $sql = "INSERT INTO uploads (usuario_id, file_path) VALUES ('$usuario_id', '$target_file')";
                if (mysqli_query($conn, $sql)) {
                    echo "<h2>O arquivo ". basename($_FILES["image"]["name"]). " foi enviado com sucesso</h2>";
                } else {
                    echo "<h2>Erro ao salvar o caminho no banco de dados</h2>";
                }
            } else {
                echo "<h2>Desculpe, houve um erro ao enviar o seu arquivo</h2>";
            }
        } else {
            echo "<h2>O arquivo não é uma imagem</h2>";
        }
    } else {
        echo "<h2>Erro no upload: " . $_FILES['image']['error'] . "</h2>";
    }
}
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta http-equiv="refresh" content="2;url=pagina_principal.php">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./css/style.css">
    <title>Upload de Imagem</title>
</head>
<body>
    <h2>Redirecionando para a galeria</h2>
</body>
</html>