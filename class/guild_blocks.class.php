<?php
/**
 * @Author: Your name
 * @Date:   2022-04-03 21:50:57
 * @Last Modified by:   Your name
 * @Last Modified time: 2022-04-21 13:41:49
 */

require_once('gw2.class.php');
require_once('guild_block.class.php');

/**
 * guild
 */
class guild_blocks extends gw2{
    
    private $blocks;    
    
    /**
     * loadBlocksByGuildId
     *
     * @param  int $guild
     * @return mixed
     */
    public function loadBlocksByGuildId($guild)
    {   
        $query = 'SELECT guild_block.id FROM guild_block WHERE guild_block.guild = ? ORDER BY guild_block.row ASC, guild_block.column ASC';
        $types = "i";
        $params = array($guild);
        $guild_blocks = $this->query($query, $types, $params);
        $blocks = array();
        foreach($guild_blocks AS $block)
        {
            $guild_block = new guild_block($block['id']);
            array_push($blocks, $guild_block);
        }
        $this->blocks = $blocks;
    }

    /**
     * loadBlocksByGuildName
     *
     * @param  string $guild
     * @return mixed
     */
    public function loadBlocksByGuildName($guild)
    {   
        $query = 'SELECT gb.* FROM guild_block gb INNER JOIN guild g ON gb.guild = g.id WHERE g.name = ? ORDER BY row ASC, gb.column ASC';
        $types = "s";
        $params = array($guild);
        $guild_blocks = $this->query($query, $types, $params);
        $blocks = array();
        foreach($guild_blocks AS $block)
        {
            $guild_block = new guild_block();
            $guild_block->id = $block['id'];
            $guild_block->guild = $block['guild'];
            $guild_block->type = $block['type'];
            $guild_block->value = $block['value'];
            $guild_block->extra = $block['extra'];
            $guild_block->row = $block['row'];
            $guild_block->column = $block['column'];
            $guild_block->modifed = $block['modifed'];
            $guild_block->created = $block['created'];
            array_push($blocks, $guild_block);
        }
        $this->blocks = $blocks;
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