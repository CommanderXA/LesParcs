<?php
    require_once 'secure.php';
    if (!Helper::can('admin')) {
        header('Location: 404.php');
        exit();
    }
    if (isset($_POST['plan_id'])) {
        $schedule = new Schedules();
        $schedule->plan_id = Helper::clearInt($_POST['plan_id']);
        $schedule->day_id = Helper::clearInt($_POST['day_id']);
        $schedule->watering_time_id = Helper::clearInt($_POST['watering_time_id']);
        $userId = Helper::clearInt($_POST['user_id']);
        $scheduleMap = new SchedulesMap();
        if ($schedule->validate() && !$scheduleMap->existsSchedulesAttendantAndPlant($schedule)) {
            if ($scheduleMap->save($schedule)) {
                header('Location: list-schedule.php?id='.$userId);
            } else {
                Helper::setFlash('Failed to save schedule.');
                header('Location: add-schedule.php?idUser='.$userId.'&idDay='.$schedule->day_id);
            }
        } else {
            Helper::setFlash('Such schedule for Attendant and Plant already exists.');
            header('Location: add-schedule.php?idUser='.$userId.'&idDay='.$schedule->day_id);
        }
    } else {
        header('Location: 404.php');
    }
?>