<?php
    require_once 'secure.php';
    if (!Helper::can('admin')) {
        header('Location: 404.php');
        exit();
    }
    if (isset($_POST['zone_id'])) {
        $zone = new Zone();
        $zone->zone_id = Helper::clearInt($_POST['zone_id']);
        $zone->park_id = Helper::clearInt($_POST['park_id']);
        $zone->name = Helper::clearString($_POST['name']);
        $zone->active = Helper::clearInt($_POST['active']);
        if ((new ZoneMap())->save($zone)) {
            header('Location: view-zone.php?id='.$zone->zone_id);
        } else {
            if ($zone->zone_id) {
                header('Location: add-zone.php?id='.$zone->zone_id);
            } else {
                header('Location: add-zone.php');
            }
        }
    }
?>