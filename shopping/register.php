<?php
session_start();
require './database/db.php';
require './base/header.php';
   if (isset($_SESSION['user_id'])){
    header('Location: index.php');
   }

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'];
    $password = md5($_POST['password']); // Criptografando a senha com MD5

    try {
        $stmt = $pdo->prepare("INSERT INTO users (username, password) VALUES (?, ?)"); // Coonsulta BD
        $stmt->execute([$username, $password]); // Obtém Dados
        header('Location: login.php');
        exit;
    } catch (PDOException $e) {
        $error = "Erro ao registrar usuário: " . $e->getMessage();
    }
}
?>

<h1>Registrar</h1>
<form method="post">
    <div class="mb-3">
        <label for="username" class="form-label">Usuário</label>
        <input type="text" name="username" id="username" class="form-control" required>
    </div>
    <div class="mb-3">
        <label for="password" class="form-label">Senha</label>
        <input type="password" name="password" id="password" class="form-control" required>
    </div>
    <?php if (isset($error)): ?>
        <div class="alert alert-danger"><?php echo $error; ?></div>
    <?php endif; ?>
    <button type="submit" class="btn btn-primary">Registrar</button>
</form>

<?php require './base/footer.php'; ?>