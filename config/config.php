<?php
    // define("DB_HOST","localhost:3300");

define("DB_HOST","localhost");
    define("DB_USER","root");
    define("DB_PASS","123456");
    define("BASE_URL","http://localhost/quin_group/");

    define("DB_NAME","quingroup");
    // google authen
    define('GOOGLE_APP_ID','179563114207-79g13hf3v49boufmmnsro1fsoqijeak3.apps.googleusercontent.com');
    define('GOOGLE_APP_SECRET','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');
    define('GOOGLE_APP_CALLBACK_URL','http://localhost/LoginGoogle/redirect-google.php');
    // vnpay
    define("VNP_RETURN_URL","http://localhost/quin_group/?mod=page&act=payment_result");
    define("VNP_URL","https://sandbox.vnpayment.vn/paymentv2/vpcpay.html");
    define("VNP_HASHSECRET","YETJQVOMBAKTQRBNBOQVCXFOQGDVJJPA");

?>
