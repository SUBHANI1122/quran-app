'use strict';

(function () {
  const wizardValidation = document.querySelector('#wizard-validation');
  if (wizardValidation !== null) {
    const wizardValidationForm = wizardValidation.querySelector('#wizard-validation-form');
    const wizardStep1 = wizardValidationForm.querySelector('#topic-step');
    const wizardStep2 = wizardValidationForm.querySelector('#ayah-step');
    const wizardStep3 = wizardValidationForm.querySelector('#hadith-step');

    const wizardNextButtons = [].slice.call(wizardValidationForm.querySelectorAll('.btn-next'));
    const wizardPrevButtons = [].slice.call(wizardValidationForm.querySelectorAll('.btn-prev'));

    const validationStepper = new Stepper(wizardValidation, {
      linear: true
    });

    // Step 1: Topic Validation
    const FormValidation1 = FormValidation.formValidation(wizardStep1, {
      fields: {
        topic_name: {
          validators: {
            notEmpty: {
              message: 'The topic name is required'
            },
            stringLength: {
              min: 3,
              max: 100,
              message: 'The topic name must be between 3 and 100 characters'
            }
          }
        },
        topic_description: {
          validators: {
            notEmpty: {
              message: 'The topic description is required'
            }
          }
        }
      },
      plugins: {
        trigger: new FormValidation.plugins.Trigger(),
        bootstrap5: new FormValidation.plugins.Bootstrap5({
          rowSelector: '.form-control'
        }),
        autoFocus: new FormValidation.plugins.AutoFocus(),
        submitButton: new FormValidation.plugins.SubmitButton()
      }
    }).on('core.form.valid', function () {
      validationStepper.next();
    });

    // Step 2: Ayah Validation
    const FormValidation2 = FormValidation.formValidation(wizardStep2, {
      fields: {
        selectedSurah: {
          validators: {
            notEmpty: {
              message: 'Please select a Surah'
            }
          }
        },
        selectedAyah: {
          validators: {
            notEmpty: {
              message: 'Please select an Ayah'
            }
          }
        },
        ayahDescription: {
          validators: {
            notEmpty: {
              message: 'Ayah description is required'
            }
          }
        }
      },
      plugins: {
        trigger: new FormValidation.plugins.Trigger(),
        bootstrap5: new FormValidation.plugins.Bootstrap5({
          rowSelector: '.form-control'
        }),
        autoFocus: new FormValidation.plugins.AutoFocus(),
        submitButton: new FormValidation.plugins.SubmitButton()
      }
    }).on('core.form.valid', function () {
      validationStepper.next();
    });

    // Step 3: Hadith Validation
    const FormValidation3 = FormValidation.formValidation(wizardStep3, {
      fields: {
        hadithText: {
          validators: {
            notEmpty: {
              message: 'The Hadith text is required'
            }
          }
        },
        hadithDescription: {
          validators: {
            notEmpty: {
              message: 'Hadith description is required'
            }
          }
        }
      },
      plugins: {
        trigger: new FormValidation.plugins.Trigger(),
        bootstrap5: new FormValidation.plugins.Bootstrap5({
          rowSelector: '.form-control'
        }),
        autoFocus: new FormValidation.plugins.AutoFocus(),
        submitButton: new FormValidation.plugins.SubmitButton()
      }
    }).on('core.form.valid', function () {
      alert('Form submitted successfully!');
    });

    // Handle Next Button Clicks
    wizardNextButtons.forEach(item => {
      item.addEventListener('click', event => {
        switch (validationStepper._currentIndex) {
          case 0:
            FormValidation1.validate();
            break;
          case 1:
            FormValidation2.validate();
            break;
          case 2:
            FormValidation3.validate();
            break;
        }
      });
    });

    // Handle Previous Button Clicks
    wizardPrevButtons.forEach(item => {
      item.addEventListener('click', event => {
        validationStepper.previous();
      });
    });
  }
})();
