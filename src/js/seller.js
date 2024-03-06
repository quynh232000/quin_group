// function  count time

function countTime(
  time,
  element = ".time-count-body",
  title = ".time-count-title"
) {
  let timeNow = time;
  let id = setInterval(function () {
    if (timeNow == 0) {
      clearInterval(id);
      $(title).text("Mã xác nhận đã hết hạn!").css("color", "red");
    } else {
      timeNow--;
      $(element).text(timeNow + "s");
    }
  }, 1000);
}
function selectCategory(_this, id) {
  // ===
  $(_this).closest(".modal-cate-group").nextAll()?.remove();
  $(_this)
    .closest(".modal-cate-group")
    .find(".modal-cate-item")
    ?.removeClass("active");
  $(_this).addClass("active");

  // ===
  let htmlCateSelect = "";
  $(".modal-cate-item.active").each(function (index, element) {
    const text = $(element).find("p")?.text();
    const id = $(element).attr("idCate").trim();
    if (index == 0) {
      htmlCateSelect += `
            <div class="modal-cate-selected-item">
              <span>${text}</span>
            </div>
        `;
    } else {
      htmlCateSelect += `
            <div class="modal-cate-selected-item">
            <i class="fa-solid fa-chevron-right"></i>
              <span>${text}</span>
            </div>
        `;
    }
    
  });
  const type = $(_this).attr("checkLast")?.trim();

  // const id = $(_this).attr("idCate");
  if (type == "has") {
    $('#input_category_id').val("")
    // $(_this).closest('.modal-cate-group').nextAll().remove()
    $.ajax({
      url: "?mod=request&act=get-all-category&idCate=" + id,
    }).done((data) => {
      data = JSON.parse(data);
      if (data.length > 0) {
        const html = data
          .map((item) => {
            if (item?.children?.length > 0) {
              return `
                <div class="modal-cate-item" onclick="selectCategory(this,${
                  item.id
                })"
                    idCate="${item.id}" checkLast="has" >
                    <p>
                        ${item.name}
                    </p>
                    ${
                      item?.children?.length > 0
                        ? `<i class="fa-solid fa-chevron-right"></i>`
                        : ""
                    }
                </div>
              `;
            } else {
              return `
                    <div class="modal-cate-item" onclick="selectCategory(this,${item.id})"
                        idCate="${item.id}" checkLast="no">
                        <p>
                            ${item.name}
                        </p>
                    </div>
                  `;
            }
          })
          .join("");
        $(_this).closest(".modal-cate-group").after(`
            <div class="modal-cate-group" >
                <div class="modal-cate-group-wrapper">
                  ${html}
                </div>
            </div>
          `);
        //show nav select
        // console.log("asdd: ",$(".modal-cate-item.active"));
        //show nav select
      }
      // selectCategory();
    });
  } else {
    $('#input_category_id').val(id)
    $(".show-select-cate-view").html(htmlCateSelect)
  }
  
  // $(".modal-cate-item").map((index,item) => {
  //   console.log($(item));
  //   // $text = $(item).find("p")?.text();
  //   // $id = $(item).attr("idCate").trim();
  //   // console.log(text);
  // });
  // let htmlCateSelect = $(".modal-cate-item.active")
  //   .map((index,item) => {
  //     const text = $(item).find("p")?.text();
  //     const id = $(item).attr("idCate").trim();
  //     return `
  //       <div class="modal-cate-selected-item">
  //         <span>${text}</span>
  //       </div>
  //   `;
  //   })
  //   .join("");
  // console.log(htmlCateSelect);
  $(".modal-cate-selected").html(htmlCateSelect);
  
}
