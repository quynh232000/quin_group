

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>UNIDI - Register</title>
  <link rel="icon" type="image/x-icon" href="./assest/images/logo-no-text.png">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/8.0.1/normalize.min.css" />
  <link rel="preconnect" href="https://fonts.googleapis.com" />
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
  <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500;700&display=swap" rel="stylesheet" />
  <link rel="stylesheet" href="./src/css/base.css" />
  <link rel="stylesheet" href="./src/css/register.css" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css"
    integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw=="
    crossorigin="anonymous" referrerpolicy="no-referrer" />
  <script src="https://code.jquery.com/jquery-2.2.4.min.js"
    integrity="sha256-BbhdlvQf/xTY9gja0Dq3HiwQF8LaCRTXxZKRutelT44=" crossorigin="anonymous"></script>
  <style>
   
    .form-group {
      margin-top: 0;
    }

    .register {
      padding: 40px 0;
    }
  </style>
</head>

<body>
  <div class="register">
    <div class="wrapper body-register">
      <form class="form-register" id="register-form" method="POST" action="">
        <h1>Đăng kí</h1>
        <!-- invalidate -->
        <!-- <div class="form-group">
          <div class="form-wrapper">
            <label for="userName">Tên đăng nhập</label>
            <div class="form-body">
              <i class="fa-solid fa-user"></i>
              <input type="text" class="form-control"  value="<?=$_POST['username'] ??"" ?>" id="userName" rules="required" name="username"
                placeholder="Tên đăng nhập..." />
            </div>
            <div class="form-msg"></div>
          </div>
        </div> -->
        <div class="form-group">
          <div class="form-wrapper">
            <label for="email">Email</label>
            <div class="form-body">
              <i class="fa-solid fa-paper-plane"></i>
              <input type="text" class="form-control" value="<?=$_POST['email'] ??"" ?>" rules="required|email" id="email" name="email"
                placeholder="Email..." />
            </div>
            <div class="form-msg"></div>
          </div>
        </div>
        <div class="form-group">
          <div class="form-wrapper">
            <label for="full_name">Họ và tên</label>
            <div class="form-body">
              <i class="fa-solid fa-user"></i>
              <input type="text" class="form-control" id="full_name" value="<?=$_POST['full_name'] ??"" ?>" rules="required" name="full_name"
                placeholder="Họ và tên..." />
            </div>
            <div class="form-msg"></div>
          </div>
        </div>

        
        <div class="form-group">
          <div class="form-wrapper">
            <label for="phone">Số điện thoại</label>
            <div class="form-body">
              <i class="fa-solid fa-phone"></i>
              <input type="text" class="form-control" value="<?=$_POST['phone'] ??"" ?>" id="phone" rules="required" name="phone"
                placeholder="Số điện thoại..." />
            </div>
            <div class="form-msg"></div>
          </div>
        </div>
        <div class="form-group">
          <div class="form-wrapper">
            <label for="password">Mật khẩu</label>
            <div class="form-body">
              <i class="fa-solid fa-lock"></i>
              <input type="password" class="form-control" value="<?=$_POST['password'] ??"" ?>" id="password" rules="required|min:6" name="password"
                placeholder="Mật khẩu..." />
            </div>
            <div class="form-msg"></div>
          </div>
        </div>
        <div class="form-group">
          <div class="form-wrapper">
            <label for="confirmPassword">Xác nhận mật khẩu</label>
            <div class="form-body">
              <i class="fa-solid fa-lock"></i>
              <input type="password" class="form-control" id="confirmPassword" rules="required|min:6" value="<?=$_POST['confirmpassword'] ??"" ?>" name="confirmpassword"
                placeholder="Xác nhận mật khẩu..." />
            </div>
            <div class="form-msg"></div>
          </div>
        </div>
        <div class="form-group invalid">
          <div class="form-wrapper">
            <div class="form-msg">
              <?php
              // if (isset($checkRegister)) {
              //   echo $checkRegister["message"];
              // } else {
              //   echo "";
              // }

              if (isset($checkRegister)) {
                if ($checkRegister['status'] == false) {
                  echo '<div id="toast" mes-type="error" mes-title="Thất bại!" mes-text="' . $checkRegister['message'] . '."></div>';
                } else {
                  echo '<div id="toast" mes-type="success" mes-title="Thành công!" mes-text="' . $checkRegister['message'] . '."></div>';
                  echo ' <script>
                  setTimeout(function() {
                      window.location.href="' . $checkRegister['redirect'] . '";
                  }, 3000);
              </script>';
                }
              }
              ?>
            </div>
          </div>
        </div>
        <div class="form-btn">
          <button class="btn-submit" type="submit">Đăng kí</button>
        </div>
        <div class="form-change">
          Bạn đã có tài khoản?
          <span><a href="?mod=profile&act=login">Đăng nhập</a></span>
        </div>
      </form>
    </div>
  </div>


  <!-- <script src="./src/js/register.js" type="module"></script> -->
  <script src="./src/js/main.js" type="module"></script>
</body>

</html>