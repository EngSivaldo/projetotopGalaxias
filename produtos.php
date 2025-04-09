<!DOCTYPE html>
<html lang="pt-br">

<head>
  <meta charset="UTF-8">
  <title>Produtos Cadastrados - Galáxias Store</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <style>
  body {
    background-color: #f2f5f9;
  }

  .card {
    border: none;
    border-radius: 10px;
    box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
  }

  .card-img-top {
    height: 180px;
    object-fit: cover;
    border-top-left-radius: 10px;
    border-top-right-radius: 10px;
  }
  </style>
</head>

<body>

  <div class="container mt-5">
    <h2 class="mb-4">🛍 Produtos Cadastrados</h2>
    <div class="row">
      <?php
    $db = new SQLite3('galaxias.db');
    $res = $db->query("SELECT * FROM produtos ORDER BY id DESC");

    while ($row = $res->fetchArray()) {
      echo '<div class="col-md-4 mb-4">';
      echo '  <div class="card">';
      echo '    <img src="' . $row['imagem'] . '" class="card-img-top" alt="Imagem do Produto">';
      echo '    <div class="card-body">';
      echo '      <h5 class="card-title">' . htmlspecialchars($row['nome']) . '</h5>';
      echo '      <p class="card-text">💸 R$ ' . number_format($row['preco'], 2, ',', '.') . '</p>';
      echo '      <p class="card-text">📦 Categoria: ' . htmlspecialchars($row['categoria']) . '</p>';
      echo '    </div>';
      echo '  </div>';
      echo '</div>';
    }
    ?>
    </div>
  </div>

</body>

</html>