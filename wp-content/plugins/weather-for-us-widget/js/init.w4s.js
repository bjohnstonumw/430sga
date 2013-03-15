(function (win, $){

  function hook_field(fld){
    var fld = $(this);
    fld.ColorPicker({
      onBeforeShow: function () {
        $(fld).ColorPickerSetColor(fld.val());
      },
      onChange: function (hsb, hex, rgb) {
        fld.val(hex);
      }
    }).addClass("picked");
  }

  function hook_fields_in(elm) {
    $(elm).find(".color-picker").not(".picked").each(hook_field).addClass("picked");
  }

  $(function(){
    $("div.widgets-sortables").bind("sortcreate", function(ev, ui){
      hook_fields_in(this);
    });
    $('div.widgets-sortables').bind('sortreceive',function(ev,ui){
      var that = this;
      window.setTimeout(function(){
       hook_fields_in(that);
      }, 500);
    });
  });
})(window, jQuery);