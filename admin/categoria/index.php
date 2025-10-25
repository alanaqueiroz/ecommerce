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

$sql = "SELECT id, nome AS categoria_nome FROM categoria ORDER BY nome;";

$result = mysqli_query($link, $sql);

if (!$result) {
    die("Erro na consulta: " . mysqli_error($link));
}
?>

<table border="1" cellpadding="5" cellspacing="0">
    <tr>
        <th>Nome</th>
        <th>Editar</th> 
        <th>Apagar</th> 
    </tr>
    <?php
    if (mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_assoc($result)) {
            ?>
            <tr>
                <td><?= htmlspecialchars($row['categoria_nome'] ?? '', ENT_QUOTES, 'UTF-8'); ?></td>
                <td><a href="/ecommerce/admin/categoria/upd.php?id=<?= urlencode($row['id']); ?>" style="text-decoration:none;color:black;">✏️</a></td>
                <td><a href="/ecommerce/admin/categoria/del.php?id=<?= urlencode($row['id']); ?>" style="text-decoration:none;color:black;">❌</a></td>
            </tr>
            <?php
        }
    } else {
        echo "Nenhum resultado encontrado.";
    }
    ?>
</table>

<?php
include("../../footer.php");
?>
