@extends('layouts/layoutMaster')

@section('title', 'Treeview - Extended UI')

<!-- Vendor Styles -->
@section('vendor-style')
@vite('resources/assets/vendor/libs/jstree/jstree.scss')
@endsection

<!-- Vendor Scripts -->
@section('vendor-script')
@vite('resources/assets/vendor/libs/jstree/jstree.js')
@endsection

<!-- Page Scripts -->
@section('page-script')
@vite('resources/assets/js/extended-ui-treeview.js')
@endsection

@section('content')

<!-- JSTree -->
<div class="row">
  <!-- Basic -->
  <div class="col-md-6 col-12">
    <div class="card mb-6">
      <h5 class="card-header">Basic</h5>
      <div class="card-body">
        <div id="jstree-basic">
          <ul id="jstree">
            <li data-jstree='{}'>css
              <ul>
                <li data-jstree='{}'>app.css</li>
                <li data-jstree='{}'>style.css</li>
              </ul>
            </li>
            <li data-jstree='{}'>img
              <ul>
                <li data-jstree='{}'>bg.jpg</li>
                <li data-jstree='{}'>logo.png</li>
                <li data-jstree='{}'>avatar.png</li>
              </ul>
            </li>
            <li data-jstree-1='{}'>js
              <ul>
                <li data-jstree-1='{}'>jquery.js</li>
                <li data-jstree-1='{}'>app.js</li>
              </ul>
            </li>
          </ul>

        </div>
      </div>
    </div>
  </div>
  <!-- /Basic -->
  <!-- Custom Icons -->
  <div class="col-md-6 col-12">
    <div class="card mb-6">
      <h5 class="card-header">Custom Icons</h5>
      <div class="card-body">
        <div id="jstree-custom-icons"></div>
      </div>
    </div>
  </div>
  <!-- /Custom Icons -->
</div>

<div class="row">
  <!-- Context Menu -->
  <div class="col-md-6 col-12">
    <div class="card mb-6">
      <h5 class="card-header">Context Menu</h5>
      <div class="card-body">
        <div id="jstree-context-menu" class="overflow-auto"></div>
      </div>
    </div>
  </div>
  <!-- /Context Menu -->
  <!-- Drag & Drop -->
  <div class="col-md-6 col-12">
    <div class="card mb-6">
      <h5 class="card-header">Drag & Drop</h5>
      <div class="card-body">
        <div id="jstree-drag-drop" class="overflow-auto"></div>
      </div>
    </div>
  </div>
  <!-- /Drag & Drop -->
</div>

<div class="row">
  <!-- Checkbox -->
  <div class="col-md-6 col-12">
    <div class="card mb-md-0 mb-6">
      <h5 class="card-header">Checkboxes</h5>
      <div class="card-body">
        <div id="jstree-checkbox"></div>
      </div>
    </div>
  </div>
  <!-- /Checkbox -->
  <!-- Ajax -->
  <div class="col-md-6 col-12">
    <div class="card">
      <h5 class="card-header">Ajax</h5>
      <div class="card-body">
        <div id="jstree-ajax"></div>
      </div>
    </div>
  </div>
  <!-- Ajax -->
</div>
<!-- /JSTree -->
@endsection