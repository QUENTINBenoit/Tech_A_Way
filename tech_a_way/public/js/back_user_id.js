let userId = {

    init: function() {
       
        const detailsOrderLines = document.querySelectorAll('.button_orderLines_infos');
        for( const detailsOrderLine of detailsOrderLines) {
            detailsOrderLine.addEventListener('click', userId.handleDetailsOrderLineClick);
        }
        
        const hideDetailsOrderLines = document.querySelectorAll('.button_hide_orderLines_infos');
        for( const hideDetailsOrderLine of hideDetailsOrderLines) {
            hideDetailsOrderLine.addEventListener('click', userId.handlehideDetailsOrderLineClick);
        }


},


    handleDetailsOrderLineClick: function(evt) {
        
        target = evt.currentTarget;
        orderId = target.dataset.id;

        // We hide div summary OrderLines...
        const divSummaryOrderlinesEl = document.querySelector('#summary_number_orderlines_'+orderId);
        divSummaryOrderlinesEl.classList.remove("d-block");
        divSummaryOrderlinesEl.classList.add("d-none");

        // to display orderLines informations
        const tableInfosOrderlinesEl = document.querySelector('#orderLines_infos_'+orderId);
        tableInfosOrderlinesEl.classList.remove("d-none");
        tableInfosOrderlinesEl.classList.add("d-block");

     
     },

     handlehideDetailsOrderLineClick: function(evt) {
        target = evt.currentTarget;
        orderId = target.dataset.id;

         // We hide orderLines informations...
        const tableInfosOrderlinesEl = document.querySelector('#orderLines_infos_'+orderId);
        tableInfosOrderlinesEl.classList.remove("d-block");
        tableInfosOrderlinesEl.classList.add("d-none");
        
        // to display div summary OrderLines...

        const divSummaryOrderlinesEl = document.querySelector('#summary_number_orderlines_'+orderId);
        divSummaryOrderlinesEl.classList.remove("d-none");
        divSummaryOrderlinesEl.classList.add("d-block");

    
     },




};



document.addEventListener('DOMContentLoaded', userId.init);