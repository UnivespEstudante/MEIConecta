    <?php
    session_start(); // Inicia sessão para guardar login

    // Função de login
    function login($pdo, $usuario, $senha) {
        $stmt = $pdo->prepare("SELECT id, nome, senha FROM clientes WHERE usuario = ?");
        $stmt->execute([$usuario]);
        $cliente = $stmt->fetch();

        // Verifica senha com hash
        if ($cliente && password_verify($senha, $cliente['senha'])) {
            $_SESSION['cliente_id'] = $cliente['id'];   // guarda id
            $_SESSION['cliente_nome'] = $cliente['nome']; // guarda nome
            return true;
        }
        return false;
    }

    // Função de logout
    function logout() {
        session_destroy(); // encerra sessão
        header("Location: index.php"); // volta para home
        exit;
    }

    // Verifica se usuário está logado
    function isLogged() {
        return isset($_SESSION['cliente_id']);
    }
    ?>