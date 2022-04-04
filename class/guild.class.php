<?php
/**
 * @Author: Albert
 * @Date:   2022-03-26 05:48:53
 * @Last Modified by:   Your name
 * @Last Modified time: 2022-04-04 03:07:56
 */

require_once('gw2.class.php');
require_once('user_guild.class.php');

/**
 * guild
 */
class guild extends gw2{
    
    private $id;
    private $name;
    private $api;
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
     * saveUserGuilds
     *
     * @param  user $user_data
     * @param  string $user_api
     * @return void
     */
    public function saveUserGuilds($user_data, $user_api)
    {
        $user = new user();
        $user->api = $user_api;
        $user->loadByApi();
        foreach($user_data->guilds AS $guild_api)
        {
            $guild_data = $this->curl('guild', $guild_api);

            $guild = new guild();
            $guild->api = $guild_api;
            $guild->loadByApi();
            if(is_null($guild->id)){
                $guild->name = $guild_data->name;
                $guild->api = $guild_api;
                $guild->modifed = date('y-m-d H:i:s');
                $guild->created = date('y-m-d H:i:s');
                $guild->save();
            }

            $user_guild = new user_guild();
            $user_guild->user = $user_api;
            $user_guild->guild = $guild_api;
            $user_guild->loadByUserApiGuildApi();
            if(is_null($user_guild->id))
            {
                $user_guild->user = $user->id;
                $user_guild->guild = $guild->id;
                if(in_array($guild_api, $user_data->guild_leader)){
                    $user_guild->leader = 1;   
                }else{
                    $user_guild->leader = 0;   
                }
                $user_guild->created = date('y-m-d H:i:s');
                $user_guild->save();
            }
        }
    }


    public function loadByName()
    {
        $query = 'SELECT * FROM guild WHERE name = ?';

        $types = "s";
        $params = array($this->name);
        $guild = $this->query($query, $types, $params);

        if(!is_null($guild))
        {
            $this->id = $guild['id'];
            $this->name = $guild['name'];
            $this->api = $guild['api'];
            $this->modifed = $guild['modifed'];
            $this->created = $guild['created'];
        }
    }
    
    /**
     * loadByApi
     *
     * @return void
     */
    public function loadByApi()
    {
        
        $query = 'SELECT * FROM guild WHERE api = ?';

        $types = "s";
        $params = array($this->api);
        $guild = $this->query($query, $types, $params);

        if(!is_null($guild))
        {
            $this->id = $guild['id'];
            $this->name = $guild['name'];
            $this->api = $guild['api'];
            $this->modifed = $guild['modifed'];
            $this->created = $guild['created'];
        }
    }
    
    /**
     * load
     *
     * @return void
     */
    public function load()
    {
        $query = 'SELECT * FROM guild WHERE id = ?';
        $types = "i";
        $params = array($this->id);
        $guild = $this->query($query, $types, $params);
        if(!is_null($guild))
        {
            $this->id = $guild['id'];
            $this->name = $guild['name'];
            $this->api = $guild['api'];
            $this->modifed = $guild['modifed'];
            $this->created = $guild['created'];
        }
    }
    
    /**
     * save
     *
     * @return void
     */
    public function save()
    {
        $query = 'INSERT INTO guild (name, api, modifed, created) VALUES (?, ?, ?, ?)';
        $types = "ssss";
        $params = array();

        $guild_data = $this->curl('guild', $this->api);
        
        array_push($params, $this->name);
        if(!is_null($guild_data)){
            array_push($params, $this->api);
        }else{
            array_push($params, null);
        }
        array_push($params, date('y-m-d H:i:s'));
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
        $query = 'UPDATE guild SET name = ?, api= ?, modifed = ?, created = ? WHERE id = ?';
        $types = "ssssi";
        $params = array();
        array_push($params, $this->name);
        array_push($params, $this->api);
        array_push($params, date('y-m-d H:i:s'));
        array_push($params, $this->modifed);
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
        $query = 'DELETE FROM guild WHERE id = ?';
        $types = "i";
        $params = array();
        array_push($params, $this->id);

        $result = $this->query($query, $types, $params);

        if($result)
        {
            $this->id = null;
            $this->name = null;
            $this->api = null;
            $this->modifed = null;
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
     * @param  mixed $value
     * @return void
     */
    public function __set($property, $value){
        if(property_exists($this, $property)) {
            $this->$property = $value;
        }
    }
}