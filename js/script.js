$(document).ready(function () {
    var $content = $('#content');
    $.preload();


    //$content.find('div.widget').wl_Widget();
    //$('#widget_panel_box').find('div.widget').wl_Widget();

    /*----------------------------------------------------------------------*/
    /* All Form Plugins
    /*----------------------------------------------------------------------*/

    //Integers and decimals
    $content.find('input[type=number].integer').wl_Number();
    $content.find('input[type=number].decimal').wl_Number({decimals: 2, step: 0.5});

    //Date and Time fields
    $content.find('input.date, div.date').wl_Date();
    $content.find('input.time').wl_Time();

    //Autocompletes (source is required)
    /*$content.find('input.autocomplete').wl_Autocomplete({
        source: ["ActionScript","AppleScript","Asp","BASIC","C","C++","Clojure","COBOL","ColdFusion","Erlang","Fortran","Groovy","Haskell","Java","JavaScript","Lisp","Perl","PHP","Python","Ruby","Scala","Scheme"]
    });*/

    //Elastic textareas (autogrow)
    $content.find('textarea[data-autogrow]').elastic();
    //WYSIWYG Editor
    //$content.find('textarea.html').wl_Editor();

    //Validation
    $content.find('input[data-regex]').wl_Valid();
    $content.find('input[type=email]').wl_Mail();
    $content.find('input[type=url]').wl_URL();

    //File Upload
    //$content.find('input[type=file]').wl_File();

    //Password and Color
    $content.find('input[type=password].confirm').wl_Password();
    //$content.find('input.color').wl_Color();

    //Sliders
    //$content.find('div.slider').wl_Slider();


    //The Form itself
    //	$content.find('form').wl_Form();

    /*----------------------------------------------------------------------*/
    /* Alert boxes
    /*----------------------------------------------------------------------*/

    $content.find('div.alert').wl_Alert();

    /*----------------------------------------------------------------------*/
    /* Breadcrumb
    /*----------------------------------------------------------------------*/

    //$content.find('ul.breadcrumb').wl_Breadcrumb();

    /*----------------------------------------------------------------------*/
    /* datatable plugin
    /*----------------------------------------------------------------------*/

    $content.find("table.datatable_ext").dataTable({
        "bLengthChange": true,
        "bFilter": false,
        "bSort": true,
        "bAutoWidth": false,
        "iDisplayLength": 50,
        "aaSorting": [[0, 'desc']]
    });

    /*----------------------------------------------------------------------*/
    /* uniform plugin
    /*----------------------------------------------------------------------*/

    $("select, textarea, input").not('input[type=submit],input[type=file], textarea.html').uniform();


    $content.find('input[title]').tipsy({
        gravity: function () {
            return ($(this).data('tooltip-gravity') || config.tooltip.gravity);
        },
        fade: config.tooltip.fade,
        opacity: config.tooltip.opacity,
        color: config.tooltip.color,
        offset: config.tooltip.offset
    });


    /*----------------------------------------------------------------------*/
    /* Accordions
    /*----------------------------------------------------------------------*/

    $content.find('div.accordion').accordion({
        collapsible: true,
        autoHeight: false
    });

    /*----------------------------------------------------------------------*/
    /* Tabs
    /*----------------------------------------------------------------------*/

    $content.find('div.tab').tabs({
        fx: {
            opacity: 'toggle',
            duration: 'fast',
            height: 'auto'
        }
    });

    /*----------------------------------------------------------------------*/
    /* Buttons
    /*----------------------------------------------------------------------*/

    //$content.find('button, input[type=submit]').button();


    /*----------------------------------------------------------------------*/
    /* Navigation Stuff
    /*----------------------------------------------------------------------*/


    //Top Pageoptions
    $('#wl_config').click(function () {
        var $pageoptions = $('#pageoptions');
        if ($pageoptions.height() < 200) {
            $pageoptions.animate({'height': 200});
            $(this).addClass('active');
        } else {
            $pageoptions.animate({'height': 20});
            $(this).removeClass('active');
        }
        return false;
    });


    //Header navigation for smaller screens
    var $headernav = $('ul#headernav');

    $headernav.bind('click', function () {
        //if(window.innerWidth > 800) return false;
        var ul = $headernav.find('ul').eq(0);
        (ul.is(':hidden')) ? ul.addClass('shown') : ul.removeClass('shown');
    });

    $headernav.find('ul > li').bind('click', function (event) {
        event.stopPropagation();
        var children = $(this).children('ul');

        if (children.length) {
            (children.is(':hidden')) ? children.addClass('shown') : children.removeClass('shown');
        }
    });

    //Search Field Stuff
    var $searchform = $('#searchform'),
        $searchfield = $('#search');

    $searchfield
        .bind('focus.wl', function () {
            $searchfield.parent().animate({width: '150px'}, 100).select();
        })
        .bind('blur.wl', function () {
            $searchfield.parent().animate({width: '90px'}, 100);
        });

    $searchform
        .bind('submit.wl', function () {
            //do something on submit
            var query = $searchfield.val();
        });


    //Main Navigation
    var $nav = $('#nav');

    $nav.delegate('li', 'click.wl', function (event) {
        var _this = $(this),
            _parent = _this.parent(),
            a = _parent.find('a');
        _parent.find('ul').slideUp('fast');
        a.removeClass('active');
        _this.find('ul:hidden').slideDown('fast');
        _this.find('a').eq(0).addClass('active');
        event.stopPropagation();
    });

    /*----------------------------------------------------------------------*/
    /* Helpers
    /*----------------------------------------------------------------------*/

    //placholder in inputs is not implemented well in all browsers, so we need to trick this
    $("[placeholder]").bind('focus.placeholder', function () {
        var el = $(this);
        if (el.val() == el.attr("placeholder") && !el.data('uservalue')) {
            el.val("");
            el.removeClass("placeholder");
        }
    }).bind('blur.placeholder', function () {
        var el = $(this);
        if (el.val() == "" || el.val() == el.attr("placeholder") && !el.data('uservalue')) {
            el.addClass("placeholder");
            el.val(el.attr("placeholder"));
            el.data("uservalue", false);
        } else {

        }
    }).bind('keyup.placeholder', function () {
        var el = $(this);
        if (el.val() == "") {
            el.data("uservalue", false);
        } else {
            el.data("uservalue", true);
        }
    }).trigger('blur.placeholder');


    /*----------------------------------------------------------------------*/
    /* add some Callbacks to the Form
    /* http://themeforest.revaxarts.com/whitelabel/form.html
    /*----------------------------------------------------------------------*/

//			$content.find('form').wl_Form({
//				/*onSuccess: function(data, status){
////					if(window.console){
////						console.log(status);
////						console.log(data);
////					};
//					//$.msg("Custom Callback on success\nDevelopers! Check your Console!");
//				},*/
//				onError: function(status, error, jqXHR){
//				//	$.msg("Callback on Error\nError Status: "+status+"\nError Msg: "+error);
//				}
//                        });
});


