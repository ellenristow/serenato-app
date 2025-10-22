<?php

require "src/conexao-bd.php";
require "src/Model/Produto.php";
require "src/Repository/ProdutoRepositorio.php";

$produtoRepositorio = new ProdutoRepositorio($pdo);

if ( isset($_GET['id']) && is_numeric($_GET['id']) ){
    $id = (int) $_GET['id'];
    $produtoRepositorio->delete($id);
    header("Location: admin.php"); 
    exit;
} else {
    echo "ID do produto inválido ou não informado.";
}