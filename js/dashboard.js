var westDefaultSize = 320,
    DefaultSize = "33%",
    toggleButtons = '<div class="btnToggler"></div><div class="btnToggler"></div><div class="btnToggler"></div>',
    myLayout;

resizeInProgress = false;
resizeFinished = true;


$.fixHeight = function () {
    max_height = 0;
    $('#dashboard').find('.widgets').each(function (i) {
        if (max_height < $(this).height())
            max_height = $(this).height() + 20;
    });
    if ($('#widget-dock').css('display') != 'none')
        max_height += $('#widget-dock').height();
    max_height += $('.sortable_placeholder').height();
    $('#content').height(max_height);
};

$.finishResizing = function () {
    if (resizeInProgress) {
        resizeInProgress = false;
        setTimeout('$.finishResizing()', 200);
        return;
    }
    resizeFinished = true;
    $('#highchart').show();
    $('#highchart-placeholder').hide();
    $('#highchart').trigger("resize");
    $.fixHeight();
    $.saveColumnSizes();
};

$.saveColumnSizes = function () {
    var wl_Store = new $.wl_Store('wl_' + location.pathname.toString());
    $('#dashboard').find('.pane').each(function (i, cont) {
        state = {
            'width': (100 * parseFloat($(this).css('width')) / parseFloat($(this).parent().css('width'))) + '%',
            'display': $(this).css('display') != 'none'
        };
        wl_Store.save($(this).attr('id'), state);
    });
    wl_Store.sync();
};

$(function () {
    $('#widget_panel').bind('click', function () {
        $('#widget-dock').slideToggle('', function () {
            $.fixHeight();
        });
    });
});

$.initLayout = function () {

    // CREATE THE LAYOUT
    myLayout = $('#dashboard').layout({
        resizeWhileDragging: true,
        fxName: "none",
        west__size: DefaultSize,
        east__size: DefaultSize,
        spacing_open: 16,
        spacing_closed: 16,
        minSize: 150,
        slideDelay_open: 300,
        slideDelay_close: 300,
        west__togglerLength_closed: 105,
        west__togglerLength_open: 105,
        east__togglerLength_closed: 105,
        east__togglerLength_open: 105,
        west__togglerContent_closed: toggleButtons,
        west__togglerContent_open: toggleButtons,
        east__togglerContent_closed: toggleButtons,
        east__togglerContent_open: toggleButtons,
        onresize: function () {
            resizeInProgress = true;
            $('#highchart').hide();
            $('#highchart-placeholder').show();

            if (resizeFinished) {
                resizeFinished = false;
                $.finishResizing();
            }
        }
    });
    var wl_Store = new $.wl_Store('wl_' + location.pathname.toString());
    west = wl_Store.get('pane-west');
    east = wl_Store.get('pane-east');
    if (!west['display'])
        myLayout.close('west');
    if (!east['display'])
        myLayout.close('east');

    west = parseFloat(west['width']) / 100 * parseFloat($('#dashboard').css('width'));
    east = parseFloat(east['width']) / 100 * parseFloat($('#dashboard').css('width'));

    if (west > east) {
        myLayout.sizePane('east', east);
        myLayout.sizePane('west', west);
    }
    else {
        myLayout.sizePane('west', west);
        myLayout.sizePane('east', east);
    }
    $.fixHeight();
}


//load widgets and init layout
$(document).ready(function () {
    var $content = $('#content');
    $.preload();
    var wl_Store = new $.wl_Store('wl_' + location.pathname.toString());
    wl_Store.restore();
    $content.find('.widgets').each(function (i) {
        if ($(this).hasClass('nodrag')) {
            $(this).wl_Widget({
                sortable: false
            });
        } else {
            $(this).wl_Widget({
                sortable: true
            });
        }
        $(this).bind("sortover", function (event, ui) {
            $.fixHeight();
        });
    });
    $.initLayout();


    var tourdata = [{
        html: "Welcome to FitForGreen! <br/> Let me show you short intro to our dashboard. You can skip it by pressing Esc"
    }
        , {
            html: "Click here to view other widgets",
            element: $('#widget_panel'),
            position: 'w'
        }
        , {
            html: "You can add any of these, just drag down",
            element: $('#content'),
            onShow: function (e) {
                $('#widget-dock').slideToggle()
            },
            onHide: function (e) {
                $('#widget-dock').hide()
            },
            position: 'n'
        }
        , {
            html: "You can remove widget from the dashboard by clicking on this button",
            element: $('#global_stats > .handle'),
            onShow: function (e) {
                $('#global_stats > .handle > .collapse').show()
            },
            onHide: function (e) {
                $('#global_stats > .handle > .collapse').hide()
            },
            position: 'se'
        }
        , {
            html: "You can customize/resize layout using splitters. Choose the most usable view",
            element: $('.btnToggler'),
            onShow: function (e) {
                $(e).parent().parent().parent().addClass('ui-layout-toggler-hover');
            },
            onHide: function (e) {
                $(e).parent().parent().parent().removeClass('ui-layout-toggler-hover')
            },
            position: 'n'
        },
        {
            element: $('#content'),
            html: "This one is good for small screens",
            onShow: function (e) {
                myLayout.hide('east');
                myLayout.hide('west');
            },
            onHide: function (e) {
                myLayout.show('east');
                myLayout.show('west');
            },
            position: 'n'
        },
        /*{
                html: "Click here to view other widgets",
                onShow: function(e){myLayout.hide('east');myLayout.hide('west');
                },
                onHide: function(e){myLayout.show('east');myLayout.show('west');
                },
                position: 'n'
        },*/
        {
            html: "Sharing your results with friend is very simple.",
            element: $('#posttowall_bulb'),
            position: 'n'
        },
        {
            html: "Hope you'll engoy"
        }
    ];


    var myTour = jTour(
        tourdata,
        {
            /*showControls: false,*/
            overlayOpacity: 0.1
        }
    );
    if (uid == 19)
        myTour.start();


});