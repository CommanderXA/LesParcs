<?php
    require_once 'secure.php';
    if (!Helper::can('admin')) {
        header('Location: 404.php');
        exit();
    }
    $id = Helper::clearInt($_GET['id']);
    if ((new AttendantMap())->findById($id)->validate()) {
        $attendant = (new UserMap())->findProfileById($id);
    } else {
        header('Location: 404.php');
    }
    $header = 'Schedule of Attendant: '.$attendant->full_name;
    $daysSchedules = (new SchedulesMap())->findByAttendantId($id);
    require_once 'template/header.php';
?>
<div class="row">
    <div class="col-xs-12">
        <div class="box">
            <section class="content-header">
            <ol class="breadcrumb">
                <li><a href="/index.php"><i class="fa fa-dashboard"></i> Main</a></li>
                <li><a href="list-attendant-schedule.php">Schedule</a></li>
                <li class="active"><?=$header;?></li>
            </ol>
            </section>
            <section class="box-body">
                <h3><?=$header;?></h3>
            </section>
            <div class="box-body">
                <?php if ($daysSchedules) : ?>
                <table class="table table-bordered table-hover">
                    <?php foreach ($daysSchedules as $day) : ?>
                        <tr>
                            <th colspan="6">
                                <h4 class="center-block">
                                    <?=$day['name'];?>
                                    <a href="add-schedule.php?idUser=<?=$id;?>&idDay=<?=$day['id'];?>"><i class="fa fa-plus"></i></a>
                                </h4>
                            </th>
                        </tr>

                    <?php if ($day['plant']) : ?>
                        <?php foreach ($day['plant'] as $plant) : ?>
                            <?php foreach
                                ($plant['schedule'] as $schedule ) : ?>
                                <tr>
                                    <td><b><?=$plant['name'];?></b></td>
                                    <td>id: <?=$plant['id'];?></td>
                                    <td><?=$schedule['time'];?></td>
                                    <td><?=$plant['zone'];?></td>
                                    <td><?=$plant['park'];?></td>
                                    <td><a href="delete-schedule.php?id=<?=$schedule['schedules_id'];?>&idAttendant=<?=$id;?>"><i class="fa fa-trash"></i></a></td>
                                </tr>
                            <?php endforeach;?>
                        <?php endforeach;?>
                        <?php else: ?>
                            <tr>
                                <td colspan="6">No schedule for this day</td>
                            </tr>
                        <?php endif; ?>
                    <?php endforeach;?>
                </table>
                <?php else: ?>
                    <p>No schedule</p>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>
<?php
    require_once 'template/footer.php';
?>