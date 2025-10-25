<?php
    include("../config.inc.php");
    include("../session.php");
    validaSessao();

    // conecta e carrega categorias para o dropdown
    $link = mysqli_connect("localhost", "root", "", "ecommerce");
    mysqli_set_charset($link, "utf8");
    $categorias = [];
    $resCats = mysqli_query($link, "SELECT id, nome FROM categoria ORDER BY nome");
    if ($resCats) {
        while ($r = mysqli_fetch_assoc($resCats)) {
            $categorias[] = $r;
        }
    }

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        extract($_POST);
        $error = "";
        if (!$nome) {
            $error = "Nome obrigatorio";
        }
        if (!$preco) {
            $error = "Preco obrigatorio";
        }
        if (!$categoria) {
            $error = "Categoria obrigatoria";
        }
        if (!$error) {
            $nomeEsc = mysqli_real_escape_string($link, $nome);
            $precoEsc = mysqli_real_escape_string($link, $preco);
            $categoriaEsc = (int)$categoria;

            $sql = "";
            $sql .= " INSERT INTO produto ";
            $sql .= " (nome, preco, categoria) ";
            $sql .= " VALUES ";
            $sql .= "('".$nomeEsc."', '".$precoEsc."', '".$categoriaEsc."')";
            $result = mysqli_query($link, $sql);
            header("Location: /ecommerce/admin/produto");
            exit;
        }
    }
?>

<h3>ADICIONAR PRODUTO</h3>

<form method = "POST">
    <table>
        <tr>
            <td style="text-align: right;">Nome:</td>
            <td> 
                <input type="text" name="nome" value="<?=isset($nome) ?htmlspecialchars($nome):""?>">
            </td>
            </td>
        <tr>
        <tr>
            <td style="text-align: right;">Preco:</td>
            <td> 
                <input type="text" name="preco" value="<?=isset($preco) ?htmlspecialchars($preco):""?>">
            </td>
            </td>
        <tr>
        <tr>
            <td style="text-align: right;">Categoria:</td>
            <td>
                <select name="categoria">
                    <option value="">-- selecione --</option>
                    <?php foreach ($categorias as $cat): ?>
                        <option value="<?= $cat['id'] ?>" <?= (isset($categoria) && $categoria == $cat['id']) ? 'selected' : '' ?>>
                            <?= htmlspecialchars($cat['nome']) ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </td>
            </td>
        <tr>
            <td colspan="2" style="text-align: center;">
                <input type="submit" name="submit" value="Cadastrar">
            </td>
        </tr>
    </table>
</form>

<?php
    include("../../footer.php");
?>

