<?php
    include("../config.inc.php");
    include("../session.php");
    validaSessao();

    $id = null;
    if (isset($_GET['id']) && $_GET['id'] !== '') {
        $id = intval($_GET['id']);
    } elseif (isset($_POST['id']) && $_POST['id'] !== '') {
        $id = intval($_POST['id']);
    }

    if (!$id) {
        header("Location: /ecommerce/admin/produto");
        exit;
    }

    $link = mysqli_connect("localhost", "root", "", "ecommerce");
    mysqli_set_charset($link, "utf8");

    $sql = "SELECT * FROM produto WHERE id = '".mysqli_real_escape_string($link, $id)."';";
    $result = mysqli_query($link, $sql);

    if (!$result || mysqli_num_rows($result) == 0) {
        header("Location: /ecommerce/admin/produto");
        exit;
    }
    $row = mysqli_fetch_assoc($result);
    $nome = $row['nome'];
    $preco = $row['preco'];
    $categoria = $row['categoria'];

    $cats = [];
    $r2 = mysqli_query($link, "SELECT id, nome FROM categoria ORDER BY nome;");
    if ($r2) {
        while ($c = mysqli_fetch_assoc($r2)) {
            $cats[] = $c;
        }
    }

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $nome_post = isset($_POST['nome']) ? trim($_POST['nome']) : '';
        $preco_post = isset($_POST['preco']) ? trim($_POST['preco']) : '';
        $categoria_post = isset($_POST['categoria']) && $_POST['categoria'] !== '' ? intval($_POST['categoria']) : null;

        $error = "";
        if ($nome_post === "") {
            $error = "Nome obrigatorio";
        }
        if ($preco_post === "") {
            $error = "Preco obrigatorio";
        }

        if (!$error) {
            $nome_esc = mysqli_real_escape_string($link, $nome_post);
            $preco_esc = mysqli_real_escape_string($link, $preco_post);
            $categoria_sql = is_null($categoria_post) ? "NULL" : "'".mysqli_real_escape_string($link, $categoria_post)."'";

            $sql_up = "UPDATE produto SET nome = '".$nome_esc."', preco = '".$preco_esc."', categoria = ".$categoria_sql." WHERE id = '".mysqli_real_escape_string($link, $id)."';";
            mysqli_query($link, $sql_up);
            header("Location: /ecommerce/admin/produto");
            exit;
        }

        $nome = $nome_post;
        $preco = $preco_post;
        $categoria = $categoria_post;
    }
?>

<h3>Editar Produto</h3>

<?php if (!empty($error)): ?>
    <div style="color: red;"><?= htmlspecialchars($error, ENT_QUOTES, 'UTF-8'); ?></div>
<?php endif; ?>

<form method="POST">
    <input type="hidden" name="id" value="<?= htmlspecialchars($id, ENT_QUOTES, 'UTF-8'); ?>">
    <table>
        <tr>
            <td style="text-align: right;">Nome:</td>
            <td>
                <input type="text" name="nome" value="<?= htmlspecialchars($nome ?? '', ENT_QUOTES, 'UTF-8'); ?>">
            </td>
        </tr>
        <tr>
            <td style="text-align: right;">Preço:</td>
            <td>
                <input type="text" name="preco" value="<?= htmlspecialchars($preco ?? '', ENT_QUOTES, 'UTF-8'); ?>">
            </td>
        </tr>
        <tr>
            <td style="text-align: right;">Categoria:</td>
            <td>
                <select name="categoria">
                    <?php foreach ($cats as $c): ?>
                        <option value="<?= htmlspecialchars($c['id'], ENT_QUOTES, 'UTF-8'); ?>" <?= ($categoria !== null && intval($categoria) === intval($c['id'])) ? 'selected' : ''; ?>>
                            <?= htmlspecialchars($c['nome'], ENT_QUOTES, 'UTF-8'); ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </td>
        </tr>
        <tr>
            <td colspan="2" style="text-align: center;">
                <input type="submit" name="submit" value="Editar">
            </td>
        </tr>
    </table>
</form>

<?php
    include("../../footer.php");
?>

