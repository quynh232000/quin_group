let filter = { page: 1 }

function toggleDropdown(id) {
    let dropdownButton = document.querySelector(id);
    dropdownButton.classList.toggle('hidden');
}




/** GET PRODUCTS BY CATEGORY*/

function getProductsByCate(data) {
    let uuid = get_param("uuid");
    data = { ...data, uuid }
    $.ajax({
        type: 'GET',
        url: "?mod=request&act=get_filtered_products_shop",
        data: data
    }).then(function (res) {
        let data = JSON.parse(res);
        const html = data?.result.map(item => {
            let price_sale = new Intl.NumberFormat('de-DE', {
                maximumFractionDigits: 0
            }).format(item.price / (1 - item.percent_sale / 100));
            item.price = new Intl.NumberFormat('de-DE', {
                maximumFractionDigits: 0
            }).format(item.price);
            // render sao
            let star = "";
            if (item.pro_avg_level) {
                for (let i = 0; i < Math.floor(item.pro_avg_level); i++) {
                    star += '<i class="fa-solid fa-star"></i>'
                    // 
                }
                if (item.pro_avg_level > Math.floor(item.pro_avg_level)) {
                    star += '<i class="fa-solid fa-star-half-stroke"></i>'
                }
            } else {
                star = '<i style="color:gray" class="fa-regular fa-star"></i>'.repeat(5);
            }

            return `
                                    <!-- item -->
                                    <div class="product ">
                                        <div class="product-wrapper">
                                            <a href="?mod=page&act=home&product=${item.slug}" class="product-info">

                                                <div class="product-img">
                                                    <img src="./assest/upload/${item.image_cover}">
                                                </div>
                                                <div class="product-brand">
                                                    ${item.brand}
                                                </div>
                                                <div class="product-name">
                                                    ${item.name}
                                                </div>
                                                <div class="product-stars">
                                                    ${star}
                                                </div>
                                                <div class="product-sale-label">
                                            <svg width="48" height="50" viewBox="0 0 48 50" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                <g filter="url(#filter0_d_604_13229)">
                                                    <path d="M4.49011 0C3.66365 0 2.99416 0.677946 2.99416 1.51484V11.0288V26.9329C2.99416 30.7346 5.01545 34.2444 8.28604 36.116L20.4106 43.0512C22.6241 44.3163 25.3277 44.3163 27.5412 43.0512L39.6658 36.116C42.9363 34.2444 44.9576 30.7346 44.9576 26.9329V11.0288V1.51484C44.9576 0.677946 44.2882 0 43.4617 0H4.49011Z" fill="#F5C144"></path>
                                                </g>
                                                <defs>
                                                    <filter id="filter0_d_604_13229" x="-1.00584" y="0" width="49.9635" height="52" filterUnits="userSpaceOnUse" color-interpolation-filters="sRGB">
                                                        <feFlood flood-opacity="0" result="BackgroundImageFix"></feFlood>
                                                        <feColorMatrix in="SourceAlpha" type="matrix" values="0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 127 0" result="hardAlpha"></feColorMatrix>
                                                        <feOffset dy="4"></feOffset>
                                                        <feGaussianBlur stdDeviation="2"></feGaussianBlur>
                                                        <feComposite in2="hardAlpha" operator="out"></feComposite>
                                                        <feColorMatrix type="matrix" values="0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0.25 0"></feColorMatrix>
                                                        <feBlend mode="normal" in2="BackgroundImageFix" result="effect1_dropShadow_604_13229"></feBlend>
                                                        <feBlend mode="normal" in="SourceGraphic" in2="effect1_dropShadow_604_13229" result="shape"></feBlend>
                                                    </filter>
                                                </defs>
                                            </svg>
                                            <span>-%${item.percent_sale}</span>
                                            </div>
                                            <div class="product-price">
                                                <del class="product-price-old">đ${price_sale}</del>
                                            </div>
                                            <div class="product-price">
                                                <div class="product-price-sale">đ${item.price}</div>
                                            </div>
                                            </a>
                                            <div class="product-btn">
                                                <i class="fa-solid fa-cart-plus"></i>
                                                <span>Thêm vào giỏ hàng</span>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- item -->
                                    `
        }).join('')
        $('.g-list-product').html(html);
        // console.log(data.total);
        let html_pagi = ""
        for (let index = 0; index < Math.ceil(data.total / 8); index++) {
            const active = filter.page == (index + 1) ? 'active' : '';
            // const disable = filter.page == (Math.ceil(data.total / 8)) ? 'disable' : '';
            // ${ disable }
            html_pagi += `<div class="g-nav-btn pagination_number ${active}" data="${index + 1}">${index + 1}</div>`;
        }
        $('.list_number').html(html_pagi);
        page_click();
        format_price();

        $('.dropdown').each(function () {
            $(this).addClass('hidden');
        });
        // check disable chevrons_page
        if (filter.page == 1) {
            $('.chevrons_page[type="previous"]').addClass('disabled');
        } else {
            $('.chevrons_page[type="previous"]').removeClass('disabled');

        }
        // check disable chevrons_page
        if (filter.page == Math.ceil(data.total / 8)) {
            $('.chevrons_page[type="next"]').addClass('disabled');
        } else {
            $('.chevrons_page[type="next"]').removeClass('disabled');

        }

    })
}
let list_id = [];

