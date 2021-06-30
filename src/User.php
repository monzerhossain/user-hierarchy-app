<?php
/**
 * Created by PhpStorm.
 * User: monzer
 * Date: 6/29/21
 * Time: 6:20 PM
 */

/**
 * Class User
 *
 * User class has all user related data
 * It also contains a list of subordinates who are also Users who report to the User
 *
 */
class User
{
    private $id;
    private $name;
    private $roleId;
    private $subordinates;

    public  function __construct(int $id, String $name, int $roleId){
        $this->id = $id;
        $this->name = $name;
        $this->roleId = $roleId;
        $this->subordinates = array();
    }


    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    public function setId(int $id){
        $this->id = $id;
        return $this;
    }

    /**
     * @return String
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param String $name
     * @return User
     */
    public function setName(String $name){
        $this->name = $name;
        return $this;
    }

    /**
     * @return int
     */
    public function getRoleId()
    {
        return $this->roleId;
    }

    /**
     * @param int $roleId
     * @return User
     */
    public function setRoleId(int $roleId){
        $this->roleId = $roleId;
        return $this;
    }

    public function addSubordinate($user){
        $this->subordinates[] = $user;
    }

    public function getSubordinates(){
        return $this->subordinates;
    }
}