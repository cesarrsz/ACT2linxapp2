<?php
session_start();
if (!isset($_SESSION['votes'])) {
    $_SESSION['votes'] = [0, 0, 0];
    $_SESSION['user_vote'] = -1;
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $choice = $_POST['choice'];
    if ($_SESSION['user_vote'] != -1) {
        $_SESSION['votes'][$_SESSION['user_vote']]--;
    }
    $_SESSION['votes'][$choice]++;
    $_SESSION['user_vote'] = $choice;
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Encuesta Dinámica</title>
    <style>
        body {
            background-color: black;
            color: white;
            display: flex;
            flex-direction: column;
            align-items: center;
            height: 100vh;
            font-family: Arial, sans-serif;
            text-align: center;
        }
        .bar {
            height: 20px;
            background-color: white;
            margin: 5px 0;
        }
    </style>
</head>
<body>
    <h1>Encuesta Dinámica</h1>
    <form method="POST">
        <input type="radio" name="choice" value="0" required> Opción 1<br>
        <input type="radio" name="choice" value="1"> Opción 2<br>
        <input type="radio" name="choice" value="2"> Opción 3<br>
        <button type="submit">Votar</button>
    </form>
    <h2>Resultados:</h2>
    <div>Opción 1: <?php echo $_SESSION['votes'][0]; ?> votos</div>
    <div class="bar" style="width:<?php echo ($_SESSION['votes'][0] * 10); ?>%"></div>
    <div>Opción 2: <?php echo $_SESSION['votes'][1]; ?> votos</div>
    <div class="bar" style="width:<?php echo ($_SESSION['votes'][1] * 10); ?>%"></div>
    <div>Opción 3: <?php echo $_SESSION['votes'][2]; ?> votos</div>
    <div class="bar" style="width:<?php echo ($_SESSION['votes'][2] * 10); ?>%"></div>
</body>
</html>
