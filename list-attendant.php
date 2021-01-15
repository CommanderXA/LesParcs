<?php
    require_once 'secure.php';
    if (!Helper::can('admin')) {
        header('Location: 404.php');
        exit();
    }
    $size = 10;
    if (isset($_GET['page'])) {
        $page = Helper::clearInt($_GET['page']);
    } else {
        $page = 1;
    }
    $attendantMap = new AttendantMap();
    $count = $attendantMap->count();
    $attendants = $attendantMap->findAll($page*$size-$size, $size);
    $header = 'Park Attendants';
    require_once 'template/header.php';
?>
    <div class="row">
        <div class="col-xs-12">
            <div class="box">
            <section class="content-header">
                <h1>Park Attendants</h1>
                <ol class="breadcrumb">
                    <li><a href="/index.php"><i class="fa fa-dashboard"></i> Main</a></li>
                    <li class="active">Attendants List</li>
                </ol>
            </section>
            <div class="box-body">
                <a class="btn btn-success" href="add-attendant.php">Add Attendant</a>
            </div>
            <!-- /.box-header -->
                <div class="box-body">
                <?php
                    if ($attendants) {
                ?>

                <table id="example2" class="table table-bordered table-hover">

                    <thead>
                        <tr>
                            <th>Username</th>
                            <th>First Name</th>
                            <th>Last Name</th>
                            <th>Role</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                            foreach ($attendants as $attendant) {
                                echo '<tr>';
                                echo '<td><a href="profile-attendant.php?id='.$attendant->user_id.'">'.$attendant->username.'</a> ' . '<a href="add-attendant.php?id='.$attendant->user_id.'"><i class="fa fa-pencil"></i></a></td>';
                                echo '<td>'.$attendant->firstname.'</td>';
                                echo '<td>'.$attendant->lastname.'</td>';
                                echo '<td>'.$attendant->role.'</td>';
                                echo '<td><a href="delete-user.php?id='.$attendant->user_id.'&role='.$attendant->role.'"><i class="fa fa-trash"></i> Delete</a></td>';
                                echo '</tr>';
                            }
                        ?>
                    </tbody>
                </table>
                <?php 
                    } else {
                        echo 'No attendants found';
                    } 
                ?>
                </div>
                <div class="box-body">
                    <?php Helper::paginator($count, $page, $size); ?>
                </div>
            <!-- /.box-body -->
            </div>
        </div>
    </div>
<?php
    require_once 'template/footer.php';
?>