<?php
    require_once 'secure.php';
    if (!Helper::can('admin')) {
        header('Location: 404.php');
        exit();
    }
    if (isset($_GET['id'])) {
        $id = Helper::clearInt($_GET['id']);
    } else {
        header('Location: 404.php');
    }
    $header = 'Profile of an Attendant';
    $attendant = (new AttendantMap())->findProfileById($id);
    require_once 'template/header.php';
?>
<div class="row">
    <div class="col-xs-12">
        <div class="box">
            <section class="content-header">
            <h1>Profile of an Attendant</h1>
            <ol class="breadcrumb">
                <li><a href="index.php"><i class="fa fa-dashboard"></i> Main</a></li>
                <li><a href="list-attendant.php">Attendants</a></li>
                <li class="active">Profile</li>
            </ol>
            </section>
            <div class="box-body">
                <a class="btn btn-success" href="add-attendant.php?id=<?=$id;?>">Change</a>
            </div>
            <div class="box-body">

                <table class="table table-bordered table-hover">
                    <?php require_once '_profile.php';?>
                    <tr>
                        <th>Blocked</th>
                        <td><?=($user->active) ? 'No' : 'Yes';?></td>
                    </tr>
                </table>
            </div>
        </div>
    </div>
</div>
<?php
    require_once 'template/footer.php';
?>