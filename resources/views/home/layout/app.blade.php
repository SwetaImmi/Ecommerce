<!DOCTYPE html>
<html lang="en">

<head>
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <link href="https://fonts.googleapis.com/css?family=Poppins:100,200,300,400,500,600,700,800,900&display=swap" rel="stylesheet">

    <title>Hexashop Ecommerce HTML CSS Template</title>

    <!-- Cart -->
    <link href="https://unpkg.com/tailwindcss@^2/dist/tailwind.min.css" rel="stylesheet">
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- catrt end -->
    <!-- Additional CSS Files -->
    <link rel="stylesheet" type="text/css" href="{{asset('assets1/css/bootstrap.min.css')}}">

    <link rel="stylesheet" type="text/css" href="{{asset('assets1/css/font-awesome.css')}}">

    <link rel="stylesheet" href="{{asset('assets1/css/templatemo-hexashop.css')}}">

    <link rel="stylesheet" href="{{asset('assets1/css/owl-carousel.css')}}">

    <link rel="stylesheet" href="{{asset('assets1/css/lightbox.css')}}">
    <link rel="stylesheet" href="{{asset('assets1/css/single.css')}}">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css">

    <!-- Notfication -->
    @vite(['resources/css/app.css' , 'resources/js/app.js'])
    <!-- <link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous"> -->
    <style>
        */.dropdown-container {
            position: absolute;
            top: 100%;
            left: 0;
            z-index: 1000;
            display: none;
            float: left;
            min-width: 200px;
            max-width: 330px;
            margin: 2px 0 0;
            list-style: none;
            font-size: 14px;
            background-color: #fff;
            border: 1px solid #ccc;
            border: 1px solid rgba(0, 0, 0, 0.15);
            border-radius: 4px;
            -webkit-box-shadow: 0 6px 12px rgba(0, 0, 0, 0.175);
            box-shadow: 0 6px 12px rgba(0, 0, 0, 0.175);
            background-clip: padding-box
        }

        .dropdown-container>.dropdown-menu {
            position: static;
            z-index: 1000;
            float: none !important;
            padding: 10px 0;
            margin: 0;
            border: 0;
            background: transparent;
            border-radius: 0;
            -webkit-box-shadow: none;
            box-shadow: none;
            max-height: 330px;
            overflow-y: auto
        }

        .dropdown-container>.dropdown-menu+.dropdown-menu {
            padding-top: 0
        }

        .dropdown-menu>li>a {
            overflow: hidden;
            white-space: nowrap;
            word-wrap: normal;
            text-decoration: none;
            text-overflow: ellipsis;
            -o-text-overflow: ellipsis;
            -webkit-transition: none;
            -o-transition: none;
            transition: none
        }

        .dropdown-toggle {
            cursor: pointer
        }

        .dropdown-header {
            white-space: nowrap
        }

        .open>.dropdown-container>.dropdown-menu,
        .open>.dropdown-container {
            display: block
        }

        .dropdown-toolbar {
            padding-top: 6px;
            padding-left: 20px;
            padding-right: 20px;
            padding-bottom: 5px;
            background-color: #fff;
            border-bottom: 1px solid rgba(0, 0, 0, 0.15);
            border-radius: 4px 4px 0 0
        }

        .dropdown-toolbar>.form-group {
            margin: 5px -10px
        }

        .dropdown-toolbar .dropdown-toolbar-actions {
            float: right
        }

        .dropdown-toolbar .dropdown-toolbar-title {
            margin: 0;
            font-size: 14px
        }

        .dropdown-footer {
            padding: 5px 20px;
            border-top: 1px solid #ccc;
            border-top: 1px solid rgba(0, 0, 0, 0.15);
            border-radius: 0 0 4px 4px
        }

        .anchor-block small {
            display: none
        }

        @media (min-width:992px) {
            .anchor-block small {
                display: block;
                font-weight: normal;
                color: #777777
            }

            .dropdown-menu>li>a.anchor-block {
                padding-top: 6px;
                padding-bottom: 6px
            }
        }

        @media (min-width:992px) {
            .dropdown.hoverable:hover>ul {
                display: block
            }
        }

        .dropdown-position-topright {
            top: auto;
            right: 0;
            bottom: 100%;
            left: auto;
            margin-bottom: 2px
        }

        .dropdown-position-topleft {
            top: auto;
            right: auto;
            bottom: 100%;
            left: 0;
            margin-bottom: 2px
        }

        .dropdown-position-bottomright {
            right: 0;
            left: auto
        }

        .dropmenu-item-label {
            white-space: nowrap
        }

        .dropmenu-item-content {
            position: absolute;
            text-align: right;
            max-width: 60px;
            right: 20px;
            color: #777777;
            overflow: hidden;
            white-space: nowrap;
            word-wrap: normal;
            -o-text-overflow: ellipsis;
            text-overflow: ellipsis
        }

        small.dropmenu-item-content {
            line-height: 20px
        }

        .dropdown-menu>li>a.dropmenu-item {
            position: relative;
            padding-right: 66px
        }

        .dropdown-submenu .dropmenu-item-content {
            right: 40px
        }

        .dropdown-menu>li.dropdown-submenu>a.dropmenu-item {
            padding-right: 86px
        }

        .dropdown-inverse .dropdown-menu {
            background-color: rgba(0, 0, 0, 0.8);
            border: 1px solid rgba(0, 0, 0, 0.9)
        }

        .dropdown-inverse .dropdown-menu .divider {
            height: 1px;
            margin: 9px 0;
            overflow: hidden;
            background-color: #2b2b2b
        }

        .dropdown-inverse .dropdown-menu>li>a {
            color: #cccccc
        }

        .dropdown-inverse .dropdown-menu>li>a:hover,
        .dropdown-inverse .dropdown-menu>li>a:focus {
            color: #fff;
            background-color: #262626
        }

        .dropdown-inverse .dropdown-menu>.active>a,
        .dropdown-inverse .dropdown-menu>.active>a:hover,
        .dropdown-inverse .dropdown-menu>.active>a:focus {
            color: #fff;
            background-color: #337ab7
        }

        .dropdown-inverse .dropdown-menu>.disabled>a,
        .dropdown-inverse .dropdown-menu>.disabled>a:hover,
        .dropdown-inverse .dropdown-menu>.disabled>a:focus {
            color: #777777
        }

        .dropdown-inverse .dropdown-header {
            color: #777777
        }

        .table>thead>tr>th.col-actions {
            padding-top: 0;
            padding-bottom: 0
        }

        .table>thead>tr>th.col-actions .dropdown-toggle {
            color: #777777
        }

        .notifications {
            list-style: none;
            padding: 0
        }

        .notification {
            display: block;
            padding: 9.6px 12px;
            border-bottom: 1px solid #eeeeee;
            color: #333333;
            text-decoration: none
        }

        .notification:last-child {
            border-bottom: 0
        }

        .notification:hover,
        .notification.active:hover {
            background-color: #f9f9f9
        }

        .notification.active {
            background-color: #f4f4f4
        }

        .notification-title {
            font-size: 15px;
            margin-bottom: 0
        }

        .notification-desc {
            margin-bottom: 0
        }

        .notification-meta {
            color: #777777
        }

        a.notification:hover {
            text-decoration: none
        }

        .dropdown-notifications>.dropdown-container,
        .dropdown-notifications>.dropdown-menu {
            width: 450px;
            max-width: 450px
        }

        .dropdown-notifications .dropdown-menu {
            padding: 0
        }

        .dropdown-notifications .dropdown-toolbar,
        .dropdown-notifications .dropdown-footer {
            padding: 9.6px 12px
        }

        .dropdown-notifications .dropdown-toolbar {
            background: #fff
        }

        .dropdown-notifications .dropdown-footer {
            background: #eeeeee
        }

        .notification-icon {
            margin-right: 6.8775px
        }

        .notification-icon:after {
            position: absolute;
            content: attr(data-count);
            margin-left: -6.8775px;
            margin-top: -6.8775px;
            padding: 0 4px;
            min-width: 13.755px;
            height: 13.755px;
            line-height: 13.755px;
            background: red;
            border-radius: 10px;
            color: #fff;
            text-align: center;
            vertical-align: middle;
            font-size: 11.004px;
            font-weight: 600;
            font-family: "Helvetica Neue", Helvetica, Arial, sans-serif
        }

        .notification .media-body {
            padding-top: 5.6px
        }

        .btn-lg .notification-icon:after {
            margin-left: -8.253px;
            margin-top: -8.253px;
            min-width: 16.506px;
            height: 16.506px;
            line-height: 16.506px;
            font-size: 13.755px
        }

        .btn-xs .notification-icon:after {
            content: '';
            margin-left: -4.1265px;
            margin-top: -2.06325px;
            min-width: 6.25227273px;
            height: 6.25227273px;
            line-height: 6.25227273px;
            padding: 0
        }

        .btn-xs .notification-icon {
            margin-right: 3.43875px
        }
    </style>

    <!-- Notification end -->

    <!--

