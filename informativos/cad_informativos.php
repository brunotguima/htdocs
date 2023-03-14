<?php
include '../estrutural/backend_informativos.php';
// Verifica se o usuário está logado
$is_logged_in = verifica_login();
if ($is_logged_in['logged'] == 0) {
  // Se o usuário não estiver logado, redireciona para a página de login
  header('Location: ../login/login.php');
  exit();
}
?>

<!-- cad_informativos.php -->
<!DOCTYPE html>
<html lang="PT-Br">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>INTRANET SULAMERICANA - Cadastro de Informativos</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/semantic-ui/2.4.1/semantic.min.css">
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/semantic-ui/2.4.1/semantic.min.js"></script>
</head>

<body>
    <?php include '../estrutural/navbar.php'; ?>

    <div class="ui centered aligned grid">
        <div class="six wide column">
            <div class="ui fluid card">
                <div class="content">
                    <h1 class="ui header">Cadastro de Informativos</h1>
                </div>
                <div class="content">
                <form class="ui form" enctype="multipart/form-data" method="POST" onsubmit="return <?php echo cadastrarInformativo(); ?>" action="">
                        <div class="field">
                            <label>Título</label>
                            <input type="text" name="titulo" required>
                        </div>
                        <div class="field">
                            <label>Descrição</label>
                            <textarea name="descricao" rows="4" required></textarea>
                        </div>
                        <div class="field">
                            <label>Imagens</label>
                            <input type="file" name="imagens[]" multiple>
                        </div>
                        <div class="fields">
                            <div class="equal width field">
                                <label>Data de Início</label>
                                <input type="date" name="data_inicio" placeholder="<?php echo date('d/m/Y'); ?>" value="<?php echo date('d/m/Y'); ?>" required>
                            </div>
                            <div class="equal width field">
                                <label>Hora de Início</label>
                                <input type="time" name="hora_inicio" required>
                            </div>
                        </div>
                        <div class="fields">
                            <div class="equal width field">
                                <label>Data de Fim</label>
                                <input type="date" name="data_fim" placeholder="<?php echo date('d/m/Y'); ?>" value="<?php echo date('d/m/Y'); ?>" required>

                            </div>
                            <div class="equal width field">
                                <label>Hora de Fim</label>
                                <input type="time" name="hora_fim" required>
                            </div>
                        </div>
                        <button class="ui green button" type="submit">Cadastrar</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

</body>

</html>