<?php
    class Plan extends Table {

        public $plan_id = 0;
        public $plant_id = 0;
        public $employee_id = 0;
        public $water_rate = 0;

        public function validate() {
            if(!empty($this->plant_id) &&
                !empty($this->employee_id) &&
                !empty($this->water_rate)) {
                return true;
            }
            return false;
        }
    }
?>