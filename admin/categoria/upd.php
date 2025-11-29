<?php
    include("../config.inc.php");
    include("../session.php");
    validaSessao();    
    include("../../header.php");
    include("../menu.php");

    $id = "";
    if(($_GET["id"]).$id = $_GET["id"]);
    elseif($_POST["id"]) $id = $_POST["id"];

     IF(!$id)
    {
        header("Location: /ecommerce/admin/categoria");
        exit;
    }
    
    $link = mysqli_connect("localhost", "root", "", "ecommerce");
    $sql = "";
    $sql .= "SELECT * FROM categoria WHERE id = '".$id."';";
    $result = mysqli_query($link, $sql);

    if(mysqli_num_rows($result) == 0)
    {
        header("Location: /ecommerce/admin/categoria");
        exit;
    }
    $row = mysqli_fetch_assoc($result);
    extract($row);

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        extract($_POST);
        $error = "";
        if(!$nome){
            $error = "Nome obrigatorio";
        }
        if(!$error){
            $link = mysqli_connect("localhost", "root", "", "ecommerce");
            $sql = "UPDATE categoria SET nome = '".$nome."' WHERE id = '".$id."';";
            $result = mysqli_query($link, $sql);
            header("Location: /ecommerce/admin/categoria");
            exit;
        }
    }
?>

<h3>EDITAR CATEGORIA</h3>

<form method = "POST">
    <table>
        <tr>
            <td>Nome:</td>
            <td> 
                <input type="text" name="nome" value="<?=isset($nome) ?$nome:""?>">
            </td>
        </tr>
    </table>
    <br>
    <tr>
        <td colspan="2">
            <input type="submit" name="submit" value="Confirmar">
        </td>
    </tr>
</form>

<?php
    include("../../footer.php");
?>

