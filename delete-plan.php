<?php
    require_once 'secure.php';
    if (!Helper::can('admin')) {
        header('Location: 404.php');
        exit();
    }
    $id = Helper::clearInt($_GET['id']);
    $idPlan = Helper::clearInt($_GET['idplan']);
    if ((new ScheduleMap())->existsScheduleByPlanId($id) || !(new PlanMap())->delete($id)) {
        Helper::setFlash('Could not delete the plan. It has schedules (Delete them first).');
    }
    header('Location: list-plan.php?id='.$idPlan);
?>