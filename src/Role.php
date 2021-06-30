<?php
/**
 * Created by PhpStorm.
 * User: monzer
 * Date: 6/29/21
 * Time: 6:20 PM
 */



class Role
{
    private $id;
    private $name;
    private $parentId;

    public  function __construct(int $id, String $name, int $parentId){
        $this->id = $id;
        $this->name = $name;
        $this->parentId = $parentId;
    }


    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param int $id
     * @return Role
     */
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
     * @return Role
     */
    public function setName(String $name){
        $this->name = $name;
        return $this;
    }

    /**
     * @return int
     */
    public function getParentId()
    {
        return $this->parentId;
    }

    /**
     * @param int $parentId
     * @return Role
     */
    public function setParentId(int $parentId){
        $this->parentId = $parentId;
        return $this;
    }
}