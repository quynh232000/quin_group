<link rel="stylesheet" href="src/css/profile.css">
<!-- <link rel="stylesheet" href="src/css/base.css"> -->


<div class="container-scroller">
    <!-- partial -->
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
                        <small class="settings-heading border-top-0 mb-3 pt-0 border-bottom-0 pb-0 pr-3 fw-normal">See All</small>
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
        <?php include_once "./view/admin/side_bar.php"; ?>
        <!-- partial -->
        <div class="main-panel">
            <div class="content-wrapper">



                <div class="admin-treeview-box">
                    <div class="admin-treeview-column">


                        <!-- <span class="admin-treeview-clickable"><i class="fa-solid fa-caret-right"></i>category 1
                            <ul>
                                <li class="admin-treeview-clickable">child1</li>
                                <li class="admin-treeview-clickable">child2
                                    <ul>
                                        <li class="admin-treeview-clickable">son1</li>
                                        <li class="admin-treeview-clickable">son2</li>
                                    </ul>
                                </li>

                                <li class="admin-treeview-clickable">child3
                                    <ul>
                                        <li class="admin-treeview-clickable">son1
                                            <ul>
                                                <li class="admin-treeview-clickable">sonest1</li>
                                                <li class="admin-treeview-clickable">sonest2</li>
                                                <li class="admin-treeview-clickable">sonest3</li>

                                            </ul>
                                        </li>
                                        <li class="admin-treeview-clickable">son2</li>
                                        <li class="admin-treeview-clickable">son3</li>
                                        <li class="admin-treeview-clickable">son4
                                            <ul>
                                                <li class="admin-treeview-clickable">sonest1</li>
                                                <li class="admin-treeview-clickable">sonest2</li>
                                                <li class="admin-treeview-clickable">sonest3</li>

                                            </ul>
                                        </li>
                                        <li class="admin-treeview-clickable">son5</li>
                                    </ul>
                                </li>
                            </ul>
                        </span> -->


                        <!-- <span class="admin-treeview-clickable">category 2
                            <ul>
                                <li class="admin-treeview-clickable">child1</li>
                                <li class="admin-treeview-clickable">child2
                                    <ul>
                                        <li class="admin-treeview-clickable">son1</li>
                                        <li class="admin-treeview-clickable">son2</li>
                                    </ul>
                                </li>

                                <li class="admin-treeview-clickable">child3
                                    <ul>
                                        <li class="admin-treeview-clickable">son1
                                            <ul>
                                                <li class="admin-treeview-clickable">sonest1</li>
                                                <li class="admin-treeview-clickable">sonest2</li>
                                                <li class="admin-treeview-clickable">sonest3</li>

                                            </ul>
                                        </li>
                                        <li class="admin-treeview-clickable">son2</li>
                                        <li class="admin-treeview-clickable">son3</li>
                                        <li class="admin-treeview-clickable">son4
                                            <ul>
                                                <li class="admin-treeview-clickable">sonest1</li>
                                                <li class="admin-treeview-clickable">sonest2</li>
                                                <li class="admin-treeview-clickable">sonest3</li>

                                            </ul>
                                        </li>
                                        <li class="admin-treeview-clickable">son5</li>
                                    </ul>
                                </li>
                            </ul>
                        </span>
                        <span class="admin-treeview-clickable">category 3
                            <ul>
                                <li class="admin-treeview-clickable">child1</li>
                                <li class="admin-treeview-clickable">child2
                                    <ul>
                                        <li class="admin-treeview-clickable">son1</li>
                                        <li class="admin-treeview-clickable">son2</li>
                                    </ul>
                                </li>

                                <li class="admin-treeview-clickable">child3
                                    <ul>
                                        <li class="admin-treeview-clickable">son1
                                            <ul>
                                                <li class="admin-treeview-clickable">sonest1</li>
                                                <li class="admin-treeview-clickable">sonest2</li>
                                                <li class="admin-treeview-clickable">sonest3</li>

                                            </ul>
                                        </li>
                                        <li class="admin-treeview-clickable">son2</li>
                                        <li class="admin-treeview-clickable">son3</li>
                                        <li class="admin-treeview-clickable">son4
                                            <ul>
                                                <li class="admin-treeview-clickable">sonest1</li>
                                                <li class="admin-treeview-clickable">sonest2</li>
                                                <li class="admin-treeview-clickable">sonest3</li>
                                            </ul>
                                        </li>
                                        <li class="admin-treeview-clickable">son5</li>
                                    </ul>
                                </li>
                            </ul>
                        </span> -->



                        <div class="referral-content tree active">
                            <div class="referral-tree">
                                <!-- tree start -->
                                <ul class="tree-ul active">
                                    <li class="tree-li">
                                        <span class="tree-item has">
                                            <div class="tree-item-icon">
                                                <i class="fa-solid fa-square-plus"></i>
                                                <i class="fa-regular fa-square-minus"></i>

                                            </div>

                                            <div class="tree-item-username">unidi</div>-
                                            <div class="tree-item-fullname">Nguyễn Văn A</div>-
                                            <div class="tree-item-date">22-8-2022</div>
                                        </span>
                                        <ul class="tree-ul">
                                            <li class="tree-li">
                                                <span class="tree-item">
                                                    <div class="tree-item-icon">
                                                        <i class="fa-solid fa-square-plus"></i>
                                                        <i class="fa-regular fa-square-minus"></i>
                                                    </div>
                                                    <div class="tree-item-username">unidi12</div>-
                                                    <div class="tree-item-fullname">Nguyễn Văn A</div>-
                                                    <div class="tree-item-date">22-8-2022</div>
                                                </span>
                                            </li>
                                            <li class="tree-li">
                                                <span class="tree-item has">
                                                    <div class="tree-item-icon ">
                                                        <i class="fa-solid fa-square-plus"></i>
                                                        <i class="fa-regular fa-square-minus"></i>
                                                    </div>
                                                    <div class="tree-item-username">unidi</div>-
                                                    <div class="tree-item-fullname">Nguyễn Văn A</div>-
                                                    <div class="tree-item-date">22-8-2022</div>
                                                </span>
                                                <ul class="tree-ul">
                                                    <li class="tree-li">
                                                        <span class="tree-item has">
                                                            <div class="tree-item-icon">
                                                                <i class="fa-solid fa-square-plus"></i>
                                                                <i class="fa-regular fa-square-minus"></i>
                                                            </div>
                                                            <div class="tree-item-username">unidi</div>-
                                                            <div class="tree-item-fullname">Nguyễn Văn A</div>-
                                                            <div class="tree-item-date">22-8-2022</div>
                                                        </span>
                                                        <ul class="tree-ul">
                                                            <li class="tree-li">
                                                                <span class="tree-item">
                                                                    <div class="tree-item-icon">
                                                                        <i class="fa-solid fa-square-plus"></i>
                                                                        <i class="fa-regular fa-square-minus"></i>
                                                                    </div>
                                                                    <div class="tree-item-username">unidi</div>-
                                                                    <div class="tree-item-fullname">Nguyễn Văn A</div>-
                                                                    <div class="tree-item-date">22-8-2022</div>
                                                                </span>
                                                            </li>
                                                            <li class="tree-li">
                                                                <span class="tree-item">
                                                                    <div class="tree-item-icon">
                                                                        <i class="fa-solid fa-square-plus"></i>
                                                                        <i class="fa-regular fa-square-minus"></i>
                                                                    </div>
                                                                    <div class="tree-item-username">unidi</div>-
                                                                    <div class="tree-item-fullname">Nguyễn Văn A</div>-
                                                                    <div class="tree-item-date">22-8-2022</div>
                                                                </span>
                                                            </li>
                                                            <li class="tree-li">
                                                                <span class="tree-item">
                                                                    <div class="tree-item-icon">
                                                                        <i class="fa-solid fa-square-plus"></i>
                                                                        <i class="fa-regular fa-square-minus"></i>
                                                                    </div>
                                                                    <div class="tree-item-username">unidi</div>-
                                                                    <div class="tree-item-fullname">Nguyễn Văn A</div>-
                                                                    <div class="tree-item-date">22-8-2022</div>
                                                                </span>
                                                            </li>
                                                        </ul>
                                                    </li>
                                                    <li class="tree-li">
                                                        <span class="tree-item">
                                                            <div class="tree-item-icon">
                                                                <i class="fa-solid fa-square-plus"></i>
                                                                <i class="fa-regular fa-square-minus"></i>
                                                            </div>
                                                            <div class="tree-item-username">unidi</div>-
                                                            <div class="tree-item-fullname">Nguyễn Văn A</div>-
                                                            <div class="tree-item-date">22-8-2022</div>
                                                        </span>
                                                    </li>
                                                    <li class="tree-li">
                                                        <span class="tree-item">
                                                            <div class="tree-item-icon">
                                                                <i class="fa-solid fa-square-plus"></i>
                                                                <i class="fa-regular fa-square-minus"></i>
                                                            </div>
                                                            <div class="tree-item-username">unidi</div>-
                                                            <div class="tree-item-fullname">Nguyễn Văn A</div>-
                                                            <div class="tree-item-date">22-8-2022</div>
                                                        </span>
                                                    </li>
                                                </ul>

                                            </li>
                                        </ul>
                                    </li>
                                    <li class="tree-li">
                                        <span class="tree-item has">
                                            <div class="tree-item-icon">
                                                <i class="fa-solid fa-square-plus"></i>
                                                <i class="fa-regular fa-square-minus"></i>

                                            </div>
                                            
                                            <div class="tree-item-username">unidi</div>-
                                            <div class="tree-item-fullname">Nguyễn Văn A</div>-
                                            <div class="tree-item-date">22-8-2022</div>
                                        </span>
                                        <ul class="tree-ul">
                                            <li class="tree-li">
                                                <span class="tree-item">
                                                    <div class="tree-item-icon">
                                                        <i class="fa-solid fa-square-plus"></i>
                                                        <i class="fa-regular fa-square-minus"></i>
                                                    </div>
                                                    <div class="tree-item-username">unidi12</div>-
                                                    <div class="tree-item-fullname">Nguyễn Văn A</div>-
                                                    <div class="tree-item-date">22-8-2022</div>
                                                </span>
                                            </li>
                                            <li class="tree-li">
                                                <span class="tree-item has">
                                                    <div class="tree-item-icon ">
                                                        <i class="fa-solid fa-square-plus"></i>
                                                        <i class="fa-regular fa-square-minus"></i>
                                                    </div>
                                                    <div class="tree-item-username">unidi</div>-
                                                    <div class="tree-item-fullname">Nguyễn Văn A</div>-
                                                    <div class="tree-item-date">22-8-2022</div>
                                                </span>
                                                <ul class="tree-ul">
                                                    <li class="tree-li">
                                                        <span class="tree-item has">
                                                            <div class="tree-item-icon">
                                                                <i class="fa-solid fa-square-plus"></i>
                                                                <i class="fa-regular fa-square-minus"></i>
                                                            </div>
                                                            <div class="tree-item-username">unidi</div>-
                                                            <div class="tree-item-fullname">Nguyễn Văn A</div>-
                                                            <div class="tree-item-date">22-8-2022</div>
                                                        </span>
                                                        <ul class="tree-ul">
                                                            <li class="tree-li">
                                                                <span class="tree-item">
                                                                    <div class="tree-item-icon">
                                                                        <i class="fa-solid fa-square-plus"></i>
                                                                        <i class="fa-regular fa-square-minus"></i>
                                                                    </div>
                                                                    <div class="tree-item-username">unidi</div>-
                                                                    <div class="tree-item-fullname">Nguyễn Văn A</div>-
                                                                    <div class="tree-item-date">22-8-2022</div>
                                                                </span>
                                                            </li>
                                                            <li class="tree-li">
                                                                <span class="tree-item">
                                                                    <div class="tree-item-icon">
                                                                        <i class="fa-solid fa-square-plus"></i>
                                                                        <i class="fa-regular fa-square-minus"></i>
                                                                    </div>
                                                                    <div class="tree-item-username">unidi</div>-
                                                                    <div class="tree-item-fullname">Nguyễn Văn A</div>-
                                                                    <div class="tree-item-date">22-8-2022</div>
                                                                </span>
                                                            </li>
                                                            <li class="tree-li">
                                                                <span class="tree-item">
                                                                    <div class="tree-item-icon">
                                                                        <i class="fa-solid fa-square-plus"></i>
                                                                        <i class="fa-regular fa-square-minus"></i>
                                                                    </div>
                                                                    <div class="tree-item-username">unidi</div>-
                                                                    <div class="tree-item-fullname">Nguyễn Văn A</div>-
                                                                    <div class="tree-item-date">22-8-2022</div>
                                                                </span>
                                                            </li>
                                                        </ul>
                                                    </li>
                                                    <li class="tree-li">
                                                        <span class="tree-item">
                                                            <div class="tree-item-icon">
                                                                <i class="fa-solid fa-square-plus"></i>
                                                                <i class="fa-regular fa-square-minus"></i>
                                                            </div>
                                                            <div class="tree-item-username">unidi</div>-
                                                            <div class="tree-item-fullname">Nguyễn Văn A</div>-
                                                            <div class="tree-item-date">22-8-2022</div>
                                                        </span>
                                                    </li>
                                                    <li class="tree-li">
                                                        <span class="tree-item">
                                                            <div class="tree-item-icon">
                                                                <i class="fa-solid fa-square-plus"></i>
                                                                <i class="fa-regular fa-square-minus"></i>
                                                            </div>
                                                            <div class="tree-item-username">unidi</div>-
                                                            <div class="tree-item-fullname">Nguyễn Văn A</div>-
                                                            <div class="tree-item-date">22-8-2022</div>
                                                        </span>
                                                    </li>
                                                </ul>

                                            </li>
                                        </ul>
                                    </li>

                                </ul>
                                <!-- tree end -->
                            </div>
                        </div>



                    </div>
                </div>


                <!-- <div class="col-md-6 grid-margin stretch-card">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title">Thêm danh mục</h4>
                            <p class="card-description">
                                Danh mục thứ 1
                            </p>
                            <form class="forms-sample" method="POST" action="" enctype="multipart/form-data">

                                <div class="form-group">
                                    <label for="exampleInputUsername1">Tên danh mục</label>
                                    <input name="name_category" type="text" class="form-control" id="exampleInputUsername1" placeholder="ten danh muc">
                                </div>

                                <div class="form-group">
                                    <label>Hình ảnh</label>
                                    <input type="file" name="file_img" class="file-upload-default">
                                    <div class="input-group col-xs-12">
                                        <input type="text" class="form-control file-upload-info" disabled placeholder="Upload Image">
                                        <span class="input-group-append">
                                            <button class="file-upload-browse btn btn-primary" type="button">Upload</button>
                                        </span>
                                    </div>
                                </div>

                                <div class="form-group">
                                        <label class="col-sm-3 col-form-label">Gender</label>
                                        <div class="col-sm-9">
                                            <select class="form-control">
                                                <option>Male</option>
                                                <option>Female</option>
                                            </select>
                                        </div>
                                    </div> 

                                <button type="submit" class="btn btn-primary me-2" name="submit">Submit</button>
                                <button class="btn btn-light">Cancel</button>
                            </form>


                        </div>
                    </div>
                </div> -->



            </div>
            <!-- content-wrapper ends -->
            <!-- partial:../../partials/_footer.html -->
            <?php include_once "view/admin/footer.php" ?>
            <!-- partial -->
        </div>
        <!-- main-panel ends -->
    </div>
    <!-- page-body-wrapper ends -->
</div>
<!-- <script type="module" src="src/js/main.js"></script> -->