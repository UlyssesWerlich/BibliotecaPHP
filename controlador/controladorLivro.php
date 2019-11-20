<?php

$titulo = "Registrar Quantitativo de Livros";
include('../paginaBase/cabecalho.php');

$livrosEmprestados = $_POST['livrosEmprestados'];
$livrosDevolvidos = $_POST['livrosDevolvidos'];
$livrosNovos = $_POST['livrosNovos'];

try{
    $pdo=new PDO("mysql:host=localhost;dbname=biblioteca","root","password");
}catch(PDOException $e){
    echo "<p>Erro ao registrar quantitativo de livros</p>";
    echo "<script> console('$e->getMessage()')";
}

$data = date('Y-m-d');
$verificar=$pdo->prepare("select * from qtdlivros where dataRegistro like '$data'");
$verificar->execute();
$resultado = $verificar->fetchAll();

if (empty($resultado)){
    $data = date('Y-m-d');
    $inserir=$pdo->prepare("Insert into qtdlivros(livrosEmprestados, livrosDevolvidos, livrosNovos, dataRegistro) Values('$livrosEmprestados', '$livrosDevolvidos', '$livrosNovos','$data');");
	$inserir->execute();
    $pdo = null;
    
    echo "<p>Quantitativo de livros registrada com sucesso</p>";
} else {
    echo "<p>Não foi possível registrar Quantitativo de livros, já existe registro no dia de hoje</p>";
}


include('../paginaBase/rodape.php');
?>