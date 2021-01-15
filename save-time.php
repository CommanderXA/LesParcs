<?php
    require_once 'secure.php';
    if (!Helper::can('admin')) {
        header('Location: 404.php');
        exit();
    }
    if (isset($_POST['watering_time_id'])) {
        $time = new Time();
        $time->watering_time_id = Helper::clearInt($_POST['watering_time_id']);
        $time->watering_time = Helper::clearString($_POST['watering_time']);
        if ((new TimeMap())->save($time)) {
            header('Location: view-time.php?id='.$time->watering_time_id);
        } else {
            if ($time->watering_time_id) {
                header('Location: add-time.php?id='.$time->watering_time_id);
            } else {
                header('Location: add-time.php');
            }
        }
    }
?>