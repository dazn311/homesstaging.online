<?php

function dirToArray($dir, $ts, $idDoc,$isEditMode,$currentInit) {
   $result = array();
   $current = $currentInit;
   $cdir = scandir($dir);

   foreach ($cdir as $key => $value) {
      if (!in_array($value,array(".",".."))) {
        $pathName = $dir . DIRECTORY_SEPARATOR . $value;
        
        if (is_dir($pathName)) {
          $sub_res = dirToArray($pathName,$value, $idDoc,$isEditMode,$current);
          if (in_array('data',$sub_res)) {
           
            $result = $sub_res;
          } else {
            $result[$value] = $sub_res;
          }
          
        } else {
          $isEditModeStr = $isEditMode ? 'edit' : 'read';
          if (strpos($value, $idDoc) !== false && strpos($value, $isEditModeStr) !== false) { // Проверяем, что это файл и ищем по имени
            $current[] = [
              'name' => $ts,
              'value' => $value
            ];
 
            $result['data'] = $current[0];
          }
        } 
      }
   }
  
    if (isset($result['data'])) {
      return $result['data'];   
    }
   return $result;
}