$('.cate_input').change(function (e) {
    let idCate = $(this).attr('id-cate');
    if (e.target.checked) {
        list_id = [...new Set([...list_id, idCate])];
    } else {
        list_id.splice(list_id.indexOf(idCate), 1);
    }
    filter = { ...filter, list_id, page: 1, type_price: "", type: "", brand: "" }

    getProductsByCate(filter);

    $('.g-nav-left input:radio').each(
        function () {
            console.log($(this));
            $(this).attr('checked', false);

        }

    )
    $('.price_sort').text("Giá");
    $('.brand_sort').text("Thương hiệu");
    $('.sort_sort').text("Theo loại");

})

/** GET PRODUCTS BY FILTER */
// $uuid, $list_id_post, $type, $brand, $price_from, $price_to, $page, $limit

// Sort by Price - type_radio_1
$("#type_radio_1 input[type='radio']").change(function (e) {
    if (e.target.checked) {
        const type_price = e.target.value
        filter = { ...filter, type_price }
        getProductsByCate(filter);
        $('.price_sort').text($($(this).siblings('label')).text());
    }
})

// Sort by Brands - type_radio_2
$("#type_radio_2 input[type='radio']").change(function (e) {
    if (e.target.checked) {
        const brand = e.target.value
        // console.log(brand);
        filter = { ...filter, brand }
        getProductsByCate(filter);
        $('.brand_sort').text($($(this).siblings('label')).text());

    }
})

// Sort by Type - type_radio_3
$("#type_radio_3 input[type='radio']").change(function (e) {
    if (e.target.checked) {
        const type = e.target.value
        filter = { ...filter, type }
        $('.sort_sort').text($($(this).siblings('label')).text());
        getProductsByCate(filter);
    }
})




/** GET PRODUCTS BY FILTER */


function page_click() {
    $(".pagination_number").click(function () {
        $(".pagination_number").each(function (params) {
            $(this).removeClass('active')
        })
        $(this).addClass('active')
        const page = $(this).attr("data")
        filter = { ...filter, page, limit: 8 }
        getProductsByCate(filter);


    })
}
page_click()

$('.chevrons_page').click(function () {
    if ($(this).hasClass('disabled')) {

        return;
    }
    const type = $(this).attr('type');

    if (type == "next") {
        filter = { ...filter, page: filter.page + 1 }
        getProductsByCate(filter);
    } else {
        filter = { ...filter, page: filter.page - 1 }
        getProductsByCate(filter);

    }
})


/** FUNCTION FOLLOW */



/** FUNCTION FOLLOW */