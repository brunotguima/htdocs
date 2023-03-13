<?php
session_start();
if (!isset($_SESSION['usuario_id'])) {
  header('Location: login.php');
  exit();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $titulo = $_POST['titulo'];
  $arquivo = $_FILES['arquivo'];
  $usuario_id = $_SESSION['usuario_id'];
  $usuario_aprovador_id = $_POST['usuario_aprovador_id'];

  $nome_arquivo = $arquivo['name'];
  $caminho_arquivo = '/doc_upload/' . $nome_arquivo;

  if (move_uploaded_file($arquivo['tmp_name'], $caminho_arquivo)) {
    $conn = new mysqli('localhost', 'root', 'sil2023@#', 'sis');
    $stmt = $conn->prepare('INSERT INTO documentos (titulo, arquivo, usuario_id, usuario_aprovador_id, data_envio) VALUES (?, ?, ?, ?, NOW())');
    $stmt->bind_param('ssii', $titulo, $caminho_arquivo, $usuario_id, $usuario_aprovador_id);
    $stmt->execute();

    header('Location: index.php');
    exit();
  } else {
    $erro = 'Erro ao enviar arquivo. Verifique se o diretório de upload está configurado corretamente e tem permissão de escrita.';
    if ($arquivo['error'] === UPLOAD_ERR_INI_SIZE) {
      $erro = 'Erro ao enviar arquivo. O tamanho do arquivo enviado excede o tamanho máximo permitido pelo servidor.';
    } elseif ($arquivo['error'] === UPLOAD_ERR_PARTIAL) {
      $erro = 'Erro ao enviar arquivo. O upload do arquivo foi interrompido antes de ser concluído.';
    }
  }
}
?>

<!DOCTYPE html>
<html>

<head>
  <title>Enviar Documento</title>
</head>

<body>
  <h1>Enviar Documento</h1>
  <?php if (isset($erro)) : ?>
    <p><?= $erro ?></p>
  <?php endif; ?>
  <form method="post" enctype="multipart/form-data">
    <label for="titulo">Título:</label>
    <input type="text" name="titulo" required>
    <br>
    <label for="arquivo">Arquivo:</label>
    <input type="file" name="arquivo" required>
    <br>
    <label for="usuario_aprovador_id">Usuário que deverá aprovar:</label>
    <select name="usuario_aprovador_id" required>
      <?php
      $conn = new mysqli('localhost', 'root', 'sil2023@#', 'sis');
      $stmt = $conn->prepare('SELECT id, nome FROM usuarios');
      $stmt->execute();
      $stmt->bind_result($id, $nome);
      while ($stmt->fetch()) {
        if ($id !== $_SESSION['usuario_id']) {
          echo "<option value='$id'>$nome</option>";
        }
      }
      ?>
    </select>
    <br>
    <button type="submit">Enviar</button>
  </form>
</body>

</html>