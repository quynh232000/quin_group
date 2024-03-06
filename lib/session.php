
<?php
    class Session{
        public static function init(){
            // session_start();
            if(version_compare(phpversion(),'5.4.0','<')){
                if(session_id()==''){
                    session_start();
                }
            }else{
                if(session_status() == 'PHP_SESION_NONE'){
                    session_start();
                }
            }
        }
        public static function set($key, $val){
            $_SESSION[$key] = $val;
        } 
        public static function get($key){
            if(isset($_SESSION[$key])){
                return $_SESSION[$key];
            }else{
                return false;
            }
        }
        public static function checkPermission($role){
            self::checkSession();
            if(!(self::get("role") == 'admin' || self::get("role") == 'adminall')){
                header("Location: ?mod=profile&act=login&redirect=admin");
            }
        }
        public static function checkSession(){
            self::init();
            if(isset($_SESSION['isLogin']) && $_SESSION['isLogin']==true){
                if (isset($_SESSION['LAST_ACTIVITY']) && (time() - $_SESSION['LAST_ACTIVITY'] > 76800)) {
                    session_unset();
                    session_destroy();
                    header("Location:/web-demo_php/login.php");
                }
                $_SESSION['LAST_ACTIVITY'] = time();

            }else{
                header("Location: ?mod=profile&act=login");
            }
        }
        public static function checkLogin(){
            self::init();
            if((self::get("isLogin"))==true){
                header("Location: ./");
            }
        }
        public static function destroy(){
            self::init();
            // unset()
            session_destroy();
            return  "<script>location.href = '?mod=profile&act=login';</script>";
            
            
        }
        
    }

?>