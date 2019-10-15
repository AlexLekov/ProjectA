<?php
/**
 * Created by PhpStorm.
 * User: user-09
 * Date: 29.03.18
 * Time: 14:28
 */

namespace model;

class User implements \JsonSerializable {

    public function jsonSerialize() {
        return get_object_vars($this);
    }

    private $id;
    private $username;
    private $age;
    private $city;
    private $gender;
    private $height;
    private $grade;

    /**
     * User constructor.
     * @param $username
     * @param $age
     * @param $city
     * @param $gender
     * @param $height
     */

    public function __construct($id = 0,$username = 0, $age = 0, $city = 0, $gender = 0, $height = 0, $grade = 0)
    {
        $this->id = $id;
        $this->username = $username;
        $this->age = $age;
        $this->city = $city;
        $this->gender = $gender;
        $this->height = $height;
        $this->grade = $grade;
    }

    /**
     * @return int
     */
    public function getGrade()
    {
        return $this->grade;
    }

    /**
     * @param int $grade
     */
    public function setGrade($grade)
    {
        $this->grade = $grade;
    }

    /**
     * @return mixed
     */
    public function getUsername() {
        return $this->username;
    }

    /**
     * @param mixed $username
     */
    public function setUsername($username) {
        $this->username = $username;
    }

    /**
     * @return mixed
     */
    public function getAge() {
        return $this->age;
    }

    /**
     * @param mixed $age
     */
    public function setAge($age)
    {
        $this->age = $age;
    }

    /**
     * @return mixed
     */
    public function getCity()
    {
        return $this->city;
    }

    /**
     * @param mixed $city
     */
    public function setCity($city)
    {
        $this->city = $city;
    }

    /**
     * @return mixed
     */
    public function getGender()
    {
        return $this->gender;
    }

    /**
     * @param mixed $gender
     */
    public function setGender($gender)
    {
        $this->gender = $gender;
    }

    /**
     * @return mixed
     */
    public function getHeight()
    {
        return $this->height;
    }

    /**
     * @param mixed $height
     */
    public function setHeight($height)
    {
        $this->height = $height;
    }

    public function removeCity() {
        unset($this->city);
    }


}