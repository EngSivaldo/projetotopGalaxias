// script.js - Galáxias Store

// Carrinho de compras simulado em localStorage
let carrinho = JSON.parse(localStorage.getItem("carrinho")) || [];

function adicionarAoCarrinho(produtoId, nome, preco) {
  const item = carrinho.find((p) => p.id === produtoId);
  if (item) {
    item.qtd += 1;
  } else {
    carrinho.push({ id: produtoId, nome, preco, qtd: 1 });
  }
  localStorage.setItem("carrinho", JSON.stringify(carrinho));
  alert(`${nome} foi adicionado ao carrinho!`);
}

function atualizarCarrinho() {
  const container = document.getElementById("lista-carrinho");
  const totalSpan = document.getElementById("total-carrinho");
  if (!container) return;
  container.innerHTML = "";
  let total = 0;
  carrinho.forEach((item) => {
    total += item.preco * item.qtd;
    container.innerHTML += `
      <tr>
        <td>${item.nome}</td>
        <td>${item.qtd}</td>
        <td>R$ ${(item.preco * item.qtd).toFixed(2)}</td>
        <td><button class="btn btn-sm btn-danger" onclick="removerItem(${
          item.id
        })">Remover</button></td>
      </tr>
    `;
  });
  totalSpan.innerText = `R$ ${total.toFixed(2)}`;
}

function removerItem(id) {
  carrinho = carrinho.filter((p) => p.id !== id);
  localStorage.setItem("carrinho", JSON.stringify(carrinho));
  atualizarCarrinho();
}

document.addEventListener("DOMContentLoaded", atualizarCarrinho);
