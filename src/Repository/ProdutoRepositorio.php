<?php
require_once "src/Model/Produto.php";

class ProdutoRepositorio
{
    private PDO $pdo;

    public function __construct(PDO $pdo)
    {
        $this->pdo = $pdo;
    }

    public function opcoesCafe(): array
    {
        $sql = "SELECT * FROM produtos WHERE tipo = 'Café' ORDER BY preco";
        $stmt = $this->pdo->query($sql);
        $produtosCafe = $stmt->fetchAll(PDO::FETCH_ASSOC);

        return array_map(function ($cafe) {
            return new Produto(
                (int) $cafe['id'],
                (string) $cafe['tipo'],
                (string) $cafe['nome'],
                (string) $cafe['descricao'],
                (float) $cafe['preco'],
                (string) $cafe['imagem']
            );
        }, $produtosCafe);
    }

    public function opcoesAlmoco(): array
    {
        $sql = "SELECT * FROM produtos WHERE tipo = 'Almoço' ORDER BY preco";
        $stmt = $this->pdo->query($sql);
        $produtosAlmoco = $stmt->fetchAll(PDO::FETCH_ASSOC);

        return array_map(function ($almoco) {
            return new Produto(
                (int) $almoco['id'],
                (string) $almoco['tipo'],
                (string) $almoco['nome'],
                (string) $almoco['descricao'],
                (float) $almoco['preco'],
                (string) $almoco['imagem']
            );
        }, $produtosAlmoco);
    }

    public function buscarTodos(): array
    {
        $sql = "SELECT * FROM produtos ORDER BY preco";
        $statement = $this->pdo->query($sql);
        $dados = $statement->fetchAll(PDO::FETCH_ASSOC);

        return array_map([$this, 'formarObjeto'], $dados);
    }

    private function formarObjeto(array $dados): Produto
    {
        return new Produto(
            (int) $dados['id'],
            (string) $dados['tipo'],
            (string) $dados['nome'],
            (string) $dados['descricao'],
            (float) $dados['preco'],
            (string) $dados['imagem']
        );
    }

    public function save(Produto $produto): void
    {
        $sql = "INSERT INTO produtos (tipo, nome, descricao, preco, imagem)
                VALUES (?, ?, ?, ?, ?)";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindValue(1, $produto->getTipo());
        $stmt->bindValue(2, $produto->getNome());
        $stmt->bindValue(3, $produto->getDescricao());
        $stmt->bindValue(4, $produto->getPreco());
        $stmt->bindValue(5, $produto->getImagem());
        $stmt->execute();
    }

    public function delete(int $id): void
    {
        $sql = "DELETE FROM produtos WHERE id = ?";
        $statement = $this->pdo->prepare($sql);
        $statement->bindValue(1, $id, PDO::PARAM_INT);
        $statement->execute();
    }
}