
let loadingHTML = `   
                    <div class="loading-skeleton">
                        <table class="table table-light">
                            <tbody>
                                <tr data-toggle="collapse" class="accordion-toggle" data-target="#demo10">
                                    <td>
                                        <p style="margin-bottom: 0;" class="">Some quick example text to build on the card title and make up the bulk of
                                            the card's content.</p>
                                    </td>

                                    <td>
                                        <p style="margin-bottom: 0;" class="">Some quick example text to build on the card title and make up the bulk of
                                            the card's content.</p>
                                    </td>

                                    <td>
                                        <a href="#" class="">Enginner Software</a>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <a href="#" class="">Enginner Software</a>
                                    </td>
                                    <td>
                                        <a href="#" class="">Enginner Software</a>
                                    </td>
                                    <td>
                                        <a href="#" class="">Enginner Software</a>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <a href="#" class="">Enginner Software</a>
                                    </td>
                                    <td>
                                        <a href="#" class="">Enginner Software</a>
                                    </td>
                                    <td> <a href="#" class="">Enginner Software</a>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>`
/**
 * 
 * @key OBI_OD is saved order detail on local
 * @key O_L is saved orders on local
 */

// global var
let page = 1
let currentPage = 1
let allPages = 0

const FIRSTKEY_OBJECT_ORDERS = "order-status"
const FIRSTKEY_OBJECT_ORDERS_DETAIL = "orderId-orderDetail"

const urlParams = new URLSearchParams(window.location.search)
const paramAct = urlParams.get('act')
if (paramAct != "" && paramAct == "mn_all_order") {
    const orderIdExists = checkStateOfData("order-status", "O_L", "All")
    if (!orderIdExists) {
        // console.log(orderIdExists)
        $(".render-tab-layout").html(loadingHTML)
        waitingData("O_L", "order-status", "All", 2000, page)
    } else {
        const dataLocalOrders = JSON.parse(localStorage.getItem("O_L"))
        renderTablesOrders("All", dataLocalOrders)
    }
}

function timeoutLocal() {
    if (localStorage.getItem("OBI_OD")) {
        setTimeout(() => {
            localStorage.removeItem("OBI_OD")
        }, 864000); // 14 minutes after last refresh page
    }
}

timeoutLocal()

/**
 * 
 * @param {respone} res from ajax request 
 * @param {nameOfLocalData} nameOfLocalData the name of the local data
 * @param {keyOfObject} keyOfObject the first one element of object
 * @param {status} status status of key object
 */

function updateListDataOrder(res, nameOfLocalData, keyOfObject, status) {
    const data = JSON.parse(res)
    let stateOfData = null
    stateOfData = checkStateOfData(keyOfObject, nameOfLocalData, status)

    let dataArray = localStorage.getItem(nameOfLocalData)
        ? JSON.parse(localStorage.getItem(nameOfLocalData))
        : []

    if (!stateOfData) {
        dataArray.push(data)
    }
    localStorage.setItem(nameOfLocalData, JSON.stringify(dataArray))
}

function updateDataOrderPages(res, nameOfLocalData, keyOfObject, status) {
    const dataRaw = localStorage.getItem(nameOfLocalData)
    const data = JSON.parse(dataRaw)
    data.forEach((el, index) => {
        if (el[keyOfObject] == status) {
            data[index] = JSON.parse(res)
        }
    })
    localStorage.setItem(nameOfLocalData, JSON.stringify(data))
}

/**
 * 
 * @param {*} keyOfObject 
 * @param {*} nameOfLocalData 
 * @param {*} status 
 * @returns looking for the value of the first element in object | true or false
 */

function checkStateOfData(keyOfObject, nameOfLocalData, status) {
    // console.log(status)
    if (localStorage.getItem(nameOfLocalData) === null)
        return false
    let dataArrayOrder = JSON.parse(localStorage.getItem(nameOfLocalData))
    let found = false
    dataArrayOrder.forEach(el => {
        if (el[keyOfObject] === status) {
            found = true
        }
    })
    return found
}

