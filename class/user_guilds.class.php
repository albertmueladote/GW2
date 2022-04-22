<?php
/**
 * @Author: Albert
 * @Date:   2022-04-01 13:26:22
 * @Last Modified by:   Your name
 * @Last Modified time: 2022-04-21 13:44:51
 */

require_once('gw2.class.php');
require_once('user_guild.class.php');

/**
 * user_guilds
 */
class user_guilds extends gw2{
    
    private $user;
    private $member_guilds;
    private $leader_guilds;
       
    /**
     * __construct
     *
     * @param  int $user
     * @return void
     */
    function __construct($user = null) {
        if(is_int($user)){
            $this->user = $user;
            $this->load();
        }
    }
    
    /**
     * load
     *
     * @return void
     */
    public function load()
    {
        $query = 'SELECT g.*, ug.leader FROM user_guild ug INNER JOIN user u ON u.id = ug.user INNER JOIN guild g ON g.id = ug.guild WHERE u.id = ?';
        $types = "i";
        $params = array($this->user);
        $guilds = $this->query($query, $types, $params);
        if(sizeof($guilds) > 0){
            $member_guilds = array();
            $leader_guilds = array();

            foreach($guilds AS $guild){

                $user_guild = new guild($guild['id']);
                if($guild['leader'] == 1){
                    array_push($leader_guilds, $user_guild);
                }else{
                    array_push($member_guilds, $user_guild);
                }
               
            }
            $this->member_guilds = $member_guilds;
            $this->leader_guilds = $leader_guilds;
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