// toast message
function toastjs(text, type = true) {
  var x = document.getElementById("snackbar");

  x.className = "show";
  if (type == false) {
    x.classList.add("toast-error");
  }
  x.textContent = text;
  setTimeout(function () {
    x.className = x.className.replace("show", "");
  }, 3000);
}
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
    $("#input_category_id").val("");
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
      }
    });
    $(".modal-btn-confirm").attr("disabled", "disabled");
  } else {
    $(".show-select-cate-view").html(htmlCateSelect);
    $(".modal-btn-confirm").removeAttr("disabled");
    $("#input_category_id").val(id);

    $(".modal-btn-confirm").click(function () {
      $(".modal-edit-cate").css("display", "none");
    });
  }
  $(".modal-cate-selected").html(htmlCateSelect);

}


// accept order
function update_status_order(id,status) {
  $.ajax({
    url: `?mod=request&act=update_status_order&id=${id}&status=${status}` ,
  }).done((data) => {
    data = JSON.parse(data);
    console.log(data);
    if (data) {
      toastjs(data.message,data.status)
      setTimeout(()=>{
        window.location.reload();
      },2500)
    }
  });
}
// update status order all
function update_status_order_all(status) {
  if(status){
    $.ajax({
      url: `?mod=request&act=update_status_order_all&status=${status}` ,
    }).done((data) => {
      data = JSON.parse(data);
      console.log(data);
      if (data) {
        toastjs(data.message,data.status)
        setTimeout(()=>{
          window.location.reload();
        },2500)
      }
    });
  }
}

// address
function select_address(el, type) {
  $.ajax({
    url: `?mod=request&act=get_address&id=${el.value}&type=${type}`,
  }).done((data) => {
    data = JSON.parse(data);
    let html = data.map(item=>{
      if(type =='district'){
        console.log(item.maqh);
      }else{
        console.log(item.xaid);
      }
      return `
        <option value="${(type == 'district')? item.maqh+"" : item.xaid+""}">${item.name}</option>
      `
    })
    html.unshift('option value="">--Chọn--</option>')
    $('#'+type).html(html.join(''))
    
  });
}
// get param 
function get_param(paramName) {
  const urlParams = new URLSearchParams(window.location.search);
  return urlParams.get(paramName);
}