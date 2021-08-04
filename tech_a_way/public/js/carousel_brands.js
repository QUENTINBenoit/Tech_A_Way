// Le module app est un objet JavaScript
// avec des propriétés et des méthodes
let app = {

    init: function() {

      if(window.innerWidth >= 768) {

        const firstCarousel = document.querySelector('#partial_brands_0');
        // console.log(firstCarousel.dataset.begin);
        if (firstCarousel.dataset.begin == 0) 
        firstCarousel.classList.remove("d-none");
        firstCarousel.classList.add("d-flex");
        {
         
        }


           }





      // on ajoute les écouteurs sur les flèches de chaque carrousel des marques (il y a plusieurs carrousel mais avec la même classe) et on boucle
      const prevButtonsArrow = document.querySelectorAll('.button_brands-left');
      for (const prevButton of prevButtonsArrow) {
        // console.log(prevButton);
        prevButton.addEventListener('click', app.handlePrevButtonClick);
      }
      
 

    const nextButtonsArrow = document.querySelectorAll('.button_brands-right');
    for (const nextButton of nextButtonsArrow) {
      // console.log(nextButton);
      nextButton.addEventListener('click', app.handleNextButtonClick);
    }
    },

    /**
   * Récupère l'étape en cours et lance la vérification de l'étape
   * @param {*} evt 
   */
     handlePrevButtonClick: function(evt) {

        console.log('evt.currentTarget', evt.currentTarget);
        let carousel = evt.currentTarget.parentNode;
        console.log('carousel', carousel);
        carousel.classList.remove("d-flex");
        carousel.classList.add("d-none");


        idOfElement = carousel.id;
        console.log('idOfElement', idOfElement);

        carouselNumber = idOfElement.charAt(idOfElement.length-1);
        console.log('carouselNumber', carouselNumber);
        if(carouselNumber != 0) {

            prevCarousel = document.querySelector('#partial_brands_' + (carouselNumber - 1));
            console.log('prevCarousel', prevCarousel);
            prevCarousel.classList.remove("d-none");
            prevCarousel.classList.add("d-flex");
          

        } else {
            let indexMax = carousel.dataset.max;
  
              let carouselMax = document.querySelector('#partial_brands_' + indexMax);
                console.log('carouselMax', carouselMax);
  
      
              carouselMax.classList.remove("d-none");
              carouselMax.classList.add("d-flex");
        }


     
  },

      /**
   * Récupère l'étape en cours et lance la vérification de l'étape
   * @param {*} evt 
   */
       handleNextButtonClick: function(evt) {

       

        let carousel = evt.currentTarget.parentNode;
        console.log(carousel);
        carousel.classList.remove("d-flex");
        carousel.classList.add("d-none");

        idOfElement = carousel.id;

        console.log("l'id est " + idOfElement);

        carouselNumber = idOfElement.charAt(idOfElement.length-1);
        console.log('carouselNumber');
        console.log(carouselNumber);
 

        let carouselrecovered = document.querySelector('#partial_brands_' + (carouselNumber -1 + 2));
        console.log('carouselrecovered');
        console.log(carouselrecovered);
        
        if(carouselrecovered) {
            console.log("plus existe");

            carouselrecovered.classList.remove("d-none");
            carouselrecovered.classList.add("d-flex");

        } else {
          let indexMin = carousel.dataset.min;

            let carouselInitial = document.querySelector('#partial_brands_' + indexMin);
            carouselInitial.classList.remove("d-none");
            carouselInitial.classList.add("d-flex");
        }


     
  },

};


document.addEventListener('DOMContentLoaded', app.init);