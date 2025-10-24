<?php
    include("../config.inc.php");
    include("../session.php");
    validaSessao();
    include("../../header.php");
    include("../menu.php");
?>

<h3>CATEGORIAS</h3>

<a href="/ecommerce/admin/categoria/add.php" style="color: black;">+ Adicionar Nova Categoria</a><br><br>

<table border="1">
    <tr>
        <th>Nome</th>
        <th>Descricao</th>
        <th>EDITAR</th> 
        <th>APAGAR</th> 
    </tr>
    <?php
        $link = mysqli_connect("localhost", "root", "", "ecommerce");
        $sql = "SELECT * FROM categoria ORDER BY nome;";
        $result = mysqli_query($link, $sql);
        while($row = mysqli_fetch_assoc($result)) {
            ?>
            <tr>
                <td><?=$row["nome"];?></td>
                <td><?=$row["descricao"];?></td>
                <td><a href="/ecommerce/admin/categoria/upd.php?id=<?= $row["id"]; ?>" style="color: black;">✏️</a></td>
                <td><a href="/ecommerce/admin/categoria/del.php?id=<?= $row["id"]; ?>" style="color: black;">❌</a></td>
            </tr>
            <?php
        }      
    ?>   
</table>

<?php
    include("../../footer.php");
?>