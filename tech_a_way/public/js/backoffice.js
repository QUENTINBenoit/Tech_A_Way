/* global bootstrap: false */
(function () {
  'use strict'
  var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'))
  tooltipTriggerList.forEach(function (tooltipTriggerEl) {
    new bootstrap.Tooltip(tooltipTriggerEl)
  })

  const confirmRequestedElement = document.querySelectorAll('.confirmRequested');
  
  for(const element of confirmRequestedElement) {
    element.addEventListener('click', function(e) {
      if (!window.confirm("Êtes vous sur de vouloir supprimer cet élément ? ")) {
        e.preventDefault();
      }
    });
  }

})()
