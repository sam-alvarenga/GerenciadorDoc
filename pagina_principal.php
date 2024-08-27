<?php
session_start();
include 'conexao.php';

if (!isset($_SESSION['usuario_id'])) {
    header("Location: index.php");
    exit;
}

$usuario_id = $_SESSION['usuario_id'];

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_FILES['image'])) {
    $file = $_FILES['image'];
    $file_path = 'uploads/' . basename($file['name']);

    if (move_uploaded_file($file['tmp_name'], $file_path)) {
        $sql = "INSERT INTO uploads (usuario_id, file_path) VALUES ('$usuario_id', '$file_path')";
        mysqli_query($conn, $sql);
    }
    header("Location: pagina_principal.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Painel</title>
    <link rel="stylesheet" href="./css/style.css">
</head>
<body>
    <h1>Bem-vindo, <?php echo htmlspecialchars($_SESSION['usuario_nome']); ?>!</h1>
    <h1>Sua Galeria de Imagens</h1>
    <form action="upload.php" method="POST" enctype="multipart/form-data">
        <input type="file" name="image" accept="image/*">
        <button type="submit">Enviar Imagem</button>
    </form>
    <div class="gallery">
        <?php 
            $sql = "SELECT file_path FROM uploads WHERE usuario_id='$usuario_id'";
            $result = mysqli_query($conn, $sql);
            while ($row = mysqli_fetch_assoc($result)) {
                $file_path = $row['file_path'];
                echo '<img src="'.$file_path.'" alt="imagem" style="max-width: 250px; margin: 10px;">';
            }
        ?>
    </div>
</body>
</html>