function waitingData(nameOfLocalData, keyOfObject, status, duration, page, callback) {
    $(".render-tab-layout").html(loadingHTML)
    setTimeout(async () => {
        try {
            const res = await getOrder(status, page)
            updateListDataOrder(res, nameOfLocalData, keyOfObject, status)
            const dataLocalOrders = JSON.parse(localStorage.getItem(nameOfLocalData))
            renderTablesOrders(status, dataLocalOrders)
            callback(res)
        } catch (err) {
            console.log(err)
        }
    }, duration)
}

/**
 * "tab-content-clickable" class handler a click event to show each tabs content all status of orders
 */

$(".tab-content-clickable").on("click", async function (e) {
    page = 1
    currentPage = 1
    const status = $(this).attr("data-status")
    const capitalizedStatus = status.charAt(0).toUpperCase() + status.slice(1);
    // const orderIdExists = checkStateOfData("order-status", "O_L", capitalizedStatus)
    $(".render-tab-layout").html(loadingHTML)
    waitingData("O_L", "order-status", capitalizedStatus, 800, page)
    if (!orderIdExists) {
        $(".render-tab-layout").html(loadingHTML)
        waitingData("O_L", "order-status", capitalizedStatus, 800, page)
        return
    }

    const dataLocalOrders = JSON.parse(localStorage.getItem("O_L"))
    switch (status) {
        case "all":
            renderTablesOrders(capitalizedStatus, dataLocalOrders)
            break
        case "new":
            renderTablesOrders(capitalizedStatus, dataLocalOrders)
            break
        case "processing":
            renderTablesOrders(capitalizedStatus, dataLocalOrders)
            break
        case "confirmed":
            renderTablesOrders(capitalizedStatus, dataLocalOrders)
            break
        case "completed":
            renderTablesOrders(capitalizedStatus, dataLocalOrders)
            break
        case "cancelled":
            renderTablesOrders(capitalizedStatus, dataLocalOrders)
            break
        default:
            renderTablesOrders("On_delivery", dataLocalOrders)
            break
    }
})

/**
 * 
 * @param {*} order_status order status for each statement
 * @returns 
 */

function rememberStateOfStatus(order_status) {
    switch (order_status.toLowerCase()) {
        case "new":
            return { "badge": "badge-danger", "progress": "bg-danger", "percent": "0%" }
        case "processing":
            return { "badge": "badge-dark", "progress": "bg-dark", "percent": "25%" }
        case "confirmed":
            return { "badge": "badge-warning", "progress": "bg-warning", "percent": "50%" }
        case "on_delivery":
            return { "badge": "badge-primary", "progress": "bg-primary", "percent": "75%" }
        case "completed":
            return { "badge": "badge-success", "progress": "bg-success", "percent": "100%" }
        case "cancelled":
            return { "badge": "badge-danger", "progress": "bg-danger", "percent": "0%" }
    }
}

/**
 * 
 * @param {*} status pass a status param with ajax to server
 * @param {*} page for pagination
 * @returns if success returns a value at response
 */

async function getOrder(status, page = 1) {
    return new Promise((resolve, reject) => {
        $.ajax({
            type: "POST",
            url: `?mod=requestAdmin&status=${status}`,
            data: JSON.stringify({ order_status: status, page: page }),
            success: function (res) {
                resolve(res)
            },
            error: function (err) {
                reject(err)
            }
        })
    })
}

async function getOrderDetail(orderId) {
    return new Promise((resolve, reject) => {
        $.ajax({
            type: "POST",
            url: "?mod=requestAdmin&act=order-detail",
            data: JSON.stringify({ orderId: orderId }),
            success: function (res) {
                resolve(res)
            },
            error: function (err) {
                reject(err)
            }
        })
    })
}

/**
 * this function to render a list data order of the table with pagination
 * @param {*} statusKey 
 * @param {*} dataLocalOrders 
 */

