<?php
    include("../config.inc.php");
    include("../session.php");
    validaSessao();

    if(!$_GET["id"])
    {
        header("Location: /ecommerce/admin/produto");
        exit;
    }
    
            $link = mysqli_connect("localhost", "root", "", "ecommerce");
            $sql = "";
            $sql = "SELECT * FROM produto WHERE id = '".$_GET["id"]."';";
            $result = mysqli_query($link, $sql);

            if(mysqli_num_rows($result) == 0)
            {
                header("Location: /ecommerce/admin/produto");
                exit;
            }
            $row = mysqli_fetch_assoc($result);

            if(isset($_GET["del"]) && ($_GET["del"] == "yes"))
            {
                $link = mysqli_connect("localhost", "root", "", "ecommerce");
                $sql = "DELETE FROM produto WHERE id = '".$_GET["id"]."';";
                $result = mysqli_query($link, $sql);
                 header("Location: /ecommerce/admin/produto");
                exit;
            }
            include("../../header.php");
            include("../menu.php");
?>

<h3>APAGAR PRODUTO</h3>

<table>
    <tr>
        <td colspan="2" style="text-align: center;">
            Tem certeza que deseja apagar o produto "<?=$row["nome"];?>"?
        </td>
    <tr>
    <tr>
        
    <tr>
        <td style="text-align: center;">
            <a href="/ecommerce/admin/produto/del.php?id=<?=$row["id"];?>&del=yes"><input type="button" value="SIM">
        </td> 
        <td>   
            <a href="/ecommerce/admin/produto/"><input type="button" value="NÃO">
        </td>
    </tr>
</table>

<?php
    include("../../footer.php");
?>

