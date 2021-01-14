<?php
    require_once 'secure.php';
    if (!Helper::can('admin')) {
        header('Location: 404.php');
        exit();
    }
    $id = 0;
    if (isset($_GET['id'])) {
        $id = Helper::clearInt($_GET['id']);
    }
    $attendant = (new AttendantMap())->findById($id);
    $header = (($id)?'Edit the':'Add an').' attendant';
    require_once 'template/header.php';
?>
<section class="content-header">
    <h1><?=$header;?></h1>
    <ol class="breadcrumb">
        <li><a href="/index.php"><i class="fa fa-dashboard"></i> Main</a></li>
        <li><a href="list-attendant.php">Attendants</a></li>
        <li class="active"><?=$header;?></li>
    </ol>
</section>
<div class="box-body">
    <form action="save-user.php" method="POST">
    <?php require_once '_formUser.php'; ?>
        <div class="form-group">
            <label>Role</label>
            <select class="form-control" name="role_id">
                <?= Helper::printSelectOptions($user->role_id, $userMap->arrRoles());?>
            </select>
        </div>
        <div class="form-group">
            <label>Block</label>
            <div class="radio">
                <label>
                    <input type="radio" name="active" value="1" <?=($user->active)?'checked':'';?>> No
                </label> &nbsp;
                <label>
                    <input type="radio" name="active" value="0" <?=(!$user->active)?'checked':'';?>> Yes
                </label>
            </div>
        </div>
        <div class="form-group">
            <button type="submit" name="saveAttendant" class="btn btn-primary">Save</button>
        </div>
    </form>
</div>
<?php
    require_once 'template/footer.php';
?>