/*----------------------------------------------------------------------*/
/* Autocomplete Function must be available befor wl_Autocomplete is called
/*----------------------------------------------------------------------*/

window.myAutocompleteFunction = function () {
    return ['Lorem ipsum dolor', 'sit amet consectetur adipiscing', 'elit Nulla et justo', 'est Vestibulum libero', 'enim adipiscing in', 'porta mollis sem', 'Duis lacinia', 'velit et est rhoncus', 'mattis Aliquam at', 'diam eu ipsum', 'rutrum tincidunt Etiam', 'nec porta erat Pellentesque', 'et elit sed sem', 'bibendum posuere Curabitur id', 'purus erat vel pretium', 'erat Ut ultricies semper', 'quam eu dignissim Cras sed', 'sapien arcu Phasellus sit amet', 'venenatis sapien Nulla facilisi', 'Curabitur ut', 'bibendum odio Fusce', 'vitae velit hendrerit', 'dui convallis tristique', 'eget nec leo', 'Vestibulum fermentum leo', 'ac rutrum interdum mauris', 'felis sodales arcu', 'non vehicula odio magna sed', 'tortor Etiam enim leo', 'interdum vitae elementum id', 'laoreet at massa Curabitur nisi dui', 'lobortis ut rutrum', 'quis gravida ut velit', 'Phasellus augue quam gravida non', 'vulputate vel tempus sit amet', 'nunc Proin convallis tristique purus'];
};