// For disabling form submissions if there are invalid fields basta for validation chuchu ng lahat ng forms
(function() {
    'use strict';
    window.addEventListener('load', function() {
      // Fetch all the forms to apply custom validation styles to
      var forms = document.getElementsByClassName('needs-validation');
      // Loop over them and prevent submission
      var validation = Array.prototype.filter.call(forms, function(form) {
        form.addEventListener('submit', function(event) {
          if (form.checkValidity() === false) {
            event.preventDefault();
            event.stopPropagation();
          }
          form.classList.add('was-validated');
        }, false);
      });
    }, false);
  })();