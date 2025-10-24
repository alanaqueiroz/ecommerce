<?php
include("../config.inc.php");
include("../session.php");
validaSessao();
include("../../header.php");
include("../menu.php");
?>

<h3>CATEGORIAS</h3>

<a href="/ecommerce/admin/categoria/add.php" style="color: black;">+ Adicionar Nova Categoria</a><br><br>

<form method="get">
    Buscar:
    <br>
    <input type="text" name="kw" value="<?= isset($_GET["kw"]) ? htmlspecialchars($_GET["kw"]) : ""; ?>">
    <input type="submit" value="🔍">
</form>

<?php
$link = mysqli_connect("localhost", "root", "", "ecommerce");
mysqli_set_charset($link, "utf8");

// Montagem da query com filtro
$sql = "SELECT * FROM categoria";
if (isset($_GET["kw"]) && trim($_GET["kw"]) != "") {
    $kw = mysqli_real_escape_string($link, $_GET["kw"]);
    $sql .= " WHERE nome LIKE '%$kw%' OR descricao LIKE '%$kw%'";
}
$sql .= " ORDER BY nome ASC;";

$result = mysqli_query($link, $sql);

if (!$result) {
    die("Erro na consulta: " . mysqli_error($link));
}
?>

<table border="1" cellpadding="5" cellspacing="0">
    <tr>
        <th>Nome</th>
        <th>Descrição</th>
        <th>EDITAR</th> 
        <th>APAGAR</th> 
    </tr>
    <?php
    if (mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_assoc($result)) {
            ?>
            <tr>
                <td><?= htmlspecialchars($row["nome"]); ?></td>
                <td><?= htmlspecialchars($row["descricao"]); ?></td>
                <td><a style="text-decoration: none;" href="/ecommerce/admin/categoria/upd.php?id=<?= $row["id"]; ?>" style="color: black;">✏️</a></td>
                <td><a style="text-decoration: none;" href="/ecommerce/admin/categoria/del.php?id=<?= $row["id"]; ?>" style="color: black;">❌</a></td>
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
