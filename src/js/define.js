// function  count time

function countTime(time,element=".time-count-body",title ='.time-count-title') {
    let timeNow = time
    let id=  setInterval(function () {
      if(timeNow ==0){
        clearInterval(id)
        $(title).text('Mã xác nhận đã hết hạn!').css('color','red')
      }else{
        timeNow --
        $(element).text(timeNow+"s")
      }
    },1000)
  }
  
  function selectCategory(_this,id) {
    // ===
    $(_this).closest(".modal-cate-group").nextAll()?.remove();
    $(_this)
      .closest(".modal-cate-group")
      .find(".modal-cate-item")
      ?.removeClass("active");
    $(_this).addClass("active");
    const type = $(_this).attr("checkLast")?.trim();
    // const id = $(_this).attr("idCate");
    if (type == "has") {
      console.log(id);
      // $(_this).closest('.modal-cate-group').nextAll().remove()
      $.ajax({
        url: "?mod=request&act=get-all-category&idCate=" + id,
      }).done((data) => {
        data = JSON.parse(data);
        if (data.length > 0) {
          const html = data
            .map((item) => {
              return `
                  <div class="modal-cate-item"
                      idCate="${item.id}" checkLast="${
                item?.children?.length > 0 ? "has" : "no"
              }">
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
            })
            .join("");
          $(_this).closest(".modal-cate-group").after(`
            <div class="modal-cate-group" onclick="selectCategory(this,${id})">
                <div class="modal-cate-group-wrapper">
                  ${html}
                </div>
            </div>
          `);
        }
        // selectCategory();
      });
    } else {
      console.log("no ", id);
    }
    // ===
  }