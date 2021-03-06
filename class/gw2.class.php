<?php
/**
 * @Author: Albert
 * @Date:   2022-03-25 13:27:45
 * @Last Modified by:   Your name
 * @Last Modified time: 2022-04-21 13:40:04
 */


/**
 * gw2
 */
class gw2 {
       
    /**
     * query
     *
     * @param  string $query
     * @param  string $types
     * @param  array $params
     * @return mixed
     */
    public function query($query, $types = null, $params = array())
    {
    	$result = null;
        $mysqli  = mysqli_connect(HOST_DB, USER_DB, PASSWORD_DB, DATABASE_DB);
        if (!$mysqli ) {
            $result = false;
        }else{
            $stmt = $mysqli->prepare($query);
            if(sizeof($params) > 0){
                $stmt->bind_param($types, ...$params);
            }
            $stmt->execute();
            if (strpos($query, 'SELECT') !== false) {
                $rows = $stmt->get_result();
                if($rows->num_rows == 0){
                    $result = array();
                }elseif($rows->num_rows == 1){
                    $result = $rows->fetch_assoc();
                }elseif($rows->num_rows > 1){
                    $result = array();
                    while ($row = $rows->fetch_array())
                    {
                        array_push($result, $row);
                    }
                }
            }else if(strpos($query, 'INSERT') !== false){
                $result = $stmt->insert_id;
            }else if(strpos($query, 'UPDATE') !== false){
                $result = $stmt->id;
            }else if(strpos($query, 'DELETE') !== false){
                $result = true;
            }else if(strpos($query, 'REPLACE') !== false){
                $result = true;
            }
            $mysqli->close();
        }
    	return $result;
    }
    
    /**
     * curl
     *
     * @param  string $param
     * @param  string $api
     * @return mixed
     */
    public function curl($param, $api)
    {
        $result = null;
        $ch = curl_init();
        if(strcmp($param, 'account') == 0){
            curl_setopt($ch, CURLOPT_URL, URL_API . $param . URL_KEY_API . $api);
        }else if(strcmp($param, 'guild') == 0){
            curl_setopt($ch, CURLOPT_URL, URL_API . $param . '/' . $api);
        }
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $response = json_decode(curl_exec($ch));
        curl_close($ch);
        if(!isset($response->text)){
            $result = $response;
        }   
        return $result;
    }
    
    /**
     * cleanString
     *
     * @param  string $string
     * @return string
     */
    public function cleanString($string){
        $unwanted_array = array('??'=>'S', '??'=>'s', '??'=>'Z', '??'=>'z', '??'=>'A', '??'=>'A', '??'=>'A', '??'=>'A', '??'=>'A', '??'=>'A', '??'=>'A', '??'=>'C', '??'=>'E', '??'=>'E',
                            '??'=>'E', '??'=>'E', '??'=>'I', '??'=>'I', '??'=>'I', '??'=>'I', '??'=>'N', '??'=>'O', '??'=>'O', '??'=>'O', '??'=>'O', '??'=>'O', '??'=>'O', '??'=>'U',
                            '??'=>'U', '??'=>'U', '??'=>'U', '??'=>'Y', '??'=>'B', '??'=>'Ss', '??'=>'a', '??'=>'a', '??'=>'a', '??'=>'a', '??'=>'a', '??'=>'a', '??'=>'a', '??'=>'c',
                            '??'=>'e', '??'=>'e', '??'=>'e', '??'=>'e', '??'=>'i', '??'=>'i', '??'=>'i', '??'=>'i', '??'=>'o', '??'=>'n', '??'=>'o', '??'=>'o', '??'=>'o', '??'=>'o',
                            '??'=>'o', '??'=>'o', '??'=>'u', '??'=>'u', '??'=>'u', '??'=>'y', '??'=>'b', '??'=>'y', ' ' => '-');
        return strtr($string, $unwanted_array);
    }

    public function cleanStringSpaces($string){
        $unwanted_array = array('-' => ' ');
        return strtr($string, $unwanted_array);
    }
}
