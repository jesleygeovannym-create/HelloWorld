<?php
session_start();

if (isset($_GET['id'])) {

    $id = $_GET['id'];

    unset($_SESSION['productos'][$id]);

    $_SESSION['productos'] = array_values($_SESSION['productos']);
}

header('Location: index.php');
exit;
?>