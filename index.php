<?php
require_once 'conexao.php';
// muda de concluido para não concluido
if (isset($_GET['id'])) {
    $tarefa = R::load('tarefa', $_GET['id']);
    if ($tarefa->id) {
        $tarefa->concluida = $tarefa->concluida ? 0 : 1;
        R::store($tarefa);
    }
    $filtro = $_GET['filtro'] ?? 'todas';
    header('Location: index.php?filtro=' . $filtro);
    exit;
}

$filtro = $_GET['filtro'] ?? 'todas';

if ($filtro === 'concluidas') {
    $tarefas = R::findAll('tarefa', 'concluida = ?', [1]);
} elseif ($filtro === 'pendentes') {
    $tarefas = R::findAll('tarefa', 'concluida = ?', [0]);
} else {
    $tarefas = R::findAll('tarefa');
}
$total = count($tarefas);
$feitas = 0;
foreach ($tarefas as $t) {
    if ($t->concluida) {
        $feitas++;
    }
}
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Gestão de tarefas</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Figtree:wght@400;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="assets/style/style.css">
</head>

<body>
    <div class="container">

        <header class="topo">
            <div>
                <h1>Minhas tarefas</h1>
                <p class="resumo"><?php echo $feitas; ?> de <?php echo $total; ?> concluídas</p>
            </div>
            <nav class="menu">
                <a class="btn" href="inclusao.php">Adicionar tarefa</a>
                <a class="btn btn-claro" href="exclusao.php">Excluir tarefas</a>
            </nav>
        </header>

        <nav class="filtros">
            <a href="index.php" class="btn-filtro">Todas</a>
            <a href="index.php?filtro=concluidas" class="btn-filtro">Concluídas</a>
            <a href="index.php?filtro=pendentes" class="btn-filtro">Não feitas</a>
        </nav>

        <ul class="lista">
            <?php if (empty($tarefas)): ?>
                <li class="vazio">Nenhuma tarefa ainda. Adicione a primeira.</li>
            <?php endif; ?>

            <?php foreach ($tarefas as $tarefa): ?>
                <li class="tarefa <?php echo $tarefa->concluida ? 'concluida' : ''; ?>">

                    <a class="marcar" href="index.php?id=<?php echo $tarefa->id; ?>" title="Alterar situação"
                        aria-label="Alterar situação de <?php echo htmlspecialchars($tarefa->nome); ?>">
                        <svg viewBox="0 0 16 16" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round"
                            stroke-linejoin="round" aria-hidden="true">
                            <path d="M3 8.5l3.2 3.2L13 4.8" />
                        </svg>
                    </a>

                    <span class="nome"><?php echo htmlspecialchars($tarefa->nome); ?></span>

                    <span class="situacao">
                        <?php echo $tarefa->concluida ? 'Concluída' : 'Não concluída'; ?>
                    </span>

                </li>
            <?php endforeach; ?>
        </ul>

    </div>
</body>

</html>