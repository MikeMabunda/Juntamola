<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nome = $_POST["nome"];
    $telefone = $_POST["telefone"];
    $senha = $_POST["senha"];  // Adicionar lógica para senha, se necessário
    $operadora = $_POST["operadora"];
    $data_cadastro = date("Y-m-d");

    // Registrar no arquivo saldos.txt
    $usuario = "$telefone|0|$data_cadastro\n";
    file_put_contents("saldos.txt", $usuario, FILE_APPEND);

    echo "Cadastro realizado com sucesso!";
}
?>

<form action="cadastro.php" method="POST">
    <input type="text" name="nome" placeholder="Nome completo" required>
    <input type="tel" name="telefone" placeholder="Número de telefone" required>
    <input type="password" name="senha" placeholder="Senha" required>
    <select name="operadora" required>
        <option value="e-mola">e-Mola</option>
        <option value="m-pesa">M-Pesa</option>
    </select>
    <button type="submit">Cadastrar</button>
</form>
