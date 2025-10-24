<?php
    include("../config.inc.php");
    include("../session.php");
    validaSessao();
    include("../../header.php");
    include("../menu.php");
?>

<h3>PRODUTOS</h3>

<a href="/ecommerce/admin/produto/add.php" style="color: black;">+ Adicionar Novo Produto</a><br><br>

<form method="get">
    Buscar:
    <br>
    <input type="text" name="kw" value="<?= isset($_GET["kw"]) ? htmlspecialchars($_GET["kw"]) : ""; ?>">
    <input type="submit" value="🔍">
</form>

<?php
    $link = mysqli_connect("localhost", "root", "", "ecommerce");
    mysqli_set_charset($link, "utf8");

    $sql = "SELECT * FROM produto";
    if (isset($_GET["kw"]) && $_GET["kw"] != "") {
        $kw = mysqli_real_escape_string($link, $_GET["kw"]);
        $sql .= " WHERE nome LIKE '%$kw%'";
    }
    $sql .= " ORDER BY nome;";

    $result = mysqli_query($link, $sql);
?>

<table border="1">
    <tr>
        <th>Nome</th>
        <th>Preco</th> 
        <th>EDITAR</th> 
        <th>APAGAR</th> 
    </tr>
    <?php
        if (mysqli_num_rows($result) > 0) {
            while ($row = mysqli_fetch_assoc($result)) {
                ?>
                <tr>
                    <td><?= htmlspecialchars($row["nome"]); ?></td>
                    <td><?= number_format($row["preco"], 2, ',', '.'); ?></td>
                    <td><a style="text-decoration: none;" href="/ecommerce/admin/produto/upd.php?id=<?= $row["id"]; ?>" style="color: black;">✏️</a></td>
                    <td><a style="text-decoration: none;" href="/ecommerce/admin/produto/del.php?id=<?= $row["id"]; ?>" style="color: black;">❌</a></td>
                </tr>
                <?php
            }
        } else {
            ?>
            <tr><td colspan="4">Nenhum resultado encontrado.</td></tr>
            <?php
        }
    ?>   
</table>

<?php
    include("../../footer.php");
?>