<?php
/**
 * Created by PhpStorm.
 * User: user-09
 * Date: 29.03.18
 * Time: 14:38
 */

namespace model;

class UserDAO {


    const DB_NAME = "WOw";
    const DB_IP = "192.168.8.22";
    const DB_PORT = "3306";
    const DB_USER = "RealDeal";
    const DB_PASS = "123";

    private $pdo;

    public function __construct() {
        try {
            $this->pdo = new \PDO("mysql:host=" . self::DB_IP . ":" . self::DB_PORT . ";dbname=" . self::DB_NAME, self::DB_USER, self::DB_PASS);
            $this->pdo->setAttribute( \PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION );

        }
        catch (\PDOException $e){
            echo "Problem with db query  - " . $e->getMessage();
        }
    }


    public function getFilteredUsers($page, $entries, $gender, $grade){
        $offset = intval(($page-1)*$entries);
        $limit = intval($entries);
        $users = array();
        $params = array();
        $sql = "SELECT id, username, age, city, gender, height, high_school_grade
             FROM users";
        if($gender != "all"){
            $params[] = $gender;
            $sql .= " WHERE gender = ?";
        }
        if($grade != "all"){
            $params[] = $grade;
            $sql .= ($gender == "all" ? " WHERE" : " AND ") . "  high_school_grade = ?";
        }
        $sql .= " LIMIT $limit OFFSET $offset";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute($params);
        while($row = $stmt->fetch(\PDO::FETCH_ASSOC)){
            $u = new User(
                $row["id"],
                $row["username"],
                $row["age"],
                $row["city"],
                $row["gender"],
                $row["height"],
                $row["high_school_grade"]);
            $users[] = $u;
        }
        return $users;
    }

    public function getAllUsers($page, $entries){
        $offset = intval(($page-1)*$entries);
        $limit = intval($entries);
        $users = array();
        $stmt = $this->pdo->prepare(
            "SELECT id, username, age, city, gender, height, high_school_grade 
             FROM users LIMIT $limit OFFSET $offset");
        $stmt->execute();
        while($row = $stmt->fetch(\PDO::FETCH_ASSOC)){
            $u = new User(
                            $row["id"],
                            $row["username"],
                            $row["age"],
                            $row["city"],
                            $row["gender"],
                            $row["height"],
                            $row["high_school_grade"]);
            $users[] = $u;
        }
        return $users;
    }

    public function saveUser(User $u){//type hinting
        $stmt = $this->pdo->prepare(
            "INSERT INTO users (username, age, city, gender, height) VALUES (?, ?, ?, ?, ?)");
        $stmt->execute(array(
            $u->getUsername(),
            $u->getAge(),
            $u->getCity(),
            $u->getGender(),
            $u->getHeight(),
        ));
    }

    public function editUser($id, $height){//type hinting
        $stmt = $this->pdo->prepare(
            "UPDATE users SET height = ? WHERE id = ?");
        $stmt->execute(array($height, $id));
    }

    public function getUsersCount($gender, $grade){
        $params = array();
        $sql = "SELECT count(*) as number_of_users FROM users";
        if($gender != "all"){
            $params[] = $gender;
            $sql .= " WHERE gender = ?";
        }
        if($grade != "all"){
            $params[] = $grade;
            $sql .= ($gender == "all" ? " WHERE" : " AND ") . "  high_school_grade = ?";
        }
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute($params);
        $row = $stmt->fetch(\PDO::FETCH_ASSOC);
        return $row["number_of_users"];
    }

    public function getGenders(){
        $stmt = $this->pdo->prepare("SELECT DISTINCT gender FROM users");
        $stmt->execute();
        $genders = array();
        while($row = $stmt->fetch(\PDO::FETCH_ASSOC)){
            $genders[] = $row["gender"];
        }
        return $genders;

    }

    public function getGrades(){
        $stmt = $this->pdo->prepare("SELECT DISTINCT high_school_grade as grade FROM users ORDER BY grade desc");
        $stmt->execute();
        $genders = array();
        while($row = $stmt->fetch(\PDO::FETCH_ASSOC)){
            $genders[] = $row["grade"];
        }
        return $genders;

    }


}