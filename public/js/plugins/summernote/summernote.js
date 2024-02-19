"use strict";
// Class definition

var KTSummernoteDemo = function () {    
    // Private functions
    var demos = function () {
        $('.summernote').summernote({
            height: 100,
        });

        $('.summernote').summernote('editor.saveRange');

        // Editor loses selected range (e.g after blur)

        $('.summernote').summernote('editor.restoreRange');
        $('.summernote').summernote('editor.focus');
        //$('.summernote').summernote('editor.insertText', 'This text should appear at the cursor');
    };

    return {
        // public functions
        init: function() {
            demos(); 
        }
    };
}();

// Initialization
jQuery(document).ready(function() {
    KTSummernoteDemo.init();
});
