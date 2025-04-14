<style>
    body {
        background-color: wheat;
        font-family: Arial, sans-serif;
    }
    h2 {
        color: #333;
        margin-top:20%;
    }
    a:hover{background-color: rgb(187, 187, 187);}
</style>

<?php
$host = 'localhost'; 
$dbname = 'contato'; 
$username = 'root'; 
$password = ''; 


class Contato {
    
    private $nome;
    private $email;
    private $mensagem;

   
    public function setNome($nome) {
        $this->nome = $nome;
    }


    public function getNome() {
        return $this->nome;
    }

 
    public function setEmail($email) {
        $this->email = $email;
    }


    public function getEmail() {
        return $this->email;
    }

    public function setMensagem($mensagem) {
        $this->mensagem = $mensagem;
    }

    public function getMensagem() {
        return $this->mensagem;
    }
}


try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Erro ao conectar com o banco de dados: " . $e->getMessage());
}


if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nome = $_POST['nome'];
    $email = $_POST['email'];
    $mensagem = $_POST['desc'];  

    if (empty($nome) || empty($email) || empty($mensagem)) {
        echo "Todos os campos são obrigatórios.";
        exit;
    }

    try {
        $sql = "INSERT INTO mensagens (nome, email, mensagem) VALUES (:nome, :email, :mensagem)";
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':nome', $nome);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':mensagem', $mensagem);

        $stmt->execute();

        echo "<center><h2>Dados enviados com sucesso!</h2><center/>";
        echo "<a href='index.html'>Voltar ao Formulário</a>";
    } catch (PDOException $e) {
        echo "Erro ao salvar os dados: " . $e->getMessage();
    }
}
?>
