<?php
    include("../config.inc.php");
    include("../session.php");
    validaSessao();
    include("../../header.php");
    include("../menu.php");
?>

<h3>CATEGORIAS</h3>

<table>
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
                <td><input type="text" value="<?= htmlspecialchars($row["nome"]); ?>" /></td>
                <td><input type="text" value="<?= htmlspecialchars($row["descricao"]); ?>" /></td>
                <td><a href="/ecommerce/admin/categoria/upd.php?id=<?= $row["id"]; ?>" style="color: black;">Editar</a></td>
                <td><a href="/ecommerce/admin/categoria/del.php?id=<?= $row["id"]; ?>" style="color: black;">Apagar</a></td>
            </tr>
            <?php
        }      
    ?>   
</table>

<a href="/ecommerce/admin/categoria/add.php" style="color: black;">+ Adicionar Categoria</a>

<?php
    include("../../footer.php");
?>