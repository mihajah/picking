$(function() {
	var common_header = $('<div id="tcz_common_header"/>');
	var header_menu   = $('<div class="tcz_header_menu"/>');
	header_menu.append('<button class="hamburger">&#9776;</button>');
	header_menu.append('<button class="cross">&#88;</button>');
	header_menu.append('<span id="tcz_brand_name"> '+ config.app_name +' </span>');
	common_header.append(header_menu);

	var menu = $('<div class="tcz_menu"/>');
	var list = $('<ul/>');

	for(m in config.menus){
		var clsapp   = config.menus[m].class_app;
		var urlapp   = config.menus[m].url_app;
		var labelapp = config.menus[m].menu_label;
		list.append('<li><a target="_blank" class="_'+clsapp+'_" href="'+urlapp+'">'+labelapp+'</a></li>');
	}
	
	menu.append(list);
	common_header.append(menu);
	common_header.insertBefore('#tcz_header_commun_menu');
	$('<input type="hidden" id="tcz_params_idproduct"/>').insertAfter('#tcz_header_commun_menu');

	/** Ajout de style in header **/
    $('head').append('<link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet" />');
    $('#tcz_common_header').insertBefore('#tcz_header_commun_menu');
    
    $('.tcz_menu').hide();
    $('.cross').hide();
    $( ".hamburger" ).click(function() {
        $( ".tcz_menu" ).slideToggle( "slow", function() {
            $( ".hamburger" ).hide();
            $( ".cross" ).show();
        });
        performUrlMenu();
    });

    $( ".cross" ).click(function() {
        $( ".tcz_menu" ).slideToggle( "slow", function() {
            $( ".cross" ).hide();
            $( ".hamburger" ).show();
        });
        performUrlMenu();
    });  

    $(document).on('click', 'a._restock_, a._productlog_, a._labelcreat_', function(event) {
        var param_val = $("#tcz_params_idproduct").val();
        if (param_val != "0" ) {
            event.preventDefault();
            var val_act = $(this).attr('href');
            val_act = val_act.replace(/\?p=\d+/g,'');
            //window.location.href = val_act+"?p="+param_val;
            window.open(val_act+"?p="+param_val);
        }
    });

    function performUrlMenu() {
        var idProduct  = $(".picking #idProduct").text();
        if(idProduct != "") {
            $("#tcz_params_idproduct").val(idProduct);
        }
    }

    function getSearchParams(k){
	 	 var p={};
		 location.search.replace(/[?&]+([^=&]+)=([^&]*)/gi, function(s,k,v){p[k]=v})
		 return k?p[k]:p;
	}

	var param = getSearchParams("p");
	if(typeof param !== 'undefined') {
		var find     = param.match(/(\d+)/i);
		var valparam = find?param:"0";
		$('#tcz_params_idproduct').val(valparam);
	} else {
		$('#tcz_params_idproduct').val("0");
	}
});