<?php
    require_once 'secure.php';
    $header = 'Your Schedule';
    $userIdentity = (new UserMap())->identity($_SESSION['id']);
    if ($userIdentity == UserMap::ATTENDANT) {
        $schedules = (new ScheduleMap())->findByAttendantId($_SESSION['id']);
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
                        <?php endforeach;?>
                            <?php else: ?>
                                <tr>
                                    <td colspan="3">You have no Schedule for this day</td>
                                </tr>
                            <?php endif; ?>
                        <?php endforeach;?>
                    </table>
                <?php else: ?>
                <p>You have no Schedule</p>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>
<?php
    require_once 'template/footer.php';
?>