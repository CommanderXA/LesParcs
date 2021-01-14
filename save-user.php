<?php
    require_once 'secure.php';
    if (!Helper::can('admin')) {
        header('Location: 404.php');
        exit();
    }

    if (isset($_POST['user_id'])) {
        $user = new User();
        $user->lastname = Helper::clearString($_POST['lastname']);
        $user->user_id= Helper::clearInt($_POST['user_id']);
        $user->firstname = Helper::clearString($_POST['firstname']);
        $user->patronymic = Helper::clearString($_POST['patronymic']);
        $user->phone = Helper::clearString($_POST['phone']);
        $user->username = Helper::clearString($_POST['username']);
        $user->password = password_hash(Helper::clearString($_POST['password']), PASSWORD_BCRYPT);
        $user->address = Helper::clearString($_POST['address']);
        $user->role_id = Helper::clearInt($_POST['role_id']);
        $user->active = Helper::clearInt($_POST['active']);

        if (isset($_POST['saveAttendant'])) {
            $attendant = new Attendant();
            $attendant->user_id = $user->user_id;

            if ((new AttendantMap())->save($user, $attendant)) {
                header('Location: profile-attendant.php?id='.$attendant->user_id);
            } else {
                if ($attendant->user_id) {
                    header('Location: add-attendant.php?id='.$attendant->user_id);
                } else {
                    header('Location: add-attendant.php');
                }
            }
            exit();
        }

        if (isset($_POST['saveDecorator'])) {
            $decorator = new Decorator();
            $decorator->graduation_id = Helper::clearInt($_POST['graduation_id']);
            $decorator->category_id = Helper::clearInt($_POST['category_id']);
            $decorator->educational_institution = Helper::clearString($_POST['educational_institution']);
            $decorator->user_id = $user->user_id;

            if ((new DecoratorMap())->save($user, $decorator)) {
                header('Location: profile-decorator.php?id='.$decorator->user_id);
            } else {
                if ($decorator->user_id) {
                    header('Location: add-decorator.php?id='.$decorator->user_id);
                } else {
                    header('Location: add-decorator.php');
                }
            }
            exit();
        }
    }
?>