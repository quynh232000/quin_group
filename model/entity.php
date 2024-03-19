<?php 
    
    class Response{
        public $status;
        public $message;
        public $result;
        public $redirect;
        public $total;
        function __construct($status,$message ="",$result ="",$redirect="",$total=0) {
            $this->status = $status;
            $this->message = $message;
            $this->result = $result;
            $this->redirect = $redirect;
            $this->total = $total;
        }
    }
    
   
   
?>