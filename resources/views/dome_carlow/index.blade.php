@extends('dome_carlow.layouts.main')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css"
    integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg=="
    crossorigin="anonymous" referrerpolicy="no-referrer" />
@section('content')
    <style>
        body {
            font-family: 'Open Sans', sans-serif;
            background-color: #f8f9fa;
        }

        .step {
            display: none;
        }

        .active {
            display: block;
        }

        input {
            padding: 15px 20px;
            width: 100%;
            font-size: 1em;
            border: 1px solid #e3e3e3;
            border-radius: 5px;
        }

        input:focus {
            border: 1px solid #009688;
            outline: 0;
        }

        .invalid {
            border: 1px solid #ffaba5;
        }

        #prevBtn {
            color:black;
            border: none;
            font-size: 20px;
            cursor: pointer;
            border-radius: 50%;
            margin-top: 5px;
            transition: background-color 0.3s ease;
            width: 70px;
            height: 70px;
            margin-right: 10px;
            background-color: white;
        }

     
   

        .progress {
            margin-bottom: 20px;
        }

        .stepper {
            display: flex;
            justify-content: space-between;
            padding: 14px;

        }

        .stepper-item {
            flex: 1;
            position: relative;
            text-align: center;
        }

        .stepper-item:first-child:before {
            width: 50%;
            left: 50%;
        }


        .stepper-item.active .stepper-label {
            color: #9cbf17;
            font-weight: bold;
            border-bottom: 3px solid #9cbf17;
            padding: 0px 15px;
        }

        .stepper-label {
            display: inline-block;
            /* padding: 10px;
                        background: white;
                        border-radius: 50%;
                        border: 2px solid #ccc;
                        width: 40px;
                        height: 40px;
                        line-height: 40px;
                        margin-bottom: 10px; */
        }

        .stepper-item.active .stepper-label {
            border-color: #9cbf17;
            background-color: #fff;
            color: #9cbf17;
        }
    </style>
    <div id="wrapper">
        @include('dome_carlow.layouts.header')
        <div class="content container">
            <form class="from" action="{{ route('dome-carlow.personal_info') }}" method="GET" id="select_date_time">
                <div class="row gx-xxl-5 row-booking justify-content-end">
                    <div class="booking-header">
                        <div class="inner">
                            <div class="row d-flex justify-content-center align-items-center">
                                <div class="col-lg-6 px-5 d-flex">
                                    <button type="button" id="prevBtn" onclick="nextPrev(-1)" class="shadow"><i
                                            class="fa-solid fa-arrow-left"></i></button>

                                    <div class="step-label">
                                        <p class="mb-0">Step 1 of 3</p>
                                        <h1 class="title fw-bold mt-0">Select Date</h1>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 d-none d-lg-block px-2">
                        <div class="mb-3">
                            <img src="{{ asset('assets/img/Sports-simulator.png') }}" alt="" class="w-100">
                        </div>
                        <div class="mt-3">
                            <img src="{{ asset('assets/img/Sports-simulator-1.png') }}" alt="" class="w-100">
                        </div>
                    </div>
                    <div class=" col-12 col-lg-6 h-100 px-2">


                        <div class="step active">
                            @include('dome_carlow.activity')
                        </div>
                        <div class="step">
                            @include('dome_carlow.personal_info')

                        </div>
                        <div class="step">
                            @include('dome_carlow.payment')
                        </div>



                    </div>

                    <div class="col-12 col-md-3 col-lg-3 col-booking-side px-2">

                        <div class="ticket-summary sticky">
                            <div class="card shadow border-0 rounded-4 px-2 py-3">
                                <div class="card-header bg-white border-0 d-flex align-items-center">
                                    <h4 class="mt-1 fw-bold" style="font-size: 24px">Ticket Reservation Summary</h4>
                                </div>
                                <div class="card-body pt-1">
                                    <div id="cartItems" class="rounded border"
                                        style="background-color: rgba(220, 223, 228, .11)">
                                        <table class="tbl-booking border-0">
                                            <tr>
                                                <td>
                                                    <div class="date-label">Date</div>
                                                    <div class="" id="displayedDateInCart">25-05-2022</div>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <div class="date-label">Reserved Slot</div>
                                                    <div class="" id="">09:00</div>
                                                </td>
                                            </tr>
                                            <tr class="border-0">
                                                <td>
                                                    <div class="date-label">Slot Duration</div>
                                                    <div class="" id="">30 minutes</div>
                                                </td>
                                                <td class="p-0">
                                                    <div class=""
                                                        style="border-left: 2px solid #DCDFE4; height:40px;"></div>
                                                </td>
                                                <td>
                                                    <div class="date-label"><i class="bi bi-person"></i> Person</div>
                                                    <div class="" id="">6</div>
                                                </td>
                                            </tr>
                                        </table>
                                    </div>
                                    <h4 class="mt-4 mb-3 fw-bold" style="font-size: 24px">Your Price Summary</h4>
                                    <div id="cartItems" class="rounded" style="background-color: rgba(220, 223, 228, .11)">
                                        <table class="tbl-booking border-0">
                                            <tr>
                                                <td>
                                                    <div class="date-label">Bowling</div>
                                                    <div class="" id="">€ 600</div>
                                                </td>
                                                <td class="text-center">
                                                    2
                                                </td>
                                            </tr>
                                            <tr class="">
                                                <td>
                                                    <h4 class="my-2">Total Price</h4>
                                                </td>
                                                <td>
                                                    <h4 class="fw-bold my-2">€ 600</h4>
                                                </td>
                                            </tr>
                                        </table>
                                    </div>
                                    <div class="mt-rem-20">
                                        <div class="row gx-3">
                                            <div class="col">
                                                <button type="button"
                                                    class=" cta text-white  main-continue" id="nextBtn" onclick="nextPrev(1)">Continue</button>
                                            </div>

                                        </div>
                                      
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </form>

        </div>
        @include('dome_carlow.layouts.footer')
        <script src="{{ asset('assets/js/main.js') }}"></script>

        <script src="{{ asset('assets/lib/jquery/jquery.min.js') }}"></script>
        <script src="{{ asset('assets/lib/jquery-validation/dist/jquery.validate.js') }}"></script>
        <script src="{{ asset('assets/lib/jquery-validation-unobtrusive/jquery.validate.unobtrusive.js') }}"></script>
        <script src="{{ asset('assets/js/plugins.js') }}"></script>
        <script type="text/javascript" src="{{ asset('assets/js/tickets-helper.js') }}"></script>
        <script type="text/javascript" src="{{ asset('assets/js/select-tickets.js') }}"></script>
        <script type="text/javascript" src="{{ asset('assets/js/timer.js') }}"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
        <script src="https://code.jquery.com/ui/1.10.3/jquery-ui.js"></script>

        <script>
            $(document).ready(function() {
                $(document).on('click', '.btn_continue', function() {
                    $("#select_date_time").submit();
                });

            });
        </script>
        <script>
            $(function() {
                $("#datepicker").datepicker({
                    firstDay: 1
                });
            });
        </script>

        @push('script')
            <script>
                let currentTab = 0;
                showTab(currentTab);

                function showTab(n) {
                    let x = document.getElementsByClassName("step");
                    let stepperItems = document.getElementsByClassName("stepper-item");

                    x[n].style.display = "block";

                    // Update the stepper header
                    for (let i = 0; i < stepperItems.length; i++) {
                        stepperItems[i].classList.remove("active");
                    }
                    stepperItems[n].classList.add("active");

                   
                    document.getElementById("prevBtn").style.display = n == 0 ? "none" : "inline";
                    document.getElementById("nextBtn").innerHTML = n == x.length - 1 ? "Submit" : "Next";
                }

                function nextPrev(n) {
                    let x = document.getElementsByClassName("step");
                    if (n == 1 && !validateForm()) return false;
                    x[currentTab].style.display = "none";
                    currentTab += n;
                    if (currentTab >= x.length) {
                        resetForm();
                        return false;
                    }
                    showTab(currentTab);
                }

                function validateForm() {
                    let valid = true;
                    let x = document.getElementsByClassName("step");
                    let y = x[currentTab].getElementsByTagName("input");
                    for (var i = 0; i < y.length; i++) {
                        if (y[i].value == "") {
                            y[i].className += " invalid";
                            valid = false;
                        }
                    }
                    return valid;
                }

                function resetForm() {
                    let x = document.getElementsByClassName("step");
                    for (var i = 0; i < x.length; i++) {
                        x[i].style.display = "none";
                    }
                    let inputs = document.querySelectorAll("input");
                    inputs.forEach(input => {
                        input.value = "";
                        input.className = "";
                    });
                    currentTab = 0;
                    showTab(currentTab);
                    document.getElementById("prevBtn").style.display = "none";
                }
            </script>
        @endpush
    @endsection
