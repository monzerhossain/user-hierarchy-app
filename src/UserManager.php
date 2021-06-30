<?php
/**
 * Created by PhpStorm.
 * User: monzer
 * Date: 6/29/21
 * Time: 6:47 PM
 */

require_once 'User.php';

/**
 * Class UserManager
 *
 * User Manager manages a list of Users along with their subordinates with the help of RoleManager
 * It has also a function to get all the subordinates of the user
 */
class UserManager
{
    private $users;
    private $roleManager;

    public function __construct(RoleManager $roleManager, $userList)
    {
        $this->roleManager = $roleManager;
        $this->users = array();
        foreach($userList as $user){
            $this->addUser($user);
        }

        $this->initSubordinates();
    }

    public function addUser($userData){
        $user = new User($userData['Id'], $userData['Name'], $userData['Role']);
        $this->users[$user->getId()] = $user;

        return $user;
    }

    public function deleteUser(User $user){
        unset($this->users[$user->getId()]);
    }

    public function getUserById(int $id){
        return $this->users[$id];
    }

    public function getUsers(){
        return $this->users;
    }

    public function getUsersWithRoleId(int $roleId){
        $userList = array();
        foreach ($this->users as $user) {
            if($user->getRoleId() == $roleId)
                $userList[] = $user;
        }

        return $userList;
    }

    private function initSubordinates(){
        /** @var User $user */
        foreach($this->users as $user){
            $userRole = $this->roleManager->getRoleById($user->getRoleId());
            $parentRoleId = $userRole->getParentId();
            $usersWithParentRole = $this->getUsersWithRoleId($parentRoleId);
            /** @var User $parent */
            foreach ($usersWithParentRole as $parent){
                $parent->addSubordinate($user);
            }
        }
    }

    /**
     * @param int $userId
     * @param array $allSubordinates
     * @return string
     *
     * This function recursively finds all the subordinates of a given user
     */
    public function getAllSubordinates(int $userId, &$allSubordinates = array()){
        $user = $this->getUserById($userId);
        /** @var User $subordinate */
        foreach($user->getSubordinates() as $subordinate){
            $allSubordinates[$subordinate->getId()] = array('Id' => $subordinate->getId(), 'Name' => $subordinate->getName(), 'Role' => $subordinate->getRoleId());
            $this->getAllSubordinates($subordinate->getId(), $allSubordinates);
        }

        return json_encode(array_values($allSubordinates));
    }


}