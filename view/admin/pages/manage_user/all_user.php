<?php
$isProductsExist = ($countPageUser <= 0) ? false : true;
function checkNullWithValue($valueInput, $opacity, $color)
{
  return (isset($valueInput) && !empty($valueInput)) ? $valueInput : "<div style='opacity: $opacity; color: $color;'>no data...</div>";
}



?>

<div class="container-scroller">
  <!-- partial -->
  <div class="container-fluid page-body-wrapper">
    <!-- partial:../../partials/_settings-panel.html -->
    <!-- partial -->
    <!-- partial:../../partials/_sidebar.html -->
    <?php include_once "view/admin/component/side_bar.php"; ?>
    <!-- partial -->
    <div class="main-panel">
      <div class="content-wrapper">
        <div class="row">

          <!-- modal  -->
          <div class="popup-container popup-create">
            <div class="popup-box" style="overflow-y: scroll; height: 500px;">
              <div class="col-12 stretch-card">
                <div class="card">
                  <div class="card-body">
                    <h4 class="card-title">
                      Edit User
                    </h4>

                    <form id="form-edit-user" class="forms-sample form-edit-user" method="POST" enctype="multipart/form-data" action="">

                      <div class="form-render-user">

                      </div>

                      <!-- <div style="padding: 8px; border-radius: 6px; border: 1px solid rgba(0,0,0,0.2); margin-bottom: 1.5rem;">
                          <p>(Optional)</p>
                          <div class="form-group">
                            <label for="exampleInputPassword4">Old Password</label>
                            <input value="" type="password" class="form-control" id="exampleInputPassword4" placeholder="change your password">
                          </div>
                          <div class="form-group">---------------
                            <label for="exampleInputPassword5">Re-type Password</label>
                            <input value="" type="password" class="form-control" id="exampleInputPassword5" placeholder="re-type your password">
                          </div>
                        </div> -->

                      <input type="text" name="id_product" id="id_product" hidden>
                      <input type="text" name="type" id="id_type" hidden>
                      <input type="text" name="reason" id="id_reason" hidden>

                      <input name="save" type="submit" class="btn btn-primary me-2 submitbtn save-btn-user-edit" value="save" />
                      <button class="btn btn-light popup-close-btn">Cancel</button>
                    </form>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <!-- end modal  -->

          <div class="col-lg-12 grid-margin stretch-card">
            <div class="card">
              <div class="card-body">

                <ul class="nav nav-tabs" id="myTab" role="tablist">
                  <li class="nav-item" role="presentation">
                    <button onclick="window.location.href = '?mod=admin&act=mn_all_user&role=All&page=1'" class="nav-link <?= (isset($_GET["role"]) && $_GET["role"] == "All") ? 'active" aria-selected="true' : '" aria-selected="false'  ?>" id="home-tab" data-bs-toggle="tab" data-bs-target="#home" type="button" role="tab" aria-controls="home">All</button>
                  </li>
                  <li class="nav-item" role="presentation">
                    <button onclick="window.location.href = '?mod=admin&act=mn_all_user&role=Member&page=1'" class="nav-link <?= (isset($_GET["role"]) && $_GET["role"] == "Member") ? 'active" aria-selected="true' : '" aria-selected="false' ?>" aria-selected="true" id="profile-tab" data-bs-toggle="tab" data-bs-target="#profile" type="button" role="tab" aria-controls="profile">Member</button>
                  </li>
                  <li class="nav-item" role="presentation">
                    <button onclick="window.location.href = '?mod=admin&act=mn_all_user&role=Seller&page=1'" class="nav-link <?= (isset($_GET["role"]) && $_GET["role"] == "Seller") ? 'active" aria-selected="true' : '" aria-selected="false' ?>" aria-selected="true" id="contact-tab" data-bs-toggle="tab" data-bs-target="#contact" type="button" role="tab" aria-controls="contact">Seller</button>
                  </li>
                  <li class="nav-item" role="presentation">
                    <button onclick="window.location.href = '?mod=admin&act=mn_all_user&role=Admin&page=1'" class="nav-link <?= (isset($_GET["role"]) && $_GET["role"] == "Admin") ? 'active" aria-selected="true' : '" aria-selected="false' ?>" aria-selected="true" id="contact-tab" data-bs-toggle="tab" data-bs-target="#contact" type="button" role="tab" aria-controls="contact">Admin</button>
                  </li>
                  <li class="nav-item" role="presentation">
                    <button onclick="window.location.href = '?mod=admin&act=mn_all_user&role=AdminAll&page=1'" class="nav-link <?= (isset($_GET["role"]) && $_GET["role"] == "AdminAll") ? 'active" aria-selected="true' : '" aria-selected="false' ?>" aria-selected="true" id="contact-tab" data-bs-toggle="tab" data-bs-target="#contact" type="button" role="tab" aria-controls="contact">Admin All</button>
                  </li>
                </ul>

                <div class="tab-content" id="myTabContent" style="border-radius: 0 16px 16px 16px; padding: 0;">

                  <!-- render issue  -->

                  <div class="tab-pane fade show active" id="contact" role="tabpanel" aria-labelledby="contact-tab">
                    <div class="card-body">
                      <h4 class="card-title">All Users</h4>
                      <p class="card-description">
                        Tất cả users
                      </p>
                      <div class="table-responsive">
                        <!-- table -->
                        <table class="table">

                          <thead>
                            <tr>
                              <th>Full Name</th>
                              <th>Email</th>
                              <th>Phone Number</th>
                              <th>Address</th>
                              <th>Role</th>
                              <th>Created At</th>
                              <th>Action</th>
                            </tr>
                          </thead>

                          <tbody>
                            <?php
                            foreach ($users as $value) {
                              extract($value);
                            ?>
                              <tr>
                                <td>
                                  <a style="text-decoration: none;" href="?mod=admin&act=mn_user_detail&uid=<?= $user_id ?>">
                                    <div class="d-flex flex-column gap-3"><?= $user_fullname ?>
                                      <img src="assest/upload/<?= $user_avatar ?>" alt="">
                                    </div>
                                  </a>
                                </td>
                                <td><?= checkNullWithValue($user_email, "60%", "red") ?></td>
                                <td><?= checkNullWithValue($user_phone, "60%", "red") ?></td>
                                <td><?= checkNullWithValue($user_address, "60%", "red") ?></td>
                                <td><?= checkNullWithValue($user_role, "60%", "red") ?></td>
                                <td><?= checkNullWithValue($user_created, "60%", "red") ?></td>

                                <td>
                                  <div class="btn-clickable" data-user-id="<?= $user_id ?>" data-type="edit">
                                    <img style="cursor: <?= $user_role !== "AdminAll" ? "not-allowed" : "pointer" ?>; width: 20px; height: 20px;" class="" src="assest/upload/setting_771203.png" alt="">
                                  </div>
                                </td>
                              </tr>
                            <?php } ?>
                          </tbody>
                        </table>
                      </div>
                    </div>
                  </div>
                </div>

                <!-- pagination  -->
                <?php
                $pageHTML = "";
                $countPage = ceil(intval($countPageUser["total"]) / 5);
                $page = isset($_GET["page"]) ? intval($_GET["page"]) : 1;
                $roleParam = isset($_GET["role"]) ? "&role=" . $_GET["role"] . "" : "";
                $previousPage = $page > 1 ? $page - 1 : false;
                $nextPage = $page + 1;

                $previous = '<li class="page-item ' . ((($page == 1) || (!$isProductsExist)) ? "disabled" : "") . '" style="' . ((($page == 1) || (!$isProductsExist)) ? "cursor: not-allowed;" : "") . '"> <!--  disabled active class when needs -->
                                                <a class="page-link" href="?mod=admin&act=mn_all_user' . $roleParam . '&page=' . $previousPage . '">Previous</a> <!-- add aria-disabled="true" when you want to disabled -->
                                            </li>';
                $next = '<li class="page-item ' . ((($page == $countPage) || (!$isProductsExist)) ? "disabled" : "") . '" style="' . ((($page == $countPage) || (!$isProductsExist)) ? "cursor: not-allowed;" : "") . '">
                                            <a class="page-link" href="?mod=admin&act=mn_all_user' . $roleParam . '&page=' . $nextPage . '">Next</a>
                                        </li>';
                function paginationHTML($i, $isActive, $role = "")
                {
                  $roleParam = !empty($role) ? "&role=$role" : "";
                  return '
                            <li class="page-item ' . ($isActive ? 'active' : '') . '">
                                <a class="page-link" href="?mod=admin&act=mn_all_user' . $roleParam . '&page=' . $i + 1 . '">' . $i + 1 . '</a>
                            </li>
                            ';
                }

                for ($i = 0; $i < $countPage; $i++) {
                  $isActive = isset($_GET["page"]) && $_GET["page"] == ($i + 1);
                  if (!isset($_GET["role"])) {
                    $pageHTML .= paginationHTML($i, $isActive);
                  } else if (isset($_GET["role"]) && $_GET["role"]) {
                    $pageHTML .= paginationHTML($i, $isActive, $_GET["role"]);
                  }
                }

                $paginationFinal = $previous . $pageHTML . $next;

                ?>

                <nav aria-label="..." style="margin-top: 24px;">
                  <ul class="pagination">
                    <?= $paginationFinal ?>
                  </ul>
                </nav>
                <!-- pagination  -->

              </div>
            </div>
          </div>

        </div>
        <!-- content-wrapper ends -->
        <!-- partial:../../partials/_footer.html -->
        <?php include_once "view/admin/component/footer.php"; ?>
        <!-- partial -->
      </div>
      <!-- main-panel ends -->
    </div>
    <!-- page-body-wrapper ends -->
  </div>