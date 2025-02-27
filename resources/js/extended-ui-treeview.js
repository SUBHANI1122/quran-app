/**
 * Treeview (jquery)
 */

'use strict';
$(function () {
  const select2 = $('.select2');

  $(document).ready(function () {
    $('tr[class^="level-"]').not('.level-0').hide();

    $('tr.parent-row').on('click', function () {
      var parentId = $(this).data('id');
      var level = $(this).attr('class').match(/level-(\d+)/)[1];
      var nextLevel = parseInt(level) + 1;
      $('tr.level-' + nextLevel + '[data-parent-id="' + parentId + '"]').toggle();
    });
  });


  if (select2.length) {
    select2.each(function () {
      var $this = $(this);
      $this.wrap('<div class="position-relative"></div>').select2({
        placeholder: 'Select value',
        dropdownParent: $this.parent()
      });
    });
  }
});
$(function () {
  var theme = $('html').hasClass('light-style') ? 'default' : 'default-dark',
    basicTree = $('#jstree-basic'),
    customIconsTree = $('#jstree-custom-icons'),
    contextMenu = $('#jstree-context-menu'),
    dragDrop = $('#jstree-drag-drop'),
    checkboxTree = $('#jstree-checkbox'),
    ajaxTree = $('#jstree-ajax');

  // Basic
  // --------------------------------------------------------------------

  if (basicTree.length) {
    basicTree.jstree({
      core: {
        themes: {
          name: theme
        }
      }
    });
  }
});
var offCanvasForm = $('#offCanvasForm');

var dt_classifications_table = $('.datatables-classifications').DataTable({
  processing: true,
  paging: false,
  searching: true,
  ordering: false,
  info: false,
  columns: [
    // { data: null, title: 'Serial No' },
    { data: 'name', title: 'Name' },
    { data: 'code', title: 'Code' },
    { data: 'status', title: 'Status' },
    { data: 'action', title: 'Actions' }

  ],
});


$.ajaxSetup({
  headers: {
    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
  }
});



$(document).on('click', '.add-new', function () {
  $('#addAccountClasssificationForm')[0].reset();
  $('.select2').val(null).trigger('change');

  $('#account_classification_id').val('');

  $('#offcanvasAddUserLabel').html('Add Classification');

  $('#addAccountClassification').modal('show');
});

$('#addAccountClassification').on('hidden.bs.modal', function () {
  $('#addAccountClasssificationForm')[0].reset();
  $('.select2').val(null).trigger('change');

  $('#account_classification_id').val('');
});

$(document).on('click', '.edit-record', function () {
  var user_id = $(this).data('id');

  $('#addAccountClasssificationForm')[0].reset();
  $('.select2').val(null).trigger('change');

  $('#offcanvasAddUserLabel').html('Edit Classification');

  $.get(`${baseUrl}account-classification/${user_id}/edit`, function (data) {
    $('#account_classification_id').val(data.id);
    $('#parent_id').val(data.parent_id).trigger('change');
    $('#status').val(data.status).trigger('change');
    $('#name').val(data.name);
    $('#name').focus();
  });
  $('#addAccountClassification').modal('show');
});


FormValidation.formValidation(document.getElementById('addAccountClasssificationForm'), {
  fields: {
    status: { validators: { notEmpty: { message: 'Please select status' } } },
    name: {
      validators: {
        notEmpty: { message: 'Please enter name' },
      }
    }
  },
  plugins: {
    trigger: new FormValidation.plugins.Trigger(),
    bootstrap5: new FormValidation.plugins.Bootstrap5({
      eleValidClass: '',
      rowSelector: '.col-12'
    }),
    submitButton: new FormValidation.plugins.SubmitButton(),
    autoFocus: new FormValidation.plugins.AutoFocus()
  }
}).on('core.form.valid', function () {
  $.ajax({
    data: $('#addAccountClasssificationForm').serialize(),
    url: `${baseUrl}account-classification`,
    type: 'POST',
    success: function (status) {

      $('#addAccountClasssificationForm')[0].reset();

      $('.select2').val(null).trigger('change');

      $('#addAccountClassification').modal('hide');

      Swal.fire({
        icon: 'success',
        title: `Successfully ${status}!`,
        text: `Classificaition ${status} Successfully.`,
        customClass: { confirmButton: 'btn btn-success' }
      });
      window.location.reload(true);
      // dt_classifications_table.ajax.reload();
    },
    error: function (xhr) {
      // Handle error response
      const errorMessage = xhr.responseJSON?.error || 'An unexpected error occurred.';
      Swal.fire({
        title: 'Error',
        text: errorMessage,
        icon: 'error',
        customClass: { confirmButton: 'btn btn-success' }
      });
    }
  });
});
