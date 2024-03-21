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
// add to cart
function update_cart_user(type, product_id, quantity="") {
    $.ajax({
      url: "?mod=request&act=update_cart_user",
      type:"GET",
      data: {
        type,
        product_id,
        quantity,
      },
    }).done((data) => {
      data = JSON.parse(data);
      toastjs(data.message,data.status)
      let count = 0;
      let total = 0;
      const result = data?.result
      let html_view_cart='';
      for (let key in result) {
          const product_info = result[key].product_info;
          total+= +product_info?.price*result[key].quantity;
          count += +result[key].quantity;
          // html view cart
          html_view_cart+=`
                  <li class="header__cart-item">
                        <img src="./assest/upload/${product_info.image_cover}" alt=""
                            class="header__cart-img">
                        <div class="header__cart-item-info">
                            <div class="header__cart-item-head">
                                <h5 class="header__cart-item-name">
                                    ${product_info.name}
                                </h5>
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
      $("#cart-count").text(count) ;
      $("#cart-total").text(total);
      $('#list_product_cart').html(html_view_cart)
      
      format_price(".header")
      
    });
}