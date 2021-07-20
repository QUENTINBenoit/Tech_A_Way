let quantity = {

    init: function() {
       
    const buttonsMinus1 = document.querySelector('.quantity_product_minus_1');
    buttonsMinus1.addEventListener('click', quantity.handleButtonMinusClick);

    const buttonsMinus2 = document.querySelector('.quantity_product_minus_2');
    buttonsMinus2.addEventListener('click', quantity.handleButtonMinusClick);

    const buttonsMinus3 = document.querySelector('.quantity_product_minus_3');
    buttonsMinus3.addEventListener('click', quantity.handleButtonMinusClick);

    const buttonsPlus1 = document.querySelector('.quantity_product_plus_1');
    buttonsPlus1.addEventListener('click', quantity.handleButtonPlusClick);

    const buttonsPlus2 = document.querySelector('.quantity_product_plus_2');
    buttonsPlus2.addEventListener('click', quantity.handleButtonPlusClick);

    const buttonsPlus3 = document.querySelector('.quantity_product_plus_3');
    buttonsPlus3.addEventListener('click', quantity.handleButtonPlusClick);
    },
 

    handleButtonMinusClick: function(evt) {

        target = evt.currentTarget;
        targetNameByClass = target.className
        

        productNumber = targetNameByClass.charAt(targetNameByClass.length-1);
 
        // on récupère l'élément contenant la quantité actuelle
        actualQuantityEl = document.querySelector('.actual_quantity_product_' + productNumber);
        actualQuantityEl.innerText -= 1; 
        
        if (actualQuantityEl.innerText == 0 ) {
            productEl = target.closest(".product");
            productEl.remove();
        }
     
     },

     handleButtonPlusClick: function(evt) {

        target = evt.currentTarget;
        targetNameByClass = target.className
        

        productNumber = targetNameByClass.charAt(targetNameByClass.length-1);
 
        // on récupère l'élément contenant la quantité actuelle
        actualQuantityEl = document.querySelector('.actual_quantity_product_' + productNumber);
        if (actualQuantityEl.innerText != 9 ) {
        actualQuantityEl.innerText -= -1; 
        console.log("coucou");
        
   
        }
     
     },

};



document.addEventListener('DOMContentLoaded', quantity.init);