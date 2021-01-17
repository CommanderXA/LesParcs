<?php
    class Schedules extends Table {

        public $schedule_id = 0;
        public $plan_id = 0;
        public $watering_time_id = 0;
        public $day_id = 0;

        public function validate() {
            if(!empty($this->plan_id) &&
                !empty($this->watering_time_id) &&
                !empty($this->day_id)) {
                return true;
            }
            return false;
        }
    }
?>