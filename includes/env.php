<?php

class env {
    protected 
        $_FILENAME = NULL,
        $_LINES    = NULL,
        $_LINE     = NULL,
        $_MATCHES  = NULL;


    public function get($data = ""){
        self::setenv(); 
        return getenv($data);  
    }
    
    protected function setenv(){
        
        
        die;
        $this->_FILENAME   =  file_get_contents(dirname(dirname(__FILE__)).".env");
        $this->_LINES      = explode("\n",$this->_FILENAME);
        foreach($this->_LINES as $this->_LINE){
            preg_match("/([^#]+)\=(.*)/",$this->_LINE, $this->_MATCHES);            
            if(isset($this->_MATCHES[2])){
                putenv(trim($this->_LINE));
            }
        }                  
    }
}
