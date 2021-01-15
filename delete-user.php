<?php
    require_once 'secure.php';
    if (!Helper::can('admin')) {
        header('Location: 404.php');
        exit();
    }

    $id = Helper::clearInt($_GET['id']);
    $role = Helper::clearString($_GET['role']);

    if($role == 'Attendant') {
        (new AttendantMap())->delete($id);
        if ((new UserMap())->existsUserById($id) || !(new AttendantMap())->delete($id)) {
            Helper::setFlash('Could not delete the user. An error occured.');
        }
        header('Location: list-attendant.php');
    } elseif($role == 'Decorator') {
        (new DecoratorMap())->delete($id);
        if ((new UserMap())->existsUserById($id) || !(new DecoratorMap())->delete($id)) {
            Helper::setFlash('Could not delete the user. An error occured.');
        }
        header('Location: list-decorator.php');
    }
?>