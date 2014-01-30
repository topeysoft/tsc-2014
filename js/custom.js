// JavaScript Document
//( function( $ ) {
var $ = jQuery.noConflict();
var navbar_is_now_fixed=false;
	var request;

$(document).ready(function(){
		_init();
});
var _redirectTo = function(url){
	window.location.href = url;	
}

	var fixNavbar={
		onMobile:function(){
			if ($(window).scrollTop() >= 100) { //use `this`, not `document`
				if(!navbar_is_now_fixed){
				$('#site-header.top-nav').removeClass('navbar-static-top').addClass('navbar-fixed-top').addClass('navbar-with-drop-shadow');
					//$('.mini-logo').removeClass('visible-xs');
					$('.go-to-top').show('slide',{direction:"right"},'slow');
				}
				 navbar_is_now_fixed=true;
			}else{
				if(navbar_is_now_fixed){
				 $('#site-header.top-nav').removeClass('navbar-fixed-top').removeClass('navbar-with-drop-shadow').addClass('navbar-static-top');//"slide",{direction:"down"},"fast");
				 //$('.mini-logo').addClass('visible-xs');
				 $('.go-to-top').hide('slide',{direction:"right"},'slow');
				}
				 navbar_is_now_fixed=false;
			}
		
		},
			onDesktop:function(){
				//alert("hey");
				
				if ($(window).scrollTop() >= 100) { //use `this`, not `document`
					if(!navbar_is_now_fixed){
						
					$('#site-header.top-nav').hide().removeClass('navbar-static-top').addClass('navbar-fixed-top').addClass('navbar-with-drop-shadow','slow').show("slide",{direction:"up"},"slow");
						$('.mini-logo').removeClass('visible-xs');
						$('.go-to-top').show('slide',{direction:"right"},'slow');
					
					}
					 navbar_is_now_fixed=true;
				}else{
					if(navbar_is_now_fixed){
					 $('#site-header.top-nav').hide().removeClass('navbar-fixed-top').removeClass('navbar-with-drop-shadow',"slow").addClass('navbar-static-top').show();//"slide",{direction:"down"},"fast");
					 $('.mini-logo').addClass('visible-xs');
					 $('.go-to-top').hide('slide',{direction:"right"},'slow');
					}
					 navbar_is_now_fixed=false;
				}
			
		}
	}
	
	var Response={
			_winOffset:-20,
			resize:function() {
				
			Response.isXs();
			Response.isSm();
			Response.isMd();
			Response.isLg();
				

			
		},
		isXs:function(){  // Extra Small Screens (E.g Smartphones);
			if ($(window).width() < (768+Response._winOffset)) {
					// do something for small screens
					
					//alert($(window).width()-Response._winOffset);
					return true;
			}else{
				return false;	
			}
		},
		isSm:function(){  //  Small Screens (E.g Tablets);
			if ($(window).width() > (768+Response._winOffset) &&  $(window).width() <= (992+Response._winOffset)) {
					// do something for small screens
					//alert($(window).width()-Response._winOffset);
					return true;
			}else{
				return false;	
			}
		},
		isMd:function(){  // Medium Screens (E.g Desktop);
			if ($(window).width() > (992+Response._winOffset) &&  $(window).width() <= (1200+Response._winOffset)) {
					// do something for small screens
					//alert($(window).width()-Response._winOffset);
					return true;
			}else{
				return false;	
			}
		},
		isLg:function(){  // Large Screens (E.g Tvs, Wide desktops and laptops, etc);
			if ( $(window).width() > (1200+Response._winOffset)) {
					// do something for small screens
					//alert($(window).width()-Response._winOffset);
					return true;
			}else{
				return false;	
			}
		}
		
		
	};
	$.fn.exists = function(){
		return this.length > 0?true:false;
 	};
	//$.fn.extend({
		var tsc_overlay={
			overlay:function(){
				return tsc_overlay.getOverlay()	
			},
			
			postData:function(form,url){
				postForm(form,url);
				
				
			},
			
			loadContent:function(url){
				var ol=this.getOverlay();
				var inst=this;
				//$('.tsc-overlay').load(url);
				//alert(url);
				$.get( url, function( data ) {
				  ol.html( data );
				  inst.reposition();
				  //alert( "Load was performed." );
				});
				//.load(url);
				
			},
			reposition:function(){
				//alert("repositioned");
					$('.overlay-float').position({
						
						of:$('.tsc-overlay')	
					});
			},
			getOverlay:function(options){
				var inst=this;
				var settings={
					loader_text:" Loading... ",
					loader_icon_class:"fa fa-spinner fa-spin fa-2x"
						
				};
				$.extend(settings,options);
				var loader_div=function(){
						var loader_icon =$('<i></i>');
						loader_icon.addClass(settings.loader_icon_class);
					var tsc_msg_box=$("<div ></div>");
						tsc_msg_box.append(loader_icon).append(settings.loader_text).addClass("message-box");
						//alert(tsc_msg_box.html());
					var overlay_float=$("<div ></div>");
						overlay_float.append(tsc_msg_box).addClass("overlay-float");
					var wrapper=$("<div ></div>");
						wrapper.append(overlay_float).addClass("wrapper loadingDiv");
						return wrapper;
					}
					var tsc_ovl=function(){
						var tsc_ol=$('<div ></div>');
						tsc_ol.append(loader_div()).addClass("tsc-overlay");
						return tsc_ol;
					}
				if(!$('.tsc-overlay').exists()){
							
					//alert($(this).length);
					
					
					
									
					$('body').prepend(tsc_ovl());
									
					
				}
				if(!$('.wrapper .loadingDiv').exists()){
					$('.tsc-overlay').prepend(loader_div());
				}
				$('.tsc_overlay .loadingDiv').hide().ajaxStart( function() {
					$(this).show();  // show Loading Div
					} ).ajaxStop ( function(){
					$(this).hide(); // hide loading div
				});
				
				//$('body').addClass('noscroll');
				return $('.tsc-overlay');
			}
		}
		
