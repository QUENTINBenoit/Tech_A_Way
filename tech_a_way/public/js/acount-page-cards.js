let acountPage = {

    init: function() {
       
      const buttonAddressesEl = document.querySelector('#button-page-acount-addresses');
      buttonAddressesEl.addEventListener('click', acountPage.handleButtonAdressesClick);
      const buttonMenuAddressesEl = document.querySelector('#menu-page-acount-addresses');
      buttonMenuAddressesEl.addEventListener('click', acountPage.handleButtonAdressesClick);
      
      const buttonInformationsEl = document.querySelector('#button-page-acount-informations');
      buttonInformationsEl.addEventListener('click', acountPage.handleButtonInformationsClick);
      const buttonMenuInformationsEl = document.querySelector('#menu-page-acount-informations');
      buttonMenuInformationsEl.addEventListener('click', acountPage.handleButtonInformationsClick);

      const buttonOrdersEl = document.querySelector('#button-page-acount-orders');
      buttonOrdersEl.addEventListener('click', acountPage.handleButtonOrdersClick);
      const buttonMenuOrdersEl = document.querySelector('#menu-page-acount-orders');
      buttonMenuOrdersEl.addEventListener('click', acountPage.handleButtonOrdersClick);
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