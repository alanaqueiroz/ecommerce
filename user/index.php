<?php
include("./config.inc.php");
include("../header.php");
include("./menu.php");
?>

<h3>PRODUTOS</h3>

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
if (isset($_GET["kw"]) && $_GET["kw"]) {
    $kw = mysqli_real_escape_string($link, $_GET["kw"]);
    $sql .= " WHERE nome LIKE '%$kw%'";
}
$sql .= " ORDER BY nome;";

$result = mysqli_query($link, $sql);
if (mysqli_num_rows($result) > 0) {
    ?>
    <table border="1">
        <tr>
            <th>Nome</th>
            <th>Preço</th>
            <th>COMPRAR</th>
        </tr>
        <?php
        while ($row = mysqli_fetch_assoc($result)) {
            ?>
            <tr>
                <td><?= htmlspecialchars($row["nome"]); ?></td>
                <td><?= number_format($row["preco"], 2, ',', '.'); ?></td>
                <td align="center">
                    <a href="/ecommerce/user/carrinho.php?a=<?= $row["id"]; ?>" style="color: black;">(+)</a>
                </td>
            </tr>
            <?php
        }
        ?>
    </table>
    <?php
} else {
    echo "Nenhum resultado encontrado.";
}
?>

<?php
include("../footer.php");
?>