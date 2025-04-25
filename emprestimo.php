<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $telefone = $_POST["telefone"];
    $valor = $_POST["valor"];
    $acao = $_POST["acao"]; // "solicitar" ou "emprestar"
    $usuarios = file("saldos.txt");
    $emprestimos = file("emprestimos.txt");
    $encontrado = false;
    $novo_emprestimo = false;

    foreach ($usuarios as &$usuario) {
        list($tel, $saldo, $data) = explode("|", trim($usuario));

        if ($tel == $telefone) {
            if ($acao == "solicitar" && $saldo >= 2000) {
                // Verificar se o cliente tem 3 meses de saldo suficiente
                $data_primeiro_deposito = new DateTime($data);
                $data_atual = new DateTime();
                $intervalo = $data_primeiro_deposito->diff($data_atual);

                if ($intervalo->m >= 3) {
                    $emprestimo = $valor * 0.20; // 20% do valor
                    $usuario = "$tel|$saldo|$data\n";
                    file_put_contents("saldos.txt", implode("", $usuarios));
                    $novo_emprestimo = true;
                    $emprestimos[] = "$telefone|$telefone|$emprestimo|" . $data_atual->format('Y-m-d') . "|5\n"; // 5% juros
                    break;
                } else {
                    echo "Você precisa manter o saldo por 3 meses.";
                    exit;
                }
            }

            if ($acao == "emprestar") {
                $novo_emprestimo = true;
                $emprestimos[] = "$telefone|$telefone|$valor|" . date("Y-m-d") . "|5\n"; // 5% juros
                break;
            }
        }
    }

    if ($novo_emprestimo) {
        file_put_contents("emprestimos.txt", implode("", $emprestimos));
        echo "Empréstimo registrado!";
    } else {
        echo "Saldo insuficiente para solicitar empréstimo ou erro ao emprestar.";
    }
}
?>
