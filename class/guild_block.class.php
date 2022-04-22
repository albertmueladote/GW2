<?php
/**
 * @Author: Your name
 * @Date:   2022-04-03 21:50:57
 * @Last Modified by:   Your name
 * @Last Modified time: 2022-04-21 15:49:14
 */

require_once('gw2.class.php');

/**
 * guild
 */
class guild_block extends gw2{
    
    private $id;
    private $guild;
    private $type;
    private $value;
    private $extra;
    private $row;
    private $column;
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

    public function loadByGuildRowColumn()
    {
        $query = 'SELECT * FROM guild_block WHERE guild_block.guild = ? AND guild_block.row = ? AND guild_block.column = ?';
        $types = "iii";
        $params = array($this->guild, $this->row, $this->column);
        $guild_block = $this->query($query, $types, $params);
        if(sizeof($guild_block) > 0)
        {
            $this->id = $guild_block['id'];
            $this->guild = $guild_block['guild'];
            $this->type = $guild_block['type'];
            $this->value = $guild_block['value'];
            $this->extra = $guild_block['extra'];
            $this->row = $guild_block['row'];
            $this->column = $guild_block['column'];
            $this->modifed = $guild_block['modifed'];
            $this->created = $guild_block['created'];
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
        $query = 'SELECT * FROM guild_block WHERE guild_block.id = ?';
        $types = "i";
        $params = array($this->id);
        $guild_block = $this->query($query, $types, $params);
        if(sizeof($guild_block) > 0)
        {
            $this->id = $guild_block['id'];
            $this->guild = $guild_block['guild'];
            $this->type = $guild_block['type'];
            $this->value = $guild_block['value'];
            $this->extra = $guild_block['extra'];
            $this->row = $guild_block['row'];
            $this->column = $guild_block['column'];
            $this->modifed = $guild_block['modifed'];
            $this->created = $guild_block['created'];
        }
    }
    
    /**
     * save
     *
     * @return void
     */
    public function save()
    {
        $query = 'INSERT INTO guild_block (guild_block.guild, guild_block.type, guild_block.value, guild_block.extra, guild_block.row, guild_block.column, guild_block.modifed, guild_block.created) VALUES (?, ?, ?, ?, ?, ?, ?, ?)';
        $types = "isssiiss";
        $params = array();        
        array_push($params, $this->guild);
        array_push($params, $this->type);
        array_push($params, $this->value);
        array_push($params, $this->extra);
        array_push($params, $this->row);
        array_push($params, $this->column);
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
        $query = 'UPDATE guild_block SET guild_block.guild = ?, guild_block.type= ?, guild_block.value = ?, guild_block.extra = ?, guild_block.row = ?, guild_block.column = ?, guild_block.modifed = ? WHERE guild_block.id = ?';
        $types = "isssiisi";
        $params = array();
        array_push($params, $this->guild);
        array_push($params, $this->type);
        array_push($params, $this->value);
        array_push($params, $this->extra);
        array_push($params, $this->row);
        array_push($params, $this->column);
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
        $query = 'DELETE FROM guild_block WHERE guild_block.id = ?';
        $types = "i";
        $params = array();
        array_push($params, $this->id);

        $result = $this->query($query, $types, $params);

        if($result)
        {
            $this->id = null;
            $this->guild = null;
            $this->type = null;
            $this->value = null;
            $this->extra = null;
            $this->row = null;
            $this->column = null;
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