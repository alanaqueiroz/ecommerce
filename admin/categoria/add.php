<?php
    include("../config.inc.php");
    include("../session.php");
    validaSessao();
    include("../../header.php");
    include("../menu.php");

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        extract($_POST);
        $error = "";
        if(!$nome){
            $error = "Nome obrigatorio";
        }
        if(!$error){
            $link = mysqli_connect("localhost", "root", "", "ecommerce");
            $sql = "";
            $sql .= " INSERT INTO categoria ";
            $sql .= " (nome) ";
            $sql .= " VALUES ";
            $sql .= "('".$nome."')";
            $result = mysqli_query($link, $sql);
            header("Location: /ecommerce/admin/categoria");
            exit;
        }
    }
?>

<h3>ADICIONAR CATEGORIA</h3>

<form method="POST">
    <table>
        <tr>
            <td style="text-align: right;">Nome:</td>
            <td>
                <input type="text" name="nome" value="<?=isset($nome) ? $nome : ""?>">
            </td>
        </tr>
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

