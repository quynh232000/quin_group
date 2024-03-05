<!-- main -->
<main class="shop-main">
    <!-- content -->
    <div class="shop-main-content">
        <div class="shop-top">
            <div class="shop-title">Quản lí danh mục</div>
            <div class="shop-pro-filter">
                <div class="category">
                    <form method="post" class="cate-add" enctype="multipart/form-data">

                        <div class="form-group">
                            <label for="name" class="form-label">Tên danh mục</label>
                            <input type="text" value="<?php
                            if (isset($resultGetInfo)) {
                                echo $resultGetInfo['nameCate'];
                            }
                            ?>" name="name" rules="required" class="form-control" placeholder="Aa..." />
                            <span class="form-message"></span>
                        </div>
                        <div class="form-group">
                            <label for="fullname" class="form-label">Ảnh đại diện</label>
                            <input hidden type="file" id="idcateimage" name="image" rules="required"
                                class="form-control cate-up-image" />
                            <span class="form-message"></span>
                        </div>
                        <div class="form-group">
                            <label for="idcateimage" class="cate-img-wrapper">
                                <img class="cate-img-preview" src="<?php
                                if (isset($resultGetInfo)) {
                                    echo "./assest/upload/" . $resultGetInfo['imageCate'];
                                } else {
                                    echo "https://png.pngtree.com/png-clipart/20190921/original/pngtree-file-upload-icon-png-image_4717174.jpg";
                                }
                                ?>" alt="">
                            </label>
                        </div>

                        <div class="cate-mes" style="color:blue">
                            <?php
                            if (isset($createCate)) {
                                echo $createCate;
                            }
                            ?>
                        </div>

                        <!-- <button class="form-submit">Tạo</button> -->
                        <!-- <input class="form-submit" type="submit" name="create-cate-btn" value="<?php
                        if (isset($resultGetInfo)) {
                            echo "Cập nhật";
                        } else {
                            echo "Tạo";
                        }
                        ?>"> -->
                        <label for="create-btn-pro" class="btn-add-pro" style="text-align:center">
                            <input id="create-btn-pro" type="submit" class="c-btn c-btn-save" hidden type="submit"
                                name="create-cate-btn" value="<?php
                                if (isset($resultGetInfo)) {
                                    echo "Cập nhật";
                                } else {
                                    echo "Tạo";
                                }
                                ?>">
                            <?php
                                if (isset($resultGetInfo)) {
                                    echo "Cập nhật";
                                } else {
                                    echo "Tạo";
                                }
                                ?>
                            <div class="star-1">
                                <svg xmlns="http://www.w3.org/2000/svg" xml:space="preserve" version="1.1"
                                    style="shape-rendering:geometricPrecision; text-rendering:geometricPrecision; image-rendering:optimizeQuality; fill-rule:evenodd; clip-rule:evenodd"
                                    viewBox="0 0 784.11 815.53" xmlns:xlink="http://www.w3.org/1999/xlink">
                                    <defs></defs>
                                    <g id="Layer_x0020_1">
                                        <metadata id="CorelCorpID_0Corel-Layer"></metadata>
                                        <path class="fil0"
                                            d="M392.05 0c-20.9,210.08 -184.06,378.41 -392.05,407.78 207.96,29.37 371.12,197.68 392.05,407.74 20.93,-210.06 184.09,-378.37 392.05,-407.74 -207.98,-29.38 -371.16,-197.69 -392.06,-407.78z">
                                        </path>
                                    </g>
                                </svg>
                            </div>
                            <div class="star-2">
                                <svg xmlns="http://www.w3.org/2000/svg" xml:space="preserve" version="1.1"
                                    style="shape-rendering:geometricPrecision; text-rendering:geometricPrecision; image-rendering:optimizeQuality; fill-rule:evenodd; clip-rule:evenodd"
                                    viewBox="0 0 784.11 815.53" xmlns:xlink="http://www.w3.org/1999/xlink">
                                    <defs></defs>
                                    <g id="Layer_x0020_1">
                                        <metadata id="CorelCorpID_0Corel-Layer"></metadata>
                                        <path class="fil0"
                                            d="M392.05 0c-20.9,210.08 -184.06,378.41 -392.05,407.78 207.96,29.37 371.12,197.68 392.05,407.74 20.93,-210.06 184.09,-378.37 392.05,-407.74 -207.98,-29.38 -371.16,-197.69 -392.06,-407.78z">
                                        </path>
                                    </g>
                                </svg>
                            </div>
                            <div class="star-3">
                                <svg xmlns="http://www.w3.org/2000/svg" xml:space="preserve" version="1.1"
                                    style="shape-rendering:geometricPrecision; text-rendering:geometricPrecision; image-rendering:optimizeQuality; fill-rule:evenodd; clip-rule:evenodd"
                                    viewBox="0 0 784.11 815.53" xmlns:xlink="http://www.w3.org/1999/xlink">
                                    <defs></defs>
                                    <g id="Layer_x0020_1">
                                        <metadata id="CorelCorpID_0Corel-Layer"></metadata>
                                        <path class="fil0"
                                            d="M392.05 0c-20.9,210.08 -184.06,378.41 -392.05,407.78 207.96,29.37 371.12,197.68 392.05,407.74 20.93,-210.06 184.09,-378.37 392.05,-407.74 -207.98,-29.38 -371.16,-197.69 -392.06,-407.78z">
                                        </path>
                                    </g>
                                </svg>
                            </div>
                            <div class="star-4">
                                <svg xmlns="http://www.w3.org/2000/svg" xml:space="preserve" version="1.1"
                                    style="shape-rendering:geometricPrecision; text-rendering:geometricPrecision; image-rendering:optimizeQuality; fill-rule:evenodd; clip-rule:evenodd"
                                    viewBox="0 0 784.11 815.53" xmlns:xlink="http://www.w3.org/1999/xlink">
                                    <defs></defs>
                                    <g id="Layer_x0020_1">
                                        <metadata id="CorelCorpID_0Corel-Layer"></metadata>
                                        <path class="fil0"
                                            d="M392.05 0c-20.9,210.08 -184.06,378.41 -392.05,407.78 207.96,29.37 371.12,197.68 392.05,407.74 20.93,-210.06 184.09,-378.37 392.05,-407.74 -207.98,-29.38 -371.16,-197.69 -392.06,-407.78z">
                                        </path>
                                    </g>
                                </svg>
                            </div>
                            <div class="star-5">
                                <svg xmlns="http://www.w3.org/2000/svg" xml:space="preserve" version="1.1"
                                    style="shape-rendering:geometricPrecision; text-rendering:geometricPrecision; image-rendering:optimizeQuality; fill-rule:evenodd; clip-rule:evenodd"
                                    viewBox="0 0 784.11 815.53" xmlns:xlink="http://www.w3.org/1999/xlink">
                                    <defs></defs>
                                    <g id="Layer_x0020_1">
                                        <metadata id="CorelCorpID_0Corel-Layer"></metadata>
                                        <path class="fil0"
                                            d="M392.05 0c-20.9,210.08 -184.06,378.41 -392.05,407.78 207.96,29.37 371.12,197.68 392.05,407.74 20.93,-210.06 184.09,-378.37 392.05,-407.74 -207.98,-29.38 -371.16,-197.69 -392.06,-407.78z">
                                        </path>
                                    </g>
                                </svg>
                            </div>
                            <div class="star-6">
                                <svg xmlns="http://www.w3.org/2000/svg" xml:space="preserve" version="1.1"
                                    style="shape-rendering:geometricPrecision; text-rendering:geometricPrecision; image-rendering:optimizeQuality; fill-rule:evenodd; clip-rule:evenodd"
                                    viewBox="0 0 784.11 815.53" xmlns:xlink="http://www.w3.org/1999/xlink">
                                    <defs></defs>
                                    <g id="Layer_x0020_1">
                                        <metadata id="CorelCorpID_0Corel-Layer"></metadata>
                                        <path class="fil0"
                                            d="M392.05 0c-20.9,210.08 -184.06,378.41 -392.05,407.78 207.96,29.37 371.12,197.68 392.05,407.74 20.93,-210.06 184.09,-378.37 392.05,-407.74 -207.98,-29.38 -371.16,-197.69 -392.06,-407.78z">
                                        </path>
                                    </g>
                                </svg>
                            </div>
                        </label>

                    </form>

                </div>
            </div>

            <div class="cate-list-item">
                <div class="cate-nav">
                    <div class="cate-item1">
                        <div class="cate-stt">
                            <div class="cate-label">STT</div>
                        </div>
                        <div class="cate-iamge">
                            <div class="cate-label">Ảnh</div>
                        </div>
                        <div class="cate-right">
                            <div class="cate-name">
                                <div class="cate-label">Tên</div>
                            </div>
                            <div class="cate-action">
                                <div class="cate-label">Hành động</div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="cate-list">

                    <?php
                    if (isset($allCategory)) {
                        foreach ($allCategory as $key => $value) {

                            echo '<div class="cate-item1">
                                            <div class="cate-stt">' . $value["id"] . '</div>
                                            <div class="cate-iamge">
                                                <img src="assest/upload/' . $value["imageCate"] . '"
                                                    alt="">
                                            </div>
                                           <div class="cate-right">
                                            <div class="cate-name">(' . $value["count"] . ') ' . $value["nameCate"] . '</div>
                                            <div class="cate-action" >
                                                <a href="?mod=seller&act=managecategory&type=edit&idCate=' . $value["id"] . '" class="cate-action-item" title="Sửa"><i class="fa-regular fa-pen-to-square"></i></a>
                                                <a href="?mod=seller&act=managecategory&type=delete&idCate=' . $value["id"] . '" class="cate-action-item" title="Xóa"><i class="fa-solid fa-trash-can"></i></a>
                                               
                                            </div>
                                           </div>
                                        </div>';
                        }
                    }
                    ?>

                </div>


            </div>
        </div>

    </div>
</main>
</div>
</div>