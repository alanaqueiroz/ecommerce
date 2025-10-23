<?php
    include("../config.inc.php");
    include("../session.php");
    validaSessao();

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        extract($_POST);
        $error = "";
        if(!$nome){
            $error = "Nome obrigatorio";
        }
        if(!$preco){
            $error = "Preco obrigatorio";
        }
        if(!$error){
            $link = mysqli_connect("localhost", "root", "", "ecommerce");
            $sql = "";
            $sql .= " INSERT INTO categoria ";
            $sql .= " (nome, preco) ";
            $sql .= " VALUES ";
            $sql .= "('".$nome."', '".$preco."')";
            $result = mysqli_query($link, $sql);
            header("Location: /ecommerce/admin/categoria");
            exit;
        }
    }
?>

<h3>ADICIONAR CATEGORIA</h3>

<form method = "POST">
    <table>
        <tr>
            <td style="text-align: right;">Nome:</td>
            <td> 
                <input type="text" name="nome" value="<?=isset($nome) ?$nome:""?>">
            </td>
            </td>
        <tr>
        <tr>
            <td style="text-align: right;">Nome:</td>
            <td> 
                <input type="text" name="preco" value="<?=isset($preco) ?$preco:""?>">
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

