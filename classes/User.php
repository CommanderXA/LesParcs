<?php
    class User extends Table {

        public $user_id = 0;
        public $lastname = '';
        public $firstname = '';
        public $patronymic = null;
        public $username = null;
        public $password = null;
        public $phone = null;
        public $address = null;
        public $role_id = 0;
        public $active = 1;

        public function validate() {
            if(!empty($this->firstname) &&
                !empty($this->lastname) &&
                !empty($this->username) &&
                !empty($this->password) &&
                !empty($this->role_id)) {
                return true;
            }
            return false;
        }
    }
?>