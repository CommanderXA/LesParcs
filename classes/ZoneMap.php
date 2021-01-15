<?php
    class ZoneMap extends BaseMap {
        public function arrZones() {
            $res = $this->db->query("SELECT zone_id AS id, name
                                    AS value FROM zone");
            return $res->fetchAll(PDO::FETCH_ASSOC);
        }

        public function findById($id = null) {
            if ($id) {
                $res = $this->db->query("SELECT zone_id, name, park_id FROM zone WHERE zone_id = $id");
                return $res->fetchObject("Zone");
            }
            return new Zone();
        }

        public function save(Zone $zone) {
            if ($zone->validate()) {
                if ($zone->zone_id == 0) {
                    return $this->insert($zone);
                } else {
                    return $this->update($zone);
                }
            }
            return false;
        }

        private function insert(Zone $zone) {
            $name = $this->db->quote($zone->name);
            if ($this->db->exec("INSERT INTO zone(name, park_id, active)" . " VALUES($name, $zone->park_id, $zone->active)") == 1) {
                $zone->zone_id = $this->db->lastInsertId();
                return true;
            }
            return false;
        }

        private function update(Zone $zone) {
            $name = $this->db->quote($zone->name);
            if ( $this->db->exec("UPDATE zone SET name = $name, park_id = $zone->park_id, active = $zone->active WHERE zone_id = ".$zone->zone_id) == 1) {
                return true;
            }
            return false;
        }

        public function delete($id) {
            if ($this->db->exec("DELETE FROM zone WHERE zone_id=$id") == 1) {
                return true;
            }
            return false;
        }

        public function findAll($ofset = 0, $limit = 30) {
            $res = $this->db->query("SELECT zone.zone_id, zone.name, park.name AS park FROM zone INNER JOIN park ON zone.park_id=park.park_id LIMIT $ofset, $limit");
            return $res->fetchAll(PDO::FETCH_OBJ);
        }

        public function count() {
            $res = $this->db->query("SELECT COUNT(*) AS cnt FROM zone");
            return $res->fetch(PDO::FETCH_OBJ)->cnt;
        }

        public function findViewById($id = null) {
            if ($id) {
                $res = $this->db->query("SELECT zone.zone_id, zone.name, park.name AS park FROM zone INNER JOIN park ON zone.park_id=park.park_id WHERE zone_id = $id");
                return $res->fetch(PDO::FETCH_OBJ);
            }
            return false;
        }

        public function existsZoneByParkId($id) {
            $res = $this->db->query("SELECT zone_id FROM zone WHERE park_id = $id");
            if ($res->fetchColumn() > 0) {
                return true;
            }
            return false;
        }
    }
?>