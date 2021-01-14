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
    $header = 'Profile of an Decorator';
    $decorator = (new DecoratorMap())->findProfileById($id);
    require_once 'template/header.php';
?>
<div class="row">
    <div class="col-xs-12">
        <div class="box">
            <section class="content-header">
            <h1>Profile of an Decorator</h1>
            <ol class="breadcrumb">
                <li><a href="index.php"><i class="fa fa-dashboard"></i> Main</a></li>
                <li><a href="list-decorator.php">Decorators</a></li>
                <li class="active">Profile</li>
            </ol>
            </section>
            <div class="box-body">
                <a class="btn btn-success" href="add-decorator.php?id=<?=$id;?>">Change</a>
            </div>
            <div class="box-body">

                <table class="table table-bordered table-hover">
                    <?php require_once '_profile.php';?>
                    <tr>
                        <th>Graduation Type</th>
                        <td><?=$decorator->graduation;?></td>
                    </tr>
                    <tr>
                        <th>Category</th>
                        <td><?=$decorator->category;?></td>
                    </tr>
                    <tr>
                        <th>Educational Institution</th>
                        <td><?=$decorator->educational_institution;?></td>
                    </tr>
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