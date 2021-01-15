<?php
    require_once 'secure.php';
    if (!Helper::can('admin')) {
        header('Location: 404.php');
        exit();
    }
    $id = Helper::clearInt($_GET['id']);
    (new TimeMap())->delete($id);
    if ((new TimeMap())->existsTimeById($id) || !(new TimeMap())->delete($id)) {
        Helper::setFlash('Could not delete the time (An error occured).');
    }
    header('Location: list-time.php');
?>