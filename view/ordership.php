<?php
if ($is_expire == 'expired') { ?>
    <h2>Đơn hàng này đã giao thành công!</h2>
<?php } elseif ($is_expire == 'new') { ?>
    <!-- not expire -->
    <form method="POST" action="<?= $_SERVER['REQUEST_URI'] ?>">

        <input type="submit" value="Xác nhận đã giao" name="submit">
    </form>


    <h1>
        <button id="create_qr">Get QrCode</button>
    </h1>


    <!-- qr code ======================-->
    <style>
        #qrcode {
            width: 160px;
            height: 160px;
            margin-top: 15px;
        }
    </style>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/qrcodejs/1.0.0/qrcode.min.js"
        integrity="sha512-CNgIRecGo7nphbeZ04Sc13ka07paqdeTu0WR1IM4kNcpmBAUSHSQX0FslNhTDadL4O5SAGapGt4FodqL8My0mA=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>

    <input id="text" hidden type="text" value="<?= $_SERVER['REQUEST_URI'] ?>&qrcode=true" style="width:80%" /><br />
    <div id="qrcode"></div>
    <script>
        var qrcode = new QRCode("qrcode");

        function makeCode() {
            var elText = document.getElementById("text");

            if (!elText.value) {
                alert("Input a text");
                elText.focus();
                return;
            }

            qrcode.makeCode(elText.value);
        }
        const btn = document.getElementById('create_qr')
        btn.onclick = () => {

            makeCode();
        }

        $("#text").
            on("blur", function () {
                makeCode();
            }).
            on("keydown", function (e) {
                if (e.keyCode == 13) {
                    makeCode();
                }
            });
    </script>

<?php } else { ?>
    <!-- view qrcode -->
    <style>
        .container {
            width: 300px;
            margin: 50px auto;
        }

        .svg-success {
            display: inline-block;
            vertical-align: top;
            height: 300px;
            width: 300px;
            opacity: 1;
            overflow: visible;
        }

        @keyframes success-tick {
            0% {
                stroke-dashoffset: 16px;
                opacity: 1;
            }

            100% {
                stroke-dashoffset: 31px;
                opacity: 1;
            }
        }

        @keyframes success-circle-outline {
            0% {
                stroke-dashoffset: 72px;
                opacity: 1;
            }

            100% {
                stroke-dashoffset: 0px;
                opacity: 1;
            }
        }

        @keyframes success-circle-fill {
            0% {
                opacity: 0;
            }

            100% {
                opacity: 1;
            }
        }

        .svg-success .success-tick {
            fill: none;
            stroke-width: 1px;
            stroke: #fff;
            stroke-dasharray: 15px, 15px;
            stroke-dashoffset: -14px;
            animation: success-tick 450ms ease 1400ms forwards;
            opacity: 0;
        }

        .svg-success .success-circle-outline {
            fill: none;
            stroke-width: 1px;
            stroke: #81c038;
            stroke-dasharray: 72px, 72px;
            stroke-dashoffset: 72px;
            animation: success-circle-outline 300ms ease-in-out 800ms forwards;
            opacity: 0;
        }

        .svg-success .success-circle-fill {
            fill: #81c038;
            stroke: none;
            opacity: 0;
            animation: success-circle-fill 300ms ease-out 1100ms forwards;
        }

        @media screen and (-ms-high-contrast: active),
        screen and (-ms-high-contrast: none) {
            .svg-success .success-tick {
                stroke-dasharray: 0;
                stroke-dashoffset: 0;
                animation: none;
                opacity: 1;
            }

            .svg-success .success-circle-outline {
                stroke-dasharray: 0;
                stroke-dashoffset: 0;
                animation: none;
                opacity: 1;
            }

            .svg-success .success-circle-fill {
                animation: none;
                opacity: 1;
            }
        }
    </style>
    <div class="container">
        <svg xmlns="http://www.w3.org/2000/svg" class="svg-success" viewBox="0 0 24 24">
            <g stroke-linecap="round" stroke-linejoin="round" stroke-miterlimit="10">
                <circle class="success-circle-outline" cx="12" cy="12" r="11.5" />
                <circle class="success-circle-fill" cx="12" cy="12" r="11.5" />
                <polyline class="success-tick" points="17,8.5 9.5,15.5 7,13" />
            </g>
        </svg>

    </div>

<?php } ?>