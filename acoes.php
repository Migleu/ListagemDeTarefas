<?php
session_start();
require_once('conexao.php');


if (isset($_POST['create_tarefa'])) {
    $nome = trim($_POST['txtNome']);
    $descricao = trim($_POST['txtDescricao']);
    $dataLimite = trim($_POST['txtDataLimite']);
    $condicao = 0;
  
    $sql = "INSERT INTO tarefas (nome, descricao, condicao, data_limite) VALUES('$nome', '$descricao', '$condicao', '$dataLimite')";

    mysqli_query($conn, $sql);
  
    $_SESSION['message'] = "Tarefa criada com sucesso!";
    $_SESSION['type'] = 'success';

    header('Location: index.php');
    exit();
}

if (isset($_POST['delete_tarefa'])) {
    $tarefaId = mysqli_real_escape_string($conn, $_POST['delete_tarefa']);
    $sql = "DELETE FROM tarefas WHERE id = '$tarefaId'";

    mysqli_query($conn, $sql);

    if (mysqli_affected_rows($conn) > 0) {
        $_SESSION['message'] = "Tarefa com ID {$tarefaId} excluído com sucesso!";
        $_SESSION['type'] = 'success';
    } else {
        $_SESSION['message'] = "Ops! Não foi possível excluir a tarefa";
        $_SESSION['type'] = 'error';
    }

    header('Location: index.php');
    exit;
}

if (isset($_POST['edit_tarefa'])) {
    $tarefaId = mysqli_real_escape_string($conn, $_POST['tarefa_id']);
    $nome = mysqli_real_escape_string($conn, $_POST['txtNome']);
    $descricao = mysqli_real_escape_string($conn, $_POST['txtDescricao']);
    $dataLimite = mysqli_real_escape_string($conn, $_POST['txtDataLimite']);

    $sql = "UPDATE tarefas SET nome = '{$nome}', descricao = '{$descricao}', data_limite = '{$dataLimite}'";

    $sql .= " WHERE id = '{$tarefaId}'";

    mysqli_query($conn, $sql);

    if (mysqli_affected_rows($conn) > 0) {
        $_SESSION['message'] = "Tarefa {$tarefaId} atualizada com sucesso!";
        $_SESSION['type'] = 'success';
    } else {
        $_SESSION['message'] = "Não foi possível atualizar a tarefa {$tarefaId}";
        $_SESSION['type'] = 'error';
    }

    header("Location: index.php");
    exit;
}

if (isset($_POST['pausar_tarefa'])) {
    $tarefaId = mysqli_real_escape_string($conn, $_POST['pausar_tarefa']);
    $condicao = 0;

    $sql = "UPDATE tarefas SET condicao = '{$condicao}' WHERE id = '$tarefaId'";

    mysqli_query($conn, $sql);
  
    $_SESSION['message'] = "Tarefa pausada, continue depois!";
    $_SESSION['type'] = 'success';

    header('Location: index.php');
    exit;
}


if (isset($_POST['iniciar_tarefa'])) {
    $tarefaId = mysqli_real_escape_string($conn, $_POST['iniciar_tarefa']);
    $condicao = 1;

    $sql = "UPDATE tarefas SET condicao = '{$condicao}' WHERE id = '$tarefaId'";

    mysqli_query($conn, $sql);
  
    $_SESSION['message'] = "Tarefa iniciada com sucesso!";
    $_SESSION['type'] = 'success';

    header('Location: index.php');
    exit;
}

if (isset($_POST['finalizar_tarefa'])) {
    $tarefaId = mysqli_real_escape_string($conn, $_POST['finalizar_tarefa']);
    $condicao = 2;

    $sql = "UPDATE tarefas SET condicao = '{$condicao}' WHERE id = '$tarefaId'";

    mysqli_query($conn, $sql);
  
    $_SESSION['message'] = "Tarefa finalizada, parabéns!";
    $_SESSION['type'] = 'success';

    header('Location: index.php');
    exit;
}

// if (isset($_POST['iniciar_tarefa'])) {
//     $tarefaId = mysqli_real_escape_string($conn, $_POST['iniciar_tarefa']);
//     $condicao = trim("Em execução");

//     $sql = "UPDATE tarefas SET condicao = '{$condicao}' WHERE id = '$tarefaId'";

//     mysqli_query($conn, $sql);
  
//     $_SESSION['message'] = "Tarefa iniciada com sucesso!";
//     $_SESSION['type'] = 'success';

//     header('Location: index.php');
//     exit;
// }

// if (isset($_POST['finalizar_tarefa'])) {
//     $tarefaId = mysqli_real_escape_string($conn, $_POST['finalizar_tarefa']);
//     $condicao = trim("Concluida");

//     $sql = "UPDATE tarefas SET condicao = '{$condicao}' WHERE id = '$tarefaId'";

//     mysqli_query($conn, $sql);
  
//     $_SESSION['message'] = "Tarefa finalizada, parabéns!";
//     $_SESSION['type'] = 'success';

//     header('Location: index.php');
//     exit;
// }