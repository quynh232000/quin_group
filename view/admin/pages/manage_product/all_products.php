<?php
$isProductsExist = (count($productPagination) <= 0) ? false : true;
$updatedHTML = "<th>Updated</th>";
?>

<div class="container-scroller">

    <div class="container-fluid page-body-wrapper">
        <!-- partial:../../partials/_settings-panel.html -->
        <div class="theme-setting-wrapper">
            <div id="settings-trigger"><i class="ti-settings"></i></div>
            <div id="theme-settings" class="settings-panel">
                <i class="settings-close ti-close"></i>
                <p class="settings-heading">SIDEBAR SKINS</p>
                <div class="sidebar-bg-options selected" id="sidebar-light-theme">
                    <div class="img-ss rounded-circle bg-light border me-3"></div>Light
                </div>
                <div class="sidebar-bg-options" id="sidebar-dark-theme">
                    <div class="img-ss rounded-circle bg-dark border me-3"></div>Dark
                </div>
                <p class="settings-heading mt-2">HEADER SKINS</p>
                <div class="color-tiles mx-0 px-4">
                    <div class="tiles success"></div>
                    <div class="tiles warning"></div>
                    <div class="tiles danger"></div>
                    <div class="tiles info"></div>
                    <div class="tiles dark"></div>
                    <div class="tiles default"></div>
                </div>
            </div>
        </div>
        <div id="right-sidebar" class="settings-panel">
            <i class="settings-close ti-close"></i>
            <ul class="nav nav-tabs border-top" id="setting-panel" role="tablist">
                <li class="nav-item">
                    <a class="nav-link active" id="todo-tab" data-bs-toggle="tab" href="#todo-section" role="tab" aria-controls="todo-section" aria-expanded="true">TO DO LIST</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="chats-tab" data-bs-toggle="tab" href="#chats-section" role="tab" aria-controls="chats-section">CHATS</a>
                </li>
            </ul>
            <div class="tab-content" id="setting-content">
                <div class="tab-pane fade show active scroll-wrapper" id="todo-section" role="tabpanel" aria-labelledby="todo-section">
                    <div class="add-items d-flex px-3 mb-0">
                        <form class="form w-100">
                            <div class="form-group d-flex">
                                <input type="text" class="form-control todo-list-input" placeholder="Add To-do">
                                <button type="submit" class="add btn btn-primary todo-list-add-btn" id="add-task">Add</button>
                            </div>
                        </form>
                    </div>
                    <div class="list-wrapper px-3">
                        <ul class="d-flex flex-column-reverse todo-list">
                            <li>
                                <div class="form-check">
                                    <label class="form-check-label">
                                        <input class="checkbox" type="checkbox">
                                        Team review meeting at 3.00 PM
                                    </label>
                                </div>
                                <i class="remove ti-close"></i>
                            </li>
                            <li>
                                <div class="form-check">
                                    <label class="form-check-label">
                                        <input class="checkbox" type="checkbox">
                                        Prepare for presentation
                                    </label>
                                </div>
                                <i class="remove ti-close"></i>
                            </li>
                            <li>
                                <div class="form-check">
                                    <label class="form-check-label">
                                        <input class="checkbox" type="checkbox">
                                        Resolve all the low priority tickets due today
                                    </label>
                                </div>
                                <i class="remove ti-close"></i>
                            </li>
                            <li class="completed">
                                <div class="form-check">
                                    <label class="form-check-label">
                                        <input class="checkbox" type="checkbox" checked>
                                        Schedule meeting for next week
                                    </label>
                                </div>
                                <i class="remove ti-close"></i>
                            </li>
                            <li class="completed">
                                <div class="form-check">
                                    <label class="form-check-label">
                                        <input class="checkbox" type="checkbox" checked>
                                        Project review
                                    </label>
                                </div>
                                <i class="remove ti-close"></i>
                            </li>
                        </ul>
                    </div>
                    <h4 class="px-3 text-muted mt-5 fw-light mb-0">Events</h4>
                    <div class="events pt-4 px-3">
                        <div class="wrapper d-flex mb-2">
                            <i class="ti-control-record text-primary me-2"></i>
                            <span>Feb 11 2018</span>
                        </div>
                        <p class="mb-0 font-weight-thin text-gray">Creating component page build a js</p>
                        <p class="text-gray mb-0">The total number of sessions</p>
                    </div>
                    <div class="events pt-4 px-3">
                        <div class="wrapper d-flex mb-2">
                            <i class="ti-control-record text-primary me-2"></i>
                            <span>Feb 7 2018</span>
                        </div>
                        <p class="mb-0 font-weight-thin text-gray">Meeting with Alisa</p>
                        <p class="text-gray mb-0 ">Call Sarah Graves</p>
                    </div>
                </div>
                <!-- To do section tab ends -->
                <div class="tab-pane fade" id="chats-section" role="tabpanel" aria-labelledby="chats-section">
                    <div class="d-flex align-items-center justify-content-between border-bottom">
                        <p class="settings-heading border-top-0 mb-3 pl-3 pt-0 border-bottom-0 pb-0">Friends</p>
                        <small class="settings-heading border-top-0 mb-3 pt-0 border-bottom-0 pb-0 pr-3 fw-normal">See
                            All</small>
                    </div>
                    <ul class="chat-list">
                        <li class="list active">
                            <div class="profile"><img src="../../images/faces/face1.jpg" alt="image"><span class="online"></span></div>
                            <div class="info">
                                <p>Thomas Douglas</p>
                                <p>Available</p>
                            </div>
                            <small class="text-muted my-auto">19 min</small>
                        </li>
                        <li class="list">
                            <div class="profile"><img src="../../images/faces/face2.jpg" alt="image"><span class="offline"></span></div>
                            <div class="info">
                                <div class="wrapper d-flex">
                                    <p>Catherine</p>
                                </div>
                                <p>Away</p>
                            </div>
                            <div class="badge badge-success badge-pill my-auto mx-2">4</div>
                            <small class="text-muted my-auto">23 min</small>
                        </li>
                        <li class="list">
                            <div class="profile"><img src="../../images/faces/face3.jpg" alt="image"><span class="online"></span></div>
                            <div class="info">
                                <p>Daniel Russell</p>
                                <p>Available</p>
                            </div>
                            <small class="text-muted my-auto">14 min</small>
                        </li>
                        <li class="list">
                            <div class="profile"><img src="../../images/faces/face4.jpg" alt="image"><span class="offline"></span></div>
                            <div class="info">
                                <p>James Richardson</p>
                                <p>Away</p>
                            </div>
                            <small class="text-muted my-auto">2 min</small>
                        </li>
                        <li class="list">
                            <div class="profile"><img src="../../images/faces/face5.jpg" alt="image"><span class="online"></span></div>
                            <div class="info">
                                <p>Madeline Kennedy</p>
                                <p>Available</p>
                            </div>
                            <small class="text-muted my-auto">5 min</small>
                        </li>
                        <li class="list">
                            <div class="profile"><img src="../../images/faces/face6.jpg" alt="image"><span class="online"></span></div>
                            <div class="info">
                                <p>Sarah Graves</p>
                                <p>Available</p>
                            </div>
                            <small class="text-muted my-auto">47 min</small>
                        </li>
                    </ul>
                </div>
                <!-- chat tab ends -->
            </div>
        </div>
        <!-- partial -->
        <!-- partial:../../partials/_sidebar.html -->
        <?php include_once "view/admin/component/side_bar.php"; ?>
        <!-- partial -->
        <div class="main-panel">
            <div class="content-wrapper">
                <div class="row">


                    <!-- modal  -->
                    <div class="popup-container popup-create">
                        <div class="popup-box">
                            <div class="col-12 stretch-card">
                                <div class="card">
                                    <div class="card-body">
                                        <h4 class="card-title"></h4>

                                        <form class="forms-sample" method="POST" enctype="multipart/form-data" action="">
                                            <div class="form-group" style="display: flex; margin-bottom: 12px; align-items: center; gap: 12px">
                                                <label class="label-input" for="">Image</label>
                                                <img id="img-preview" src="" alt="" width="100px">
                                            </div>

                                            <div class="form-group" style="display: flex; align-items: center; gap: 12px; margin-bottom: 0">
                                                <label class="label-input" for="exampleInputName1">Name</label>
                                                <p class="string-name"></p>
                                            </div>
                                            <div class="form-group" style="display: flex; align-items: center; gap: 12px; margin-bottom: 0">
                                                <label class="label-input" for="exampleInputName1">Shop</label>
                                                <p class="string-name"></p>
                                            </div>
                                            <div class="form-group" style="display: flex; align-items: center; gap: 12px; margin-bottom: 0">
                                                <label class="label-input" for="exampleInputName1">Category</label>
                                                <p class="string-name"></p>
                                            </div>

                                            <input type="text" name="id_product" id="id_product" hidden>
                                            <input type="text" name="type" id="id_type" hidden>
                                            <input type="text" name="reason" id="id_reason" hidden>
                                            <div class="reject-message"></div>

                                            <input name="approve" type="submit" class="btn btn-primary me-2 submitbtn approve" value="Approve" />
                                            <input name="reject" type="submit" class="btn btn-danger me-2 submitbtn reject" value="Reject" />
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
                                        <button onclick="window.location.href = '?mod=admin&act=mn_all_products&page=1'" class="nav-link <?= (!isset($_GET["status"])) ? 'active" aria-selected="true' : '" aria-selected="false'  ?>" id="home-tab" data-bs-toggle="tab" data-bs-target="#home" type="button" role="tab" aria-controls="home">All</button>
                                    </li>
                                    <li class="nav-item" role="presentation">
                                        <button onclick="window.location.href = '?mod=admin&act=mn_all_products&status=New&page=1'" class="nav-link <?= (isset($_GET["status"]) && $_GET["status"] == "New") ? 'active" aria-selected="true' : '" aria-selected="false' ?>" aria-selected="true" id="profile-tab" data-bs-toggle="tab" data-bs-target="#profile" type="button" role="tab" aria-controls="profile">Pending</button>
                                    </li>
                                    <li class="nav-item" role="presentation">
                                        <button onclick="window.location.href = '?mod=admin&act=mn_all_products&status=Activated&page=1'" class="nav-link <?= (isset($_GET["status"]) && $_GET["status"] == "Activated") ? 'active" aria-selected="true' : '" aria-selected="false' ?>" aria-selected="true" id="contact-tab" data-bs-toggle="tab" data-bs-target="#contact" type="button" role="tab" aria-controls="contact">Activated</button>
                                    </li>
                                    <li class="nav-item" role="presentation">
                                        <button onclick="window.location.href = '?mod=admin&act=mn_all_products&status=Rejected&page=1'" class="nav-link <?= (isset($_GET["status"]) && $_GET["status"] == "Rejected") ? 'active" aria-selected="true' : '" aria-selected="false' ?>" aria-selected="true" id="contact-tab" data-bs-toggle="tab" data-bs-target="#contact" type="button" role="tab" aria-controls="contact">Rejected</button>
                                    </li>
                                </ul>

                                <div class="tab-content" id="myTabContent" style="border-radius: 0 16px 16px 16px; padding: 0;">

                                    <!-- render issue  -->

                                    <div class="tab-pane fade show active" id="contact" role="tabpanel" aria-labelledby="contact-tab">
                                        <div class="card-body">
                                            <?php
                                            if (isset($_GET["status"]) && $_GET["status"]) {
                                                switch (strtolower($_GET["status"])) {
                                                    case "new":
                                                        echo ' <h4 class="card-title">Pending products</h4>
                                                                <p class="card-description">Sản phẩm chờ duyệt</p>';
                                                        break;
                                                    case "activated":
                                                        echo ' <h4 class="card-title">Activated products</h4>
                                                                <p class="card-description">Sản phẩm đã duyệt</p>';
                                                        break;
                                                    case "rejected":
                                                        echo ' <h4 class="card-title">Rejected products</h4>
                                                                <p class="card-description">Sản phẩm bị từ chối</p>';
                                                        break;
                                                }
                                            } else {
                                                echo ' <h4 class="card-title">Tất cả sản phẩm</h4>
                                                        <p class="card-description"></p>';
                                            }
                                            ?>

                                            <div class="table-responsive">
                                                <!-- table -->
                                                <table class="table">
                                                    <?php
                                                    if ($isProductsExist) {
                                                    ?>
                                                        <thead>
                                                            <tr>
                                                                <th>Shop Owner</th>
                                                                <th>Name</th>
                                                                <th>Image</th>
                                                                <th>Brand</th>
                                                                <th>Shop</th>
                                                                <th>Category</th>
                                                                <th>Status</th>
                                                                <th>Created</th>
                                                                <?php
                                                                echo ((isset($_GET["status"]) && ($_GET["status"] == "Activated" || $_GET["status"] == "Rejected"))) ? $updatedHTML : "";
                                                                ?>
                                                            </tr>
                                                        </thead>
                                                    <?php
                                                    } else {
                                                        echo "";
                                                    }
                                                    ?>
                                                    <tbody>
                                                        <?php
                                                        if (isset($productPagination) && count($productPagination) > 0) {
                                                            foreach ($productPagination as $key => $value) {
                                                                extract($value);
                                                        ?>
                                                                <tr>
                                                                    <td><?= $shop_owner ?></td>
                                                                    <td style="width: 45%"><?= $product_name ?></td>
                                                                    <td>
                                                                        <img src="assest/upload/<?= $image_cover ?>" />
                                                                    </td>
                                                                    <td><?= $brand ?></td>
                                                                    <td><?= $shop_name ?></td>
                                                                    <td><?= $category_name ?></td>
                                                                    <td>
                                                                        <?php
                                                                        switch (strtolower($status)) {
                                                                            case "new":
                                                                                $listString = json_encode([$product_name, $shop_name, $category_name]);
                                                                                echo '<label class="badge badge-warning btn-clickable" data-idProduct="' . $id . '" data-type="' . strtolower($status) . '" data-img="' . $image_cover . '" data-list-name=\'' . $listString . '\' style="cursor: pointer;">
                                                                                        ' . $status . '
                                                                                    </label>';
                                                                                break;
                                                                            case "activated":
                                                                                echo '<label class="badge badge-success" style="cursor: pointer">
                                                                                        ' . $status . '
                                                                                    </label>';
                                                                                break;
                                                                            case "rejected":
                                                                                echo '<label class="badge badge-danger btn-clickable" style="cursor: pointer" data-type="' . strtolower($status) . '" data-reason="' . $reason . '" data-onwer="' . $shop_owner . '">
                                                                                        ' . $status . '
                                                                                    </label>';
                                                                                break;
                                                                        }
                                                                        ?>
                                                                    </td>
                                                                    <td><?= $created_at ?></td>
                                                                    <?php echo ((isset($_GET["status"]) && $_GET["status"] == "Activated")) ? "<td>$updated</td>" : (((isset($_GET["status"])) && $_GET["status"] == "Rejected") ? "<td>$updated</td>" : ""); ?>
                                                                </tr>
                                                        <?php  }
                                                        } else {
                                                            echo '<h3 style="color: red; text-align:center;">No record...</h3>';
                                                        }
                                                        ?>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- pagination  -->
                                <?php
                                $pageHTML = "";
                                $countPage = ceil(count($products) / 10);
                                $page = isset($_GET["page"]) ? intval($_GET["page"]) : 1;
                                $statusParam = isset($_GET["status"]) ? "&status=" . $_GET["status"] . "" : "";
                                $previousPage = $page > 1 ? $page - 1 : false;
                                $nextPage = $page + 1;

                                $previous = '<li class="page-item ' . ((($page == 1) || (!$isProductsExist)) ? "disabled" : "") . '" style="' . ((($page == 1) || (!$isProductsExist)) ? "cursor: not-allowed;" : "") . '"> <!--  disabled active class when needs -->
                                                <a class="page-link" href="?mod=admin&act=mn_all_products' . $statusParam . '&page=' . $previousPage . '">Previous</a> <!-- add aria-disabled="true" when you want to disabled -->
                                            </li>';
                                $next = '<li class="page-item ' . ((($page == $countPage) || (!$isProductsExist)) ? "disabled" : "") . '" style="' . ((($page == $countPage) || (!$isProductsExist)) ? "cursor: not-allowed;" : "") . '">
                                            <a class="page-link" href="?mod=admin&act=mn_all_products' . $statusParam . '&page=' . $nextPage . '">Next</a>
                                        </li>';
                                function paginationHTML($i, $isActive, $status = "")
                                {
                                    $statusParam = !empty($status) ? "&status=$status" : "";
                                    return '
                                            <li class="page-item ' . ($isActive ? 'active' : '') . '">
                                                <a class="page-link" href="?mod=admin&act=mn_all_products' . $statusParam . '&page=' . $i + 1 . '">' . $i + 1 . '</a>
                                            </li>
                                            ';
                                }

                                for ($i = 0; $i < $countPage; $i++) {
                                    $isActive = isset($_GET["page"]) && $_GET["page"] == ($i + 1);
                                    if (!isset($_GET["status"])) {
                                        $pageHTML .= paginationHTML($i, $isActive);
                                    } else if (isset($_GET["status"]) && $_GET["status"]) {
                                        switch (strtolower($_GET["status"])) {
                                            case "new":
                                            case "activated":
                                            case "rejected":
                                                $pageHTML .= paginationHTML($i, $isActive, $_GET["status"]);
                                                break;
                                        }
                                    }
                                }
                                $paginationFinal = $previous . $pageHTML . $next;

                                ?>

                                <nav aria-label="..." style="margin-top: 24px;">
                                    <ul class="pagination">
                                        <?= $paginationFinal ?>
                                    </ul>
                                </nav>


                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- content-wrapper ends -->
            <!-- partial:../../partials/_footer.html -->
            <?php include_once "view/admin/component/footer.php" ?>
            <!-- partial -->
        </div>
        <!-- main-panel ends -->
    </div>
    <!-- page-body-wrapper ends -->
</div>