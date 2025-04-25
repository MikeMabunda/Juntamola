<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $telefone = $_POST["telefone"];
    $senha = $_POST["senha"];  // Adicione uma lógica de senha, se necessário.
    
    // Verificar se o telefone está registrado no arquivo saldos.txt
    $usuarios = file("saldos.txt");
    $encontrado = false;

    foreach ($usuarios as $usuario) {
        list($tel, $saldo, $data) = explode("|", trim($usuario));
        if ($tel == $telefone) {
            $encontrado = true;
            break;
        }
    }

    if ($encontrado) {
        echo "Login bem-sucedido!";
    } else {
        echo "Telefone não encontrado. Por favor, cadastre-se primeiro.";
    }
}
?>

<form action="login.php" method="POST">
    <input type="tel" name="telefone" placeholder="Número de telefone" required>
    <input type="password" name="senha" placeholder="Senha" required>
    <button type="submit">Entrar</button>
</form>
