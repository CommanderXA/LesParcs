<?php
    require_once 'secure.php';
    if (!Helper::can('admin')) {
        header('Location: 404.php');
        exit();
    }
    $id = Helper::clearInt($_GET['id']);
    $idAttender = Helper::clearInt($_GET['idAttender']);
    (new ScheduleMap())->delete($id);
    header('Location: list-schedule.php?id='.$idAttender);
?>