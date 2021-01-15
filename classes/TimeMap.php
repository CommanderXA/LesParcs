<?php
    class TimeMap extends BaseMap {
        public function arrTimes() {
            $res = $this->db->query("SELECT watering_time_id AS id, watering_time
                                    AS value FROM time");
            return $res->fetchAll(PDO::FETCH_ASSOC);
        }

        public function findById($id = null) {
            if ($id) {
                $res = $this->db->query("SELECT watering_time_id, watering_time FROM time WHERE watering_time_id = $id");
                return $res->fetchObject("Time");
            }
            return new Time();
        }

        public function save(Time $time) {
            if ($time->validate()) {
                if ($time->watering_time_id == 0) {
                    return $this->insert($time);
                } else {
                    return $this->update($time);
                }
            }
            return false;
        }

        private function insert(Time $time) {
            $watering_time = $this->db->quote($time->watering_time);
            if ($this->db->exec("INSERT INTO time(watering_time)" . " VALUES($watering_time)") == 1) {
                $time->watering_time_id = $this->db->lastInsertId();
                return true;
            }
            return false;
        }

        private function update(Time $time) {
            $watering_time = $this->db->quote($time->watering_time);
            if ( $this->db->exec("UPDATE time SET watering_time = $watering_time" . "WHERE watering_time_id = ".$time->watering_time_id) == 1) {
                return true;
            }
            return false;
        }

        public function delete($id) {
            if ($this->db->exec("DELETE FROM time WHERE watering_time_id=$id") == 1) {
                return true;
            }
            return false;
        }

        public function findAll($ofset = 0, $limit = 30) {
            $res = $this->db->query("SELECT time.watering_time_id, time.watering_time FROM time ORDER BY watering_time LIMIT $ofset, $limit");
            return $res->fetchAll(PDO::FETCH_OBJ);
        }

        public function count() {
            $res = $this->db->query("SELECT COUNT(*) AS cnt FROM time");
            return $res->fetch(PDO::FETCH_OBJ)->cnt;
        }

        public function findViewById($id = null) {
            if ($id) {
                $res = $this->db->query("SELECT time.watering_time_id, time.watering_time" . " FROM time WHERE watering_time_id = $id");
                return $res->fetch(PDO::FETCH_OBJ);
            }
            return false;
        }

        public function existsTimeById($id) {
            $res = $this->db->query("SELECT watering_time_id FROM time WHERE watering_time_id = $id");
            if ($res->fetchColumn() > 0) {
                return true;
            }
            return false;
        }
    }
?>