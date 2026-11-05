<?php
require_once 'conexao.php';
$sucesso = false;
// adiciona a tarefa
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $tarefa = R::dispense('tarefa');
    $tarefa->nome = trim($_POST['nome']);
    $tarefa->concluida = isset($_POST['concluida']) ? 1 : 0;
    R::store($tarefa);
    $sucesso = true;
}

?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Adicionar tarefa</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Figtree:wght@400;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="assets/style/style.css">
</head>

<body>
    <div class="container">

        <header class="topo">
            <h1>Adicionar tarefa</h1>
        </header>

        <?php if ($sucesso): ?>
            <p class="aviso" role="status">Tarefa cadastrada com sucesso!</p>
        <?php endif; ?>

        <form method="POST" class="formulario">
            <div class="campo">
                <label for="nome">Nome da tarefa</label>
                <input type="text" id="nome" name="nome" required autofocus>
            </div>
            <label class="campo-check">
                <input type="checkbox" name="concluida" value="1">
                Tarefa concluída
            </label>
            <div class="acoes">
                <button type="submit" class="btn">Cadastrar tarefa</button>
                <a class="btn btn-claro" href="index.php">Voltar às tarefas</a>
            </div>
        </form>
    </div>
</body>

</html>