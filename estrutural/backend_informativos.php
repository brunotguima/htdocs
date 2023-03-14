<!-- backend_informativos.php -->
<?php
include 'backend.php';

function cadastrarInformativo()
{
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $titulo = $_POST['titulo'];
        $descricao = $_POST['descricao'];
        $data_inicio = $_POST['data_inicio'];
        $hora_inicio = $_POST['hora_inicio'];
        $hora_fim = $_POST['hora_fim'];
        $data_fim = $_POST['data_fim'];

        if (isset($_SESSION['usuario_id'])) {
            $usuario_id = $_SESSION['usuario_id'];
        } else {
            echo '<script>window.location.href = "../login/login.php";</script>';
            exit();
        }

        $pdo = conectar_banco();

        try {
            $pdo->beginTransaction();

            $sql = "INSERT INTO informativos (titulo, descricao, usuario_id, data_inicio, hora_inicio, hora_fim, data_fim) 
              VALUES (:titulo, :descricao, :usuario_id, :data_inicio, :hora_inicio, :hora_fim, :data_fim)";
            $stmt = $pdo->prepare($sql);
            $stmt->execute([
                ':titulo' => $titulo,
                ':descricao' => $descricao,
                ':usuario_id' => $usuario_id,
                ':data_inicio' => $data_inicio,
                ':hora_inicio' => $hora_inicio,
                ':hora_fim' => $hora_fim,
                ':data_fim' => $data_fim
            ]);

            $informativo_id = $pdo->lastInsertId();

            if (isset($_FILES['imagens']) && count($_FILES['imagens']['name']) > 0) {
                for ($i = 0; $i < count($_FILES['imagens']['name']); $i++) {
                    $name = $_FILES['imagens']['name'][$i];
                    $type = $_FILES['imagens']['type'][$i];
                    $tmp_name = $_FILES['imagens']['tmp_name'][$i];

                    if (in_array($type, ['image/jpeg', 'image/png', 'image/gif'])) {
                        $uploads_dir = '../informativos/uploads/';
                        $path = $uploads_dir . uniqid() . '-' . basename($name);
                        if (!move_uploaded_file($tmp_name, $path)) {
                            throw new Exception("Erro ao mover arquivo $name para $path");
                        }

                        $sql = "INSERT INTO imagens_informativos (informativo_id, imagem) VALUES (:informativo_id, :imagem)";
                        $stmt = $pdo->prepare($sql);
                        $stmt->execute([
                            ':informativo_id' => $informativo_id,
                            ':imagem' => $path
                        ]);
                    }
                }
            }

            $pdo->commit();
            $pdo = null;
            redirectIndex();
        } catch (PDOException $e) {
            echo "Erro ao conectar ao banco de dados: " . $e->getMessage();
        } catch (Exception $e) {
            echo "Erro ao mover arquivo: " . $e->getMessage();
        }

        $pdo = null;
    }
}
?>
