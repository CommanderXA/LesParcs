<?php
    require_once 'secure.php';
    $header = 'List Day Attendant Workers';
    $attendants = (new AttendantMap())->findAttendantsByDays();
    require_once 'template/header.php';
?>
<div class="row">
    <div class="col-xs-12">
        <div class="box">
            <section class="box-body">
                <h3><?=$header;?></h3>
            </section>
            <div class="box-body">
                <?php if ($attendants) : ?>
                    <table class="table table-bordered table-hover">
                        <?php foreach ($attendants as $day) : ?>
                            <tr>
                                <th colspan="5">
                                    <h4 class="center-block">
                                        <b><?=$day['name'];?></b>
                                    </h4>
                                </th>
                            </tr>

                        <?php if ($day['attendant']) : ?>
                            <?php foreach ($day['attendant'] as $attendant) : ?>
                                    <tr>
                                        <td><?=$attendant['full_name'];?></td>
                                        <td><?=$attendant['time'];?></td>
                                        <td><?=$attendant['username'];?></td>
                                        <td><?=$attendant['address'];?></td>
                                        <td><?=$attendant['phone'];?></td>
                                    </tr>
                                
                            <?php endforeach;?>
                            <?php else: ?>
                                <tr>
                                    <td colspan="5">No workers for this day</td>
                                </tr>
                            <?php endif; ?>
                        <?php endforeach;?>
                    </table>
                <?php else: ?>
                    <p>No workers</p>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>
<?php
    require_once 'template/footer.php';
?>