// Class definition

var KTInputmask = function () {
    
    // Private functions
    var demos = function () {
        // date format
        $(".datemask").inputmask("99/99/9999", {
            "placeholder": "mm/dd/yyyy",
            autoUnmask: true
        });

        $(".datedotmask").inputmask("99.99.9999");

        // custom placeholder        
        $(".taxmask").inputmask("9999999999", {
            "mask": "9999999999",
        });

        $(".mersismask").inputmask("9999 9999 9999 9999", {
            "mask": "9999 9999 9999 9999",
        });

        $(".tcmask").inputmask("99999999999",{
            "mask":"99999999999",
        });
        
        // phone number format
        $(".phonemask").inputmask("mask", {
            "mask": "(0999) 999 99 99"
        });

        $(".ibanmask").inputmask("mask", {
            "mask": "TR99 9999 9999 9999 9999 9999 99"
        });

        //email address
        $(".emailmask").inputmask({
            mask: "*{1,20}[.*{1,20}][.*{1,20}][.*{1,20}]@*{1,20}[.*{2,6}][.*{1,2}]",
            greedy: false,
            onBeforePaste: function (pastedValue, opts) {
                pastedValue = pastedValue.toLowerCase();
                return pastedValue.replace("mailto:", "");
            },
            definitions: {
                '*': {
                    validator: "[0-9A-Za-z!#$%&'*+/=?^_`{|}~\-]",
                    cardinality: 1,
                    casing: "lower"
                }
            }
        });        
    }

    return {
        // public functions
        init: function() {
            demos(); 
        }
    };
}();

jQuery(document).ready(function() {
    KTInputmask.init();
});
