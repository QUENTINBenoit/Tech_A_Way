let quantity = {

    init: function() {
       
    const buttonsMinus = document.querySelectorAll('.quantity_product_minus');
    for (const buttonMinus of buttonsMinus) {
        buttonMinus.addEventListener('click', quantity.handleButtonMinusClick);

      }

    const buttonsPlus = document.querySelectorAll('.quantity_product_plus');
    for (const buttonPlus of buttonsPlus) {
        buttonPlus.addEventListener('click', quantity.handleButtonPlusClick);
      }


    const buttonsDelete = document.querySelectorAll('.button_delete_product');
    for (const buttonDelete of buttonsDelete) {
        buttonDelete.addEventListener('click', quantity.handleButtonDelete);
      }

    },
 

    handleButtonMinusClick: function(evt) {

        target = evt.currentTarget;
        targetNameById = target.id
        

        productNumber = targetNameById.charAt(targetNameById.length-1);
 
        // on récupère l'élément contenant la quantité actuelle
        actualQuantityEl = document.querySelector('#actual_quantity_product_' + productNumber);
        actualQuantityEl.innerText -= 1; 
        
        if (actualQuantityEl.innerText == 0 ) {
            productEl = target.closest(".product");
            productEl.remove();
        }
     
     },

     handleButtonPlusClick: function(evt) {

        target = evt.currentTarget;
        targetNameById = target.id
        

        productNumber = targetNameById.charAt(targetNameById.length-1);
 
        // on récupère l'élément contenant la quantité actuelle
        actualQuantityEl = document.querySelector('#actual_quantity_product_' + productNumber);
        if (actualQuantityEl.innerText != 9 ) {
        actualQuantityEl.innerText -= -1; 
        
   
        }
     
     },

     handleButtonDelete: function(evt) {

        target = evt.currentTarget;
        targetNameById = target.id
        
        productNumber = targetNameById.charAt(targetNameById.length-1);
 
            productEl = target.closest(".product");
            productEl.remove();

     
     },

};



document.addEventListener('DOMContentLoaded', quantity.init);