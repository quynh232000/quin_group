
// modal 
// const showPopup = document.querySelectorAll(".btn-clickable")
// const popupCreate = document.querySelector(".popup-create")
// const popupUpdate = document.querySelector(".popup-update")
// const popupDelete = document.querySelector(".popup-delete")

const popupContainers = document.querySelectorAll(".popup-container")
const closeModals = document.querySelectorAll(".popup-close-btn")

closeModals.forEach((closeModal, index) => {
    closeModal.onclick = (e) => {
        e.preventDefault()
        popupContainers[index].classList.remove('active')
    }
})


$(".btn-clickable").click(function () {
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
    }
    $("#id_parent").val(idCategory)
    $("#id_type").val(datatype)
    $("#id_product").val(idProduct)
})



// handle button event

// const createButtons = document.querySelectorAll('.create-btn')
// const updateButtons = document.querySelectorAll('.update-btn')
// const deleteButtons = document.querySelectorAll('.delete-btn')
// const submitbtn = document.querySelector('.submitbtn')

// createButtons.forEach(function (button) {
//     button.addEventListener('click', function (event) {
//         const categoryID = button.dataset.categoryId;
//         console.log('Create button clicked for category ID:', categoryID);
//         submitbtn.onclick = (e) => {
//             e.preventDefault()
//             requestAPI(categoryID)
//         }
//     })
// })

// updateButtons.forEach(function (button) {
//     button.addEventListener('click', function (event) {
//         const categoryID = button.dataset.categoryId;
//         console.log('Update button clicked for category ID:', categoryID);
//     });
// });

// deleteButtons.forEach(function (button) {
//     button.addEventListener('click', function (event) {
//         const categoryID = button.dataset.categoryId;
//         console.log('Delete button clicked for category ID:', categoryID);
//     });
// });

// function requestAPI(parent_id) {
//     $.ajax({
//         type: "POST",
//         url: "?mod=pages&act=crea-cat",
//         data: JSON.stringify({
//             parent_id: parent_id
//         }),
//         success: function (res) {
//             const json_data = JSON.parse(res)
//             console.log(json_data);
//         }, error: function (err) {
//             console.log(err)
//         }
//     })
// }
