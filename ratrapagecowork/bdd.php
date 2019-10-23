<?php





function getConnection(){
	$domaine='[URL_domaine]';
	$dbname='[DB_NAME]';
	$user='[USER_BDD]';
	$pass='[PASSWORD_BDD]';
	
	try {
		$db = new PDO('mysql:host='.$domaine.';dbname='.$dbname, $user, $pass,array(PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8'));
      $db->exec("SET NAMES 'utf8';");
		return $db;
	} catch (Exception $e) {
		return "erreur";
	}
	
}


function type($var){
    if( !(strpos($var,"NOW()") === false) )return $var;
    $type = gettype($var);
    if($type == "string")return "'".$var."'";
    return $var;
}

function insert($object){
    if(is_null($object ))return null;
   if(gettype($object) != "object") return null;
   
    $reflector = new ReflectionClass($object);
    $request = "insert into ".$reflector->getName()." ( ";
  
    $properties = $reflector->getProperties();
    $i = 0;
    foreach($properties as $propertie){
        $p = $propertie->getName();
        if($propertie->getName()!= id && isset($object->$p)){
            if($i++ == 0)$request = $request.$propertie->getName();
            else $request = $request." ,".$propertie->getName();
        }
    }
    $request = $request." ) values ( ";
    $i = 0;
    foreach($properties as $propertie){
        $p =$propertie->getName();
        if($p != id && isset($object->$p)){
            if($i++ == 0)$request = $request.type($object->$p);
            else $request =    $request." ,".type($object->$p);
        }
    }
    
    $db = getConnection();
    $query = $db->prepare($request.")");
  	
    $query->execute();
    return "ok";                                        
    
}

function update($object){
    
    if(is_null($object ))return null;
    if(gettype($object) != "object") return null;
    if(!isset($object->id)) return null;
    $reflector = new ReflectionClass($object);
    $request = " UPDATE ".$reflector->getName()." SET ";
    $properties = $reflector->getProperties();
    $i = 0;
    foreach($properties as $propertie){
        $p = $propertie->getName();
        if($propertie->getName()!= id && isset($object->$p)){
            if($i++ == 0)$request = $request.$propertie->getName()." = ".type($object->$p);
            else $request = $request." ,".$propertie->getName()." = ".type($object->$p);
        }
    }
    $request = $request." WHERE id = ".$object->id;

    $db = getConnection();
    $query = $db->prepare($request);
 
    $query->execute();
    return "ok";
}

function selectById($object){
    
    if(is_null($object ))return null;
    if(gettype($object) != "object") return null;
    if(!isset($object->id)) return null;
    $reflector = new ReflectionClass($object);
    $request = "SELECT * FROM  ".$reflector->getName()." WHERE id = ".$object->id;
   
    $db = getConnection();
    $query = $db->prepare($request);
    $query->execute();
    $res = $query->fetchAll();
    if(empty($res))return null;
    $properties = $reflector->getProperties();
   
    
    foreach($properties as $propertie){
        $p = $propertie->getName();
        
        $object->$p = $res[0][$p];
    }
    
    return $object;
    
}

function selectWithCondition($object,$condition){
    
    if(is_null($object ))return null;
    if(gettype($object) != "object") return null;
   
    $reflector = new ReflectionClass($object);
    $request = "SELECT * FROM  ".$reflector->getName()." WHERE ".$condition;

    $db = getConnection();
    $query = $db->prepare($request);
    $query->execute();
    $res = $query->fetchAll();
    if(empty($res))return null;
    $properties = $reflector->getProperties();
    $tab ;
    $i = 0;
    foreach($res as $res2){
        $obj = clone($object);
         foreach($properties as $propertie){
            $p = $propertie->getName();        
            $obj->$p = $res2[$p];
        }
        $tab[$i++] = $obj;
    }
   
    
    return $tab;
    
}
function compte($object,$condition){
   
    if(is_null($object ))return null;
    if(gettype($object) != "object") return null;
   
    $reflector = new ReflectionClass($object);
    $request = "SELECT * FROM  ".$reflector->getName()." WHERE ".$condition;
	
    $db = getConnection();
    $query = $db->prepare($request);
    $query->execute();
    $res = $query->fetchAll();
    //if(empty($res))return null;
 
    return count($res);
}   
function distinct($object , $colonne){
 	  
    $reflector = new ReflectionClass($object);
    $request = "SELECT DISTINCT ".$colonne." FROM ".$reflector->getName();
   	$db = getConnection();
    $query = $db->prepare($request);
    $query->execute();
    $res = $query->fetchAll();
  	return $res;
}
                                               
//$user = new CLIENT();
//insert($user);
//$us = selectWithCondition($user , "id > 0");
//print_r($us);