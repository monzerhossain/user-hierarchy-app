<?php
/**
 * Created by PhpStorm.
 * User: monzer
 * Date: 6/29/21
 * Time: 6:16 PM
 */

require_once 'Role.php';

/**
 * Class RoleManager
 *
 * Role Manager maintains a list of roles
 */
class RoleManager
{
    private $roles;

    public function __construct($roleList = array()){
        $this->roles = array();
        foreach($roleList as $role){
            $this->addRole($role);
        }
    }

    public function addRole($roleData){

         $role = new Role($roleData['Id'], $roleData['Name'], $roleData['Parent']);
         $this->roles[$role->getId()] = $role;
         return $role;

    }

    public function getRoles(){
        return $this->roles;
    }

    public function deleteRole(Role $role){
        unset($this->roles[$role->getId()]);
    }

    public function getRoleById(int $id){
        return $this->roles[$id];
    }

}