<div class="container-scroller">
    <!-- partial -->
    <div class="container-fluid page-body-wrapper">
        <!-- partial -->
        <?php include_once "view/admin/component/side_bar.php"; ?>
        <!-- partial -->
        <div class="main-panel">
            <div class="content-wrapper">
                <div class="row">
                    <div class="row">
                        <!-- input id or name or email or phone will search out the user after that header to that uid -->
                        <div class="col-lg-12 grid-margin stretch-card">
                            <div class="card">
                                <div class="card-body">
                                    <form action="" method="GET" class="input-group flex-nowrap">
                                        <input type="text" hidden name="mod" value="admin">
                                        <input type="text" hidden name="act" value="mn_user_detail">
                                        <input type="text" class="form-control" name="search" placeholder="search user by email" aria-label="Username" aria-describedby="addon-wrapping">
                                        <button type="submit" class="input-group-text" id="addon-wrapping"><i class="mdi mdi-account-search"></i></button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>

                    <?php
                    if ($user != false) {
                        extract($user);

                        function checkRole($userRole)
                        {
                            switch ($userRole) {
                                case "Member":
                                    return "Thống kê mua hàng";
                                    break;
                                case "Seller":
                                    return "Thống kê bán hàng";
                                    break;
                                case "Admin":
                                    return "Thống kê mua hàng";
                                    break;
                                case "AdminAll":
                                    return "Thống kê mua hàng";
                                    break;
                            }
                        }
                    ?>
                        <div id="content-user-detail" class="row">
                            <div class="col-lg-3 grid-margin stretch-card">
                                <div class="card">
                                    <div class="card-body">
                                        <img src="assest/upload/<?= $avatar ?>" style="width: 150px; height: 150px; border-radius: 50%; object-fit: cover; margin-bottom: 16px;" class="img-thumbnail" alt="...">
                                        <div class="form-group">
                                            <h2 for="exampleInputEmail3">Thông tin cá nhân</h2>
                                        </div>
                                        <div style="margin-bottom: 16px;">
                                            <div class="card">
                                                <div class="card-body">

                                                    <div class="form-group">
                                                        <label for="exampleInputEmail3">Email address:</label>
                                                        <strong><?= $email ?></strong>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="exampleInputEmail3">Phone number:</label>
                                                        <strong><?= $phone_number ?></strong>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="exampleInputEmail3">Full Name:</label>
                                                        <strong><?= $full_name ?></strong>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="exampleInputEmail3">Role:</label>
                                                        <strong><?= $role ?></strong>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="exampleInputEmail3">Created Date:</label>
                                                        <strong><?= $created_at ?></strong>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="exampleInputEmail3">Updated Date:</label>
                                                        <strong><?= $updated_at ?></strong>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <h2 for="exampleInputEmail3">Lịch sử</h2>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-lg-9 grid-margin stretch-card">
                                <div class="card">
                                    <div class="card-body">
                                        <div id="content-user-super-detail">

                                            <!-- onclick="window.location.href = '?mod=admin&act=mn_user_detail&uid=4bb91192-dbb8-11ee-a17a-00155d7efe99&view-mode=7d'" -->

                                            <ul class="nav nav-tabs" id="myTab" role="tablist">

                                                <li class="nav-item" role="presentation">
                                                    <button class="nav-link active" view-mode="7d" aria-selected="true" aria-selected="false" aria-selected="true" id="7d-tab" data-bs-toggle="tab" data-bs-target="#profile" type="button" role="tab" aria-controls="profile">7d</button>
                                                </li>
                                                <li class="nav-item" role="presentation">
                                                    <button class="nav-link" view-mode="30d" aria-selected="true" aria-selected="false" aria-selected="true" id="30d-tab" data-bs-toggle="tab" data-bs-target="#contact" type="button" role="tab" aria-controls="contact">30d</button>
                                                </li>
                                                <li class="nav-item" role="presentation">
                                                    <button class="nav-link" view-mode="12M" aria-selected="true" aria-selected="false" aria-selected="true" id="month-tab" data-bs-toggle="tab" data-bs-target="#contact" type="button" role="tab" aria-controls="contact">12M</button>
                                                </li>
                                                <li class="nav-item" role="presentation">
                                                    <button class="nav-link" view-mode="All" aria-selected="true" aria-selected="false" id="all-tab" data-bs-toggle="tab" data-bs-target="#home" type="button" role="tab" aria-controls="home">All</button>
                                                </li>

                                            </ul>

                                            <div class="tab-content" id="myTabContent" style="border-radius: 0 16px 16px 16px; padding: 0;">

                                                <!-- render issue  -->

                                                <div class="tab-pane fade show active" id="7d" role="tabpanel" aria-labelledby="7d-tab">
                                                    <div class="card-body">

                                                        <h4 class="card-title"><?= checkRole($role) ?></h4>

                                                        <!-- get data by week month and year -->
                                                        <div class="col-lg-12 grid-margin stretch-card">
                                                            <div class="card">
                                                                <div class="card-body">
                                                                    <canvas id="barChart"></canvas>
                                                                </div>
                                                            </div>
                                                        </div>

                                                    </div>
                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>
                    <?php } else {
                        echo "<h4>Search user on input</h4>";
                    } ?>
                    <!-- content-wrapper ends -->
                    <?php include_once "view/admin/component/footer.php"; ?>
                    <!-- partial -->
                </div>
                <!-- main-panel ends -->
            </div>
            <!-- page-body-wrapper ends -->
        </div>