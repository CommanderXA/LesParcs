<?php
    require_once 'secure.php';
    if (!Helper::can('admin')) {
        header('Location: 404.php');
        exit();
    }
    $idUser = Helper::clearInt($_GET['idUser']);
    $idDay = Helper::clearInt($_GET['idDay']);
    if ((new AttendantMap())->findById($idUser)->validate()) {
        $attendant = (new UserMap())->findProfileById($idUser);
    } else {
        header('Location: 404.php');
    }
    $schedule = new ScheduleMap();
    $day = $schedule->findDayById($idDay);
    $header = 'Add Schedule. Day: '.$day->name. '. Attendaer: '.$attendant->full_name;
    require_once 'template/header.php';
?>
<section class="content-header">
    <ol class="breadcrumb">
        <li><a href="/index.php"><i class="fa fa-dashboard"></i> Main</a></li>
        <li><a href="list-attendant-schedule.php">Schedule</a></li>
        <li><a href="list-schedule.php?id=<?=$idUser;?>">Attender's schedule</a></li>
        <li class="active"><?=$header;?></li>
    </ol>
</section>
<section class="box-body">
    <h3><?=$header;?></h3>
</section>
<div class="box-body">
    <?php if (Helper::hasFlash()) :?>
    <div class="alert alert-danger alert-dismissible">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
        <h4><i class="icon fa fa-ban"></i> Error</h4>
        <?= Helper::getFlash();?>
    </div>
    <?php endif;?>
    <form action="save-schedule.php" method="POST">
        <div class="form-group">
            <label>Plan and Plant</label>
            <select class="form-control" name="plan_id">
                <?= Helper::printSelectOptions(0, (new PlanMap())->arrPlanByattendantId($idUser));?>
            </select>
        </div>
        <div class="form-group">
            <label>Time</label>
            <select class="form-control" name="watering_time_id">
                <?= Helper::printSelectOptions($schedule->watering_time_id, (new Time())->arrTimes());?>
            </select>
        </div>
        <input type="hidden" name="day_id" value="<?=$idDay;?>" />
        <input type="hidden" name="user_id" value="<?=$idUser;?>" />
        <div class="form-group">
            <button type="submit" name="saveSchedule" class="btn btn-primary">Save</button>
        </div>
    </form>
</div>
<?php
    require_once 'template/footer.php';
?>