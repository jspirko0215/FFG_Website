/*----------------------------------------------------------------------*/
/* wl_Store v 1.0 by revaxarts.com
/* description: Uses window.zStorage to save information within the Browser
/*				enviroment
/* dependency:  >IE7 :)
/*----------------------------------------------------------------------*/


$.wl_Store = function (namespace) {

    //IE7 isn't a cool client :(
    //var coolClient = (typeof window.window.zStorage !== 'undefined' && typeof JSON !== 'undefined'),

    //namespace for the storage
    namespace = namespace || 'wl_store',


        loc = {

            //method to save data
            save: function (key, value) {
                var _save;
                //console.log('save');
                if (typeof key !== 'object') {
                    var _current = get() || {};
                    var _obj = {};
                    _obj[key] = value;
                    _save = $.extend({}, _current, _obj);
                } else {
                    _save = key;
                }
                //console.log(_save);
                window.zStorage = JSON.stringify(_save);
                return true;
            },

            sync: function () {
                $.ajax(
                    {
                        url: '/ajax/sync_widgets',
                        type: 'POST',
                        data: "data=" + window.zStorage,
                        cache: false,
                        success: function (result) {

                        }
                    }
                );
            },

            restore: function () {
                $.ajax(
                    {
                        url: '/ajax/sync_widgets',
                        type: 'GET',
                        async: false,
                        cache: false,
                        success: function (result) {
                            window.zStorage = result;
                        }
                    }
                );
            },

            //method to get data
            get: function (key) {
                var _obj = $.parseJSON(window.zStorage);
                // console.log(_obj);
                if (typeof key !== 'undefined' && _obj) {
                    return _obj[key];
                }
                return _obj;
            },

            //method to remove data
            remove: function (key) {
                var obj = get();
                if (typeof key !== 'undefined' && obj[key]) {
                    delete obj[key];
                    for (var i in obj) {
                        var notempty = true;
                        break;
                    }
                    if (notempty) {
                        save(obj);
                        return true;
                    }
                }
                window.zStorage.removeItem(namespace);
                return true;
            },

            //delete all saved data
            flush: function () {
                window.zStorage.clear();
                return true;
            }
        },

        //IE 7 can't handle window.zStorage but cookies are to bad for storing huge data
        save = function (key, value) {
            return loc.save(key, value);
        },

        remove = function (key) {
            return loc.remove(key);
        },

        flush = function () {
            return loc.flush();
        },

        get = function (key) {
            return loc.get(key);
        },

        sync = function () {
            return loc.sync();
        },

        restore = function () {
            return loc.restore();
        };

    //public methods
    return {
        save: function (key, value) {
            return save(key, value);
        },
        get: function (key) {
            s = get(key);
            return s;
        },
        remove: function (key) {
            return remove(key);
        },
        flush: function () {
            return flush();
        },
        sync: function () {
            return sync();
        },
        restore: function () {
            return restore();
        }

    }


};


$(document).ready(function () {
    var wl_Store = new $.wl_Store('wl_' + location.pathname.toString());
    wl_Store.restore();
    $content = $('#content');
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
        $(this).resize(function () {

        });
        $(this).bind("sortover", function (event, ui) {
            1
            $.fixHeight();
        });
        $.fixHeight();
    });

});                