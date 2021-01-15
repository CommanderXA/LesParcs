<?php
    require_once 'secure.php';
    if (!Helper::can('admin')) {
        header('Location: 404.php');
        exit();
    }
    $id = Helper::clearInt($_GET['id']);
    if ((new ZoneMap())->existsZoneByParkId($id) || !(new ParkMap())->delete($id)) {
        Helper::setFlash('Could not delete the park. It has associated zones (Delete them first).');
    }
    header('Location: list-park.php');
?>