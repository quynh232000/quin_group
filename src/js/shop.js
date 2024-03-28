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
// shhow voucher cart
function show_voucher_cart(_this,shop_id="") {
  const data = $(_this).attr("data-togle");
  $("." + data).css({
    display: "block",
    height: "fit-content",
  });
  if(shop_id){
    
    $.ajax({
        url: "?mod=request&act=get_voucher_user",
        type: "GET",
        data: {
          type:"can_use_by_shop",
          shop_id
        },
      }).done((res) => {
        res = JSON.parse(res);
        if(res.status){
            let htmlVoucher = res.result.map(item=>{
                return `
                    <div class="shop-voucher-item">
                        <div class="shop-voucher-wrapper">
                            <div class="shop-voucher-boder">
                                <div class="shop-voucher-left">
                                    <div class="shop-voucher-text1">${item.label}</div>
                                    <div class="shop-voucher-text2">Đơn hàng tối thiểu: ${item.minimum_price}</div>
                                    <div class="shop-voucher-text3">Giả tối đa: ${item.discount_amount}</div>
                                    <div class="shop-voucher-text1">Mã vouchher: ${item.code}</div>
                                    <div class="shop-voucher-text4">HSD: ${item.date_end.split(" ")[0]}</div>

                                </div>
                                <div class="shop-voucher-right">
                                    <button class="shop-voucher-btn" onclick="aply_voucher(this,'${item.code}')">Áp dụng</button>
                                </div>
                            </div>
                        </div>
                `
            }).join("")
            $(_this).closest(".group_shop").find(".list_voucher").html(htmlVoucher)
        }
    })
  }
}
// add to cart
function update_cart_user(
  type,
  product_id,
  quantity = "",
  render_cart = false
) {
  $.ajax({
    url: "?mod=request&act=update_cart_user",
    type: "GET",
    data: {
      type,
      product_id,
      quantity,
    },
  }).done((data) => {
    data = JSON.parse(data);
    toastjs(data.message, data.status);
    let count = 0;
    let total = 0;
    const result = data?.result;
    let html_view_cart = "";
    for (let key in result) {
      const product_info = result[key].product_info;
      total += +product_info?.price * result[key].quantity;
      count += +result[key].quantity;
      // html view cart
      html_view_cart += `
                  <li class="header__cart-item">
                        <img src="./assest/upload/${product_info.image_cover}" alt=""
                            class="header__cart-img">
                        <div class="header__cart-item-info">
                            <div class="header__cart-item-head">
                                <a href="?mod=page&act=detail&product=${product_info.slug}" class="header__cart-item-name">
                                    ${product_info.name}
                                </a>
                                <div class="header__cart-item-price-wrap">
                                    <span class="header__cart-item-price fm-price">
                                        ${product_info.price}
                                    </span>
                                    <span class="header__cart-item-multiple">x</span>
                                    <span class="header__cart-item-qnt">
                                        ${result[key].quantity}
                                    </span>
                                </div>
                            </div>
                            <div class="header__cart-item-body">
                                <span class="header__cart-item-description">
                                    ${product_info.brand} -
                                   ${product_info.origin}
                                </span>
                                <span onclick="update_cart_user('delete','${product_info.id}')" class="header__cart-item-remmove">Delete</span>
                            </div>
                        </div>
                    </li>
          `;
      // html view cart
    }
    $("#cart-count").text(count);
    $("#cart-total").text(total);
    $("#list_product_cart").html(html_view_cart);
    format_price(".header");
    // render cart
    if (render_cart && $("#cart-list-shop").length) {
      let list_shop = {};

      for (let key in result) {
        const shop_id = result[key]?.shop_info?.id;
        if (!list_shop[shop_id]) list_shop[shop_id] = [];
        list_shop[shop_id].push(result[key]);
      }
      let html_cart = "";
      let total = 0;
      let count = 0;
      for (let key in list_shop) {
        let html_product = list_shop[key]
          .map((item) => {
            if(item.check){
              total += item.product_info.price * item.quantity;
              count += item.quantity;

            }
            return `
                <div class="cart-item" idpro="${item.product_info.id}"
                    checkpro="${item.product_info.origin}" countpro="${
              item.product_info.quantity
            }"
                    pricepro="${item.product_info.price}">
                    <div class="cart-info">
                        <div class="cart-checkbox">
                            <input class="item-cart-checkbox" ${
                              item.check ? "checked" : ""
                            }
                                type="checkbox"
                                onchange="update_cart_user('${
                                  item.check ? "uncheck" : "check"
                                }','${item.product_info.id}',1,true)"
                                >
                        </div>
                        <div class="cart-item-pro">
                            <div class="cart-item-img">
                                <img src="./assest/upload/${
                                  item.product_info.image_cover
                                }" alt="">
                            </div>
                            <div class="cart-info-right">
                                <a href="?mod=page&act=detail&product= ${
                                  item.product_info.slug
                                }" class="cart-item-name">
                                ${item.product_info.name}
                                </a>
                                <div class="cart-item-note">
                                ${item.product_info.brand} -
                                ${item.product_info.origin}
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="cart-price">
                        <div class="cart-item-price fm-price">
                        ${item.product_info.price}
                        </div>
                    </div>
                    <div class="cart-quantity">

                        <div class="cart-item-count">
                            <div class="cart-count-btn " onclick="update_cart_user('minus','${
                              item.product_info.id
                            }',1,true)" ><i
                                    class="fa-solid fa-minus"></i></div>
                            <input type="text" class="cart-count-input" readonly
                                value="${item.quantity}">
                            <div class="cart-count-btn " onclick="update_cart_user('plus','${
                              item.product_info.id
                            }',1,true)" ><i
                                    class="fa-solid fa-plus"></i></div>
                        </div>
                    </div>
                    <div class="cart-subtotal">
                        <div class="cart-item-subtotal cart-subtotal1 fm-price"
                            data-subtotal="${
                              item.product_info.price * item.quantity
                            }">
                            ${item.product_info.price * item.quantity}
                        </div>
                    </div>
                    <div class="cart-action">
                        <div class="cart-item-action-icon">
                            <i class="fa-regular fa-heart"></i>
                        </div>
                        <div class="cart-item-action-icon" onclick="update_cart_user('delete','${
                          item.product_info.id
                        }',1,true)">
                            <i class="fa-solid fa-trash-can"></i>
                        </div>
                    </div>
                </div>
          `;
          })
          .join("");

        // ===============================================
        html_cart += `
            <div class="cart-body group_shop group_shop-${key}" data-class=".group_shop-${key}">
            <div class="cart-group">
                <div class="cart-shop">
                    <div class="cart-checkbox">
                    </div>
                    <a href="?mod=page&act=shop&uuid=${list_shop[key][0].shop_info.uuid}" class="cart-shop-info">
                        <div class="cart-shop-img">
                            <img src="./assest/upload/${list_shop[key][0].shop_info.icon}" alt="">
                        </div>
                        <div class="cart-shop-name">
                        ${list_shop[key][0].shop_info.name}
                        </div>
                    </a>
                </div>
                <div class="cart-product">
                ${html_product}
                </div>
                <?php
                if (Session::get("isLogin")) { ?>
                    <div class="cart_voucher">
                        <div class="cart_voucher_top">
                            <svg fill="var(--bg-yellow)" viewBox="0 -2 23 22"
                                class="shopee-svg-icon lGPe96 icon-voucher-line">
                                <g filter="url(#voucher-filter0_d)">
                                    <mask id="a" fill="#fff">
                                        <path fill-rule="evenodd" clip-rule="evenodd"
                                            d="M1 2h18v2.32a1.5 1.5 0 000 2.75v.65a1.5 1.5 0 000 2.75v.65a1.5 1.5 0 000 2.75V16H1v-2.12a1.5 1.5 0 000-2.75v-.65a1.5 1.5 0 000-2.75v-.65a1.5 1.5 0 000-2.75V2z">
                                        </path>
                                    </mask>
                                    <path
                                        d="M19 2h1V1h-1v1zM1 2V1H0v1h1zm18 2.32l.4.92.6-.26v-.66h-1zm0 2.75h1v-.65l-.6-.26-.4.91zm0 .65l.4.92.6-.26v-.66h-1zm0 2.75h1v-.65l-.6-.26-.4.91zm0 .65l.4.92.6-.26v-.66h-1zm0 2.75h1v-.65l-.6-.26-.4.91zM19 16v1h1v-1h-1zM1 16H0v1h1v-1zm0-2.12l-.4-.92-.6.26v.66h1zm0-2.75H0v.65l.6.26.4-.91zm0-.65l-.4-.92-.6.26v.66h1zm0-2.75H0v.65l.6.26.4-.91zm0-.65l-.4-.92-.6.26v.66h1zm0-2.75H0v.65l.6.26.4-.91zM19 1H1v2h18V1zm1 3.32V2h-2v2.32h2zm-.9 1.38c0-.2.12-.38.3-.46l-.8-1.83a2.5 2.5 0 00-1.5 2.29h2zm.3.46a.5.5 0 01-.3-.46h-2c0 1.03.62 1.9 1.5 2.3l.8-1.84zm.6 1.56v-.65h-2v.65h2zm-.9 1.38c0-.2.12-.38.3-.46l-.8-1.83a2.5 2.5 0 00-1.5 2.29h2zm.3.46a.5.5 0 01-.3-.46h-2c0 1.03.62 1.9 1.5 2.3l.8-1.84zm.6 1.56v-.65h-2v.65h2zm-.9 1.38c0-.2.12-.38.3-.46l-.8-1.83a2.5 2.5 0 00-1.5 2.29h2zm.3.46a.5.5 0 01-.3-.46h-2c0 1.03.62 1.9 1.5 2.3l.8-1.84zM20 16v-2.13h-2V16h2zM1 17h18v-2H1v2zm-1-3.12V16h2v-2.12H0zm1.4.91a2.5 2.5 0 001.5-2.29h-2a.5.5 0 01-.3.46l.8 1.83zm1.5-2.29a2.5 2.5 0 00-1.5-2.3l-.8 1.84c.18.08.3.26.3.46h2zM0 10.48v.65h2v-.65H0zM.9 9.1a.5.5 0 01-.3.46l.8 1.83A2.5 2.5 0 002.9 9.1h-2zm-.3-.46c.18.08.3.26.3.46h2a2.5 2.5 0 00-1.5-2.3L.6 8.65zM0 7.08v.65h2v-.65H0zM.9 5.7a.5.5 0 01-.3.46l.8 1.83A2.5 2.5 0 002.9 5.7h-2zm-.3-.46c.18.08.3.26.3.46h2a2.5 2.5 0 00-1.5-2.3L.6 5.25zM0 2v2.33h2V2H0z"
                                        mask="url(#a)"></path>
                                </g>
                                <path clip-rule="evenodd"
                                    d="M6.49 14.18h.86v-1.6h-.86v1.6zM6.49 11.18h.86v-1.6h-.86v1.6zM6.49 8.18h.86v-1.6h-.86v1.6zM6.49 5.18h.86v-1.6h-.86v1.6z">
                                </path>
                                <defs>
                                    <filter id="voucher-filter0_d" x="0" y="1" width="20" height="16"
                                        filterUnits="userSpaceOnUse" color-interpolation-filters="sRGB">
                                        <feFlood flood-opacity="0" result="BackgroundImageFix"></feFlood>
                                        <feColorMatrix in="SourceAlpha"
                                            values="0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 127 0"></feColorMatrix>
                                        <feOffset></feOffset>
                                        <feGaussianBlur stdDeviation=".5"></feGaussianBlur>
                                        <feColorMatrix values="0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0.09 0">
                                        </feColorMatrix>
                                        <feBlend in2="BackgroundImageFix" result="effect1_dropShadow"></feBlend>
                                        <feBlend in="SourceGraphic" in2="effect1_dropShadow" result="shape"></feBlend>
                                    </filter>
                                </defs>
                            </svg>
                            <span class="cart_voucher_add" onclick="show_voucher_cart(this,'${list_shop[key][0].shop_info.id}')" data-togle="cart_show_voucher-${key}">Thêm mã giảm giá
                                của shop</span>
                        </div>
                        <div class="cart_show_voucher cart_show_voucher-${key}">
                            <form onsubmit="submit_voucher_code(event,this,'${list_shop[key][0].shop_info.id}')"  class="cart_voucher_input">
                                <input class="cart_voucher_input_code" type="text" name="code"
                                    placeholder="Nhập mã giảm (mã chỉ áp dụng 1)">
                                <button type="submit" class="cart_btn_apply">Áp dụng</button>
                            </form>
                            <div class="cart_result_check-code"></div>
                            <div class="shop-voucher">
                                <div class="cart-voucher-title">Mã giảm giá bạn đã lưu</div>
                                <div class="shop-voucher-body list_voucher">

                                   
                                </div>
                            </div>
                        </div>
                    </div>
                <?php }
                ?>
                <div class="cart-bottom">
                    <div class="cart-bottom-total">
                        <div class="cart-bottom-left">
                            <div class="cart-checkbox">
                            </div>
                            <span>Tổng (
                                ${count} Sản phẩm)
                            </span>
                        </div>
                        <div class="cart-bottom-right">
                           <div class="cart_right-item">
                                <div class="cart-bottom-right-title">
                                    Tạm tính:
                                </div>
                                <div class="cart-bottom-right-total fm-price cart_subtotal_price"
                                    cart-total=" ${total}">
                                    ${total}
                                </div>
                           </div>
                           <div class="cart_right-item_voucher">
                                        
                            </div>
                            <div class="cart_right-item">
                                <div class="cart-bottom-right-title">
                                    Tổng tiền:
                                </div>
                                <div class="cart-bottom-right-total fm-price cart_total_price"
                                    cart-total=" ${total}">
                                    ${total}
                                </div>
                           </div>
                        </div>
                    </div>
                    <form class="cart-bottom-btn form-submit-buy">
                        <input type="text" hidden name="mod" value="page">
                        <input type="text" hidden name="act" value="checkout">
                        <input type="text" hidden name="shop" value="${list_shop[key][0].shop_info.uuid}">
                        
                        <button type="submit"  class="cart-btn cart-btn-buy">Mua
                            hàng</button>
                    </form>
                </div>
            </div>
        </div>
            `;
        // ===============================================
        $("#cart-list-shop").html(html_cart);
        format_price(".cart");
      }
    }
    // render cart
  });
}