function renderTablesOrders(statusKey, dataLocalOrders) {
    let html = ''
    const filteredData = dataLocalOrders.filter(el => {
        return el["order-status"] === statusKey
    })

    const totalOrder = filteredData[0].totalOrder[0].totalOrders
    const dataListOrders = filteredData[0].result
    if (dataListOrders.length > 0) {
        html += `
                <div class="tab-pane fade show active" id="nav-all" role="tabpanel" aria-labelledby="nav-all-tab">
                    <div>
                    <h4 class="card-title">All order</h4>
                    <p class="card-description"></p>
                    <div class="table-responsive">
                        <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>Shop Owner</th>
                                <th>Status</th>
                                <th>Progress</th>
                                <th>Subtotal</th>
                                <th>Buyer</th>
                                <th>Delivery to</th>
                                <th>Created At</th>
                            </tr>
                        </thead>
                        <tbody>`

        dataListOrders.forEach((el, index) => {
            html += `
                        <tr data-id-order="${el.order_id}" data-toggle="collapse" data-target="#demo${index}" class="accordion-toggle order-row-clickable">
                            <td class="py-1">
                                <div class="d-flex flex-column gap-2 py-2">
                                ${el.shop_name}
                                    <img style="cursor: pointer;" class="shop-owner" src="assest/upload/shop/${el.shop_icon}" alt="">
                                </div>
                            </td>
                            <td><div class="badge ${rememberStateOfStatus(el.order_status).badge}">${el.order_status}</div></td>
                            <td>
                                <div class="progress">
                                <div class="progress-bar ${rememberStateOfStatus(el.order_status).progress}" role="progressbar" style="width: ${rememberStateOfStatus(el.order_status).percent}" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                                </div>
                            </td>
                            <td>${el.order_total}</td>
                            <td>
                                <div class="d-flex flex-column gap-2 py-2">${el.buyer_name}
                                    <img style="cursor: pointer;" class="shop-owner" src="assest/upload/shop/${el.buyer_avatar}" alt="">
                                </div>
                            </td>
                            <td>${el.aw_ward + "-" + el.ad_district + "-" + el.ap_province}</td>
                            <td>${el.createdAt}</td>
                        </tr>
                        <tr>
                        <td colspan="12" class="hiddenRow" style="padding: 0;">
                            <div id="demo${index}" class="accordian-body collapse">
                            <div class="order-detail" style="padding: 12px;">
                                <!-- data order detail goes here -->
                            </div>
                            </div>
                        </td>
                        </tr>
                        `
        })
        const totalPages = Math.ceil(totalOrder / 5)
        allPages = totalPages

        html += `
                </tbody>
                </table>
            </div>
            </div>
            
            <nav aria-label="..." style="margin-top: 24px;">
            <ul class="pagination pagi">
            
                <li data-page-status="${statusKey}" onmousedown="return false" class="page-item num-pagi-previous ${currentPage === 1 ? " disable" : ""}" style="cursor: ${currentPage == 1 ? "not-allowed" : "pointer"};"> <!-- disabled | style="cursor: not-allowed;"-->
                    <span class="page-link" href="#" tabindex="-1">Previous</span>
                </li>
                `
        for (let pageNumber = 1; pageNumber <= totalPages; pageNumber++) {
            const active = pageNumber == currentPage ? "active" : ""
            html += `
                    <li data-page-status="${statusKey}" onmousedown="return false" class="page-item num-pagi ${active}" data-page-number="${pageNumber}" style="cursor: pointer;"> <!-- active -->
                        <span class="page-link" href="#">${pageNumber}</span>
                    </li>`
        }

        html += `
                <li data-page-status="${statusKey}" onmousedown="return false" class="page-item num-pagi-next ${currentPage === totalPages ? " disable" : ""}" style="cursor: ${currentPage == totalPages ? "not-allowed" : "pointer"};">
                    <span class="page-link" href="#">Next</span>
                </li>
            </ul>
            </nav>
        </div>`

    } else {
        html = '<h3 style="color: red;">No record...</h3>'
    }

    $(".render-tab-layout").html(html)

}

$(document).on("click", ".num-pagi-previous", function (e) {
    if (currentPage == 1 || page == 1) {
        e.preventDefault()
        return
    }
    --currentPage
    page = currentPage
    const dataPageStatus = $(this).attr("data-page-status")
    waitingData("O_L", FIRSTKEY_OBJECT_ORDERS, dataPageStatus, 800, page, function (res) {
        updateDataOrderPages(res, "O_L", "order-status", dataPageStatus);
        const updatedDataLocalOrders = JSON.parse(localStorage.getItem("O_L"));
        renderTablesOrders(dataPageStatus, updatedDataLocalOrders);
    })

})

