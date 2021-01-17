<?php
    class Plan extends Table {

        public $plan_id = 0;
        public $plant_id = 0;
        public $user_id = 0;

        public function validate() {
            if(!empty($this->plant_id) &&
                !empty($this->user_id)) {
                return true;
            }
            return false;
        }
    }
?>