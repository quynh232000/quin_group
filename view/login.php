<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link rel="icon" type="image/x-icon" href="./assest/images/logo-no-text.png">
  <title>QUIN -Login</title>
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
</head>

<body>
  <div class="register">
    <div class="wrapper">
      <form class="form-login" action="?mod=profile&act=login<?=isset($_GET['redirect']) ? "&redirect=".$_GET['redirect'] :""  ?>" method="post" enctype="multipart/form-data">
        <h1>Đăng nhập</h1>

        <!-- invalidate -->
        <div class="form-group">
          <div class="form-wrapper">
            <label for="userName">Tên đăng nhập</label>

            <div class="form-body">
              <i class="fa-solid fa-user"></i>
              <input type="text" class="form-control" id="userName" value="<?=$_POST['adminUser'] ??"" ?>" name="adminUser" rules="required"
                placeholder="Tên đăng nhập..." />
            </div>
            <div class="form-msg"></div>
          </div>
        </div>

        <div class="form-group invalidate">
          <div class="form-wrapper">
            <label for="password">Mật khẩu</label>
            <div class="form-body">
              <i class="fa-solid fa-lock"></i>
              <input type="password" class="form-control"  value="<?=$_POST['adminPass']??"" ?>" id="password" name="adminPass" rules="required|min:6"
                placeholder="Mật khẩu..." />
            </div>
            <div class="form-msg"></div>
          </div>
        </div>

        <div class="form-noti" style="width:100%">
          <div class="form-msg">
            <?php
            if (isset($login_check)) {
              if ($login_check['status'] == false) {
                echo '<div id="toast" mes-type="error" mes-title="Thất bại!" mes-text="' . $login_check['message'] . '."></div>';
              } else {
                echo '<div id="toast" mes-type="success" mes-title="Thành công!" mes-text="' . $login_check['message'] . '."></div>';
                echo ' <script>
                setTimeout(function() {
                    window.location.href="' . $login_check['redirect'] . '";
                }, 2500);
            </script>';
              }
            }
            ?>
          </div>
        </div>
        <div class="forgot-pass">
          <a href="?mod=profile&act=forgotpassword">Quên mật khẩu!</a>
        </div>

        <div class="form-btn">
          <button class="btn-submit" type="submit">Đăng nhập</button>
        </div>
       
        <div class="form-change">
          Bạn chưa có tài khoản?
          <span><a href="?mod=profile&act=register">Đăng kí</a></span>
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