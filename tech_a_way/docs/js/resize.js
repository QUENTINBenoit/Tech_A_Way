// TO USE THE MATCHMEDIA METHOD OR MEDIA QUERIES FOR JS


   function resize() {
       

    /*********************start SHOPPING CART*************************/
    if (window.matchMedia("(max-width: 576px)").matches) {

        const picturesProduct = document.querySelectorAll('.picture_product');
        for (const pictureProduct of picturesProduct) {
            productEl = pictureProduct.closest(".product");
            // productEl.append(pictureProduct);
           
            // je crée une div
            let divPicturePrice = document.createElement("div");
            // je lui ajoute les classes "d-flex justify-content-between picture_price_product"
            divPicturePrice.classList.add('d-flex', 'justify-content-between', 'picture_price_product');
            // je lui met dedans l'image
            divPicturePrice.append(pictureProduct);
            productEl.append(divPicturePrice);
        }
    }

 else if (window.matchMedia("(min-width: 577px)").matches) {
    const picturesProduct = document.querySelectorAll('.picture_product');
    for (const pictureProduct of picturesProduct) {
        productEl = pictureProduct.closest(".product");
        productEl.prepend(pictureProduct);

        const allDivEmpty = document.querySelectorAll('picture_price_product');
        for (const divEmpty of allDivEmpty) {
            divEmpty.remove();
        }

    }
}
    /*********************end SHOPPING CART*************************/


    /*********************start PARTIAL_BRANDS*************************/
    if (window.matchMedia("(max-width: 767px)").matches) {
        /* La largeur minimum de l'affichage est 768 px inclus */
        const divBrands = document.querySelectorAll('.partial_brands');
      for (const divBrand of divBrands) {
        divBrand.classList.remove("d-flex");
        divBrand.classList.add("d-none");
      }
      } else if (window.matchMedia("(min-width: 768px)").matches) {
        /* L'affichage est inférieur à 767px de large */

        const divBrands = document.querySelectorAll('.partial_brands');
      for (const divBrand of divBrands) {
        divBrand.classList.remove("d-flex");
        divBrand.classList.add("d-none");
      }
        let carouselInitial = document.querySelector('#partial_brands_1');
            carouselInitial.classList.remove("d-none");
            carouselInitial.classList.add("d-flex");
        }
/*********************end PARTIAL_BRANDS*************************/
    }


window.addEventListener('resize', resize, false);