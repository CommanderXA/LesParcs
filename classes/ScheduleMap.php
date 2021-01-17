<?php
    class ScheduleMap extends BaseMap {

        public function findByAttendantId($id = null) {
            $days = $this->findDays();
            $result = [];
            foreach ($days as $day) {
                $arrDay = [];
                $arrDay['id'] = $day->day_id;
                $arrDay['name'] = $day->name;
                $arrDay['plant'] = [];
                $plants = $this->findPlantsByDayAttendant($id, $day->day_id);
                foreach ($plants as $plant) {
                    $arrPlant = [];
                    $arrPlant['name'] = $plant->name;
                    $arrPlant['schedule'] = $this->findByPlantsDayAfindPlantsByDayAttendant($id, $day->day_id,$plant->plant_id);
                    $arrDay['plant'][] = $arrPlant;
                }
                $result[] = $arrDay;
            }
            return $result;
        }

        public function findDayById($id = null) {
            if ($id) {
                $res = $this->db->query("SELECT name FROM day WHERE day_id = $id");
                return $res->fetch(PDO::FETCH_OBJ);
            }
            return false;
        }

        public function existsScheduleAttendantAndPlant(Schedule $schedule) {
            $plan = (new LessonPlanMap())->findById($schedule->lesson_plan_id);
            $res = $this->db->query("SELECT * FROM plan");
            if ($res->fetchColumn() > 0) {
                return true;
            }
            return false;
        }
        
        public function findDays() {
            $res = $this->db->query("SELECT day_id, name FROM day");
            return $res->fetchAll(PDO::FETCH_OBJ);
        }

        public function findPlantsByDayAttendant($plantId, $dayId) {
            $res = $this->db->query("SELECT * from schedule");
            return $res->fetchAll(PDO::FETCH_OBJ);
        }

        public function findByPlantsDayAttendant($attendantId, $dayId, $plantId) {
            $res = $this->db->query("SELECT * from schedule");
            return $res->fetchAll(PDO::FETCH_ASSOC);
        }
    }
?>