//	});
	
// bind to the submit event of our form
var postForm=function(form,url){
	//$(form).submit(function(event){
    // abort any pending request
    if (request) {
        request.abort();
    }
    // setup some local variables
    var $form = form;
    // let's select and cache all the fields
    var $inputs = $form.find("input, select, button, textarea");
    // serialize the data in the form
    var serializedData = $form.serialize();

    // let's disable the inputs for the duration of the ajax request
    $inputs.prop("disabled", true);
	tsc_overlay.getOverlay({loader_text:"Performing login action ..."});

    // fire off the request to /form.php
    request = $.ajax({
        url: url,
        type: "post",
        data: serializedData
    });

    // callback handler that will be called on success
    request.done(function (response, textStatus, jqXHR){
        // log a message to the console
		var ol=tsc_overlay.getOverlay();
		ol.html(response);
		tsc_overlay.reposition();
        console.log("Hooray, it worked! "+url);
    });

    // callback handler that will be called on failure
    request.fail(function (jqXHR, textStatus, errorThrown){
        // log the error to the console
        console.error(
            "The following error occured: "+
            textStatus, errorThrown
        );
    });

    // callback handler that will be called regardless
    // if the request failed or succeeded
    request.always(function () {
        // reenable the inputs
        $inputs.prop("disabled", false);
    });

    // prevent default posting of form
 //   event.preventDefault();
//});
//$(form).submit();
}
//} )( jQuery );








