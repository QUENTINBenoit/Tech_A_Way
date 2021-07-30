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
            // pictureProduct.setAttribute("width", "200px");

            // je lui met dedans l'image
            divPicturePrice.append(pictureProduct);
            productEl.append(divPicturePrice);

            const allDivEmpty = document.querySelectorAll('.picture_price_product');
            for (const divEmpty of allDivEmpty) {
                
                if (divEmpty.childElementCount == 0) {
                    divEmpty.remove();
                }
            }

        }
    } else if (window.matchMedia("(min-width: 577px)").matches) {
    const picturesProduct = document.querySelectorAll('.picture_product');
    for (const pictureProduct of picturesProduct) {
        productEl = pictureProduct.closest(".product");
        productEl.prepend(pictureProduct);

        const allDivEmpty = document.querySelectorAll('.picture_price_product');
        for (const divEmpty of allDivEmpty) {
            
            if (divEmpty.childElementCount == 0) {
                divEmpty.remove();
            }
        }

    }
}
/*********************end SHOPPING CART*************************/

/*********************start ACCOUNT PAGE*************************/

if (window.matchMedia("(max-width: 991px)").matches) {
    const mainEl = document.querySelector('#account-page-main');
    mainEl.classList.remove('row');
    console.log('coucou');

    const userInsertEl = document.querySelector('#compte_user_insert');
    userInsertEl.classList.remove('d-flex');
    userInsertEl.classList.add('row');
   

   

} else if (window.matchMedia("(min-width: 992px)").matches) {
    console.log('Hello');
    const mainEl = document.querySelector('#account-page-main');
    mainEl.classList.add('row');

    const userInsertEl = document.querySelector('#compte_user_insert');
    userInsertEl.classList.remove('d-flex');
    userInsertEl.classList.remove('row');
   

}









/*********************end ACCOUNT PAGE*************************/



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