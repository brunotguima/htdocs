<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);


session_start();
if (!isset($_SESSION['usuario_id'])) {
  header('Location: login.php');
  exit();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $documento_id = $_POST['documento_id'];
  $aprovador_id = $_SESSION['usuario_id'];
  $status = "Aprovado";

  $conn = new mysqli('localhost', 'root', 'sil2023@#', 'sis');
  $stmt = $conn->prepare('UPDATE documentos SET status = ?, aprovador_id = ?, data_aprovacao = NOW() WHERE id = ?');
  $stmt->bind_param('sii', $status, $aprovador_id, $documento_id);
  
  try {
      $stmt->execute();
      header('Location: index.php');
      exit();
  } catch (\mysqli_sql_exception $e) {
      echo 'Erro: ' . $e->getMessage();
      exit();
  }
}

if (!isset($_GET['id'])) {
  header('Location: index.php');
  exit();
}

$documento_id = $_GET['id'];

$conn = new mysqli('localhost', 'root', 'sil2023@#', 'sis');
$stmt = $conn->prepare('SELECT d.id, d.titulo, d.arquivo, d.status, u.nome AS usuario FROM documentos d LEFT JOIN usuarios u ON d.usuario_id = u.id WHERE d.id = ?');
$stmt->bind_param('i', $documento_id);
$stmt->execute();
$stmt->bind_result($id, $titulo, $arquivo, $status, $usuario);
$stmt->fetch();

if ($status !== 'Pendente') {
  header('Location: index.php');
  exit();
}
?>