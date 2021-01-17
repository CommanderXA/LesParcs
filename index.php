<?php
    require_once 'secure.php';
    $header = 'Your Schedule';
    $userIdentity = (new UserMap())->identity($_SESSION['id']);
    if ($userIdentity == UserMap::ATTENDANT) {
        $schedules = (new SchedulesMap())->findByAttendantId($_SESSION['id']);
    } else {
        $schedules = null;
    }
    require_once 'template/header.php';
?>
<div class="row">
    <div class="col-xs-12">
        <div class="box">
            <section class="box-body">
                <h3><?=$header;?></h3>
            </section>
            <div class="box-body">
                <?php if ($schedules) : ?>
                    <table class="table table-bordered table-hover">
                        <?php foreach ($schedules as $day) : ?>
                            <tr>
                                <th colspan="5">
                                    <h4 class="center-block">
                                        <?=$day['name'];?>
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
                                    </tr>
                                <?php endforeach;?>
                            <?php endforeach;?>
                            <?php else: ?>
                                <tr>
                                    <td colspan="5">No schedule for this day</td>
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