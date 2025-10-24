<?php
function contaValida($username, $password)
{
    $link = mysqli_connect("localhost", "root", "", "ecommerce");
    $sql = "SELECT id FROM account WHERE username = ? AND password = ? LIMIT 1";
    $stmt = mysqli_prepare($link, $sql);
    mysqli_stmt_bind_param($stmt, "ss", $username, $password);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    $ok = ($result && mysqli_fetch_assoc($result)) ? true : false;
    mysqli_stmt_close($stmt);
    mysqli_close($link);
    return $ok;
}
function registraConta($username)
{
    session_start();
    session_unset();
    $link = mysqli_connect("localhost", "root", "", "ecommerce");
    $sql = "SELECT id FROM account WHERE username = ? LIMIT 1";
    $stmt = mysqli_prepare($link, $sql);
    mysqli_stmt_bind_param($stmt, "s", $username);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    if ($result && ($row = mysqli_fetch_assoc($result))) {
        $_SESSION["CONTA_ID"] = $row["id"];
    }
    mysqli_stmt_close($stmt);
    mysqli_close($link);
}
function logout()
{
    session_start();
    session_unset();
    session_destroy();
    header("Location: /ecommerce/user/login.php");
    exit;
}
function validaSessao()
{
    session_start();
    if (empty($_SESSION["CONTA_ID"])) {
        header("Location: /ecommerce/user/login.php");
        exit;
    }
}
?>
