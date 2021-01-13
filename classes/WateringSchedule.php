<?php
    class WateringSchedule extends Table {

        public $watering_schedule_id = 0;
        public $watering_plan_id = 0;
        public $watering_time_id = 0;
        public $day_id = 0;
        public $watering_mode_id = 0;

        public function validate() {
            if(!empty($this->watering_plan_id) &&
                !empty($this->watering_time_id) &&
                !empty($this->day_id) &&
                !empty($this->watering_mode_id)) {
                return true;
            }
            return false;
        }
    }
?>