// const treeview_clickable = document.querySelectorAll(".admin-treeview-clickable")
// treeview_clickable.forEach((el, index) => {
//     el.onclick = () => {
//         console.log(index);
//     }
// })

if ($(".referral-body")) {
    handleTreeView();
}
function handleTreeView() {
    $(".tree-item-icon").click(function () {
        if ($(this).parent().hasClass("has")) {
            const ulChild = $(this).parent().siblings();
            if ($(this).parent().siblings().hasClass("active")) {
                ulChild.removeClass("active");
            } else {
                ulChild.addClass("active");
            }
        }

    });
}

