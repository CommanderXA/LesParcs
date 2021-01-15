<?php
    require_once 'secure.php';
    if (!Helper::can('admin')) {
        header('Location: 404.php');
        exit();
    }
    $id = Helper::clearInt($_GET['id']);
    if ((new PlantMap())->existsPlantByZoneId($id) || !(new ZoneMap())->delete($id)) {
        Helper::setFlash('Could not delete the zone. It has associated plants (Delete them first).');
    }
    header('Location: list-zone.php');
?>