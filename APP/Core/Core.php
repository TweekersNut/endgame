<?php
    
    namespace APP\Core;
    
    class Core{
        
        protected $currentController = DEFAULT_CONTROLLER;
        protected $currentMethod = DEFAULT_METHOD;
        protected $params = [];
        
        
        function __construct(){
            $url = $this->getUrl();
            if(file_exists('../APP/Controllers/'. ucwords($url[0]) .'.php')){
                $this->currentController = ucwords($url[0]);
                unset($url[0]);
            }
            
            //require_once '../app/controllers/'. $this->currentController . '.php';
            $load = "APP\Controllers\\{$this->currentController}";
            $this->currentController = new $load;
            
            if(isset($url[1])){
                if(method_exists($this->currentController,$url[1])){
                    $this->currentMethod = $url[1];
                    unset($url[1]);
                }
            }
            
            $this->params = $url ? array_values($url) : [];
            
            call_user_func_array([$this->currentController,$this->currentMethod],$this->params);
        }
        
        protected function getUrl(){
            if(isset($_GET['url'])){
                return explode('/',filter_var(rtrim($_GET['url'],'/'),FILTER_SANITIZE_URL));
            }
        }
        
        public function getParams(){
            return $this->params;
        }
    
    }
