<?php
include("./config.inc.php");
include("../header.php");
include("./menu.php");
?>

<?php
if (isset($_GET["a"])) {
	if (isset($_COOKIE["carrinho"])) {
		if (strpos($_COOKIE["carrinho"], "'".$_GET["a"]."'") === false) {
			setcookie("carrinho", $_COOKIE["carrinho"].",'".$_GET["a"]."'",
				time()+60*60*24*30);
		}
	} else {
		setcookie("carrinho", "'".$_GET["a"]."'", time()+60*60*24*30);
	}
	header("Location: /ecommerce/user/carrinho.php");
	exit;
} elseif (isset($_GET["r"])) {
	if (isset($_COOKIE["carrinho"])) {
		if (strpos($_COOKIE["carrinho"], "'".$_GET["r"]."'") !== false) {
			$carrinho = $_COOKIE["carrinho"];
			$carrinho = str_replace(",'".$_GET["r"]."'," , ",", $carrinho);
			$carrinho = str_replace("'".$_GET["r"]."'," , "", $carrinho);
			$carrinho = str_replace(",'".$_GET["r"]."'" , "", $carrinho);
			$carrinho = str_replace("'".$_GET["r"]."'" , "", $carrinho);
			setcookie("carrinho", $carrinho, time()+60*60*24*30);
		}
	}
	header("Location: /ecommerce/user/carrinho.php");
	exit;
}
?>

<h3>CARRINHO</h3>

<?php
if (isset($_COOKIE["carrinho"])) {
	$link = mysqli_connect("localhost", "root", "", "ecommerce");
	$sql = "SELECT * FROM produto WHERE id IN (".$_COOKIE["carrinho"].") ORDER BY nome";
	$result = mysqli_query($link, $sql);
	if ($result) {
		while ($row = mysqli_fetch_assoc($result)) {
			echo "<a href=\"/ecommerce/user/carrinho.php?r=".$row["id"]."\" style=\"color: black;\">(-)</a> ".$row["nome"]."<br>";
		}
	}
} else {
	echo "Carrinho Vazio!<br>";
}
?>

<?php
include("../footer.php");
?>