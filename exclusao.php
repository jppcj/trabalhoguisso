<?php
require_once 'conexao.php';
// Exclui as tarefas selecionadas
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['ids'])) {
    foreach ($_POST['ids'] as $id) {
        $tarefa = R::load('tarefa', (int) $id);
        if ($tarefa->id) {
            R::trash($tarefa);
        }
    }
    header('Location: exclusao.php');
    exit;
}
$tarefas = R::findAll('tarefa');
?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Excluir tarefas</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Figtree:wght@400;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="assets/style/style.css">
</head>

<body>
    <div class="container">

        <header class="topo">
            <h1>Excluir tarefas</h1>
        </header>

        <form method="POST" class="formulario">

            <div class="campo">
                <label>Selecione as tarefas que deseja excluir:</label>

                <div class="lista-tarefas">
                    <?php foreach ($tarefas as $tarefa): ?>
                        <label class="tarefa-item">
                            <input type="checkbox" name="ids[]" value="<?php echo $tarefa->id; ?>">

                            <span><?php echo htmlspecialchars($tarefa->nome); ?></span>
                        </label>
                    <?php endforeach; ?>

                </div>
            </div>

            <div class="acoes">
                <button type="submit" class="btn btn-perigo">
                    Excluir selecionadas
                </button>

                <a class="btn btn-claro" href="index.php">Voltar às tarefas</a>
            </div>
        </form>
    </div>
</body>

</html>