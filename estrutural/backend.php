<!-- backend.php -->
<?php

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "sis";

session_start();

function dd($var)
{
  var_dump($var);
  die();
}

function redirectIndex()
{
  header("Location: ../index.php");
  exit();
}

// função de conexão com o banco de dados
function conectar_banco()
{
  try {
    $pdo = new PDO("mysql:host=$GLOBALS[servername];dbname=$GLOBALS[dbname]", $GLOBALS['username'], $GLOBALS['password']);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    return $pdo;
  } catch (PDOException $e) {
    echo "Erro ao conectar ao banco de dados: " . $e->getMessage();
    exit();
  }
}

// cadastra um novo usuário no banco de dados
function cadastrar_usuario()
{
  try {
    $pdo = conectar_banco();

    // Verificar se o email ou username já estão cadastrados
    $stmt = $pdo->prepare("SELECT * FROM usuarios WHERE email = :email OR username = :username");
    $stmt->execute([':email' => $_POST['email'], ':username' => $_POST['username']]);

    if ($stmt->rowCount() > 0) {
      throw new Exception("Usuário já cadastrado!");
    }

    // Inserir o novo usuário
    $nome = $_POST['nome'];
    $email = $_POST['email'];
    $senha = $_POST['senha'];
    $username = $_POST['username'];

    inserir_usuario($pdo, $nome, $email, $senha, $username);

    $pdo = null;
    return "Usuário cadastrado com sucesso! Faça login: <a href='/login/login.php'>Clique aqui!</a>";
  } catch (PDOException $e) {
    return "Erro ao conectar ao banco de dados: " . $e->getMessage();
  } catch (Exception $e) {
    return $e->getMessage();
  }
}

function inserir_usuario($pdo, $nome, $email, $senha, $username)
{
  $sql = "INSERT INTO usuarios (nome, email, senha, username, user_level) 
          VALUES (:nome, :email, :senha, :username, 0)";
  $stmt = $pdo->prepare($sql);
  $stmt->execute([
    ':nome' => $nome,
    ':email' => $email,
    ':senha' => password_hash($senha, PASSWORD_DEFAULT),
    ':username' => $username
  ]);
}



// verifica se o usuário está logado
function verifica_login()
{


  if (isset($_SESSION['usuario_id'])) {
    $login_url = '../login/logout.php';
    $login_text = 'Sair';
    $logged = 1;
    /*
    $usuario_id = '';
    $usuario_nome = ''; // inicializa a variável fora do bloco condicional
    $usuario_id = $_SESSION['usuario_id'];
    $pdo = conectar_banco();
    $stmt = $pdo->prepare("SELECT nome FROM usuarios WHERE usuario_id = $usuario_id");
    $stmt->execute([':usuario_id' => $usuario_id]);
    $usuario = $stmt->fetch(PDO::FETCH_ASSOC);
    $pdo = null;
    if ($usuario) {
    $usuario_nome = $usuario['nome'];
    }
    */
  } else {
    $login_url = '../login/login.php';
    $login_text = 'Fazer Login';
    $logged = 0;
  }
  return array('url' => $login_url, 'text' => $login_text, 'logged' => $logged /*, 'usuario_nome'=> $usuario_nome*/);
}


// efetua login do usuário
function efetuaLogin()
{
  if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $_POST['email'];
    $senha = $_POST['senha'];

    $pdo = conectar_banco();

    $stmt = $pdo->prepare('SELECT id, senha FROM usuarios WHERE email = ?, senha = ?');
    $stmt->execute([$email]);
    $usuario = $stmt->fetch();

    if (password_verify($senha, $usuario['senha'])) {
      $_SESSION['usuario_id'] = $usuario['id'];
      redirectIndex();
    } else {
      $erro = 'E-mail ou senha incorretos.';
      return $erro;
    }
    $pdo = null;

  }
}

// prepara a consulta para o sistema de aprovação de documentos
function prepara_consulta_aprov_docs()
{
  $pdo = conectar_banco();

  $stmt = $pdo->prepare('SELECT documentos.id, documentos.titulo, documentos.arquivo, usuarios.nome, documentos.data_envio, documentos.status FROM documentos JOIN usuarios ON documentos.usuario_id = usuarios.id WHERE documentos.usuario_aprovador_id = ?');
  $stmt->execute([$_SESSION['usuario_id']]);
  $pdo = null;

  return $stmt;
}

function index()
{
  $pdo = conectar_banco();

  // Buscar todos os informativos
  $stmt = $pdo->prepare("SELECT * FROM informativos");
  $stmt->execute();
  $informativos = $stmt->fetchAll(PDO::FETCH_ASSOC);

  // Buscar todas as imagens de cada informativo
  foreach ($informativos as &$informativo) {
    $stmt = $pdo->prepare("SELECT * FROM imagens_informativos WHERE informativo_id = :informativo_id");
    $stmt->execute([':informativo_id' => $informativo['id']]);
    $informativo['imagens'] = $stmt->fetchAll(PDO::FETCH_ASSOC);
  }

  $pdo = null;

  return array('informativos' => $informativos);
}