// like and unlike product
function like_product(product_id, type) {
  $.ajax({
    url: "?mod=request&act=like_product",
    type: "GET",
    data: {
      type,
      product_id,
    },
  }).done((data) => {
    data = JSON.parse(data);
    if (type == "like") {
      $(".detail_like_heart").html(
        `<i class="fa-solid fa-heart" onclick="like_product(${product_id},'unlike')"></i>`
      );
      $(".count_like_product").text(+$(".count_like_product").text() + 1);
    } else {
      $(".detail_like_heart").html(
        `<i class="fa-regular fa-heart" onclick="like_product(${product_id},'like')"></i>`
      );
      $(".count_like_product").text(+$(".count_like_product").text() - 1);
    }
  });
}
// submit code
function submit_voucher_code(event, _this, shop_id) {
  event.preventDefault();
  const code = $(_this).find("input").val();
  $.ajax({
    url: "?mod=request&act=check_code_voucher",
    type: "GET",
    data: {
      code,
      shop_id,
    },
  }).done((data) => {
    data = JSON.parse(data);
    const parentEl = $(_this).closest(".group_shop");
    const classParent = $(parentEl).attr("data-class");
    const priceCurrent = +$(parentEl)
      .find(".cart_subtotal_price")
      .attr("cart-total");
    const inputVoucher = $(parentEl).find(
      `.form-submit-buy input[name="voucher"]`
    );
    if (data.status) {
      $(parentEl)
        .find(".cart_result_check-code")
        .text(data.message)
        .removeClass("error");
      $(parentEl).find(".cart_right-item_voucher").html(`
                <div class="cart_right-item">
                    <div class="cart-bottom-right-title">
                        Voucher giảm giá (${code}):
                    </div>
                    <div class="cart-bottom-right-total fm-price" cart-total="">
                        ${data.result.discount_amount}
                    </div>
                </div>
            `);
      format_price(classParent + " .cart_right-item_voucher");

      $(parentEl)
        .find(".cart_total_price")
        .text(priceCurrent - data.result.discount_amount)
        .attr("cart-total", priceCurrent - data.result.discount_amount);
      format_price(classParent + " .cart_right-item.total");

      if (inputVoucher.length) {
        $(inputVoucher).val(code);
      } else {
        $(parentEl)
          .find(".form-submit-buy")
          .append(`<input type="text" hidden name="voucher" value="${code}">`);
      }
    } else {
      $(parentEl)
        .find(".cart_result_check-code")
        .text(data.message)
        .addClass("error");
      if (inputVoucher.length) {
        $(inputVoucher).remove();
      }
      $(parentEl)
        .find(".cart_total_price")
        .text(priceCurrent)
        .attr("cart-total", priceCurrent);
      format_price(classParent + " .cart_right-item.total");
    }
  });
}
function aply_voucher(_this, code) {
  $(_this).closest(".group_shop").find(".cart_voucher_input_code").val(code);
  $(_this).addClass("disabled");
}
