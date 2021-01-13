<?php
    class WateringTime extends Table {

        public $watering_time_id = 0;
        public $watering_time = null;

        public function validate() {
            if(!empty($this->watering_time)) {
                return true;
            }
            return false;
        }
    }
?>