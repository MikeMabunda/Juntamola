<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $telefone = $_POST["telefone"];
    $valor = $_POST["valor"];
    $operadora = $_POST["operadora"];
    $data_atual = date("Y-m-d");

    // Verifica se o telefone já está registrado no saldos.txt
    $usuarios = file("saldos.txt");
    $encontrado = false;

    foreach ($usuarios as &$usuario) {
        list($tel, $saldo, $data) = explode("|", trim($usuario));
        if ($tel == $telefone) {
            $novo_saldo = $saldo + $valor;
            $usuario = "$tel|$novo_saldo|$data\n";
            file_put_contents("saldos.txt", implode("", $usuarios));
            $encontrado = true;
            break;
        }
    }

    if (!$encontrado) {
        // Caso não encontrado, cria um novo usuário
        file_put_contents("saldos.txt", "$telefone|$valor|$data_atual\n", FILE_APPEND);
    }

    echo "Depósito realizado com sucesso!";
}
?>
