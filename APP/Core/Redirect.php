<?php

namespace APP\Core;

class Redirect {
    
    public static function to($location = null){
        if($location){
            echo "<script>window.location='{$location}'</script>";
            exit();
        }
    }
    
}
