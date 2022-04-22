<?php
/**
 * @Author: Albert
 * @Date:   2022-03-26 05:48:53
 * @Last Modified by:   Your name
 * @Last Modified time: 2022-04-21 13:44:37
 */

require_once('gw2.class.php');
require_once('guild.class.php');

/**
 * guild
 */
class guilds extends gw2{
    
    private $guilds;
    
   public function loadAll()
   {
        $query = 'SELECT guild.* FROM guild ORDER BY guild.name';

        $types = "";
        $params = array();
        $guilds = $this->query($query, $types, $params);

        if(sizeof($guilds) > 0)
        {
            $result = array();
            foreach($guilds AS $g){
                $guild = new guild();
                $guild->id = $g['id'];
                $guild->name = $g['name'];
                $guild->api = $g['api'];
                $guild->modifed = $g['modifed'];
                $guild->created = $g['created'];
                array_push($result, $guild);
            }
            $this->guilds = $result;
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