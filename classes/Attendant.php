<?php
    class Attendant extends Table {

        public $user_id = 0;

        public function validate() {
            return true;
        }
    }
?>