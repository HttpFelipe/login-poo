<?php
require_once('class/config.php');
require_once('class/functions.php');
require_once('vendor/autoload.php');
require_once('autoload.php');


// Verifica se todos os dados foram enviados via POST
if (isset($_POST['nome']) && isset($_POST['email']) && isset($_POST['senha']) && isset($_POST['repete_senha'])) {
    // Recebe e limpa os valores vindos do POST
    $nome = validInput($_POST['nome']);
    $email = validInput($_POST['email']);
    $senha = validInput($_POST['senha']);
    $repete_senha = validInput($_POST['repete_senha']);

    // Verifica se os valores do POST não estão vazios
    if (empty($nome) || empty($email) || empty($senha) || empty($repete_senha)) {
        $erro_geral = "Todos os campos são obrigatórios!";
    } else {
        // Instancia a classe Usuario
        $usuario = new Usuario($nome, $email, $senha);

        // Configura a repetição de senha
        $usuario->set_repeticao($repete_senha);

        // Valida o cadastro
        $usuario->validar_cadastro();

        // Se não houver erros
        if (empty($usuario->erro)) {
            // Insere o usuário
            if ($usuario->insert()) {
                header('location: cadastrar.php');
            } else {
                // Se houver algum erro, exibe o erro geral
                $erro_geral = $usuario->erro["erro_geral"];
            }
        }
    }
}
?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Cadastro</title>
    <link href="css/style.css" rel="stylesheet" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous" />
</head>

<body>
    <div class="loginBox bg-dark">
        <img class="user" src="https://i.ibb.co/yVGxFPR/2.png" height="100px" width="100px" />
        <form method="post">
            <h1>Cadastro</h1>
            <?php if (isset($erro_geral)) { ?>
                <div class="erro-geral animate__animated animate__rubberBand">
                    <?php echo $erro_geral; ?>
                </div>
            <?php } ?>
            <div class="inputBox">
                
                <div>
                <input <?php if (isset ($usuario->erro["erro_nome"]) or isset($erro_geral)){ echo 'class="erro-input"'; }?> type="text" <?php if(isset($_POST['nome'])){echo 'value="'.$_POST['nome'].'"';}?> name="nome" placeholder="Nome completo" required />
                <div class="erro"><?php if(isset($usuario->erro["erro_nome"])){echo $usuario->erro["erro_nome"];}?></div>
                </div>

                <div>
                <input <?php if (isset ($usuario->erro["erro_email"]) or isset($erro_geral)){ echo 'class="erro-input"'; }?> type="text" name="email" <?php if(isset($_POST['email'])){echo 'value="'.$_POST['email'].'"';}?> placeholder="Email" required />
                <div class="erro"><?php if(isset($usuario->erro["erro_email"])){echo $usuario->erro["erro_email"];}?></div>
                </div>

                <div>
                <input <?php if (isset ($usuario->erro["erro_senha"]) or isset($erro_geral)){ echo 'class="erro-input"'; }?> type="password" name="senha" <?php if(isset($_POST['senha'])){echo 'value="'.$_POST['senha'].'"';}?> placeholder="Senha de mínimo 6 dígitos" required />
                <div class="erro"><?php if(isset($usuario->erro["erro_senha"])){echo $usuario->erro["erro_senha"];}?></div>
                </div>

                <div>
                <input <?php if (isset ($usuario->erro["erro_repete"]) or isset($erro_geral)){ echo 'class="erro-input"'; }?> type="password" name="repete_senha" <?php if(isset($_POST['repete_senha'])){echo 'value="'.$_POST['repete_senha'].'"';}?> placeholder="Repita sua senha" required />
                <div class="erro"><?php if(isset($usuario->erro["erro_repete"])){echo $usuario->erro["erro_repete"];}?></div>
                </div>
            </div>
            <input type="submit" value="Cadastrar">
        </form>
        <div class="text-center">
            <a href="index.php" style="color: white">Já tenho cadastro</a>
        </div>
    </div>
</body>

</html>