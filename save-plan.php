<?php
    require_once 'secure.php';
    if (!Helper::can('admin')) {
        header('Location: 404.php');
        exit();
    }
    if (isset($_POST['plant_id'])) {
        $plan = new Plan();
        $plan->user_id = Helper::clearInt($_POST['user_id']);
        $plan->plant_id = Helper::clearInt($_POST['plant_id']);
        $planMap = new PlanMap();
        if ($plan->validate() && !$planMap->existsPlan($plan)) {
            if ($planMap->save($plan)) {
                header('Location: list-plan.php?id='.$plan->user_id);
            } else {
                Helper::setFlash('Could not save the plan.');
                header('Location: add-plan.php?id='.$plan->user_id);
            }
        } else {
            Helper::setFlash('Such plan already exists.');
            header('Location: add-plan.php?id='.$plan->user_id);
        }
    } else {
        Helper::setFlash('There is no free plants. <a href="add-plant.php">Create them first.</a>');
        header('Location: add-plan.php');
    }
?>