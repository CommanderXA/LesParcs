<?php
    class UserMap extends BaseMap {

        const USER = 'user';
        const ATTENDANT = 'attendant';
        const DECORATOR = 'decorator';

        public function auth($username, $password) {
            $username = $this->db->quote($username);
            $res = $this->db->query("SELECT user.user_id, CONCAT(user.firstname, ' ', user.lastname) AS full_name, " 
                                    . "user.password, role.sys_name, role.name FROM user "
                                    . "INNER JOIN role ON user.role_id=role.role_id " 
                                    . "WHERE user.username = $username AND user.active = 1");
            $user = $res->fetch(PDO::FETCH_OBJ);
            if($user) {
                if(password_verify($password, $user->password)) {
                    return $user;
                }
            }
        }

        public function findById($id = null) {
            if ($id) {
                $res = $this->db->query("SELECT user_id, firstname, patronymic, lastname, username, password, phone, address, role_id, active "
                                        . "FROM user WHERE user_id = $id");
                $user = $res->fetchObject("User");
                if ($user) {
                    return $user;
                }
            }
            return new User();
        }

        public function save(User $user) {
            if (!$this->existsLogin($user->username)) {
                if ($user->user_id == 0) {
                    return $this->insert($user);
                } 
            } else {
                return $this->update($user);
            }

            return false;
        }

        private function insert(User $user) {
            $lastname = $this->db->quote($user->lastname);
            $firstname = $this->db->quote($user->firstname);
            $patronymic = $this->db->quote($user->patronymic);
            $username = $this->db->quote($user->username);
            $password = $this->db->quote($user->password);
            $address = $this->db->quote($user->address);
            $phone = $this->db->quote($user->phone);
            if ($this->db->exec("INSERT INTO user(lastname, firstname, patronymic, username, password, phone, address, role_id, active) VALUES($lastname, $firstname, $patronymic, $username, $password, $phone, $address, $user->role_id, $user->active)") == 1) {
                $user->user_id = $this->db->lastInsertId();
                return true;
            }
            return false;
        }

        private function update(User $user) {
            $lastname = $this->db->quote($user->lastname);
            $firstname = $this->db->quote($user->firstname);
            $patronymic = $this->db->quote($user->patronymic);
            $username = $this->db->quote($user->username);
            $password = $this->db->quote($user->password);
            $address = $this->db->quote($user->address);
            $phone = $this->db->quote($user->phone);
            if ( $this->db->exec("UPDATE user SET lastname = $lastname, firstname = $firstname, patronymic = $patronymic, username = $username, password = $password, phone = $phone, address = $address, role_id = $user->role_id, active = $user->active "
            . "WHERE user_id = ".$user->user_id) == 1) {
                return true;
            }
            return false;
        }

        public function delete($id) {
            if ($this->db->exec("DELETE FROM user WHERE user_id=$id") == 1) {
                return true;
            }
            return false;
        }

        private function existsLogin($username) {
            $username = $this->db->quote($username);
            $res = $this->db->query("SELECT user_id FROM user WHERE username = $username");
            if ($res->fetchColumn() > 0) {
                return true;
            }
            return false;
        }

        public function findProfileById($id = null) {
            if ($id) {
                $res = $this->db->query("SELECT user.user_id, user.firstname,user.patronymic, user.lastname, CONCAT(user.firstname, ' ', user.lastname) AS full_name,"
                                        . " user.username, user.address, phone, role.name AS role, user.active FROM user "
                                        . "INNER JOIN role ON user.role_id=role.role_id WHERE user.user_id = $id");
                return $res->fetch(PDO::FETCH_OBJ);
            }
            return false;
        }

        public function identity($id) {
            if ((new AttendantMap())->findById($id)->validate()) {
                return self::ATTENDANT;
            }
            if ((new DecoratorMap())->findById($id)->validate()) {
                return self::DECORATOR;
            }
            if ($this->findById($id)->validate()) {
                return self::USER;
            }
            return null;
        }

        public function arrRoles() {
            $res = $this->db->query("SELECT role_id AS id, name AS
                                    value FROM role");
            return $res->fetchAll(PDO::FETCH_ASSOC);
        }

        public function existsUserById($id) {
            $res = $this->db->query("SELECT user_id FROM user WHERE user_id = $id");
            if ($res->fetchColumn() > 0) {
                return true;
            }
            return false;
        }
    }
?>