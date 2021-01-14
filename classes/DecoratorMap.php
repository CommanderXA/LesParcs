<?php
    class DecoratorMap extends BaseMap {
        public function findById($id = null) {
            if ($id) {
                $res = $this->db->query("SELECT user_id, graduation_id, category_id, educational_institution "
                                        . "FROM decorator WHERE user_id = $id");
                $decorator = $res->fetchObject("Decorator");
                if ($decorator) {
                    return $decorator;
                }
            }
            return new Decorator();
        }

        public function findAll($ofset = 0, $limit = 30) {
            $res = $this->db->query("SELECT decorator.user_id, user.username, user.firstname, user.patronymic, user.lastname, user.phone, graduation.name AS graduation, category.name AS category, decorator.educational_institution,"
                                    . " role.name AS role FROM decorator INNER JOIN user on decorator.user_id=user.user_id"
                                    . " INNER JOIN category ON decorator.category_id=category.category_id"
                                    . " INNER JOIN graduation ON decorator.graduation_id=graduation.graduation_id"
                                    . " INNER JOIN role ON user.role_id=role.role_id LIMIT $ofset, $limit");
            return $res->fetchAll(PDO::FETCH_OBJ);
        }

        public function arrCategories() {
            $res = $this->db->query("SELECT category_id AS id, name AS
                                    value FROM category");
            return $res->fetchAll(PDO::FETCH_ASSOC);
        }

        public function arrGraduations() {
            $res = $this->db->query("SELECT graduation_id AS id, name AS
                                    value FROM graduation");
            return $res->fetchAll(PDO::FETCH_ASSOC);
        }

        public function count() {
            $res = $this->db->query("SELECT COUNT(*) AS cnt FROM decorator");
            return $res->fetch(PDO::FETCH_OBJ)->cnt;
        }

        public function save(User $user, Decorator $decorator) {
            if ($user->validate() && $decorator->validate() && (new UserMap())->save($user)) {
                if ($decorator->user_id == 0) {
                    $decorator->user_id = $user->user_id;
                    return $this->insert($decorator);
                } else {
                    return $this->update($decorator);
                }
            }
            return false;
        }

        private function insert(Decorator $decorator) {
            var_dump($decorator);
            if ($this->db->exec("INSERT INTO decorator(user_id, graduation_id, category_id, educational_institution)" 
                                . "VALUES($decorator->user_id, $decorator->graduation_id, $decorator->category_id, $decorator->educational_institution)") == 1) {
                return true;
            }
            return false;
        }

        private function update(Decorator $decorator) {
            if ($this->db->exec("UPDATE decorator SET graduation_id = $decorator->graduation_id, category_id = $decorator->category_id, educational_institution = $decorator->educational_institution WHERE user_id=".$decorator->user_id) == 1) {
                return true;
            }
            return false;
        }

        public function findProfileById($id = null) {
            if ($id) {
                $res = $this->db->query("SELECT decorator.user_id, user.firstname, user.patronymic, user.lastname, user.phone, graduation.name AS graduation, category.name AS category, decorator.educational_institution, role.name AS role FROM decorator INNER JOIN user on decorator.user_id=user.user_id INNER JOIN role on user.role_id=role.role_id INNER JOIN category on decorator.category_id=category.category_id INNER JOIN graduation on decorator.graduation_id=graduation.graduation_id WHERE decorator.user_id = $id");
                return $res->fetch(PDO::FETCH_OBJ);
            }
            return false;
        }
    }
?>