<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link rel="icon" type="image/x-icon" href="./assest/images/logo-no-text.png">
  <title>QUIN -Quên mật khẩu</title>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/8.0.1/normalize.min.css" />
  <link rel="preconnect" href="https://fonts.googleapis.com" />
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
  <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500;700&display=swap" rel="stylesheet" />
  <link rel="stylesheet" href="./src/css/register.css" />
  <link rel="stylesheet" href="./src/css/base.css" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css"
    integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw=="
    crossorigin="anonymous" referrerpolicy="no-referrer" />
  <script src="https://code.jquery.com/jquery-2.2.4.min.js"
    integrity="sha256-BbhdlvQf/xTY9gja0Dq3HiwQF8LaCRTXxZKRutelT44=" crossorigin="anonymous"></script>
   
    <script src="./src/js/define.js"></script>
</head>

<body>
  <!-- forgot-bg -->
  <div class="register ">
    <div class="wrapper">
      <form class="form-login" action="?mod=profile&act=forgotpassword<?php 
        if(($active == 'submitcode')){
          echo '&verifytoken='.$_GET['verifytoken'];
        }
        if(($active == 'changepassword')){
          echo '&verifytoken='.$_GET['verifytoken'];
        }
        
      
      ?>" method="POST">
        <h1>Quên mật khẩu!</h1>
        <!-- invalidate -->
        <!-- form input email -->
        <?php
        if ($active == 'default') { ?>
          <div class="subscribe">
            <p>Email của bạn</p>
            <input placeholder="Your e-mail" class="subscribe-input" name="email" type="email">
            <br>
            <button type="submit" class="submit-btn">SUBMIT</button>
          </div>
          <?php
        }
        ?>




        <!-- form verify code -->
        <?php
        if ($active == 'submitcode') { ?>
          <div class=" ve-form ">
            <div class="ve-title">OTP - Mã xác thực</div>
            <p class="ve-message">Chúng tôi đã gửi cho bạn 1 mã code tại
              <strong class="ve-email-send">quynh@gmail.com</strong>
            </p>
            <div class="ve-inputs">
              <input id="input1" name="code[]"  maxlength="1">
              <input id="input2" name="code[]" maxlength="1">
              <input id="input3" name="code[]" maxlength="1">
              <input id="input4" name="code[]" maxlength="1">
            </div>
            <button class="ve-action">Xác thực</button>
          </div>
          <div class="time-count">
                <div class="time-count-title">Mã xác nhận sẽ hết hạn trong:</div>
                <div class="time-count-body">60s</div>
                
          </div>
        <?php 
        echo '<script>countTime(60)</script>'  ;
      
      }

        ?>
        

        <!-- form change password -->
        <?php
        if ($active == 'changepassword') { ?>
          <div class=" ve-form ">
            <div class="ve-title">Thay đổi mật khẩu</div>
            </p>
            <div class="change-pass-body">
              <input required="" class="input" type="password" name="password" placeholder="Mật khẩu mới">
              <input required="" class="input" type="password" name="passwordconfirm"
                placeholder="Xác nhận lại mật khẩu">

            </div>
            <button class="ve-action">Xác nhận</button>
          </div>
        <?php }
        ?>
        <!-- error form -->
        <?php
        if ($active == 'tokenerror') { ?>
          <div class=" ve-form ">
            <div class="ve-title">Trang web không hợp lệ</div>
            
          </div>
        <?php }
        ?>


        <div class="form-change">
          Bạn đã có tài khoản?
          <span><a href="?mod=profile&act=login">Đăng nhập</a></span>
        </div>
        <div class="l-back-home">
          <a href="./" class="home-btn">Trang chủ</a>
        </div>
      </form>
    </div>
  </div>



  <script src="./src/js/main.js" type="module"></script>
</body>

</html>