<?php
// Supondo que você tenha passado o token por GET e que tenha verificado esse token no banco de dados
if (isset($_GET['token'])) {
    $token = $_GET['token'];

    // Consultar o banco de dados para verificar o token e obter o ID do usuário
    // (Adicionar sua conexão com o banco de dados aqui)
    $sql = "SELECT id FROM usuario WHERE token_redefinicao = ? LIMIT 1";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $token);
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows > 0) {
        $stmt->bind_result($id_usuario);
        $stmt->fetch();
    } else {
        echo "Token inválido ou expirado.";
        exit;
    }
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Redefinir Senha</title>
</head>
<body>
    <h2>Redefinir Senha</h2>
    <form action="processa_redefinicao.php" method="POST">
        <input type="hidden" name="id" value="<?php echo $id; ?>">

        <label for="nova_senha">Nova Senha:</label>
        <input type="password" name="nova_senha" id="nova_senha" required><br>

        <label for="confirma_senha">Confirme a Nova Senha:</label>
        <input type="password" name="confirma_senha" id="confirma_senha" required><br>

        <button type="submit">Redefinir Senha</button>
    </form>
</body>
</html>
