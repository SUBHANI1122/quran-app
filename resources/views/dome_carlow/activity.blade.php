    <div class="card shadow border-0 rounded-4 mx-1 mb-4">
        <div class="card-body pt-5">
            <div id="datepicker" class="calendar"></div>
        </div>
    </div>
    <div class="card shadow border-0 rounded-4">
        <div class="card-body">
            <ul class="nav nav-pills mb-3 shadow rounded p-2 d-flex justify-content-between" id="pills-tab" role="tablist">
                <li class="nav-item px-0" role="presentation">
                    <button class="nav-link px-2 active" id="pills-home-tab" data-bs-toggle="pill"
                        data-bs-target="#pills-home" type="button" role="tab" aria-controls="pills-home"
                        aria-selected="true">
                        <i class="bi bi-controller" style="font-size:20px;"></i> Games</button>
                </li>
                <li class="nav-item px-0" role="presentation">
                    <button class="nav-link px-2" id="pills-profile-tab" data-bs-toggle="pill"
                        data-bs-target="#pills-profile" type="button" role="tab" aria-controls="pills-profile"
                        aria-selected="false">
                        <i class="bi bi-person-plus" style="font-size:20px;"></i> Packages</button>
                </li>
                <li class="nav-item px-0" role="presentation">
                    <button class="nav-link px-2" id="pills-contact-tab" data-bs-toggle="pill"
                        data-bs-target="#pills-contact" type="button" role="tab" aria-controls="pills-contact"
                        aria-selected="false">
                        <i class="fa-solid fa-user-plus"></i> Congo Quest</button>
                </li>
                <li class="nav-item px-0" role="presentation">
                    <button class="nav-link px-2" id="pills-da-tab" data-bs-toggle="pill" data-bs-target="#pills-da"
                        type="button" role="tab" aria-controls="pills-da" aria-selected="false">
                        <i class="fa-solid fa-mug-hot" style="font-size:20px;"></i> Parties</button>
                </li>
            </ul>
            <div class="tab-content select-game" id="pills-tabContent">
                {{-- Games Start --}}
                <div class="tab-pane fade show active" id="pills-home" role="tabpanel" aria-labelledby="pills-home-tab">
                    <h4 class="mt-4 mb-3 main-title">Select Game Type</h4>
                    <ul class="nav nav-pills row mb-2 booking-game-types" id="pills-tab" role="tablist">
                        <li class="nav-item col-4" role="presentation">
                            <button class="nav-link active w-100 fw-normal" id="pills-home-tab" data-bs-toggle="pill"
                                type="button" role="tab" aria-controls="pills-home"
                                aria-selected="true">Bowling</button>
                        </li>
                        <li class="nav-item col-4" role="presentation">
                            <button class="nav-link w-100 fw-normal" id="pills-profile-tab" data-bs-toggle="pill"
                                type="button" role="tab" aria-controls="pills-profile" aria-selected="false">Laser
                                Zone</button>
                        </li>
                        <li class="nav-item col-4" role="presentation">
                            <button class="nav-link w-100 fw-normal" id="pills-contact-tab" data-bs-toggle="pill"
                                type="button" role="tab" aria-controls="pills-contact" aria-selected="false">Sports
                                Simulator</button>
                        </li>
                        <li class="nav-item col-4" role="presentation">
                            <button class="nav-link w-100 fw-normal" id="pills-da-tab" data-bs-toggle="pill"
                                type="button" role="tab" aria-controls="pills-da" aria-selected="false">Pool
                                Tables</button>
                        </li>
                        <li class="nav-item col-4" role="presentation">
                            <button class="nav-link w-100 fw-normal" id="pills-Arcade-tab" data-bs-toggle="pill"
                                type="button" role="tab" aria-controls="pills-Arcade"
                                aria-selected="false">Arcade</button>
                        </li>
                    </ul>
                    <h4 class="mb-3 main-title">Select Time Slot</h4>
                    <ul class="nav nav-pills mb-3 shadow rounded p-2 d-flex justify-content-between" id="pills-tab"
                        role="tablist">
                        <li class="nav-item" role="presentation">
                            <button class="nav-link active" id="pills-h-tab" data-bs-toggle="pill"
                                data-bs-target="#pills-h" type="button" role="tab" aria-controls="pills-home"
                                aria-selected="true">30-Minutes</button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link" id="pills-p-tab" data-bs-toggle="pill"
                                data-bs-target="#pills-p" type="button" role="tab"
                                aria-controls="pills-profile" aria-selected="false">60-Minutes</button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link" id="pills-c-tab" data-bs-toggle="pill"
                                data-bs-target="#pills-c" type="button" role="tab"
                                aria-controls="pills-contact" aria-selected="false">10 shots</button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link" id="pills-d-tab" data-bs-toggle="pill"
                                data-bs-target="#pills-d" type="button" role="tab" aria-controls="pills-da"
                                aria-selected="false">Pizza Bowl</button>
                        </li>
                    </ul>
                    <div class="tab-content select-game" id="pills-tabContent">
                        <div class="tab-pane fade show active booking-types" id="pills-h" role="tabpanel"
                            aria-labelledby="pills-h-tab">
                            <ul class="nav nav-pills row mb-2 booking-game-types" id="pills-tab" role="tablist">
                                <li class="nav-item col-3" role="presentation">
                                    <button class="nav-link active w-100 fw-normal" id="pills-home-tab"
                                        data-bs-toggle="pill" type="button" role="tab"
                                        aria-controls="pills-home" aria-selected="true">10:30AM</button>
                                </li>
                                <li class="nav-item col-3" role="presentation">
                                    <button class="nav-link w-100 fw-normal" id="pills-profile-tab"
                                        data-bs-toggle="pill" type="button" role="tab"
                                        aria-controls="pills-profile" aria-selected="false">11:30AM</button>
                                </li>
                                <li class="nav-item col-3" role="presentation">
                                    <button class="nav-link w-100 fw-normal" id="pills-contact-tab"
                                        data-bs-toggle="pill" type="button" role="tab"
                                        aria-controls="pills-contact" aria-selected="false">12:30PM</button>
                                </li>
                                <li class="nav-item col-3" role="presentation">
                                    <button class="nav-link w-100 fw-normal" id="pills-da-tab" data-bs-toggle="pill"
                                        type="button" role="tab" aria-controls="pills-da"
                                        aria-selected="false">01:30PM</button>
                                </li>
                                <li class="nav-item col-3" role="presentation">
                                    <button class="nav-link w-100 fw-normal" id="pills-Arcade-tab"
                                        data-bs-toggle="pill" type="button" role="tab"
                                        aria-controls="pills-Arcade" aria-selected="false">02:30PM</button>
                                </li>
                                <li class="nav-item col-3" role="presentation">
                                    <button class="nav-link w-100 fw-normal" id="pills-Ae-tab" data-bs-toggle="pill"
                                        type="button" role="tab" aria-controls="pills-Ae"
                                        aria-selected="false">5:30PM</button>
                                </li>
                            </ul>
                        </div>
                        <div class="tab-pane fade" id="pills-p" role="tabpanel" aria-labelledby="pills-p-tab">
                            <div class="d-flex mt-2 mb-3">
                                <input type="checkbox" class="text-white">
                                <p style="padding-left: 5px; color:#9CBF17;">group discount making
                                    price €28(flexible), carer rate game at €4</p>
                            </div>
                            <ul class="nav nav-pills row mb-2 booking-game-types" id="pills-tab" role="tablist">
                                <li class="nav-item col-3" role="presentation">
                                    <button class="nav-link active w-100 fw-normal" id="pills-home-tab"
                                        data-bs-toggle="pill" type="button" role="tab"
                                        aria-controls="pills-home" aria-selected="true">10:00AM</button>
                                </li>
                                <li class="nav-item col-3" role="presentation">
                                    <button class="nav-link w-100 fw-normal" id="pills-profile-tab"
                                        data-bs-toggle="pill" type="button" role="tab"
                                        aria-controls="pills-profile" aria-selected="false">11:00AM</button>
                                </li>
                                <li class="nav-item col-3" role="presentation">
                                    <button class="nav-link w-100 fw-normal" id="pills-contact-tab"
                                        data-bs-toggle="pill" type="button" role="tab"
                                        aria-controls="pills-contact" aria-selected="false">12:00PM</button>
                                </li>
                                <li class="nav-item col-3" role="presentation">
                                    <button class="nav-link w-100 fw-normal" id="pills-da-tab" data-bs-toggle="pill"
                                        type="button" role="tab" aria-controls="pills-da"
                                        aria-selected="false">01:30PM</button>
                                <li class="nav-item col-3" role="presentation">
                                    <button class="nav-link w-100 fw-normal" id="pills-Ae-tab" data-bs-toggle="pill"
                                        type="button" role="tab" aria-controls="pills-Ae"
                                        aria-selected="false">02:00PM</button>
                                </li>
                                <li class="nav-item col-3" role="presentation">
                                    <button class="nav-link w-100 fw-normal" id="pills-A-tab" data-bs-toggle="pill"
                                        type="button" role="tab" aria-controls="pills-A"
                                        aria-selected="false">05:00PM</button>
                                </li>
                            </ul>
                        </div>
                        <div class="tab-pane fade" id="pills-c" role="tabpanel" aria-labelledby="pills-c-tab">
                            <ul class="nav nav-pills row mb-2 booking-game-types" id="pills-tab" role="tablist">
                                <li class="nav-item col-3" role="presentation">
                                    <button class="nav-link active w-100 fw-normal" id="pills-home-tab"
                                        data-bs-toggle="pill" type="button" role="tab"
                                        aria-controls="pills-home" aria-selected="true">10:30AM</button>
                                </li>
                                <li class="nav-item col-3" role="presentation">
                                    <button class="nav-link w-100 fw-normal" id="pills-profile-tab"
                                        data-bs-toggle="pill" type="button" role="tab"
                                        aria-controls="pills-profile" aria-selected="false">11:30AM</button>
                                </li>
                                <li class="nav-item col-3" role="presentation">
                                    <button class="nav-link w-100 fw-normal" id="pills-contact-tab"
                                        data-bs-toggle="pill" type="button" role="tab"
                                        aria-controls="pills-contact" aria-selected="false">12:30PM</button>
                                </li>
                                <li class="nav-item col-3" role="presentation">
                                    <button class="nav-link w-100 fw-normal" id="pills-da-tab" data-bs-toggle="pill"
                                        type="button" role="tab" aria-controls="pills-da"
                                        aria-selected="false">01:30PM</button>
                                </li>
                                <li class="nav-item col-3" role="presentation">
                                    <button class="nav-link w-100 fw-normal" id="pills-Arcade-tab"
                                        data-bs-toggle="pill" type="button" role="tab"
                                        aria-controls="pills-Arcade" aria-selected="false">02:30PM</button>
                                </li>
                                <li class="nav-item col-3" role="presentation">
                                    <button class="nav-link w-100 fw-normal" id="pills-Ae-tab" data-bs-toggle="pill"
                                        type="button" role="tab" aria-controls="pills-Ae"
                                        aria-selected="false">5:30PM</button>
                                </li>
                            </ul>
                        </div>
                        <div class="tab-pane fade" id="pills-d" role="tabpanel" aria-labelledby="pills-d-tab">
                            <div class="row mx-2 py-3 d-flex justify-content-center pizza_bowl">
                                <div class="col-11 py-2 rounded text-light  d-flex align-items-center justify-content-between"
                                    style="background:linear-gradient(to top, #1db4eb 0%, #9cbf17 80%) !important;">
                                    <div>
                                        <h6 class="mb-0">Pizza Bowl</h6>
                                    </div>
                                    <div class="d-flex align-items-center">
                                        <p class="mb-0 px-1">Time Interval:</p>
                                        <h6 class="mb-0"> 60 Minutes</h6>
                                    </div>
                                </div>
                                <div class="col-11 px-0 mt-3" style="color:#9CBF17; font-size:16px;">
                                    <div class="row">
                                        <div class="col-6">
                                            6 Persons
                                        </div>
                                        <div class="col-6 text-end">
                                            (€8)
                                        </div>
                                        <div class="col-6">
                                            Pizzas
                                        </div>
                                        <div class="col-6 text-end">
                                            (2x 10")
                                        </div>
                                        <div class="col-6">
                                            Fizzy Drinks
                                        </div>
                                        <div class="col-6 text-end">
                                            (2x 1.5-liter)
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12 px-2 mt-3">
                                <ul class="nav nav-pills row mb-2 booking-game-types" id="pills-tab" role="tablist">
                                    <li class="nav-item col-3" role="presentation">
                                        <button class="nav-link active w-100 fw-normal" id="pills-home-tab"
                                            data-bs-toggle="pill" type="button" role="tab"
                                            aria-controls="pills-home" aria-selected="true">10:00AM</button>
                                    </li>
                                    <li class="nav-item col-3" role="presentation">
                                        <button class="nav-link w-100 fw-normal" id="pills-profile-tab"
                                            data-bs-toggle="pill" type="button" role="tab"
                                            aria-controls="pills-profile" aria-selected="false">11:00AM</button>
                                    </li>
                                    <li class="nav-item col-3" role="presentation">
                                        <button class="nav-link w-100 fw-normal" id="pills-contact-tab"
                                            data-bs-toggle="pill" type="button" role="tab"
                                            aria-controls="pills-contact" aria-selected="false">12:00PM</button>
                                    </li>
                                    <li class="nav-item col-3" role="presentation">
                                        <button class="nav-link w-100 fw-normal" id="pills-da-tab"
                                            data-bs-toggle="pill" type="button" role="tab"
                                            aria-controls="pills-da" aria-selected="false">01:30PM</button>
                                    <li class="nav-item col-3" role="presentation">
                                        <button class="nav-link w-100 fw-normal" id="pills-Ae-tab"
                                            data-bs-toggle="pill" type="button" role="tab"
                                            aria-controls="pills-Ae" aria-selected="false">02:00PM</button>
                                    </li>
                                    <li class="nav-item col-3" role="presentation">
                                        <button class="nav-link w-100 fw-normal" id="pills-A-tab"
                                            data-bs-toggle="pill" type="button" role="tab"
                                            aria-controls="pills-A" aria-selected="false">05:00PM</button>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
                {{-- Games End --}}
                {{-- Packages Start --}}
                <div class="tab-pane fade" id="pills-profile" role="tabpanel" aria-labelledby="pills-profile-tab">
                    <h4 class="mx-2 mt-4 mb-3 main-title">Select Package</h4>
                    <div class="row mx-2 py-3 d-flex justify-content-center Pakages">
                        <div class="col-11 py-2 rounded text-light  d-flex align-items-center justify-content-between"
                            style="background:linear-gradient(to top, #1db4eb 0%, #9cbf17 80%) !important;">
                            <div>
                                <h6 class="mb-0">Package-1</h6>
                            </div>
                            <div class="d-flex align-items-center">
                                <p class="mb-0 px-1">Time Interval:</p>
                                <h6 class="mb-0">2 Hours</h6>
                            </div>
                        </div>
                        <div class="col-11 px-0 mt-3" style="font-size:16px;">
                            <div class="row">
                                <h5 class="fw-bold heading-title">Bowling Area</h5>
                                <div class="col-6 d-flex align-items-center">
                                    <label class="switch">
                                        <input type="checkbox">
                                        <span class="slider round"></span>
                                    </label>
                                    <span class="px-2">Bowling</span>
                                </div>
                                <div class="col-6 text-end">
                                    (1 Hour)
                                </div>
                                <div class="col-6 d-flex align-items-center">
                                    <label class="switch">
                                        <input type="checkbox">
                                        <span class="slider round"></span>
                                    </label>
                                    <span class="px-2">Laser</span>
                                </div>
                                <div class="col-6 text-end">
                                    (25 minutes)
                                </div>
                                <div class="col-6 d-flex align-items-center">
                                    <label class="switch">
                                        <input type="checkbox">
                                        <span class="slider round"></span>
                                    </label>
                                    <span class="px-2">Sports Simulator</span>
                                </div>
                                <div class="col-6 text-end">
                                    (25 minutes)
                                </div>
                            </div>
                            <div class="col-12 mt-1" style="color: #1DB4EB;">
                                <b>Food</b> Choice of hot food & drinks
                            </div>
                        </div>
                    </div>
                    <div class="row mx-2 py-3 my-3 d-flex justify-content-center Pakages">
                        <div class="col-11 py-2 rounded text-light  d-flex align-items-center justify-content-between"
                            style="background:linear-gradient(to top, #1db4eb 0%, #9cbf17 80%) !important;">
                            <div>
                                <h6 class="mb-0">Package-2</h6>
                            </div>
                            <div class="d-flex align-items-center">
                                <p class="mb-0 px-1">Time Interval:</p>
                                <h6 class="mb-0">2 Hours</h6>
                            </div>
                        </div>
                        <div class="col-11 px-0 mt-3" style="font-size:16px;">
                            <div class="row">
                                <h5 class="fw-bold heading-title">Bowling Area</h5>
                                <div class="col-6 d-flex align-items-center">
                                    <label class="switch">
                                        <input type="checkbox">
                                        <span class="slider round"></span>
                                    </label>
                                    <span class="px-2">Bowling</span>
                                </div>
                                <div class="col-6 text-end">
                                    (1 Hour)
                                </div>
                                <div class="col-6 d-flex align-items-center">
                                    <label class="switch">
                                        <input type="checkbox">
                                        <span class="slider round"></span>
                                    </label>
                                    <span class="px-2">Laser</span>
                                </div>
                                <div class="col-6 text-end">
                                    (25 minutes)
                                </div>
                                <div class="col-6 d-flex align-items-center">
                                    <label class="switch">
                                        <input type="checkbox">
                                        <span class="slider round"></span>
                                    </label>
                                    <span class="px-2">Sports Simulator</span>
                                </div>
                                <div class="col-6 text-end">
                                    (25 minutes)
                                </div>
                            </div>
                            <div class="col-12 mt-1" style="color: #1DB4EB;">
                                <b>Food</b> Choice of hot food & drinks
                            </div>
                        </div>
                    </div>
                    <div class="col-12 px-2 mt-3">
                        <h4 class="mt-4 mb-3 main-title">Select Time Slot</h4>
                        <ul class="nav nav-pills row mb-2 booking-game-types" id="pills-tab" role="tablist">
                            <li class="nav-item col-3" role="presentation">
                                <button class="nav-link active w-100 fw-normal" id="pills-home-tab"
                                    data-bs-toggle="pill" type="button" role="tab" aria-controls="pills-home"
                                    aria-selected="true">10:00AM</button>
                            </li>
                            <li class="nav-item col-3" role="presentation">
                                <button class="nav-link w-100 fw-normal" id="pills-profile-tab" data-bs-toggle="pill"
                                    type="button" role="tab" aria-controls="pills-profile"
                                    aria-selected="false" tabindex="-1">11:00AM</button>
                            </li>
                            <li class="nav-item col-3" role="presentation">
                                <button class="nav-link w-100 fw-normal" id="pills-contact-tab" data-bs-toggle="pill"
                                    type="button" role="tab" aria-controls="pills-contact"
                                    aria-selected="false" tabindex="-1">12:00PM</button>
                            </li>
                            <li class="nav-item col-3" role="presentation">
                                <button class="nav-link w-100 fw-normal" id="pills-da-tab" data-bs-toggle="pill"
                                    type="button" role="tab" aria-controls="pills-da" aria-selected="false"
                                    tabindex="-1">01:30PM</button>
                            </li>
                            <li class="nav-item col-3" role="presentation">
                                <button class="nav-link w-100 fw-normal" id="pills-Ae-tab" data-bs-toggle="pill"
                                    type="button" role="tab" aria-controls="pills-Ae" aria-selected="false"
                                    tabindex="-1">02:00PM</button>
                            </li>
                            <li class="nav-item col-3" role="presentation">
                                <button class="nav-link w-100 fw-normal" id="pills-A-tab" data-bs-toggle="pill"
                                    type="button" role="tab" aria-controls="pills-A" aria-selected="false"
                                    tabindex="-1">05:00PM</button>
                            </li>
                        </ul>
                    </div>
                </div>
                {{-- Packages End --}}
                {{-- Congo Quest Start --}}
                <div class="tab-pane fade" id="pills-contact" role="tabpanel" aria-labelledby="pills-contact-tab">
                    <h4 class="mx-2 mt-4 mb-3 main-title">Select Package</h4>
                    <div class="row mx-2 py-3 d-flex justify-content-center Pakages">
                        <div class="col-11 py-2 rounded text-light  d-flex align-items-center justify-content-between"
                            style="background:linear-gradient(to top, #1db4eb 0%, #9cbf17 80%) !important;">
                            <div>
                                <h6 class="mb-0">Congo Quest</h6>
                            </div>
                            <div class="d-flex align-items-center">
                                <p class="mb-0 px-1">Time Interval:</p>
                                <h6 class="mb-0">1.5 Hours</h6>
                            </div>
                        </div>
                        <div class="col-11 px-0 mt-3" style="font-size:16px;">
                            <div class="row">
                                <p class="fw-bold mb-2" style="color:#9CBF17;">Capacity: 110 Kids
                                </p>
                                <div class="col-8 d-flex align-items-center mb-2">
                                    <div class="input-group d-flex align-items-center">
                                        <span
                                            class="quantity-buttons px-1 border rounded-pill d-flex justify-content-center align-items-center"
                                            style="width: 80px; height:30px;">
                                            <button type="button" class="qt-minus"><i
                                                    class="fa-solid fa-minus"></i></button>
                                            <input type="text" max="10" value="3" name="no_of_guests"
                                                class="border border-0 text-center w-100 mx-2 bg-white"
                                                disabled="">
                                            <button type="button" class="qt-plus"><i
                                                    class="fa-solid fa-plus"></i></button>
                                        </span>
                                        <span class="font-weight-bold fs-6 mx-2">Midweek Per
                                            Child</span>
                                    </div>
                                </div>
                                <div class="col-4 mb-2 text-end">
                                    (€6)
                                </div>
                                <div class="col-8 d-flex align-items-center mb-2">
                                    <div class="input-group d-flex align-items-center">
                                        <span
                                            class="quantity-buttons px-1 border rounded-pill d-flex justify-content-center align-items-center"
                                            style="width: 80px; height:30px;">
                                            <button type="button" class="qt-minus"><i
                                                    class="fa-solid fa-minus"></i></button>
                                            <input type="text" max="10" value="3" name="no_of_guests"
                                                class="border border-0 text-center w-100 mx-2 bg-white"
                                                disabled="">
                                            <button type="button" class="qt-plus"><i
                                                    class="fa-solid fa-plus"></i></button>
                                        </span>
                                        <span class="font-weight-bold fs-6 mx-2">Weekend Per
                                            Child </span>
                                    </div>
                                </div>
                                <div class="col-4 text-end mb-2">
                                    (€8)
                                </div>
                            </div>
                            <div class="col-12 mt-2 Pakages p-3" style="background-color: #F9FAFBC7;">
                                <p class="mb-0" style="color: #1DB4EB">€5.50 For 3 Or More Children
                                </p>
                                <p style="color:#9CBF17;">Under 1 Year (Non-Walkers) Are Free </p>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 px-2 mt-3">
                        <h4 class="mt-4 mb-3 main-title">Select Time Slot</h4>
                        <ul class="nav nav-pills row mb-2 booking-game-types" id="pills-tab" role="tablist">
                            <li class="nav-item col-3" role="presentation">
                                <button class="nav-link active w-100 fw-normal" id="pills-home-tab"
                                    data-bs-toggle="pill" type="button" role="tab" aria-controls="pills-home"
                                    aria-selected="true">10:00AM</button>
                            </li>
                            <li class="nav-item col-3" role="presentation">
                                <button class="nav-link w-100 fw-normal" id="pills-profile-tab" data-bs-toggle="pill"
                                    type="button" role="tab" aria-controls="pills-profile"
                                    aria-selected="false" tabindex="-1">11:00AM</button>
                            </li>
                            <li class="nav-item col-3" role="presentation">
                                <button class="nav-link w-100 fw-normal" id="pills-contact-tab" data-bs-toggle="pill"
                                    type="button" role="tab" aria-controls="pills-contact"
                                    aria-selected="false" tabindex="-1">12:00PM</button>
                            </li>
                            <li class="nav-item col-3" role="presentation">
                                <button class="nav-link w-100 fw-normal" id="pills-da-tab" data-bs-toggle="pill"
                                    type="button" role="tab" aria-controls="pills-da" aria-selected="false"
                                    tabindex="-1">01:30PM</button>
                            </li>
                            <li class="nav-item col-3" role="presentation">
                                <button class="nav-link w-100 fw-normal" id="pills-Ae-tab" data-bs-toggle="pill"
                                    type="button" role="tab" aria-controls="pills-Ae" aria-selected="false"
                                    tabindex="-1">02:00PM</button>
                            </li>
                            <li class="nav-item col-3" role="presentation">
                                <button class="nav-link w-100 fw-normal" id="pills-A-tab" data-bs-toggle="pill"
                                    type="button" role="tab" aria-controls="pills-A" aria-selected="false"
                                    tabindex="-1">05:00PM</button>
                            </li>
                        </ul>
                    </div>
                </div>
                {{-- Congo Quest End --}}
                {{-- Parties Start --}}
                <div class="tab-pane fade" id="pills-da" role="tabpanel" aria-labelledby="pills-da-tab">
                    <h4 class="mx-2 mt-4 mb-3 main-title">Select Party</h4>
                    <div class="row mx-2 py-3 d-flex justify-content-center Pakages">
                        <div class="col-11 py-2 rounded text-light  d-flex align-items-center justify-content-between"
                            style="background:linear-gradient(to top, #1db4eb 0%, #9cbf17 80%) !important;">
                            <div>
                                <h6 class="mb-0">Party Package-1</h6>
                            </div>
                            <div class="d-flex align-items-center">
                                <p class="mb-0 px-1">Time Interval:</p>
                                <h6 class="mb-0">1.5 Hours</h6>
                            </div>
                        </div>
                        <div class="col-11 px-0 mt-3" style="font-size:16px;">
                            <div class="row">
                                <p class="fw-bold mb-2" style="color:#9CBF17;">Congo Quest Fun Party
                                    Package</p>
                                <div class="col-8 d-flex align-items-center mb-2">
                                    <div class="input-group d-flex align-items-center">
                                        <span
                                            class="quantity-buttons px-1 border rounded-pill d-flex justify-content-center align-items-center"
                                            style="width: 80px; height:30px;">
                                            <button type="button" class="qt-minus"><i
                                                    class="fa-solid fa-minus"></i></button>
                                            <input type="text" max="10" value="3" name="no_of_guests"
                                                class="border border-0 text-center w-100 mx-2 bg-white"
                                                disabled="">
                                            <button type="button" class="qt-plus"><i
                                                    class="fa-solid fa-plus"></i></button>
                                        </span>
                                        <span class="font-weight-bold fs-6 mx-2">Party Package per
                                            child</span>
                                    </div>
                                </div>
                                <div class="col-4 mb-2 text-end">
                                    (€15)
                                </div>
                            </div>
                            <div class="col-12 mt-2 Pakages p-3" style="background-color: #F9FAFBC7;">
                                <p class="mb-1" style="color: #1DB4EB">Hot food (nuggets, sausages,
                                    fish finger with chips juice)  or more children
                                </p>
                                <p class="mb-1" style="color:#9CBF17;">Private Themed Party Room</p>
                                <p class="mb-1" style="color: #1DB4EB">Party bag</p>
                            </div>
                        </div>
                    </div>
                    <div class="row mx-2 py-3 mt-3 d-flex justify-content-center Pakages">
                        <div class="col-11 py-2 rounded text-light  d-flex align-items-center justify-content-between"
                            style="background:linear-gradient(to top, #1db4eb 0%, #9cbf17 80%) !important;">
                            <div>
                                <h6 class="mb-0">Party Package-2</h6>
                            </div>
                            <div class="d-flex align-items-center">
                                <p class="mb-0 px-1">Time Interval:</p>
                                <h6 class="mb-0">1.5 Hours</h6>
                            </div>
                        </div>
                        <div class="col-11 px-0 mt-3" style="font-size:16px;">
                            <div class="row">
                                <p class="fw-bold mb-2" style="color:#9CBF17;">Congo Quest Fun Party
                                    Package</p>
                                <div class="col-8 d-flex align-items-center mb-2">
                                    <div class="input-group d-flex align-items-center">
                                        <span
                                            class="quantity-buttons px-1 border rounded-pill d-flex justify-content-center align-items-center"
                                            style="width: 80px; height:30px;">
                                            <button type="button" class="qt-minus"><i
                                                    class="fa-solid fa-minus"></i></button>
                                            <input type="text" max="10" value="3" name="no_of_guests"
                                                class="border border-0 text-center w-100 mx-2 bg-white"
                                                disabled="">
                                            <button type="button" class="qt-plus"><i
                                                    class="fa-solid fa-plus"></i></button>
                                        </span>
                                        <span class="font-weight-bold fs-6 mx-2">Party Package per
                                            child</span>
                                    </div>
                                </div>
                                <div class="col-4 mb-2 text-end">
                                    (€18)
                                </div>
                            </div>
                            <div class="col-12 mt-2 Pakages p-3" style="background-color: #F9FAFBC7;">
                                <p class="mb-1" style="color: #1DB4EB">Hot food (nuggets, sausages,
                                    fish finger with chips juice)  or more children
                                </p>
                                <p class="mb-1" style="color:#9CBF17;">Private Themed Party Room</p>
                                <p class="mb-1" style="color: #1DB4EB">Party bag</p>
                                <p class="mb-1" style="color:#9CBF17;">Air filled number balloon
                                    stack, a flask of tea/coffee and a visit from the mascot. </p>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 px-2 mt-3">
                        <h4 class="mt-4 mb-3 main-title">Select Time Slot</h4>
                        <ul class="nav nav-pills row mb-2 booking-game-types" id="pills-tab" role="tablist">
                            <li class="nav-item col-3" role="presentation">
                                <button class="nav-link active w-100 fw-normal" id="pills-home-tab"
                                    data-bs-toggle="pill" type="button" role="tab" aria-controls="pills-home"
                                    aria-selected="true">10:00AM</button>
                            </li>
                            <li class="nav-item col-3" role="presentation">
                                <button class="nav-link w-100 fw-normal" id="pills-profile-tab" data-bs-toggle="pill"
                                    type="button" role="tab" aria-controls="pills-profile"
                                    aria-selected="false" tabindex="-1">11:00AM</button>
                            </li>
                            <li class="nav-item col-3" role="presentation">
                                <button class="nav-link w-100 fw-normal" id="pills-contact-tab" data-bs-toggle="pill"
                                    type="button" role="tab" aria-controls="pills-contact"
                                    aria-selected="false" tabindex="-1">12:00PM</button>
                            </li>
                            <li class="nav-item col-3" role="presentation">
                                <button class="nav-link w-100 fw-normal" id="pills-da-tab" data-bs-toggle="pill"
                                    type="button" role="tab" aria-controls="pills-da" aria-selected="false"
                                    tabindex="-1">01:30PM</button>
                            </li>
                            <li class="nav-item col-3" role="presentation">
                                <button class="nav-link w-100 fw-normal" id="pills-Ae-tab" data-bs-toggle="pill"
                                    type="button" role="tab" aria-controls="pills-Ae" aria-selected="false"
                                    tabindex="-1">02:00PM</button>
                            </li>
                            <li class="nav-item col-3" role="presentation">
                                <button class="nav-link w-100 fw-normal" id="pills-A-tab" data-bs-toggle="pill"
                                    type="button" role="tab" aria-controls="pills-A" aria-selected="false"
                                    tabindex="-1">05:00PM</button>
                            </li>
                        </ul>
                    </div>

                </div>
                {{-- Parties End --}}
            </div>
        </div>
    </div>
