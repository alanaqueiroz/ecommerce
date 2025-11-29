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

    $currentUserId = isset($_SESSION['CONTA_ID']) ? (int)$_SESSION['CONTA_ID'] : 0;

    $sql = "SELECT p.*, c.nome AS categoria_nome
            FROM produto p
            LEFT JOIN categoria c ON p.categoria = c.id
            WHERE p.owner_id = ".$currentUserId;

    if (isset($_GET["kw"]) && $_GET["kw"] != "") {
        $kw = mysqli_real_escape_string($link, $_GET["kw"]);
        $sql .= " AND (p.nome LIKE '%$kw%' OR c.nome LIKE '%$kw%')";
    }
    $sql .= " ORDER BY p.nome ASC;";

    $result = mysqli_query($link, $sql);
?>

<table border="1">
    <tr>
        <th>Nome</th>
        <th>Categoria</th>
        <th>Preco</th> 
        <th>Editar</th> 
        <th>Apagar</th> 
    </tr>
    <?php
        if (mysqli_num_rows($result) > 0) {
            while ($row = mysqli_fetch_assoc($result)) {
                ?>
                <tr>
                    <td><?= htmlspecialchars($row["nome"]); ?></td>
                    <td><?= htmlspecialchars(!empty($row["categoria_nome"]) ? $row["categoria_nome"] : "Sem categoria", ENT_QUOTES, 'UTF-8'); ?></td>
                    <td><?= number_format($row["preco"], 2, ',', '.'); ?></td>
                    <td align="center"><a style="text-decoration: none;" href="/ecommerce/admin/produto/upd.php?id=<?= $row["id"]; ?>" style="color: black;">✏️</a></td>
                    <td align="center"><a style="text-decoration: none;" href="/ecommerce/admin/produto/del.php?id=<?= $row["id"]; ?>" style="color: black;">❌</a></td>
                </tr>
                <?php
            }
            ?>
    <?php
        } else {
            echo "Nenhum resultado encontrado.";
        }
    ?>
</table>

<?php
    include("../../footer.php");
?>