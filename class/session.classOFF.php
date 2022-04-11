<?php
/**
 * @Author: Albert
 * @Date:   2022-04-06 12:37:55
 * @Last Modified by:   Your name
 * @Last Modified time: 2022-04-09 04:27:06
 */

 require_once(_CLASS . 'gw2.class.php');
/**
 * session
 */
class session extends gw2{
    
    public function __construct() {

        // Set handler to overide SESSION
        session_set_save_handler(
            [$this, "_open"],
            [$this, "_close"],
            [$this, "_read"],
            [$this, "_write"],
            [$this, "_destroy"],
            [$this, "_clean"]
        );

        // Start the session
        session_start();
    }
    
    function _open()
    {
        return true;
    }
     
    function _close()
    {     
        return true;
    }

    /**
     * Read
     */
    function _read($id)
    {
        $query = "SELECT data FROM session WHERE id = ?";
        $types = 's';
        $params = array($id);

        $session = $this->query($query, $types, $params);
        if(!is_null($session)){
            if(isset($sessio['data'])){
                return $session['data'];
            }
        }
        return '';
    }

    /**
     * Write
     */
    function _write($id, $data)
    {     
        $access = date('y-m-d H:i:s');
     
        $query = "REPLACE INTO session VALUES (?, ?, ?)";
        $types = 'sss';
        $params = array($id, $access, $data);
        $session = $this->query($query, $types, $params);
        if(!is_null($session)){
            return $session;
        }
        return false;
    }

    /**
     * Destroy
     */
    function _destroy($id)
    {     
        $id = mysql_real_escape_string($id);
        
        $query = "DELETE FROM session WHERE id = ?";
        $types = 's';
        $params = array($id);
        $remove = $this->query($query, $types, $params);
        if($remove){
            return true;
        }
        return false;
    }

    /**
     * Garbage Collection
     */
    function _clean($max)
    {
        $old = time() - $max;
        $id = mysql_real_escape_string($id);
        
        $query = "DELETE FROM session WHERE access < ?";
        $types = 's';
        $params = array($id);
        $remove = $this->query($query, $types, $params);
        if($remove){
            return true;
        }
        return false;
    }
}
