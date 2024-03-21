// function  count time



function toastVinh(text, type = true) {
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

function countTime(time, element = ".time-count-body", title = '.time-count-title') {
  let timeNow = time
  let id = setInterval(function () {
    if (timeNow == 0) {
      clearInterval(id)
      $(title).text('Mã xác nhận đã hết hạn!').css('color', 'red')
    } else {
      timeNow--
      $(element).text(timeNow + "s")
    }
  }, 1000)
}
function loghello() {
  console.log(1234);
}

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
                      ${item?.children?.length > 0
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

function format_price(element_parent="") {

  const VND = new Intl.NumberFormat("vi-VN", {
    style: "currency",
    currency: "VND",
  });
  element_parent = element_parent? element_parent+" ":"";
  const prices =document.querySelectorAll(element_parent+".fm-price")
  prices.forEach(item=>{
    item.textContent =VND.format(item.textContent)
  })
  
  
}

// console.log(123);
/**
 * 
 * 
 * VINH */

function follow_shop(uuid, type) {
  $.ajax({
    url: '?mod=request&act=follow_shop',
    data: { uuid, type }
  }).done(data => {
    data = JSON.parse(data);
    if (data.status == true) {
      if (type == 'follow') {
        $('#count_followers').text(+$('#count_followers').text() + 1);
        $('#shop_follow_id').html(`
        <div onclick="follow_shop('${uuid}', 'unfollow')">
        <i class="fa-solid fa-minus"></i>
        Bỏ theo dõi
        </div>
        `)
      } else {
        $('#count_followers').text((+$('#count_followers').text() - 1) + '');
        $('#shop_follow_id').html(`
        <div onclick="follow_shop('${uuid}', 'follow')">
        <i class="fa-solid fa-plus"></i>
        Theo dõi
        </div>
        `)

      }

    }
    toastVinh(data.message, data.status);

  })
}
function save_voucher(_this, voucher_id) {
  $.ajax({
    url: '?mod=request&act=save_voucher',
    data: { voucher_id }
  }).done(data => {
    data = JSON.parse(data);
    if (data.status) {
      $(_this).text('Đã lưu');
      $(_this).removeAttr('onclick');
    }
    toastVinh(data.message, data.status);
  })
}

/**
 * 
 * 
 * VINH */ 

  




