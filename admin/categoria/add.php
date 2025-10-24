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
        if(!$descricao){
            $error = "Descrição obrigatorio";
        }
        if(!$error){
            $link = mysqli_connect("localhost", "root", "", "ecommerce");
            $sql = "";
            $sql .= " INSERT INTO categoria ";
            $sql .= " (nome, descricao) ";
            $sql .= " VALUES ";
            $sql .= "('".$nome."', '".$descricao."')";
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
            <td style="text-align: right;">Descrição:</td>
            <td> 
                <input type="text" name="descricao" value="<?=isset($descricao) ?$descricao:""?>">
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

