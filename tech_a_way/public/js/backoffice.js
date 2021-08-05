/* global bootstrap: false */
(function () {
  'use strict'
  var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'))
  tooltipTriggerList.forEach(function (tooltipTriggerEl) {
    new bootstrap.Tooltip(tooltipTriggerEl)
  })

  const confirmRequestedElementBrands = document.querySelectorAll('.confirmRequestedBrand');
  for(const element of confirmRequestedElementBrands) {
    element.addEventListener('click', function(e) {
      if (!window.confirm("Êtes-vous vraiment sûr de vouloir supprimer cette marque ? ATTENTION !!! Cela supprimera automatiquement tous les produits liés à cette marque")) {
        e.preventDefault();
      }
    });
  }
  const confirmRequestedElementCategories = document.querySelectorAll('.confirmRequestedCategory');
  for(const element of confirmRequestedElementCategories) {
    element.addEventListener('click', function(e) {
      if (!window.confirm("Êtes-vous vraiment sûr de vouloir supprimer cette catégorie ? ATTENTION !!! Cela supprimera EN CASCADE toutes les sous-catégories qui était dedans (de plus, Les produits liés à cette catégorie seront désormais sans catégorie)")) {
        e.preventDefault();
      }
    });
  }
  const confirmRequestedElementProducts = document.querySelectorAll('.confirmRequestedProduct');
  for(const element of confirmRequestedElementProducts) {
    element.addEventListener('click', function(e) {
      if (!window.confirm("Êtes-vous vraiment sûr de vouloir supprimer cette produit ?")) {
        e.preventDefault();
      }
    });
  }
})()
