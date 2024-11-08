<?php
session_start();
require_once("conexao.php");

$sql = "SELECT * FROM tarefas";
$tarefas = mysqli_query($conn, $sql);

?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>To do list</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
</head>
<body>
    <div class="container mt-4">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h4>
                             <i class="bi bi-clipboard2"></i> Lista de Tarefas
                            <a href="tarefa-create.php" class="btn btn-ligth float-end">Adicionar tarefa <i class="bi bi-plus"></i></a>
                        </h4>
                    </div>
                    <div class="card-body">
                        <?php include('mensagem.php'); ?>
                        <table class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>Id</th>
                                    <th>Nome</th>
                                    <th>Descrição</th>
                                    <th>Condição</th>
                                    <th>Data limite</th>
                                    <th>Status</th>
                                    <th>Ações</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($tarefas as $tarefa): ?>
                                    <tr>
                                        <td><?php echo $tarefa['id']; ?></td>
                                        <td><?php echo $tarefa['nome']; ?></td>
                                        <td><?php echo $tarefa['descricao']; ?></td>
                                        <td><?php    
                                                if ($tarefa['condicao'] == 0) {
                                                    echo "<p>Pendente</p>";
                                                } else if ($tarefa['condicao'] == 1) {
                                                    echo "<p>Em execução</p>";
                                                } else {
                                                    echo "<p>Concluido</p>";
                                                }
                                            ?></td>
                                        <td><?php echo date('d/m/Y', strtotime($tarefa['data_limite'])); ?></td>
                                        <td>
                                            
                                            <form action="acoes.php" method="POST" class="d-inline">
                                                <button onclick="return confirm('Gostaria de iniciar essa tarefa??')" name="iniciar_tarefa" type="submit" value="<?=$tarefa['id']?>"  class="btn btn-light btn-sm">Iniciar</button>
                                                <button onclick="return confirm('Gostaria de finalizar essa tarefa??')" name="finalizar_tarefa" type="submit" value="<?=$tarefa['id']?>"  class="btn btn-success btn-sm">Finalizar</button>
                                                <button onclick="return confirm('Gostaria de pausar essa tarefa??')" name="pausar_tarefa" type="submit" value="<?=$tarefa['id']?>"  class="btn btn-dark btn-sm">Pausar</button>
                                            </form>
                                        </td>
                                        <td>
                                            <a href="tarefa-edit.php?id=<?=$tarefa['id']?>" class="btn btn-dark btn-sm"><i class="bi bi-pencil-fill"></i></a>
                                            <form action="acoes.php" method="POST" class="d-inline">
                                                <button onclick="return confirm('Tem certeza que deseja excluir?')" name="delete_tarefa" type="submit" value="<?=$tarefa['id']?>" class="btn btn-danger btn-sm"><i class="bi bi-trash-fill"></i></button>
                                            </form>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>