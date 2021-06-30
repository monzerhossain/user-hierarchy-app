<?php
/**
 * Created by PhpStorm.
 * User: monzer
 * Date: 6/30/21
 * Time: 2:23 PM
 */

namespace TestNamespace;

use PHPUnit\Framework\TestCase;

require_once '../src/RoleManager.php';
require_once '../src/UserManager.php';


class SubordinateTest extends TestCase
{
    /** @var  \RoleManager $roleManager */
    private $roleManager;
    /** @var  \UserManager $userManager*/
    private $userManager;


    protected function setup() : void {
        $this->roleManager = new \RoleManager($this->getRolesData());
        $this->userManager = new \UserManager($this->roleManager, $this->getUsersData());
    }

    public function testGetAllSubordinatesForSystemAdminUser() : void {

        $expectedOutput = '[{"Id":4,"Name":"Mary Manager","Role":2},{"Id":3,"Name":"Sam Supervisor","Role":3},{"Id":2,"Name":"Emily Employee","Role":4},{"Id":5,"Name":"Steve Trainer","Role":5}]';
        $output = $this->userManager->getAllSubordinates(1);
        $this->assertEquals($expectedOutput, $output);
    }

    public function testGetAllSubordinatesForLocationManagerUser() : void {
        $expectedOutput = '[{"Id":3,"Name":"Sam Supervisor","Role":3},{"Id":2,"Name":"Emily Employee","Role":4},{"Id":5,"Name":"Steve Trainer","Role":5}]';
        $output = $this->userManager->getAllSubordinates(4);
        $this->assertEquals($expectedOutput, $output);
    }


    public function testGetAllSubordinatesForSupervisorUser() : void {
        $expectedOutput = '[{"Id":2,"Name":"Emily Employee","Role":4},{"Id":5,"Name":"Steve Trainer","Role":5}]';
        $output = $this->userManager->getAllSubordinates(3);
        $this->assertEquals($expectedOutput, $output);
    }

    public function testGetAllSubordinatesForEmployeeUser() : void {
        $expectedOutput = '[]';
        $output = $this->userManager->getAllSubordinates(2);
        $this->assertEquals($expectedOutput, $output);
    }

    public function testGetAllSubordinatesForTrainerUser() : void {
        $expectedOutput = '[]';
        $output = $this->userManager->getAllSubordinates(5);
        $this->assertEquals($expectedOutput, $output);
    }


    private function getRolesData() : array {
        $roles = '[
                        {
                        "Id": 1,
                        "Name": "System Administrator",
                        "Parent": 0
                        },
                        {
                        "Id": 2,
                        "Name": "Location Manager",
                        "Parent": 1
                        },
                        {
                        "Id": 3,
                        "Name": "Supervisor",
                        "Parent": 2
                        },
                        {
                        "Id": 4,
                        "Name": "Employee",
                        "Parent": 3
                        },
                        {
                        "Id": 5,
                        "Name": "Trainer",
                        "Parent": 3
                        }
                    ]';

        return json_decode($roles, true);
    }

    private function getUsersData() : array  {

        $users = '[
                        {
                        "Id": 1,
                        "Name": "Adam Admin",
                        "Role": 1
                        },
                        {
                        "Id": 2,
                        "Name": "Emily Employee",
                        "Role": 4
                        },
                        {
                        "Id": 3,
                        "Name": "Sam Supervisor",
                        "Role": 3
                        },
                        {
                        "Id": 4,
                        "Name": "Mary Manager",
                        "Role": 2
                        },
                        {
                        "Id": 5,
                        "Name": "Steve Trainer",
                        "Role": 5
                        }
                    ]';

        return json_decode($users, true);
    }

}