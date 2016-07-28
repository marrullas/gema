


/*=============================================================
    Authour URI: www.binarycart.com
    License: Commons Attribution 3.0

    http://creativecommons.org/licenses/by/3.0/

    100% To use For Personal And Commercial Use.
    IN EXCHANGE JUST GIVE US CREDITS AND TELL YOUR FRIENDS ABOUT US

    ========================================================  */


(function ($) {
    "use strict";
    var mainApp = {

        main_fun: function () {
            /*====================================
            METIS MENU
            ======================================*/
            $('#main-menu').metisMenu();

            /*====================================
              LOAD APPROPRIATE MENU BAR
           ======================================*/
            $(window).bind("load resize", function () {
                if ($(this).width() < 768) {
                    $('div.sidebar-collapse').addClass('collapse')
                } else {
                    $('div.sidebar-collapse').removeClass('collapse')
                }
            });


        },

        initialization: function () {
            mainApp.main_fun();

        }

    }
    // Initializing ///

    $(document).ready(function () {
        mainApp.main_fun();


        $('#formfuncionarios').parsley();

        $('#listnc').click(function(event){event.preventDefault();$('#products .item').addClass('list-group-item');});
        $('#gridnc').click(function(event){event.preventDefault();$('#products .item').removeClass('list-group-item');$('#products .item').addClass('grid-group-item');});

        $('[data-toggle="popover"]').popover();

        $.listen('parsley:form:validated', function(e){
            if (e.validationResult) {
                /* Validation has passed, prevent double form submissions */
                $('button[type=submit]').attr('disabled', 'disabled');
            }
        });
        $(".validate-form").parsley({
            successClass: "has-success",
            errorClass: "has-error",
            classHandler: function (el) {
                return el.$element.closest(".form-group");
            },
            errorsContainer: function (el) {
                return el.$element.closest(".form-group");
            },
            errorsWrapper: "<span class='help-block'></span>",
            errorTemplate: "<span></span>"
        });
    });
//funcionalidad para el menu listatareas

}(jQuery));
