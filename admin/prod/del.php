<?php
    include("../config.inc.php");
    include("../session.php");
    validaSessao();

    if(!$_GET["id"])
    {
        header("Location: /ecommerce/admin/prod");
        exit;
    }
    
            $link = mysqli_connect("localhost", "root", "", "sistema");
            $sql = "";
            $sql = "SELECT * FROM prod WHERE id = '".$_GET["id"]."';";
            $result = mysqli_query($link, $sql);

            if(mysqli_num_rows($result) == 0)
            {
                header("Location: /ecommerce/admin/prod");
                exit;
            }
            $row = mysqli_fetch_assoc($result);

            if(isset($_GET["del"]) && ($_GET["del"] == "yes"))
            {
                $link = mysqli_connect("localhost", "root", "", "sistema");
                $sql = "DELETE FROM prod WHERE id = '".$_GET["id"]."';";
                $result = mysqli_query($link, $sql);
                 header("Location: /ecommerce/admin/prod");
                exit;
            }
            include("../../header.php");
            include("../menu.php");
?>

<h3>APAGAR PRODUTO</h3>

<table>
    <tr>
        <td colspan="2" style="text-align: center;">
            Tem certeza que deseja apagar o produto? "<?=$row["nome"];?>"
        </td>
    <tr>
    <tr>
        
    <tr>
        <td style="text-align: center;">
            <a href="/ecommerce/admin/prod/del.php?id=<?=$row["id"];?>&del=yes"><input type="button" value="SIM">
        </td> 
        <td>   
            <a href="/ecommerce/admin/prod/"><input type="button" value="NÃO">
        </td>
    </tr>
</table>

<?php
    include("../../footer.php");
?>

