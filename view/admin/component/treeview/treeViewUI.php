<?php
///////////////////////////////////////////
$htmlTreeView = '';
foreach ($arrayOfCategories as $category) {
    $htmlTreeView .= generateCategoryHTML($category);
}

function generateCategoryHTML($category)
{
    $html = '';

    $src = isset($category["icon"]) && !empty($category["icon"]) ? $category["icon"] : 'logo-no-text.png';
    if (isset($category["children"]) && !empty($category["children"])) {
        $html .= '<ul class="tree-ul">
                    <li class="tree-li parent">
                        <details>
                            
                            <summary class="addable" onmousedown="return false">' . $category["name"] . '
                                <div style="width:860px; justify-content: space-between; align-items: center" class="d-flex">
                                    <img src="assest/upload/' . $src . '" width=60px height=60px style="object-fit:cover; border-radius: 50%" />
                                    <div class="btn-clickable-wrapper">
                                        <button style="height: fit-content" data-value="' . $category["name"] . '" data-img="' . $src . '" data-type="create" data-category-id="' . $category["id"] . '" class="btn-clickable create-btn btn-primary p-6">Create</button>
                                        <button style="height: fit-content" data-value="' . $category["name"] . '" data-img="' . $src . '" data-type="update" data-category-id="' . $category["id"] . '" class="btn-clickable update-btn btn-secondary">Update</button>
                                        <button style="height: fit-content" data-value="' . $category["name"] . '" data-img="' . $src . '" data-type="delete" data-category-id="' . $category["id"] . '" class="btn-clickable delete-btn btn-danger">Delete</button>
                                    </div>
                                </div>
                            </summary>
                            
                            ';

        foreach ($category["children"] as $child) {
            $html .= generateCategoryHTML($child);
        }

        $html .= '</details>
                </li>
            </ul>';
    } else {
        $html .= '<ul class="tree-ul">
                    
                        <li class="tree-li addable">' . $category["name"] . '
                            <div style="width:860px; justify-content: space-between; align-items: center" class="d-flex">
                                <img src="assest/upload/' . $src . '" width=60px height=60px style="object-fit:cover; border-radius: 50%" />
                                <div class="btn-clickable-wrapper">
                                    <button style="height: fit-content" data-value="' . $category["name"] . '" data-img="' . $src . '" data-type="create" data-category-id="' . $category["id"] . '" class="btn-clickable create-btn btn-primary p-6">Create</button>
                                    <button style="height: fit-content" data-value="' . $category["name"] . '" data-img="' . $src . '" data-type="update" data-category-id="' . $category["id"] . '" class="btn-clickable update-btn btn-secondary">Update</button>
                                    <button style="height: fit-content" data-value="' . $category["name"] . '" data-img="' . $src . '" data-type="delete" data-category-id="' . $category["id"] . '" class="btn-clickable delete-btn btn-danger">Delete</button>
                                </div>
                            </div>
                        </li>
                        
                </ul>';
    }

    return $html;
}

?>


<body>
    <div>
        <?= $htmlTreeView ?>
        <!-- modal  -->
        <div class="popup-container popup-create">
            <div class="popup-box">

                <div class="col-12 stretch-card">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title"></h4>

                            <form class="forms-sample" method="POST" enctype="multipart/form-data" action="?mod=admin&act=mn_settings_cat">
                                <div class="thuoc">Thuộc </div>
                                <div class="form-group">
                                    <label class="label-input" for="exampleInputName1">Name</label>
                                    <input type="text" class="form-control input-name" id="exampleInputName1" placeholder="Name" name="name_category">
                                </div>

                                <input type="text" name="id_parent" id="id_parent" hidden>
                                <input type="text" name="type" id="id_type" hidden>

                                <div class="form-group">
                                    <label class="label-input">File upload</label>
                                    <input type="file" name="icon" class="file-upload-default">
                                    <div class="input-group col-xs-12">
                                        <input type="text" class="form-control file-upload-info input-file" disabled placeholder="Upload Image" name="icon_category">
                                        <span class="input-group-append">
                                            <button class="file-upload-browse btn btn-primary input-file-button" type="button">Upload</button>
                                        </span>
                                    </div>
                                </div>
                                <div style="display: flex; margin-bottom: 12px;">
                                    <img id="img-preview" src="" alt="" width="100px">
                                </div>
                                <input name="submit" type="submit" class="btn btn-primary me-2 submitbtn" value="OK" />
                                <button class="btn btn-light popup-close-btn">Cancel</button>
                            </form>
                        </div>
                    </div>
                </div>

            </div>
        </div>
        <!-- end modal  -->

    </div>
</body>