<?php
require_once('class/config.php');
require_once('class/functions.php');
require_once('autoload.php');

if(isset($_POST['email']) && isset($_POST['senha']) && !empty($_POST['email']) && !empty($_POST['senha']) ){
    $email = validInput($_POST['email']);
    $senha = validInput($_POST['senha']);

    $login = new Login();
    $login->auth($email,$senha);
}
?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Login</title>
  <link href="css/style.css" rel="stylesheet" />
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous" />
</head>

<body>
  <div class="loginBox bg-dark">
    <img class="user" src="https://i.ibb.co/yVGxFPR/2.png" height="100px" width="100px" />
    <form method="post">
      <h1>Login</h1>
      <?php if (isset($login->erro["erro_geral"])) { ?>
        <div class="erro-geral animate__animated animate__rubberBand">
          <?php echo $login->erro["erro_geral"]; ?>
        </div>
      <?php } ?>
      <div class="inputBox">
        <input type="text" name="email" placeholder="Email" required/>
        <input type="password" name="senha" placeholder="Senha" required/>
      </div>
      <input type="submit" name="" value="Login" />
    </form>
    <div class="text-center">
      <a href="cadastrar.php" style="color: white">Realizar Cadastro</a>
    </div>
  </div>
</body>

</html>