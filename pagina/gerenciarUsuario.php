<?php
    $titulo = "Usuários";
    include('../paginaBase/cabecalho.php');

?>
    <div class='listaUsuarios'>
        <?php

            try {
                $pdo = new PDO("mysql:host=localhost;dbname=biblioteca","root", "password");
            } catch (PDOException $e){
                echo $e->getMessage();
            }

            $consulta = $pdo->prepare("select nome, login, cpf, telefone from usuario");
            $consulta->execute();
            $resultado = $consulta->fetchAll();

            foreach ($resultado as $row){
                echo "
                    <div class='blocoUsuarios'>
                        <h3>$row[nome]</h3>
                        <p><a href='editarUsuario.php?login=$row[login]'>$row[login]</a><br/>
                        CPF: $row[cpf] <br/>
                        Telefone: $row[telefone] </p>
                    </div>
                ";
            }
            echo "<div class='blocoUsuarios'>
                <p><a href='adicionarUsuario.php'>Adicionar Usuário</a></p>
            </div>";

        ?>

    </div>

<?php
    include('../paginaBase/rodape.php');
?>