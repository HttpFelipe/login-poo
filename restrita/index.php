<?php
require_once('../class/config.php');
require_once('../autoload.php');

$login = new Login();
$login->isAuth($_SESSION['TOKEN']);
?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Área Restrita</title>
    <style>
        body {
            margin: 0;
            padding: 0;
            background: #6a11cb;
            background: linear-gradient(to right, rgba(106, 17, 203, 1), rgba(37, 117, 252, 1));
            font-family: sans-serif;
            overflow: hidden;
            text-align: center;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            height: 100vh;
        }

        h1 {
            color: white;
            margin-bottom: 20px;
        }

        .logout-button {
            display: inline-block;
            padding: 10px 20px;
            background-color: #4CAF50;
            color: white;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        .logout-button:hover {
            background-color: #45a049;
        }
    </style>

<body>
    <div>
        <h1>Bem-vindo à Área Restrita,
            <?php echo $login->nome; ?>!
        </h1>
        <button class="logout-button" onclick="logout()">Logout</button>
    </div>
    <script>
        function logout() {
            // Enviar solicitação AJAX para excluir o token
            var xhr = new XMLHttpRequest();
            xhr.open('POST', 'logout.php', true);
            xhr.onreadystatechange = function () {
                if (xhr.readyState === XMLHttpRequest.DONE) {
                    if (xhr.status === 200) {
                        // Redirecionar para a página de login após excluir o token
                        window.location.href = '../index.php';
                    } else {
                        // Exibir mensagem de erro, se houver
                        console.error('Erro ao realizar logout:', xhr.responseText);
                    }
                }
            };
            xhr.send();
        }
    </script>
</body>
</html>