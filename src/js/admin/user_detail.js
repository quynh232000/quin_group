$(function () {
    /* ChartJS
     * -------
     * Data and config for chartjs
     */
    'use strict';

    let labelDate = []
    let countOrder = []
    let backgroundColor = []
    let borderColor = []

    // init default 
    callData(getParam("uid"), "7d")

    $("#7d-tab, #30d-tab, #month-tab, #all-tab").click(function (e) {
        actionToCall($(this))
    })

    function actionToCall(element) {
        const viewMode = element.attr("view-mode")
        const uid = getParam("uid")
        callData(uid, viewMode)
    }

    function getParam(param) {
        const url = new URLSearchParams(window.location.search)
        return url.get(param)
    }

    function callData(uid, viewMode) {

        let url = "?mod=requestAdmin&act=user_detail"
        let data = {}
        if (uid) {
            data["uid"] = uid
            if (viewMode) {
                data["viewMode"] = viewMode
            } else {
                console.log("no view-mode param -> return")
                return
            }
        } else {
            console.log("no uid param -> return")
            return
        }

        $.ajax({
            url: url,
            method: "POST",
            data: JSON.stringify(data),
            success: function (res) {
                const data = JSON.parse(res)
                if (data.status) {
                    // console.log(data.result)
                    labelDate = generateDateList(data.type, data.min_max_date)
                    initDataChart(data.result)
                }
            }
        })
    }

    function generateDateList(type, minMaxdate) {
        let datesList = []
        const currentDate = new Date()
        switch (type) {
            case "7d":
                for (let i = 0; i < 7; i++) {
                    let year = currentDate.getFullYear();
                    let month = (currentDate.getMonth() + 1).toString().padStart(2, '0'); // Ensure two digits for month
                    let day = currentDate.getDate().toString().padStart(2, '0'); // Ensure two digits for day
                    let formattedDate = year + '-' + month + '-' + day;
                    datesList.push(formattedDate);
                    currentDate.setDate(currentDate.getDate() - 1);
                }
                break
            case "30d":
                for (let i = 0; i < 30; i++) {
                    let year = currentDate.getFullYear();
                    let month = (currentDate.getMonth() + 1).toString().padStart(2, '0'); // Ensure two digits for month
                    let day = currentDate.getDate().toString().padStart(2, '0'); // Ensure two digits for day
                    let formattedDate = year + '-' + month + '-' + day;
                    datesList.push(formattedDate);
                    currentDate.setDate(currentDate.getDate() - 1);
                }
                break
            case "12M":
                for (let i = 0; i < 12; i++) {
                    let year = currentDate.getFullYear();
                    let month = (currentDate.getMonth() + 1).toString().padStart(2, '0'); // Ensure two digits for month
                    let formattedDate = year + '-' + month;
                    datesList.push(formattedDate);
                    currentDate.setMonth(currentDate.getMonth() - 1);
                }
                break
            case "All":
                const minDate = minMaxdate.min_created_at
                const maxDate = minMaxdate.max_created_at

                const startDate = new Date(minDate);
                const endDate = new Date(maxDate);
                // console.log(startDate)
                // console.log(endDate)
                // Loop through dates between startDate and endDate
                while (startDate <= endDate) {
                    let year = startDate.getFullYear();
                    let month = (startDate.getMonth() + 1).toString().padStart(2, '0'); // Ensure two digits for month
                    let formattedDate = year + '-' + month;
                    datesList.push(formattedDate);
                    startDate.setMonth(startDate.getMonth() + 1);
                }
                break
        }
        return datesList
    }

    function makeOrderCount(dateToCompare, orderCount) {
        const index = labelDate.indexOf(dateToCompare)
        if (index !== -1) {
            countOrder[index] = orderCount
        } else {
            countOrder.push(0)
        }
    }

    function initDataChart(data) {
        data.forEach((el, index) => {
            const orderDate = el.order_date
            const orderCount = el.order_count
            console.log(orderCount)
            makeOrderCount(orderDate, orderCount)
        })
        drawChart()
        countOrder = []
        console.log(labelDate)
        // console.log(countOrder)
    }

    function drawChart() {
        var data = {
            labels: labelDate,
            datasets: [{
                label: 'Số lượng',
                data: countOrder,
                backgroundColor: [
                    'rgba(255, 99, 132, 0.2)',
                    'rgba(54, 162, 235, 0.2)',
                    'rgba(255, 206, 86, 0.2)',
                    'rgba(75, 192, 192, 0.2)',
                    'rgba(153, 102, 255, 0.2)',
                    'rgba(255, 159, 64, 0.2)',
                    'rgba(75, 192, 192, 0.2)',
                    'rgba(153, 102, 255, 0.2)',
                    'rgba(255, 159, 64, 0.2)',
                    'rgba(75, 192, 192, 0.2)',
                    'rgba(255, 99, 132, 0.2)',
                    'rgba(54, 162, 235, 0.2)',
                ],
                borderColor: [
                    'rgba(255,99,132,1)',
                    'rgba(54, 162, 235, 1)',
                    'rgba(255, 206, 86, 1)',
                    'rgba(75, 192, 192, 1)',
                    'rgba(153, 102, 255, 1)',
                    'rgba(255, 159, 64, 1)',
                    'rgba(75, 192, 192, 1)',
                    'rgba(153, 102, 255, 1)',
                    'rgba(255, 159, 64, 1)',
                    'rgba(75, 192, 192, 1)',
                    'rgba(255,99,132,1)',
                    'rgba(54, 162, 235, 1)',
                ],
                borderWidth: 1,
                fill: false
            }]
        };


        var options = {
            scales: {
                yAxes: [{
                    ticks: {
                        beginAtZero: true
                    }
                }]
            },
            legend: {
                display: false
            },
            elements: {
                point: {
                    radius: 0
                }
            }
        };

        // Get context with jQuery - using jQuery's .get() method.
        if ($("#barChart").length) {
            var barChartCanvas = $("#barChart").get(0).getContext("2d");
            // This will get the first returned node in the jQuery collection.
            var barChart = new Chart(barChartCanvas, {
                type: 'bar',
                data: data,
                options: options
            });
        }
    }
})