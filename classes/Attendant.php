<?php
    class Attendant extends Table {

        public $user_id = 0;

        public function validate() {
            return true;
        }

        public function validate2() {
            if (!empty($this->user_id)) {
                return true;
            }
            return false;
        }
    }
?>