var _init=function(){
	
	var body    = $( 'body' ),
		_window = $( window );
	init_textarea();
		$('.sidebar-menu ul li').mouseenter(function(){
			$(this).children('ul').show('blind',{},'fast');
			
		});
		$('.sidebar-menu ul li').mouseleave(function(e) {
            $(this).children('ul').hide('blind',{},'fast');
        });
		$('.tsc-overlay i.close-btn').click(function(){
			$(".tsc-overlay").remove();
		});
	//$(document).pjax('a', '#pjax-container');
		$("a[data-type=ajax]").click(function(){
			//$(this).
			tsc_overlay.loadContent($(this).data("source"));
			//alert($(this).data("source"));
			return false;
		});
		
	$('.tsc-ajaxify form').submit(function(event){
		var action =$(this).data("action");
		tsc_overlay.postData($(this),action);
		 // prevent default posting of form
		event.preventDefault();
	});
	$(".self-login-button").click(function(){
		$('.third-party-login-div').hide();
		$('.self-login-div').show();
		return false;
	});
	$(".third-party-login-buttons").click(function(){
		$('.third-party-login-div').show();
		$('.self-login-div').hide();
		return false;
	});
		
	$("#show-list").click(function(){
		$('.tsc-product-image').removeClass("col-xs-12 col-sm-12  col-md-12",'slow').addClass("col-xs-3 col-sm-3  col-md-2",'slow');
		$('.tsc-product-list').addClass("row",'slow').removeClass("col-xs-12 col-sm-2 col-md-4  ",'slow');
		$('.tsc-products-ul').removeClass("row",'slow');
		$('.tsc-product-detail').removeClass('col-xs-12 col-sm-12 col-md-12','slow').addClass('col-xs-9 col-sm-9 col-md-10','slow');
		$('.tsc-product-title').removeClass('col-xs-12','slow').addClass('col-xs-9','slow');
		$('.tsc-product-button').removeClass('col-xs-12','slow').addClass('col-xs-3','slow');
	});
	$("#show-large").click(function(){
		$('.tsc-product-image').addClass("col-xs-12 col-sm-12  col-md-12",'slow').removeClass("col-xs-3 col-sm-3  col-md-2",'slow');
		$('.tsc-product-list').removeClass("row",'slow').addClass("col-xs-12 col-sm-2 col-md-4",'slow');
		$('.tsc-products-ul').addClass("row",'slow');
		$('.tsc-product-detail').addClass('col-xs-12 col-sm-12 col-md-12','slow').removeClass('col-xs-9 col-sm-9 col-md-10','slow');
		$('.tsc-product-title').removeClass('col-xs-9','slow').addClass('col-xs-12','slow');
		$('.tsc-product-button').removeClass('col-xs-3','slow').addClass('col-xs-12','slow');
	});
	
	$("a[href*=#]").click(function(event){
         event.preventDefault();
         //calculate destination place
         var dest=0;
         if($(this.hash).offset().top > $(document).height()-$(window).height()){
              dest=$(document).height()-$(window).height();
         }else{
              dest=$(this.hash).offset().top;
         }
		 var hashObj=$(this.hash);
		 var highlightDest=function(){
			var options={color:"#ff0000"};
			//hashObj.css({display:"inline-block", color:"#ff0000"});
			 hashObj.effect( "highlight", 1000 );
		 };
         //go to destination
         $('html,body').animate({scrollTop:dest}, 600,'swing', highlightDest());
		 
		 
     });
	
	$('.go-to-top').click(function(){
		$('html,body').animate({scrollTop:0}, 600,'swing');
		
	});
		Response.resize();
		$(window).resize(function(){
			//Response.resize();
		});
		_window.scroll(function() {
			if(Response.isXs()){
				fixNavbar.onMobile();
				
			}else if(Response.isSm()||Response.isMd()||Response.isLg()){
				fixNavbar.onDesktop();
				
			}
			
			});
		
		$('textarea, auto-height').keyup(function(){
			
		});
		
		//$('.left-menu-sx').show();
		if(Response.isXs()){
				var left_menu = new Snap({
			  element:document.getElementById('snap-content')
			});
			 $('.snap-left').click(function(){
				 left_menu.open('left');
				 return false;
			 });
		}	
} // var _init()


// Auto resize textview
var observe;
if (window.attachEvent) {
    observe = function (element, event, handler) {
        element.attachEvent('on'+event, handler);
    };
}
else {
    observe = function (element, event, handler) {
        element.addEventListener(event, handler, false);
    };
}
function init_textarea () {
    var text = document.getElementsByTagName('textarea')[0];
    function resize () {
        //text.style.height = 'auto';
        text.style.height = text.scrollHeight+'px';
    }
    /* 0-timeout to get the already changed text */
    function delayedResize () {
        window.setTimeout(resize, 0);
    }
    observe(text, 'change',  resize);
    observe(text, 'cut',     delayedResize);
    observe(text, 'paste',   delayedResize);
    observe(text, 'drop',    delayedResize);
    observe(text, 'keydown', delayedResize);

    text.focus();
    text.select();
    resize();
}