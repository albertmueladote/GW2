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
        $unwanted_array = array('Š'=>'S', 'š'=>'s', 'Ž'=>'Z', 'ž'=>'z', 'À'=>'A', 'Á'=>'A', 'Â'=>'A', 'Ã'=>'A', 'Ä'=>'A', 'Å'=>'A', 'Æ'=>'A', 'Ç'=>'C', 'È'=>'E', 'É'=>'E',
                            'Ê'=>'E', 'Ë'=>'E', 'Ì'=>'I', 'Í'=>'I', 'Î'=>'I', 'Ï'=>'I', 'Ñ'=>'N', 'Ò'=>'O', 'Ó'=>'O', 'Ô'=>'O', 'Õ'=>'O', 'Ö'=>'O', 'Ø'=>'O', 'Ù'=>'U',
                            'Ú'=>'U', 'Û'=>'U', 'Ü'=>'U', 'Ý'=>'Y', 'Þ'=>'B', 'ß'=>'Ss', 'à'=>'a', 'á'=>'a', 'â'=>'a', 'ã'=>'a', 'ä'=>'a', 'å'=>'a', 'æ'=>'a', 'ç'=>'c',
                            'è'=>'e', 'é'=>'e', 'ê'=>'e', 'ë'=>'e', 'ì'=>'i', 'í'=>'i', 'î'=>'i', 'ï'=>'i', 'ð'=>'o', 'ñ'=>'n', 'ò'=>'o', 'ó'=>'o', 'ô'=>'o', 'õ'=>'o',
                            'ö'=>'o', 'ø'=>'o', 'ù'=>'u', 'ú'=>'u', 'û'=>'u', 'ý'=>'y', 'þ'=>'b', 'ÿ'=>'y', ' ' => '-');
        return strtr($string, $unwanted_array);
    }

    public function cleanStringSpaces($string){
        $unwanted_array = array('-' => ' ');
        return strtr($string, $unwanted_array);
    }
}
