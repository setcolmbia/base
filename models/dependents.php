<?php 
          
    include "Database.php";
    include "../config.php";
     
    class dependents extends Database
    {
        public static function option($option){
            $result = parent::connect()->prepare('SELECT * FROM '.PREFIX .'_'.$option.' ORDER BY id');
            $result->execute();
            $data = $result->fetchAll();            
            foreach ($data as $value) {
                $data .= '<option value = "'.$value->id.'">'.$value->name.'</option>';
            }
            
            return $data;
        }
        
    }  

    if (isset($_REQUEST['option1'])){
        $option = $_REQUEST['option1'];
        echo $data = dependents::option($option);
    }
    if (isset($_REQUEST['option2'])){
        $option = $_REQUEST['option2'];
        echo $data = dependents::option($option);
    }
    if (isset($_REQUEST['option3'])){
        $option = $_REQUEST['option3'];
        echo $data = dependents::option($option);
    }
    if (isset($_REQUEST['option4'])){
        $option = $_REQUEST['option4'];
        echo $data = dependents::option($option);
    }
    if (isset($_REQUEST['option5'])){
        $option = $_REQUEST['option5'];
        echo $data = dependents::option($option);
    }
    if (isset($_REQUEST['option6'])){
        $option = $_REQUEST['option6'];
        echo $data = dependents::option($option);
    }
    if (isset($_REQUEST['option7'])){
        $option = $_REQUEST['option7'];
        echo $data = dependents::option($option);
    }
    if (isset($_REQUEST['option8'])){
        $option = $_REQUEST['option8'];
        echo $data = dependents::option($option);
    }
    if (isset($_REQUEST['option9'])){
        $option = $_REQUEST['option9'];
        echo $data = dependents::option($option);
    }
    if (isset($_REQUEST['option10'])){
        $option = $_REQUEST['option10'];
        echo $data = dependents::option($option);
    }
    if (isset($_REQUEST['option11'])){
        $option = $_REQUEST['option11'];
        echo $data = dependents::option($option);
    }
    if (isset($_REQUEST['option12'])){
        $option = $_REQUEST['option12'];
        echo $data = dependents::option($option);
    }

          
?>
       