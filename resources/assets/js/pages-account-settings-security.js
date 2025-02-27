/**
 * Account Settings - Security
 */

'use strict';

$.ajaxSetup({
  headers: {
    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
  }
});

document.addEventListener('DOMContentLoaded', function (e) {
  (function () {
    const formChangePass = document.querySelector('#formAccountSettings'),
      formApiKey = document.querySelector('#formAccountSettingsApiKey');

    // Form validation for Change password
    if (formChangePass) {
      const fv = FormValidation.formValidation(formChangePass, {
        fields: {
          currentPassword: {
            validators: {
              notEmpty: {
                message: 'Please current password'
              },
              stringLength: {
                min: 8,
                message: 'Password must be more than 8 characters'
              }
            }
          },
          password: {
            validators: {
              notEmpty: {
                message: 'Please enter a new password'
              },
              stringLength: {
                min: 8,
                message: 'Password must be at least 8 characters long'
              },
              regexp: {
                regexp: /^(?=.*[a-z])(?=.*[\d\W\s]).+$/,
                message: 'Password must contain at least one lowercase letter and at least one number, symbol, or whitespace'
              }
            }
        },
        confirmPassword: {
          validators: {
            notEmpty: {
              message: 'Please confirm new password'
            },
            identical: {
              compare: function () {
                return formChangePass.querySelector('[name="password"]').value;
              },
              message: 'The password and its confirm are not the same'
            },
            stringLength: {
              min: 8,
              message: 'Password must be more than 8 characters'
            }
          }
        }
      },
        plugins: {
        trigger: new FormValidation.plugins.Trigger(),
        bootstrap5: new FormValidation.plugins.Bootstrap5({
          eleValidClass: '',
          rowSelector: '.col-md-6'
        }),
        submitButton: new FormValidation.plugins.SubmitButton(),
        autoFocus: new FormValidation.plugins.AutoFocus()
      },
        init: instance => {
          instance.on('plugins.message.placed', function (e) {
            if (e.element.parentElement.classList.contains('input-group')) {
              e.element.parentElement.insertAdjacentElement('afterend', e.messageElement);
            }
          });
        }
      }).on('core.form.valid', function () {
          $.ajax({
            data: $(formChangePass).serialize(),
            url: `${baseUrl}update-password`,
            type: 'POST',
            success: function (status) {

              Swal.fire({
                icon: 'success',
                title: `Successfully ${status}!`,
                text: `Password ${status} Successfully.`,
                customClass: {
                  confirmButton: 'btn btn-success'
                }
              });
            },
            error: function (err) {
              if (err.status === 422 && err.responseJSON && err.responseJSON.message) {
                Swal.fire({
                  title: 'Error!',
                  text: err.responseJSON.message,  // Display the error message from the response
                  icon: 'error',
                  customClass: {
                    confirmButton: 'btn btn-danger'
                  }
                });
              } else {
                // Fallback for other errors like duplicate email
                Swal.fire({
                  title: 'Not Updated!',
                  text: 'Password Not Updated.',
                  icon: 'error',
                  customClass: {
                    confirmButton: 'btn btn-success'
                  }
                });
              }
            }
          });
        });
}

    // Form validation for API key
    if (formApiKey) {
  const fvApi = FormValidation.formValidation(formApiKey, {
    fields: {
      apiKey: {
        validators: {
          notEmpty: {
            message: 'Please enter API key name'
          }
        }
      }
    },
    plugins: {
      trigger: new FormValidation.plugins.Trigger(),
      bootstrap5: new FormValidation.plugins.Bootstrap5({
        eleValidClass: ''
      }),
      submitButton: new FormValidation.plugins.SubmitButton(),
      // Submit the form when all fields are valid
      // defaultSubmit: new FormValidation.plugins.DefaultSubmit(),
      autoFocus: new FormValidation.plugins.AutoFocus()
    },
    init: instance => {
      instance.on('plugins.message.placed', function (e) {
        if (e.element.parentElement.classList.contains('input-group')) {
          e.element.parentElement.insertAdjacentElement('afterend', e.messageElement);
        }
      });
    }
  });
}
  }) ();
});

// Select2 (jquery)
$(function () {
  var select2 = $('.select2');

  // Select2 API Key
  if (select2.length) {
    select2.each(function () {
      var $this = $(this);
      $this.wrap('<div class="position-relative"></div>');
      $this.select2({
        dropdownParent: $this.parent()
      });
    });
  }
});
