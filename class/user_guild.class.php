<?php
/**
 * @Author: Albert
 * @Date:   2022-03-29 11:59:39
 * @Last Modified by:   Your name
 * @Last Modified time: 2022-04-21 13:45:42
 */

require_once('gw2.class.php');
require_once('guild.class.php');
require_once('user.class.php');

/**
 * user_guild
 */
class user_guild extends gw2{
    
    private $id;
    private $user;
    private $guild;
    private $leader;
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
     * loadByUserApiGuildApi
     *
     * @return void
     */
    public function loadByUserApiGuildApi()
    {
        $query = 'SELECT * FROM user_guild ug INNER JOIN user u ON u.id = ug.user INNER JOIN guild g ON g.id = ug.guild WHERE u.api = ? AND g.api = ?';
        $types = "ss";
        $params = array($this->user, $this->guild);
        $user = $this->query($query, $types, $params);
        if(sizeof($user) > 0)
        {
            $this->id = $user['id'];
            $this->name = $user['user'];
            $this->api = $user['guild'];
            $this->last_login = $user['leader'];
            $this->created = $user['created'];
        }
    }
    
    /**
     * load
     *
     * @return void
     */
    public function load()
    {
        $query = 'SELECT user_guild.* FROM user_guild WHERE user_guild.id = ?';
        $types = "i";
        $params = array($this->id);
        $user = $this->query($query, $types, $params);
        if(sizeof($user) > 0)
        {
            $this->id = $user['id'];
            $this->name = $user['user'];
            $this->api = $user['guild'];
            $this->last_login = $user['leader'];
            $this->created = $user['created'];
        }
    }
    
    /**
     * save
     *
     * @return void
     */
    public function save()
    {
        $query = 'INSERT INTO user_guild (user_guild.user, user_guild.guild, user_guild.leader, user_guild.created) VALUES (?, ?, ?, ?)';
        $types = "iiis";
        $params = array();
        array_push($params, $this->user);
        array_push($params, $this->guild);
        array_push($params, $this->leader);
        array_push($params, date('y-m-d H:i:s'));

         $id = $this->query($query, $types, $params);
        
        if(!is_null($id))
        {
            $this->id = $id;
            $this->load();
        }      
    }
    
    /**
     * update
     *
     * @return void
     */
    public function update()
    {
        $query = 'UPDATE user_guild SET user_guild.user = ?, user_guild.guild= ?, user_guild.leader = ?, user_guild.created = ? WHERE user_guild.id = ?';
        $types = "iiisi";
        $params = array();
        array_push($params, $this->user);
        array_push($params, $this->guild);
        array_push($params, $this->leader);
        array_push($params, date('y-m-d H:i:s'));
        array_push($params, $this->id);
        
        $id = $this->query($query, $types, $params);

        if(!is_null($id))
        {
            $this->id = $id;
            $this->load();
        }
    }
    
    /**
     * remove
     *
     * @return void
     */
    public function remove()
    {
        $query = 'DELETE FROM user_guild WHERE user_guild.id = ?';
        $types = "i";
        $params = array();
        array_push($params, $this->id);

        $result = $this->query($query, $types, $params);

        if($result)
        {
            $this->id = null;
            $this->user = null;
            $this->guild = null;
            $this->leader = null;
            $this->created = null;
        }
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
     * @param  string $value
     * @return void
     */
    public function __set($property, $value){
        if(property_exists($this, $property)) {
            $this->$property = $value;
        }
    }
}