TemplateMo 571 Hexashop

https://templatemo.com/tm-571-hexashop

-->
</head>

<body>

    <!-- ***** Preloader Start ***** -->
    <div id="preloader">
        <div class="jumper">
            <div></div>
            <div></div>
            <div></div>
        </div>
    </div>
    <!-- ***** Preloader End ***** -->



    <!-- ***** Header Area Start ***** -->
    @include('home.layout.header')
    <!-- ***** Header Area End ***** -->

    @yield('content')


    <!-- ***** Footer Start ***** -->

    @include('home.layout.footer')
    <!-- Notification Start -->



    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>


    <script>
        // alert()
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
    </script>




    <!-- Notification end -->


    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <!-- cart -->

    <!-- <script src="{{asset('../../plugins/jquery/jquery.min.js')}}"></script> -->
    <!-- Bootstrap 4 -->
    <!-- <script src="../../plugins/bootstrap/js/bootstrap.bundle.min.js"></script> -->
    <!-- AdminLTE App -->
    <!-- <script src="../../dist/js/adminlte.min.js"></script> -->
    <!-- AdminLTE for demo purposes -->
    <!-- <script src="../../dist/js/demo.js"></script> -->
    <!-- cart -->

    <!-- jQuery -->
    <script src="{{asset('assets1/js/jquery-2.1.0.min.js')}}"></script>

    <!-- Bootstrap -->
    <script src=" {{asset('assets1/js/popper.js')}}"></script>
    <script src="{{asset('assets1/js/bootstrap.min.js')}}"></script>
    <!-- <script src="assets1/js/ajax.js"></script> -->
    <!-- Plugins -->
    <script src="{{asset('assets1/js/owl-carousel.js')}}"></script>
    <script src="{{asset('assets1/js/accordions.js')}}"></script>
    <script src="{{asset('assets1/js/datepicker.js')}}"></script>
    <script src="{{asset('assets1/js/scrollreveal.min.js')}}"></script>
    <script src="{{asset('assets1/js/waypoints.min.js')}}"></script>
    <script src="{{asset('assets1/js/jquery.counterup.min.js')}}"></script>
    <script src="{{asset('assets1/js/imgfix.min.js')}}"></script>
    <script src="{{asset('assets1/js/slick.js')}}"></script>
    <script src="{{asset('assets1/js/lightbox.js')}}"></script>
    <script src="{{asset('assets1/js/isotope.js')}}"></script>

    <!-- Global Init -->
    <script src="{{asset('assets1/js/custom.js')}}"></script>

    <script>
        $(function() {
            var selectedClass = "";
            $("p").click(function() {
                selectedClass = $(this).attr("data-rel");
                $("#portfolio").fadeTo(50, 0.1);
                $("#portfolio div").not("." + selectedClass).fadeOut();
                setTimeout(function() {
                    $("." + selectedClass).fadeIn();
                    $("#portfolio").fadeTo(50, 1);
                }, 500);

            });


        });
    </script>
    <script>
        $("document").ready(function() {
            setTimeout(function() {
                $("div.success").remove();
            }, 3000);

        });
    </script>


   
    <script>
        $(document).ready(function() {
            $('.product-image-thumb').on('click', function() {
                var $image_element = $(this).find('img')
                $('.product-image').prop('src', $image_element.attr('src'))
                $('.product-image-thumb.active').removeClass('active')
                $(this).addClass('active')
            })
        })
    </script>


    <script>
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $('#submit').click('submit', function(e) {
            e.preventDefault();

            var name = $("#name").val();
            var email = $('#email').val();
            var message = $('#message').val();
            $.ajax({
                type: "POST",
                url: '/contact/send',
                data: {
                    name: name,
                    email: email,
                    message: message,

                },
                success: function(data) {
                    if ($.isEmptyObject(data.error)) {
                        alert(data.success);
                        location.reload();
                    } else {
                        printErrorMsg(data.error);
                    }
                },

            });

        });

        function printErrorMsg(msg) {
            $(".print-error-msg").find("input").html('');
            $(".print-error-msg").css('display', 'block');
            $.each(msg, function(key, value) {
                $('print-error-msg').find("input").append('<span>' + value + '</span');
            });
        }
    </script>


   


</body>

</html>