<?php
    include("../config.inc.php");
    include("../session.php");
    validaSessao();
    include("../../header.php");
    include("../menu.php");

    if (!isset($_SESSION['CONTA_ROLE']) || $_SESSION['CONTA_ROLE'] !== 'admin') {
        header("Location: /ecommerce/admin/produto");
        exit;
    }
    $currentUserId = isset($_SESSION['CONTA_ID']) ? (int)$_SESSION['CONTA_ID'] : 0;

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
        $nome = isset($_POST['nome']) ? trim($_POST['nome']) : '';
        $preco = isset($_POST['preco']) ? trim($_POST['preco']) : '';
        $categoria = isset($_POST['categoria']) ? trim($_POST['categoria']) : '';

        $error = "";
        if ($nome === "") { $error = "Nome obrigatorio"; }
        if ($preco === "") { $error = "Preco obrigatorio"; }
        if ($categoria === "") { $error = "Categoria obrigatoria"; }

        if (!$error) {
            $nomeEsc = mysqli_real_escape_string($link, $nome);
            $precoEsc = mysqli_real_escape_string($link, $preco);
            $categoriaEsc = (int)$categoria;
            $ownerIdEsc = $currentUserId;

            $sql = "INSERT INTO produto (nome, preco, categoria, owner_id) VALUES ('".$nomeEsc."', '".$precoEsc."', '".$categoriaEsc."', '".$ownerIdEsc."')";
            mysqli_query($link, $sql);
            header("Location: /ecommerce/admin/produto");
            exit;
        }
    }
?>

<h3>ADICIONAR PRODUTO</h3>

<form method = "POST">
    <table>
        <tr>
            <td>Nome:
                <input type="text" name="nome" value="<?=isset($nome) ?htmlspecialchars($nome):""?>">
            </td>
        <tr>
        <tr>
            <td>Preco:
                <input type="text" name="preco" value="<?=isset($preco) ?htmlspecialchars($preco):""?>">
            </td>
        <tr>
        <tr>
            <td>Categoria:
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
    </table>
    <br>
    <tr>
        <td colspan="2" style="text-align: center;">
            <input type="submit" name="submit" value="Cadastrar">
        </td>
    </tr>
</form>

<?php
    include("../../footer.php");
?>

