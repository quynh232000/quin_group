
const popupContainers = document.querySelectorAll(".popup-container")
const closeModals = document.querySelectorAll(".popup-close-btn")

closeModals.forEach((closeModal, index) => {
    closeModal.onclick = (e) => {
        e.preventDefault()
        popupContainers[index].classList.remove('active')
    }
})

async function requestDataToServer(data) {
    try {
        const res = await $.ajax({
            type: "POST",
            url: `?mod=requestAdmin&act=edit-user`,
            data: JSON.stringify(data),
            processData: false,
            contentType: false,
            caches: false
        })
        return JSON.parse(res)
    } catch (err) {
        console.error(err)
        throw err
    }
}


$(".btn-clickable").click(async function () {
    const datatype = $(this).attr("data-type")
    const dataname = $(this).attr("data-value")
    const idCategory = $(this).attr("data-category-id")
    const img = $(this).attr("data-img")
    // id product pending
    const idProduct = $(this).attr("data-idProduct")
    const listOfString = $(this).data("list-name")
    // rejected product 
    const reason = $(this).attr("data-reason")
    const shopowner = $(this).attr("data-onwer")
    $(".popup-container").addClass("active")

    //
    const userId = $(this).attr("data-user-id")
    let dataUser
    try {
        const data = await requestDataToServer({ UID: userId })
        dataUser = data
    } catch (err) {
        console.log(err)
    }


    switch (datatype) {
        case "create":
            $(".card-title").text("Create Category")
            $(".thuoc").text("Thuộc danh mục: " + dataname).css("color", "")
            $("#img-preview").hide()
            $(".input-name").val("")
            $(".input-name, .input-file, .input-file-button, .label-input").show();
            break;
        case "update":
            $(".card-title").text("Update Category")
            $(".thuoc").text("Cập nhật danh mục: " + dataname).css("color", "")
            $("#exampleInputName1").val(dataname)
            $("#img-preview").show().attr("src", "assest/upload/" + img)
            $(".input-name, .input-file, .input-file-button, .label-input").show();

            break;
        case "delete":
            $(".card-title").text("Are your sure to Delete")
            $(".thuoc").text("Danh mục: " + dataname).css("color", "red")
            $(".input-name, .input-file, .input-file-button, .label-input").hide();
            $("#img-preview").hide()
            break;
        case "new":
            $(".form-group, .submitbtn").show()
            $(".reject-message").hide()
            $(".popup-close-btn").removeClass("btn-light").addClass("btn-light").text("Cancel");
            $("#img-preview").show().attr("src", "assest/upload/" + img)
            $(".string-name").each(function (index) {
                $(this).text(listOfString[index]).css({
                    "font-weight": "bold",
                    "color": "red"
                });
            })

            $(".reject").click(function (event) {
                event.preventDefault()
                let reason = prompt("Lí do từ chối:");
                if (reason !== null) {
                    $("#id_reason").val(reason)
                    $(this).unbind('click').click();
                }
            })
            break;
        case "rejected":
            $(".form-group, .submitbtn").hide()
            $(".reject-message").show().html(
                `<div class="form-group" style="display: flex; align-items: center; gap: 12px; margin-bottom: 0">
                                            <label class="label-input" for="exampleInputName1">Shop Owner: </label>
                                            <p class="string-name">${shopowner}</p>
                                        </div>

                                        <div class="form-group" style="display: flex; align-items: center; gap: 12px; margin-bottom: 0">
                                            <label class="label-input" for="exampleInputName1">Message: </label>
                                            <p class="string-name">${reason != "" ? reason : "No data..."}</p>
                                        </div>
                                        `
            )
            $(".popup-close-btn").removeClass("btn-light").addClass("btn-primary").text("OK");
            break;
        case "edit":
            const arrayRoles = ["Member", "Seller", "Admin", "AdminAll"]

            let html = dataUser.map((el, index) => {
                let htmlRole = arrayRoles.map(item => {
                    if (item !== el.user_role) {
                        return `<option value="${item}">${item}</option>`
                    } else {
                        return ''
                    }
                }).join("")
                return `<div class="form-group">
                            <label for="exampleInputName1">Name</label>
                            <input name="name" type="text" class="form-control input-name" id="exampleInputName1" placeholder="${el.user_fullname}">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail3">Email address</label>
                            <input name="email" type="email" class="form-control input-email" id="exampleInputEmail3" placeholder="${el.user_email}">
                        </div>
                        <div class="form-group">
                            <input value="${el.user_id}" name="userId" type="hidden" class="form-control input-email" id="exampleInputEmail4" placeholder="Email">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail3">Phone number</label>
                            <input name="phone" type="text" class="form-control input-email" id="exampleInputEmail3" placeholder="${el.user_phone}">
                        </div>
                        <div class="form-group">
                        <label for="exampleInputPassword4">Đổi mật khẩu</label>
                        <input type="password" name="password" class="form-control input-password" id="exampleInputPassword4" placeholder="change your password">
                      </div>
                        <div class="form-group">
                            <label for="role">Role: <span style="color: red;">${el.user_role}*</span></label>
                            <select name="role" class="form-control option-role" id="role">
                                <option value="">--All--</option>
                                ${htmlRole}
                            </select>
                        </div>
                        <div class="form-group">
                            <div>
                                <label>Change your avatar</label>
                                <input type="file" name="img" class="user-img" style="margin-bottom: 8px;">
                                <img width="120px" src="assest/upload/${el.user_avatar}" alt="">
                            </div>
                        </div>
                        
                        <div class="form-group">
                            <label for="exampleInputCity1">City</label>
                            <input type="text" name="address" class="form-control user-address" id="exampleInputCity1" placeholder="${el.user_address}">
                        </div>`
            })
            $(".form-render-user").html(html)

            $("#form-edit-user").submit(function (e) {
                e.preventDefault()
                const formData = new FormData($(this)[0])
                $.ajax({
                    type: "POST",
                    url: `?mod=requestAdmin&act=update-user`,
                    data: formData,
                    processData: false,
                    contentType: false
                }).done(res => {
                    let data = JSON.parse(res)
                    if (data.status && data.role !== "") {
                        setTimeout(() => {
                            window.location.href = "?mod=admin&act=mn_all_user&role=" + data.role + "&page=1"
                        }, 800);
                    } else {
                        setTimeout(() => {
                            location.reload()
                        }, 800);
                    }
                })
            })

            break;
    }
    $("#id_parent").val(idCategory)
    $("#id_type").val(datatype)
    $("#id_product").val(idProduct)
})

