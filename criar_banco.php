<?php
// Cria o banco de dados SQLite
$db = new SQLite3('galaxias.db');

// Cria a tabela de produtos
$db->exec("CREATE TABLE IF NOT EXISTS produtos (
  id INTEGER PRIMARY KEY AUTOINCREMENT,
  nome TEXT NOT NULL,
  preco REAL NOT NULL,
  categoria TEXT NOT NULL,
  imagem TEXT NOT NULL,
  descricao TEXT
)");

echo "Banco de dados e tabela criados com sucesso!";
?>