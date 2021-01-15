<?php
    require_once 'secure.php';
    if (!Helper::can('admin')) {
        header('Location: 404.php');
        exit();
    }
    if (isset($_POST['park_id'])) {
        $park = new Park();
        $park->park_id = Helper::clearInt($_POST['park_id']);
        $park->name = Helper::clearString($_POST['name']);
        $park->active = Helper::clearInt($_POST['active']);

        if ((new ParkMap())->save($park)) {
            header('Location: view-park.php?id='.$park->park_id);
        } else {
            if ($park->park_id) {
                header('Location: add-park.php?id='.$park->park_id);
            } else {
                header('Location: add-park.php');
            }
        }
    }
?>