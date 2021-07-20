// TO USE THE MATCHMEDIA METHOD OR MEDIA QUERIES FOR JS


   function resize() {
       


    if (window.matchMedia("(max-width: 576px)").matches) {

        const picturesProduct = document.querySelectorAll('.picture_product');
        for (const pictureProduct of picturesProduct) {
            pictureProduct.classList.add("d-none");
        }




    } else if (window.matchMedia("(max-width: 767px)").matches) {
        /* La largeur minimum de l'affichage est 768 px inclus */
      
/*********************start PARTIAL_BRANDS*************************/
        const divBrands = document.querySelectorAll('.partial_brands');
      for (const divBrand of divBrands) {
        divBrand.classList.remove("d-flex");
        divBrand.classList.add("d-none");
      }
/*********************end PARTIAL_BRANDS*************************/



      } else if (window.matchMedia("(min-width: 768px)").matches) {
        /* L'affichage est inférieur à 767px de large */




/*********************start PARTIAL_BRANDS*************************/

        const divBrands = document.querySelectorAll('.partial_brands');
      for (const divBrand of divBrands) {
        divBrand.classList.remove("d-flex");
        divBrand.classList.add("d-none");
      }
        let carouselInitial = document.querySelector('#partial_brands_1');
            carouselInitial.classList.remove("d-none");
            carouselInitial.classList.add("d-flex");
/*********************end PARTIAL_BRANDS*************************/
            
        }
    }


window.addEventListener('resize', resize, false);