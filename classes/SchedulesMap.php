<?php
    class SchedulesMap extends BaseMap {

        public function findByAttendantId($id = null) {
            $days = $this->findDays();
            $result = [];
            foreach ($days as $day) {
                $arrDay = [];
                $arrDay['id'] = $day->day_id;
                $arrDay['name'] = $day->name;
                $arrDay['plant'] = [];
                $plants = $this->findPlantsByDayAttendant($id, Helper::ClearInt($day->day_id));
                foreach ($plants as $plant) {
                    $arrPlant = [];
                    $arrPlant['name'] = $plant->species;
                    $arrPlant['id'] = $plant->plant_id;
                    $arrPlant['zone'] = $plant->zone;
                    $arrPlant['park'] = $plant->park;
                    $arrPlant['schedule'] = $this->findByPlantsDayAttendant($id, Helper::ClearInt($day->day_id),$plant->plant_id);
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

        public function save(Schedules $schedules) {
            if (!$this->modeDays($schedules) && !$this->existsSchedulesDay($schedules) && $this->db->exec("INSERT INTO schedules(plan_id, day_id, watering_time_id)"
            . " VALUES($schedules->plan_id,$schedules->day_id, $schedules->watering_time_id)") == 1) {
                return true;
            }
            return false;
        }

        public function delete($id) {
            if ($this->db->exec("DELETE FROM schedules WHERE schedules_id=$id") == 1) {
                return true;
            }
            return false;
        }

        public function existsSchedulesDay(Schedules $schedules) {
            $res = $this->db->query("SELECT schedules.schedules_id FROM schedules "
                                    . "WHERE (schedules.day_id=$schedules->day_id AND schedules.plan_id=$schedules->plan_id)");
            if ($res->fetchColumn() > 0) {
                return true;
            }
            return false;
        }

        public function modeDays(Schedules $schedules) {
            $res = $this->db->query("SELECT COUNT(*) AS cnt, mode.days, mode.sys_name FROM schedules 
                                    INNER JOIN plan ON schedules.plan_id=plan.plan_id 
                                    INNER JOIN plant ON plan.plant_id=plant.plant_id 
                                    INNER JOIN species ON plant.species_id=species.species_id 
                                    INNER JOIN mode ON species.mode_id=mode.mode_id 
                                    WHERE schedules.plan_id = $schedules->plan_id");
            $result = $res->fetchAll(PDO::FETCH_OBJ);
            $y = Helper::ClearInt($result[0]->cnt);
            $x = Helper::ClearInt($result[0]->days);
            if ($y >= $x) {
                return true;
            } else {
                return false;
            }
        }

        public function existsSchedulesAttendantAndPlant(Schedules $schedules) {
            $plan = (new PlanMap())->findById($schedules->plan_id);
            $res = $this->db->query("SELECT schedules.schedules_id FROM plan INNER JOIN schedules "
            . "ON plan.plan_id=schedules.plan_id "
            . "WHERE (plan.user_id=$plan->user_id) AND "
            . "(schedules.day_id=$schedules->day_id AND schedules.watering_time_id=$schedules->watering_time_id)");
            if ($res->fetchColumn() > 0) {
                return true;
            }
            return false;
        }
        
        public function findDays() {
            $res = $this->db->query("SELECT day_id, name FROM day");
            return $res->fetchAll(PDO::FETCH_OBJ);
        }

        public function findPlantsByDayAttendant($attedantId, $dayId) {

            $res = $this->db->query("SELECT DISTINCT plan.user_id, plant.plant_id, species.name AS species, park.name AS park, zone.name AS zone 
                                    FROM plan INNER JOIN schedules ON plan.plan_id=schedules.plan_id 
                                    INNER JOIN plant ON plan.plant_id=plant.plant_id 
                                    INNER JOIN species ON plant.species_id=species.species_id 
                                    INNER JOIN zone ON plant.zone_id=zone.zone_id 
                                    INNER JOIN park ON zone.park_id=park.park_id
                                    WHERE plan.user_id=$attedantId AND schedules.day_id=$dayId 
                                    ORDER BY species.name");
            return $res->fetchAll(PDO::FETCH_OBJ);
        }

        public function findByPlantsDayAttendant($attendantId, $dayId, $plantId) {
            $res = $this->db->query("SELECT plan.user_id,schedules.schedules_id,time.watering_time AS time,plant.plant_id, park.name AS park, zone.name AS zone FROM plan 
                                    INNER JOIN schedules ON plan.plan_id=schedules.plan_id 
                                    INNER JOIN plant ON plan.plant_id=plant.plant_id 
                                    INNER JOIN time ON schedules.watering_time_id=time.watering_time_id 
                                    INNER JOIN zone ON plant.zone_id=zone.zone_id 
                                    INNER JOIN park ON zone.park_id=park.park_id 
                                    WHERE plan.user_id=$attendantId AND schedules.day_id=$dayId AND plan.plant_id = $plantId 
                                    ORDER BY watering_time");
            return $res->fetchAll(PDO::FETCH_ASSOC);
        }

        public function existsScheduleByPlanId($idPlan) {
            $res = $this->db->query("SELECT schedules_id FROM schedules WHERE plan_id = $idPlan");
            if ($res->fetchColumn() > 0) {
                return true;
            }
            return false;
        }
    }
?>