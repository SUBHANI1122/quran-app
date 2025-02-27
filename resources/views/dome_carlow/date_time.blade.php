@extends('dome_carlow.layouts.main')
@section('content')

<div id="wrapper">
  @include('dome_carlow.layouts.header')
  <div class="content container">
      <form class="from" action="{{ route('dome-carlow.personal_info') }}" method="GET" id="select_date_time">
      <div class="row gx-xxl-5 row-booking justify-content-end">
          <div class="col-lg-6">
               <div class="booking-header">
                          <div class="inner">
                              <div class="row align-items-center">
                                  <div class="col-auto">
                                      <a href="{{ route('dome-carlow.index') }}" class="back open-modal">Back</a>
                                  </div>
                                  <div class="col">
                                      <div class="step-label">Step 1 of 3</div>
                                      <h1 class="title h2">Select Date</h1>
                                  </div>
                              </div>
                          </div>
                      </div>
              <div class="card shadow rounded-bottom rounded-5">
                  <div class="card-body py-5">
                      <div id="datepicker" class="calendar"></div>
                      <div class="row mt-rem-35 booking-calendar text-center">
                                  <div class="col">
                                      <div class="calendar-legend">
                                          <div class="color">
                                              <div class="dot park-closed"></div>
                                          </div>
                                          <div class="legend"> Closed</div>
                                      </div>
                                  </div>
                                  <div class="col">
                                      <div class="calendar-legend">
                                          <div class="color">
                                              <div class="dot sold-out"></div>
                                          </div>
                                          <div class="legend">Sold Out</div>
                                      </div>
                                  </div>
                                  <div class="col">
                                      <div class="calendar-legend">
                                          <div class="color">
                                              <div class="dot selected"></div>
                                          </div>
                                          <div class="legend">Selected</div>
                                      </div>
                                  </div>
                              </div>
                  </div>
              </div>
          </div>
          <div class="col-lg-3 col-booking-side">

           <div class="ticket-summary sticky px-4">
                            <h4 class="h4 mb-rem-25">Ticket Summary</h4>
                            <div id="cartItems">
                               <table class="tbl-booking">
                                  <tr>
                                     <td>
                                        <div class="date-label">Date</div>
                                        <div class="date-selected" id="displayedDateInCart">25-05-2022</div>
                                     </td>
                                     <td valign="bottom">
                                        <div class="total-tickets">
                                           1 <i class="bi bi-person"></i>
                                        </div>
                                     </td>
                                  </tr>
                                  <tr>
                                     <td>
                                        <div class="date-label fw-bold">Bowling</div>
                                     </td>
                                     <td valign="bottom">
                                        <div class="total-tickets">
                                           1
                                        </div>
                                     </td>
                                  </tr>

                               </table>
                            </div>
                            <div class="mt-rem-20">
                               <div class="row gx-3">
                                  <div class="col">
                                     <button type="button" class="btn_continue cta text-white cta-100">Continue</button>
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

  <script src="{{ asset('assets/lib/jquery/jquery.min.js')}}"></script>
    <script src="{{ asset('assets/lib/jquery-validation/dist/jquery.validate.js') }}"></script>
    <script src="{{ asset('assets/lib/jquery-validation-unobtrusive/jquery.validate.unobtrusive.js') }}"></script>
    <script src="{{ asset('assets/js/plugins.js') }}"></script>
    <script type="text/javascript" src="{{ asset('assets/js/tickets-helper.js') }}"></script>
    <script type="text/javascript" src="{{ asset('assets/js/select-tickets.js') }}"></script>
    <script type="text/javascript" src="{{ asset('assets/js/timer.js') }}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
<script src="https://code.jquery.com/ui/1.10.3/jquery-ui.js"></script>

<script>
       $(document).ready(function () {
           $(document).on('click', '.btn_continue', function () {
               $("#select_date_time").submit();
           });

       });
       </script>
<script>
  $(function() {
$( "#datepicker" ).datepicker({ firstDay: 1});
});
</script>
@endsection