$(document).on("click", ".num-pagi-next", function (e) {
    if (currentPage == allPages || page == allPages) {
        e.preventDefault()
        return
    }
    ++currentPage
    page = currentPage
    const dataPageStatus = $(this).attr("data-page-status")
    waitingData("O_L", FIRSTKEY_OBJECT_ORDERS, dataPageStatus, 800, page, function (res) {
        updateDataOrderPages(res, "O_L", "order-status", dataPageStatus);
        const updatedDataLocalOrders = JSON.parse(localStorage.getItem("O_L"));
        renderTablesOrders(dataPageStatus, updatedDataLocalOrders);
    })
})

$(document).on("click", ".num-pagi", function () {
    const dataNumPage = $(this).attr("data-page-number")
    currentPage = parseInt(dataNumPage)
    page = parseInt(dataNumPage)
    const dataPageStatus = $(this).attr("data-page-status")
    waitingData("O_L", FIRSTKEY_OBJECT_ORDERS, dataPageStatus, 800, page, function (res) {
        // updateDataOrderPages(res, "O_L", "order-status", dataPageStatus)
        updateDataOrderPages(res, "O_L", "order-status", dataPageStatus);
        const updatedDataLocalOrders = JSON.parse(localStorage.getItem("O_L"));
        renderTablesOrders(dataPageStatus, updatedDataLocalOrders);
    })
})

/**
 * this ".order-row-clickable" class to handler a click event to show order detail for each orders
 */

$(document).on("click", ".order-row-clickable", async function (e) {
    const orderId = $(this).attr("data-id-order")
    const orderIdExists = checkStateOfData("orderId-orderDetail", "OBI_OD", orderId)
    if (orderIdExists) {
        const dataLocalOrderDetail = JSON.parse(localStorage.getItem("OBI_OD"))
        renderTableOrderDetail(orderId, dataLocalOrderDetail);
    } else {
        $(".order-detail").html(loadingHTML)
        setTimeout(async () => {
            try {
                const res = await getOrderDetail(orderId)
                updateListDataOrder(res, "OBI_OD", "orderId-orderDetail", orderId)
                const dataLocalOrderDetail = JSON.parse(localStorage.getItem("OBI_OD"))
                renderTableOrderDetail(orderId, dataLocalOrderDetail)
            } catch (err) {
                console.log(err)
            }
        }, 1000)
        // waitingData("OBI_OD", "orderId-orderDetail", orderId, 2000)
    }
})


/**
 * this function renderTableOrderDetail() render a list of order detail with each orders
 * @param {*} orderId 
 * @param {*} dataOrderDetail 
 */

function renderTableOrderDetail(orderId, dataOrderDetail) {

    const filteredData = dataOrderDetail.filter(el => {
        return el["orderId-orderDetail"] === orderId
    })

    let html = ""

    const dataListOrderDetail = filteredData[0].result
    if (dataListOrderDetail.length > 0) {
        html += `
                <div class="card">
                    <table class="table table-success">
                        <thead>
                            <tr>
                                <th>Product</th>
                                <th>Quantity</th>
                                <th>Price</th>
                                <th>Total</th>
                                <th>Payment Method</th>
                                <th>Category</th>
                                <th>Created At</th>
                            </tr>
                        </thead>
                        <tbody>`

        dataListOrderDetail.forEach(order => {
            html += `<tr>
                        <td class="py-1">
                            <div class="d-flex flex-column gap-2 py-2">
                            ${order.name}
                                <img style="cursor: pointer;" class="shop-owner" src="assest/upload/${order.image_cover}" alt="">
                            </div>
                        </td>
                        <td>${order.quantity}</td>
                        <td>${order.price}</td>
                        <td>${order.quantity * order.price}</td>
                        <td>${order.payment_method}</td>
                        <td>${order.category_id}</td>
                        <td>${order.created_at}</td>
                    </tr>`
        })

        html += `   </tbody>
                </table>
            </div>
            `
    } else {
        html += "<p>No order details found.</p>"
    }
    $(".order-detail").html(html)
}