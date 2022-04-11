<?php
/**
 * @Author: Albert
 * @Date:   2022-03-25 12:47:23
 * @Last Modified by:   Your name
 * @Last Modified time: 2022-04-11 11:07:56
 */

require_once('gw2.class.php');
require_once('guild.class.php');

/**
 * user
 */
class user extends gw2{
    
    private $id;
    private $name;
    private $api;
    private $password;
    private $last_login;
    private $modifed;
    private $created;
       
    /**
     * __construct
     *
     * @param  int $id
     * @return void
     */
    function __construct($id = null) {
        if(is_int($id)){
            $this->id = $id;
            $this->load();
        }
    }
    
    /**
     * loadByApi
     *
     * @return void
     */
    public function loadByApi()
    {
        $query = 'SELECT * FROM user WHERE api = ?';
        $types = "s";
        $params = array($this->api);
        $user = $this->query($query, $types, $params);

        if(sizeof($user) > 0)
        {
            $this->id = $user['id'];
            $this->name = $user['name'];
            $this->api = $user['api'];
            $this->password = $user['password'];
            $this->last_login = $user['last_login'];
            $this->modifed = $user['modifed'];
            $this->created = $user['created'];
            return true;
        }
        return false;
    }

    public function loadByName()
    {
        $query = 'SELECT * FROM user WHERE name = ?';
        $types = "s";
        $params = array($this->name);
        $user = $this->query($query, $types, $params);

        if(sizeof($user) > 0)
        {
            $this->id = $user['id'];
            $this->name = $user['name'];
            $this->api = $user['api'];
            $this->password = $user['password'];
            $this->last_login = $user['last_login'];
            $this->modifed = $user['modifed'];
            $this->created = $user['created'];
            return true;
        }
        return false;
    }
    
    /**
     * login
     *
     * @return void
     */
    public function login()
    {
        $query = 'SELECT * FROM user WHERE name = ? AND password = ?';
        $types = "ss";
        $params = array($this->name, $this->password);
        $user = $this->query($query, $types, $params);
        if(sizeof($user) > 0)
        {
            $this->id = $user['id'];
            $this->name = $user['name'];
            $this->api = $user['api'];
            $this->password = $user['password'];
            $this->last_login = date('y-m-d H:i:s');
            $this->modifed = $user['modifed'];
            $this->created = $user['created'];
            $query = 'UPDATE user SET last_login = ? WHERE id = ?';
            $types = "si";
            $params = array();
            array_push($params, date('y-m-d H:i:s'));
            array_push($params, $this->id);
            
            $id = $this->query($query, $types, $params);
            return true;
        }
        return false;
    }
        
    /**
     * load
     *
     * @return void
     */
    public function load()
    {
        $query = 'SELECT * FROM user WHERE id = ?';
        $types = "i";
        $params = array($this->id);
        $user = $this->query($query, $types, $params);
        if(!is_null($user))
        {
            $this->id = $user['id'];
            $this->name = $user['name'];
            $this->api = $user['api'];
            $this->password = $user['password'];
            $this->last_login = $user['last_login'];
            $this->modifed = $user['modifed'];
            $this->created = $user['created'];
            return true;
        }
        return false;
    }

    
    /**
     * save
     *
     * @return void
     */
    public function save()
    {
        if(!$this->loadByName()){
            $query = 'INSERT INTO user (name, api, password, last_login, modifed, created) VALUES (?, ?, ?, ?, ?, ?)';
            $types = "ssssss";
            $params = array();
            
            $user_data = $this->curl('account', $this->api);
            array_push($params, $this->name);
            if(is_null($user_data)){
                array_push($params, null);
            }else{
                array_push($params, $this->api);
            }
            array_push($params, $this->password);
            array_push($params, date('y-m-d H:i:s'));
            array_push($params, date('y-m-d H:i:s'));
            array_push($params, date('y-m-d H:i:s'));
            
            $id = $this->query($query, $types, $params);
            
            $guild = new guild();
            $guild->saveUserGuilds($user_data, $this->api);
            
            if(!is_null($id))
            {
                $this->id = $id;
                return $this->load();
            }
        }
        return false;
    }
    
    /**
     * update
     *
     * @return void
     */
    public function update()
    {
        $query = 'UPDATE user SET name = ?, api= ?, password = ?, last_login = ?, modifed = ?, created = ? WHERE id = ?';
        $types = "sssssi";
        $params = array();
        array_push($params, $this->name);
        array_push($params, $this->api);
        array_push($params, $this->password);
        array_push($params, $this->last_login);
        array_push($params, date('y-m-d H:i:s'));
        array_push($params, $this->modifed);
        array_push($params, $this->id);

        $id = $this->query($query, $types, $params);

        if(!is_null($id))
        {
            $this->id = $id;
            return $this->load();
        }
        return false;
    }
    
    /**
     * remove
     *
     * @return void
     */
    public function remove()
    {
        $query = 'DELETE FROM user WHERE id = ?';
        $types = "i";
        $params = array();
        array_push($params, $this->id);

        $result = $this->query($query, $types, $params);

        if($result)
        {
            $this->id = null;
            $this->name = null;
            $this->api = null;
            $this->password = null;
            $this->last_login = null;
            $this->modifed = null;
            $this->created = null;
            return true;
        }
        return false;
    }
    
    /**
     * __get
     *
     * @param  string $property
     * @return mixed
     */
    public function __get($property){
        if(property_exists($this, $property)) {
            return $this->$property;
        }
    }
    
    /**
     * __set
     *
     * @param  string $property
     * @param  mixed $value
     * @return void
     */
    public function __set($property, $value){
        if(property_exists($this, $property)) {
            $this->$property = $value;
        }
    }
}