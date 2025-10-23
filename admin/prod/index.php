<?php
    include("../config.inc.php");
    include("../session.php");
    validaSessao();
    include("../../header.php");
    include("../menu.php");
?>

<h3>PRODUTOS</h3>

<a href="/ecommerce/admin/prod/add.php" style="color: black;">+ Adicionar Produtos</a>
<br><br>

<table border="1">
    <tr>
        <th>Nome</th>
        <th>Preco</th> 
        <th>EDITAR</th> 
        <th>APAGAR</th> 
    </tr>
    <?php
        $link = mysqli_connect("localhost", "root", "", "ecommerce");
        $sql = "SELECT * FROM prod ORDER BY nome;";
        $result = mysqli_query($link, $sql);
        while($row = mysqli_fetch_assoc($result)) {
            ?>
            <tr>
                <td><?=$row["nome"];?></td>
                <td><?=$row["preco"];?></td>
                <td><a href="/ecommerce/admin/prod/upd.php?id=<?=$row["id"];?>" style="color: black;">Editar</a></td>
                <td><a href="/ecommerce/admin/prod/del.php?id=<?=$row["id"];?>" style="color: black;">Apagar</a></td>
            </tr>
            <?php
        }      
    ?>   
</table>

<?php
    include("../../footer.php");
?>