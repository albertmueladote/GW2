<?php
/**
 * @Author: Your name
 * @Date:   2022-04-03 21:50:57
 * @Last Modified by:   Your name
 * @Last Modified time: 2022-04-04 03:41:27
 */

require_once('gw2.class.php');
require_once('guild_block.class.php');

/**
 * guild
 */
class guild_blocks extends gw2{
    
    private $blocks;

    
    public function loadBlocks($guild)
    {   
        $query = 'SELECT id FROM guild_block WHERE guild = ? ORDER BY row ASC, guild_block.column ASC';
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
        echo"<pre>";var_dump($this);echo"</pre>";
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