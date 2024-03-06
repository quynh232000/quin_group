<!-- main -->
<main class="shop-main">
    <!-- content -->
    <div class="shop-main-content">
        <div class="shop-top">
            <div class="shop-title">
                <?php
                if (isset($_GET['idPro'])) {
                    echo "Chỉnh sửa sản phẩm";
                } else {
                    echo "Tạo sản phẩm mới";
                }
                ?>
            </div>
        </div>
        <!-- <?php if (isset($productInfo)) {
            echo "";
        } ?> -->
        <div class="shop-add">
            <form class="c-body" id="form-create-product" method="POST" enctype="multipart/form-data" action="">
                <div class="c-left">
                    <div class="detail-group-item w-100">
                        <div class="shop-form-group  w-100">
                            <div class="form-group-wrapper">

                                <div class="form-group-body w-100">
                                    <label for="" class="form-label">
                                        Tên <i class="fa-solid fa-circle-info"></i>
                                    </label>
                                    <div class="shop-form-control">
                                        <div class="form-input-body">
                                            <input type="text" name="name"
                                                value="<?= isset($productInfo) ? $productInfo[0]['namePro'] : "" ?>"
                                                rules="required" class="form-input"
                                                placeholder="Nhập tên sản phẩm..." />
                                        </div>
                                    </div>
                                    <div class="form-msg"></div>
                                </div>

                                <!-- <div class="cate-body w-50">
                                          <div class="form-group-body w-100">
                                              <label for="" class="form-label">
                                                  Danh mục <i class="fa-solid fa-circle-info"></i>
                                              </label>
                                              <div class="shop-form-control">
                                                      <div class="form-input-body">
                                                          <select name="categoryId"
                                                                  rules="required"
                                                                  id=""
                                                                  class="list-categoryChild">
                                                                <option value="">--Chọn danh mục--</option>   
                                                                <?php foreach ($allCategory as $key => $value) { ?>
                                                                        <option value="<?= $value['id'] ?>"
                                                                        <?= isset($productInfo) ? $productInfo[0]['category_id'] == $value['id'] ? "selected" : "" : "" ?>
                                                                        ><?= $value['name'] ?></option>
                                                                 <?php }
                                                                ?> 
                                                            </select>
                                                      </div>
                                                  </div>
                                              <div class="form-msg"></div>
                                          </div>
                                          
                                      </div> -->


                                <div class="cate-body w-100">
                                    <div class="form-group-body w-100">
                                        <label for="" class="form-label">
                                            Danh mục <i class="fa-solid fa-circle-info"></i>
                                        </label>
                                        <div class="shop-form-control">
                                            <div class="form-input-body">
                                                <div class="select-cate-title" id="select-category-product">
                                                    <span class="show-select-cate-view">
                                                        Chọn danh mục
                                                    </span>
                                                    <i class="fa-solid fa-pen"></i>
                                                </div>
                                                <!-- <input id="input_category_id" type="text" name="category_id"> -->
                                                <!-- @*modal eidit category*@ -->
                                                <div class="modal-edit-cate">
                                                    <div class="modal-cate-wrapper">
                                                        <div class="modal-cate-title">
                                                            <span>Chỉnh sửa danh mục</span>
                                                            <div class="modal-close btn-modal-cate-close">
                                                                <i class="fa-solid fa-xmark"></i>
                                                            </div>
                                                        </div>
                                                        <div class="modal-cate-body">
                                                            <div class="madla-cate-body-title">Select the correct field,
                                                                <a href="#">click here to learn more.</a>
                                                            </div>
                                                            <div class="modal-cate-info" id="show-detail-cate">

                                                               
                                                               <div class="modal-cate-group">
                                                                    <div class="modal-cate-group-wrapper">
                                                                        <?php
                                                                        foreach ($allCategory as $key => $value) { ?>
                                                                      
                                                                            <div class="modal-cate-item" onclick="selectCategory(this,<?=$value['id']?>)"
                                                                                idCate="<?= $value['id'] ?>" checkLast=" <?php
                                                                                 if (isset($value['children']) && $value['children']) {
                                                                                     echo "has";
                                                                                 } else {
                                                                                     echo "no";
                                                                                 }
                                                                                 ?>">
                                                                                <p>
                                                                                    <?= $value['name'] ?>
                                                                                </p>
                                                                                <?php
                                                                                if (isset($value['children']) && $value['children']) {
                                                                                    echo '<i class="fa-solid fa-chevron-right"></i>';
                                                                                }
                                                                                ?>

                                                                            </div>
                                                                        <?php }
                                                                        ?>
                                                                    </div>
                                                                </div> 

                                                                <!-- <div class="modal-cate-group">
                                                                    <div class="modal-cate-group-wrapper">

                                                                        <div class="modal-cate-item active">
                                                                            <p>Men clothes</p>
                                                                            <i class="fa-solid fa-chevron-right"></i>
                                                                        </div>

                                                                        <div class="modal-cate-item">
                                                                            <p>Men clothes</p>
                                                                            <i class="fa-solid fa-chevron-right"></i>
                                                                        </div>

                                                                        <div class="modal-cate-item">
                                                                            <p>Men clothes</p>
                                                                            <i class="fa-solid fa-chevron-right"></i>
                                                                        </div>

                                                                        <div class="modal-cate-item">
                                                                            <p>Men clothes</p>
                                                                            <i class="fa-solid fa-chevron-right"></i>
                                                                        </div>

                                                                        <div class="modal-cate-item">
                                                                            <p>Men clothes</p>
                                                                            <i class="fa-solid fa-chevron-right"></i>
                                                                        </div>
                                                                    </div>
                                                                </div> -->

                                                            </div>
                                                        </div>
                                                        <div class="modal-cate-bottom">
                                                            <div class="modal-cate-bottom-left">
                                                                <span>
                                                                    Selected:
                                                                </span>
                                                                <div class="modal-cate-selected">
                                                                    <!-- <div class="modal-cate-selected-item">
                                                                        <span>Clothes</span>

                                                                    </div>
                                                                    <div class="modal-cate-selected-item">
                                                                        <i class="fa-solid fa-chevron-right"></i>
                                                                        <span>Clothes</span>

                                                                    </div>
                                                                    <div class="modal-cate-selected-item">
                                                                        <i class="fa-solid fa-chevron-right"></i>
                                                                        <span>Clothes</span>

                                                                    </div> -->
                                                                </div>
                                                            </div>
                                                            <div class="modal-cate-bottom-right" onclick="loghello()">
                                                                <button class="modal-btn-cancel" >
                                                                    Cancel
                                                                </button>
                                                                <button disabled class="modal-btn-confirm">
                                                                    Confirm
                                                                </button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                            </div>
                                        </div>
                                        <div class="form-msg"></div>
                                    </div>

                                    <div class="form-group-body w-30 catelog1">
                                        <!-- @*<label for="" class="form-label">
                                                      Catalog <i class="fa-solid fa-circle-info"></i>
                                                  </label>
                                                  <div class="shop-form-control">
                                                      <div class="form-input-body">
                                                          <select name="cateChildId"
                                                                  rules="required"
                                                                  id=""
                                                                  class="list-categoryChild"></select>
                                                      </div>
                                                  </div>
                                                  <div class="form-msg"></div>*@ -->
                                    </div>
                                    <div class="form-group-body w-30 catelog2">
                                        <!-- @*<label for="" class="form-label">
                                                      Catalog <i class="fa-solid fa-circle-info"></i>
                                                  </label>
                                                  <div class="shop-form-control">
                                                      <div class="form-input-body">
                                                          <select name="cateChildId"
                                                                  rules="required"
                                                                  id=""
                                                                  class="list-categoryChild"></select>
                                                      </div>
                                                  </div>
                                                  <div class="form-msg"></div>*@ -->
                                    </div>
                                </div>




                                <div class="form-group-body w-50">
                                    <label for="" class="form-label">
                                        Đơn vị <i class="fa-solid fa-circle-info"></i>
                                    </label>
                                    <div class="shop-form-control">
                                        <div class="form-input-body">
                                            <input type="text"
                                                value="<?= isset($productInfo) ? $productInfo[0]['unit'] : "" ?>"
                                                name="unit" placeholder="Cái, cặp, hộp,..." />

                                        </div>
                                    </div>
                                    <div class="form-msg"></div>
                                </div>
                                <div class="form-group-body w-50">
                                    <label for="" class="form-label">
                                        Thương hiệu<i class="fa-solid fa-circle-info"></i>
                                    </label>
                                    <div class="shop-form-control">
                                        <div class="form-input-body">
                                            <input type="text" name="brand"
                                                value="<?= isset($productInfo) ? $productInfo[0]['brand'] : "" ?>"
                                                class="form-input" placeholder="Iphone, Samsung,..." />
                                        </div>
                                    </div>
                                    <div class="form-msg"></div>
                                </div>
                                <div class="form-group-body w-50">
                                    <label for="" class="form-label">
                                        Xuất sứ
                                    </label>
                                    <div class="shop-form-control">
                                        <div class="form-input-body">
                                            <input type="text" name="origin"
                                                value="<?= isset($productInfo) ? $productInfo[0]['origin'] : "" ?>"
                                                class="form-input" placeholder="Trung Quốc, Nhật Bản..." />
                                        </div>
                                    </div>
                                    <div class="form-msg"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="shop-form-group  w-100">
                        <div class="form-group-wrapper">

                            <div class="form-group-body w-50">
                                <label for="" class="form-label">
                                    Giá ( VND )<i class="fa-solid fa-circle-info"></i>
                                </label>
                                <div class="shop-form-control">
                                    <div class="form-input-body">
                                        <input type="text" name="price"
                                            value=" <?= isset($productInfo) ? (int) $productInfo[0]['price'] : 0 ?>"
                                            class="form-input" rules="required" placeholder="VND" />
                                    </div>
                                </div>
                                <div class="form-msg"></div>
                            </div>
                            <div class="form-group-body w-50">
                                <label for="" class="form-label">(%) giảm giá </label>
                                <div class="shop-form-control">
                                    <div class="form-input-body">
                                        <input type="text" name="salePercent" class="form-input"
                                            value="<?= isset($productInfo) ? $productInfo[0]['salePercent'] : "" ?>"
                                            placeholder="0%" />
                                    </div>
                                </div>
                                <div class="form-msg"></div>
                            </div>
                            <div class="form-group-body w-50">
                                <label for="" class="form-label">
                                    Số lượng<i class="fa-solid fa-circle-info"></i>
                                </label>
                                <div class="shop-form-control">
                                    <div class="form-input-body">
                                        <input type="number" name="quantity" class="form-input" rules="required"
                                            value="<?= isset($productInfo) ? $productInfo[0]['quantity'] : "100" ?>"
                                            placeholder="0" />
                                    </div>
                                </div>
                                <div class="form-msg"></div>
                            </div>
                        </div>
                    </div>

                    <div class="shop-form-group  w-100">
                        <div class="form-group-wrapper">
                            <div class="form-group-body w-100">
                                <div class="form-group-title">Mô tả chi tiết</div>
                            </div>
                            <div class="form-group-body w-100">
                                <div class="shop-form-control">
                                    <div class="form-input-body form-input-body-editor">
                                        <div id="editor" style="min-height: 220px">
                                            <?= isset($productInfo) ? $productInfo[0]['description'] : "" ?>
                                        </div>
                                    </div>

                                    <textarea value="" style="display:none" name="description"
                                        id="description"></textarea>
                                </div>
                                <div class="form-msg"></div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="c-right">
                    <!-- item -->

                    <!-- @* <input name="imageCover" type="file"/>*@ -->
                    <!-- item -->
                    <div class="shop-form-group  w-100">
                        <div class="form-group-wrapper">
                            <div class="form-group-body w-100">
                                <div class="form-group-title">
                                    <div>Ảnh đại diện</div>
                                    <label for="upload-img-avatar" class="btn-upload-img">Tải lên</label>
                                </div>
                            </div>
                            <div class="form-group-body w-100 ">
                                <input type="file" id="upload-img-avatar" class="upload-img hidden" name="image"
                                    hidden />
                                <label class="form-list-img label-img label-image-cover"
                                    style="<?= isset($productInfo) ? "display:none" : "" ?>" for="upload-img-avatar">
                                    <div class="list-img w-100">
                                        <i class="fa-solid fa-images"></i>
                                    </div>
                                    <div class="list-title">Tải ảnh lên!</div>
                                </label>
                                <!-- @*show image*@ -->
                                <div class="product-imgs ">
                                    <div class="create-show-image-body"
                                        style=" <?= isset($productInfo) ? "display:flex" : "" ?>">
                                        <img class="create-show-image"
                                            src="./assest/upload/<?= isset($productInfo) ? $productInfo[0]['image'] : "" ?>" />
                                    </div>
                                </div>
                                <div class="form-msg"></div>
                            </div>
                        </div>
                    </div>
                    <div class="shop-form-group  w-100">
                        <div class="form-group-wrapper">
                            <div class="form-group-body w-100">
                                <div class="form-group-title">
                                    <div>Ảnh preview <span>(<span class="total-img">0</span>/10)</span></div>
                                    <label for="upload-img" class="btn-upload-img">Tải lên</label>
                                </div>
                            </div>
                            <div class="form-group-body w-100 ">
                                <input type="file" id="upload-img" class="upload-img" name="listImage[]"
                                    accept="image/*" multiple />
                                <label class="form-list-img label-list-img"
                                    style="<?= isset($productInfo) ? "display:block" : "" ?>" for="upload-img">
                                    <div class="list-img w-100">

                                        <?php
                                        if (isset($productInfo)) {
                                            foreach ($productInfo[1] as $key => $value) { ?>
                                                <div class="product-img">
                                                    <div class="product-img-wrapper">
                                                        <img src="./assest/upload/<?= $value['link'] ?>" />
                                                        <div class="product-img-delete">
                                                            <i class="fa-regular fa-trash-can"></i>
                                                        </div>
                                                    </div>
                                                </div>
                                            <?php }

                                        } else {
                                            echo '<i class="fa-solid fa-images"></i>';
                                        }
                                        ?>
                                    </div>
                                    <div class="list-title">Tải ảnh lên!</div>
                                </label>
                                <div class="product-imgs list-img-preview">

                                </div>
                                <div class="form-msg"></div>
                            </div>
                        </div>
                    </div>
                    <div class="c-bottom w-100 create-new-product-btn">
                        <button type="reset" class="c-btn">Hủy</button>
                        <!-- <button type="submit" class="c-btn c-btn-save">Save</button> -->

                        <!--  -->
                        <label for="create-btn-pro" class="btn-add-pro">
                            <input id="create-btn-pro" type="submit" class="c-btn c-btn-save" hidden
                                name="btn-create-product" value="<?= isset($_GET['idPro']) ? "Cập nhật" : "Lưu" ?>">
                            <?= isset($_GET['idPro']) ? "Cập nhật" : "Lưu" ?>
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
                        <!--  -->
                    </div>
                </div>

            </form>
        </div>
    </div>
</main>
</div>
</div>