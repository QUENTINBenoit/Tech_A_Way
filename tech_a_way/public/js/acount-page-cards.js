let acountPage = {

    init: function() {
      if(window.innerWidth <= 991) {
          const mainEl = document.querySelector('#account-page-main');
          if(mainEl){
            mainEl.classList.remove('row');
          }

      }
      if(window.innerWidth >= 992) {
        const mainEl = document.querySelector('#account-page-main');
        if(mainEl){
        mainEl.classList.add('row');
        }
        const userInsertEl = document.querySelector('#compte_user_insert');
        if(userInsertEl){
          userInsertEl.classList.remove('d-flex');
        }
 
           }

      const buttonAddressesEl = document.querySelector('#button-page-acount-addresses');
      if(buttonAddressesEl){
        buttonAddressesEl.addEventListener('click', acountPage.handleButtonAdressesClick);
      }

      const buttonMenuAddressesEl = document.querySelector('#menu-page-acount-addresses');
      if (buttonMenuAddressesEl){
        buttonMenuAddressesEl.addEventListener('click', acountPage.handleButtonAdressesClick);
      }
      const buttonInformationsEl = document.querySelector('#button-page-acount-informations');
      if(buttonInformationsEl){
        buttonInformationsEl.addEventListener('click', acountPage.handleButtonInformationsClick);
      }

      const buttonMenuInformationsEl = document.querySelector('#menu-page-acount-informations');
      if(buttonMenuInformationsEl){
        buttonMenuInformationsEl.addEventListener('click', acountPage.handleButtonInformationsClick);
      }

      const buttonOrdersEl = document.querySelector('#button-page-acount-orders');
      if(buttonOrdersEl){
        buttonOrdersEl.addEventListener('click', acountPage.handleButtonOrdersClick);
      }

      const buttonMenuOrdersEl = document.querySelector('#menu-page-acount-orders');
      if(buttonMenuOrdersEl){
        buttonMenuOrdersEl.addEventListener('click', acountPage.handleButtonOrdersClick);
      }

    },
    
    
    handleButtonAdressesClick: function(evt) {
      
      const informationsEl = document.querySelector('#compte_user_informations');
      informationsEl.classList.add('d-none');
      const ordersEl = document.querySelector('#compte_user_orders');
      ordersEl.classList.add('d-none');
     
      const addressesEl = document.querySelector('#compte_user_addresses');
      addressesEl.classList.remove('d-none');
     },

     handleButtonInformationsClick: function(evt) {
      
      const ordersEl = document.querySelector('#compte_user_orders');
      ordersEl.classList.add('d-none');
      const addressesEl = document.querySelector('#compte_user_addresses');
      addressesEl.classList.add('d-none');

      const informationsEl = document.querySelector('#compte_user_informations');
      informationsEl.classList.remove('d-none');
     },

     handleButtonOrdersClick: function(evt) {
      
      const informationsEl = document.querySelector('#compte_user_informations');
      informationsEl.classList.add('d-none');
      const addressesEl = document.querySelector('#compte_user_addresses');
      addressesEl.classList.add('d-none');

      const ordersEl = document.querySelector('#compte_user_orders');
      ordersEl.classList.remove('d-none');
     },



  

};



document.addEventListener('DOMContentLoaded', acountPage.init);