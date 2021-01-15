<?php
    require_once 'secure.php';
    if (!Helper::can('admin')) {
        header('Location: 404.php');
        exit();
    }
    $id = Helper::clearInt($_GET['id']);
    if ((new PlanMap())->existsPlanByPlantId($id) || !(new PlantMap())->delete($id)) {
        Helper::setFlash('Could not delete the plant. It has associated plants (Delete them first).');
    }
    header('Location: list-plant.php');
?>