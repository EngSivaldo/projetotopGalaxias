<?php
// Conecta ao banco SQLite
$db = new SQLite3('galaxias.db');

// Cria tabela se não existir
$db->exec("CREATE TABLE IF NOT EXISTS produtos (
  id INTEGER PRIMARY KEY AUTOINCREMENT,
  nome TEXT,
  preco REAL,
  categoria TEXT,
  descricao TEXT,
  imagem TEXT
)");

// Coleta os dados do formulário
$nome = isset($_POST['nome']) ? $_POST['nome'] : '';
$preco = isset($_POST['preco']) ? $_POST['preco'] : 0;
$categoria = isset($_POST['categoria']) ? $_POST['categoria'] : '';
$descricao = isset($_POST['descricao']) ? $_POST['descricao'] : '';


// Faz upload da imagem
$imagem = '';
if (isset($_FILES['imagem']) && $_FILES['imagem']['error'] === UPLOAD_ERR_OK) {
  $pasta = 'imagens/';
  if (!is_dir($pasta)) {
    mkdir($pasta, 0777, true);
  }
  $extensao = pathinfo($_FILES['imagem']['name'], PATHINFO_EXTENSION);
  $novoNome = uniqid() . "." . $extensao;
  $caminho = $pasta . $novoNome;
  move_uploaded_file($_FILES['imagem']['tmp_name'], $caminho);
  $imagem = $caminho;
}

// Insere no banco
$stmt = $db->prepare("INSERT INTO produtos (nome, preco, categoria, descricao, imagem) VALUES (:nome, :preco, :categoria, :descricao, :imagem)");
$stmt->bindValue(':nome', $nome);
$stmt->bindValue(':preco', $preco);
$stmt->bindValue(':categoria', $categoria);
$stmt->bindValue(':descricao', $descricao);
$stmt->bindValue(':imagem', $imagem);

if ($stmt->execute()) {
  echo "<script>alert('Produto cadastrado com sucesso!'); window.location.href='admin.html';</script>";
} else {
  echo "Erro ao cadastrar produto.";
}
?>