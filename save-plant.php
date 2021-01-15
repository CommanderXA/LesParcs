<?php
    require_once 'secure.php';
    if (!Helper::can('admin')) {
        header('Location: 404.php');
        exit();
    }
    if (isset($_POST['plant_id'])) {
        $plant = new Plant();
        $plant->plant_id = Helper::clearInt($_POST['plant_id']);
        $plant->species_id = Helper::clearInt($_POST['species_id']);
        $plant->plant_age = Helper::clearString($_POST['plant_age']);
        $plant->date_planted = Helper::clearString($_POST['date_planted']);
        $plant->zone_id = Helper::clearInt($_POST['zone_id']);
        if ((new PlantMap())->save($plant)) {
            header('Location: view-plant.php?id='.$plant->plant_id);
        } else {
            if ($plant->plant_id) {
                header('Location: add-plant.php?id='.$plant->plant_id);
            } else {
                header('Location: add-plant.php');
            }
        }
    }
?>