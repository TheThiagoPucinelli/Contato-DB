<?php
$conn = new mysqli("localhost", "root", "", "contato");

if ($conn->connect_error) {
    die("Erro na conexão: " . $conn->connect_error);
}

$sql = "SELECT * FROM mensagens ORDER BY data_envio DESC";
$result = $conn->query($sql);

echo "<style>
    table {
        width: 100%;
        border-collapse: collapse;
        font-family: Arial, sans-serif;
    }
    th, td {
        padding: 8px;
        border: 1px solid black;
        text-align: left;
    }
    th {
        background-color: #304650;
        color: white;
    }
    tr:nth-child(even) {
        background-color: #f2f2f2;
    }
</style>";

if ($result->num_rows > 0) {
    echo "<table>
            <tr><th>ID</th><th>Nome</th><th>Email</th><th>Mensagem</th><th>Data de Envio</th></tr>";

    while ($row = $result->fetch_assoc()) {
        echo "<tr>
                <td>{$row['id']}</td>
                <td>{$row['nome']}</td>
                <td>{$row['email']}</td>
                <td>{$row['mensagem']}</td>
                <td>{$row['data_envio']}</td>
              </tr>";
    }

    echo "</table>";
} else {
    echo "Nenhum contato encontrado.";
}

$conn->close();
?>
