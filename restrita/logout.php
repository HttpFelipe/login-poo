<?php
session_start();

// Verificar se o token existe na sessão
if (isset($_SESSION['TOKEN'])) {
    // Remover o token da sessão
    unset($_SESSION['TOKEN']);
}

// Retornar uma resposta de sucesso
http_response_code(200);