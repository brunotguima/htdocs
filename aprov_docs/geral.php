<?php include 'estrutural/backend.php'; ?>
<?php $stmt = prepara_consulta_aprov_docs(); ?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Sistema de Aprovação de Documentos</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/semantic-ui/2.4.1/semantic.min.css">
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/semantic-ui/2.4.1/semantic.min.js"></script>
</head>

<body>
    <?php include 'estrutural/navbar.php'; ?>
    <div class="ui container">
        <div class="ui three column grid stackable">
            <div class="column">
                <h4 class="ui header">Documentos Aprovados</h4>
                <div class="ui divided items">
                    <?php while ($stmt->fetch()) : ?>
                        <?php if ($status == 'Aprovado') : ?>
                            <div class="item">
                                <a href="<?= $arquivo ?>" target="_blank" class="ui tiny image">
                                    <img src="file_icon.png" alt="File Icon">
                                </a>
                                <div class="content">
                                    <a class="header"><?= $titulo ?></a>
                                    <div class="meta">
                                        <span>Enviado por <?= $nome_usuario ?></span>
                                    </div>
                                    <div class="description">
                                        <p>Status: <?= $status ?></p>
                                        <p>Enviado em <?= $data_envio ?></p>
                                    </div>
                                    <form method="post" action="aprovar.php">
                                        <input type="hidden" name="documento_id" value="<?= $documento_id ?>">
                                        <button type="submit" class="ui primary button">Aprovar</button>
                                    </form>
                                </div>
                            </div>
                        <?php endif; ?>
                    <?php endwhile; ?>
                </div>
            </div>
            <div class="column">
                <h4 class="ui header">Documentos Reprovados</h4>
                <div class="ui divided items">
                    <?php while ($stmt->fetch()) : ?>
                        <?php if ($status == 'Reprovado') : ?>
                            <div class="item">
                                <a href="<?= $arquivo ?>" target="_blank" class="ui tiny image">
                                    <img src="file_icon.png" alt="File Icon">
                                </a>
                                <div class="content">
                                    <a class="header"><?= $titulo ?></a>
                                    <div class="meta">
                                        <span>Enviado por <?= $nome_usuario ?></span>
                                    </div>
                                    <div class="description">
                                        <p>Status: <?= $status ?></p>
                                        <p>Enviado em <?= $data_envio ?></p>
                                    </div>
                                    <form method="post" action="aprovar.php">
                                        <input type="hidden" name="documento_id" value="<?= $documento_id ?>">
                                        <button type="submit" class="ui primary button">Aprovar</button>
                                    </form>
                                </div>
                            </div>
                        <?php endif; ?>
                    <?php endwhile; ?>
                </div>
            </div>
            <div class="column">
                <h4 class="ui header">Documentos Pendentes</h4>
                <div class="ui divided items">
                    <?php while ($stmt->fetch()) : ?>
                        <?php if ($status == 'Pendente') : ?>
                            <div class="item">
                                <a href="<?= $arquivo ?>" target="_blank" class="ui tiny image">
                                    <img src="file_icon.png" alt="File Icon">
                                </a>
                                <div class="content">
                                    <a class="header"><?= $titulo ?></a>
                                    <div class="meta">
                                        <span>Enviado por <?= $nome_usuario ?></span>
                                    </div>
                                    <div class="description">
                                        <p>Status: <?= $status ?></p>
                                        <p>Enviado em <?= $data_envio ?></p>
                                    </div>
                                    <form method="post" action="aprovar.php">
                                        <input type="hidden" name="documento_id" value="<?= $documento_id ?>">
                                        <button type="submit" class="ui primary button">Aprovar</button>
                                    </form>
                                </div>
                            </div>
                        <?php endif; ?>
                    <?php endwhile; ?>
                </div>
            </div>
        </div>
    </div>
    <script>
        $('.ui.sidebar')
            .sidebar('attach events', '.ui.menu .sidenav-trigger');
    </script>
</body>

</html>