
jQuery(document).ready(function(e) {

/*1.0.27*/
      var s2s_insert = jQuery('.s2s_insert').html();
      if(s2s_insert == "1"){

        var s2s_clase = '.'+jQuery('.s2s_insert_element').html();
        //verify if element exists
        if(jQuery(s2s_clase).length){

          var  s2s_element = jQuery(s2s_clase);
          var contenidos = jQuery('.s2s_supra_contenedor').html();
          var s2s_insert_position = jQuery('.s2s_insert_position').html();

          if(s2s_insert_position=="0"){
            s2s_element.before('<div class="s2s_supra_contenedor_dummy"></div>');
          }else if(s2s_insert_position=="1"){
            s2s_element.after('<div class="s2s_supra_contenedor_dummy"></div>');
          }else if(s2s_insert_position=="2"){
            s2s_element.prepend('<div class="s2s_supra_contenedor_dummy"></div>');
          }else if(s2s_insert_position=="3"){
            s2s_element.append('<div class="s2s_supra_contenedor_dummy"></div>');
          }else{
            s2s_element.after('<div class="s2s_supra_contenedor_dummy"></div>');
          }

          jQuery('.s2s_supra_contenedor_dummy').append(contenidos);
          //quito el supra contenedor
          jQuery('.s2s_supra_contenedor').html('');
        }
      }
/*fin 1.0.27*/


    jQuery('.s2s_twitter').click(function(){
      buttons(this);
      if(checkCookie()) twitter();
    });
    jQuery('.s2s_facebook').click(function(e){
      buttons(this);
      if(checkCookie()) facebook();
    });
    jQuery('.s2s_pinterest').click(function(e){
      buttons(this);
      if(checkCookie()) pinterest();
    });
    jQuery('.s2s_linkedin').click(function(e){
      buttons(this);
      if(checkCookie()) linkedin(this);
    });
    jQuery('.s2s_gplus').click(function(e){
      buttons(this);
      if(checkCookie()) gplus();
    });
    jQuery('.s2s_tumblr').click(function(e){
      buttons(this);
      if(checkCookie()) tumblr();
    });
    jQuery('.s2s_vk').click(function(e){
      buttons(this);
      if(checkCookie()) vk();
    });

    jQuery('.s2s_cookie_contenedor').click(function(e){
      e.stopPropagation();
      cookieAccept();

      /*TODO find a more elegant way*/
      var callSocialFunction = jQuery(this).parent();
      if(callSocialFunction.hasClass('s2s_twitter_iframe')){
        twitter();
      }else if (callSocialFunction.hasClass('s2s_facebook_iframe')){
        facebook();
      }else if (callSocialFunction.hasClass('s2s_pinterest_iframe')){
        pinterest();
      }else if (callSocialFunction.hasClass('s2s_linkedin_iframe')){
        linkedin();
      }else if (callSocialFunction.hasClass('s2s_gplus_iframe')){
        gplus();
      }else if (callSocialFunction.hasClass('s2s_tumblr_iframe')){
        tumblr();
      }else if (callSocialFunction.hasClass('s2s_vk_iframe')){
        vk();
      }
    });
        jQuery('.s2s_cookie_information').click(function(e){
      e.stopPropagation();
      jQuery('.s2s_cookie_more_info').toggle('slow', function(e) {
        //end of animation
      });
    });
 //avoid propagation of cookie policy link
    jQuery('.s2s_cookie_read_policy a').click(function(e){
      e.stopPropagation();
    });
    jQuery('.s2s_cookie_copyright a').click(function(e){
      e.stopPropagation();
    });
   

    function buttons(boton){

      //var claseopen = jQuery('.s2s_twitter .globo').hasClass('s2sopen');
      var globo = jQuery(boton).children('div');
      //checkCookie();
      
      if(jQuery(boton).hasClass('active')){
        globo.fadeTo(330, 0, function(){ 
          globo.hide();
        });
        jQuery(boton).removeClass('active');
      }else{
        jQuery('.s2s_contenedor > div').removeClass('active');
        jQuery('.globo').hide();
        jQuery(boton).addClass('active');
        globo.fadeTo(330, 1, function(){});
      }
    }

    function twitter(){
        if(!jQuery('.s2s_twitter_iframe').hasClass('s2s_loaded')){
            jQuery('.s2s_twitter_iframe').addClass("s2s_loaded");
            is_on_screen(jQuery('.s2s_twitter_iframe'));

            !function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0],p=/^http:/.test(d.location)?'http':'https';
            if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src=p+'://platform.twitter.com/widgets.js';
            fjs.parentNode.insertBefore(js,fjs);}}(document, 'script', 'twitter-wjs');
        }
    }

    function facebook(){
      if(!jQuery('.s2s_facebook_iframe').hasClass('s2s_loaded')){
        jQuery('.s2s_facebook_iframe').addClass("s2s_loaded");
    
        var language =  jQuery('.s2s_facebook').attr('lang');
        is_on_screen(jQuery('.s2s_facebook_iframe'));
        language.replace("-", "_");
        (function(d, s, id) {
           var js, fjs = d.getElementsByTagName(s)[0];
          if (d.getElementById(id)) return;
          js = d.createElement(s); js.id = id;
          js.src = "//connect.facebook.net/"+language+"/sdk.js#xfbml=1&appId=514279921989553&version=v2.3";
          fjs.parentNode.insertBefore(js, fjs);
        }(document, 'script', 'facebook-jssdk'));
      }
    }


    function pinterest(){
      if(!jQuery('.s2s_pinterest_iframe').hasClass('s2s_loaded')){
        jQuery('.s2s_pinterest_iframe').addClass("s2s_loaded");
         is_on_screen(jQuery('.s2s_gplus_iframe'));

        (function(d){
          var f = d.getElementsByTagName('SCRIPT')[0], p = d.createElement('SCRIPT');
          p.type = 'text/javascript';
          p.async = true;
          p.src = '//assets.pinterest.com/js/pinit.js';
          f.parentNode.insertBefore(p, f);
        }(document));
      }
    }

    function linkedin(este){
      if(!jQuery('.s2s_linkedin_iframe').hasClass('s2s_loaded')){
        //jQuery('.s2s_linkedin_iframe').addClass("s2s_loaded");
        var language =  jQuery('.s2s_linkedin').attr('lang');
        is_on_screen(jQuery('.s2s_linkedin'));
        var linkedin_art_path = jQuery(este).children('.linkedin_art_path').val();
        jQuery.getScript('http://platform.linkedin.com/in.js');
      }
    }

    function gplus(){
      if(!jQuery('.s2s_gplus_iframe').hasClass('s2s_loaded')){
        jQuery('.s2s_gplus_iframe').addClass("s2s_loaded");

        is_on_screen(jQuery('.s2s_gplus_iframe'));

        var language =  jQuery('.s2s_gplus').attr('lang');

        window.___gcfg = {lang: language};
        (function() {
          var po = document.createElement('script'); po.type = 'text/javascript'; po.async = true;
          po.src = 'https://apis.google.com/js/plusone.js';
          var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(po, s);
        })(); 
      }
    }

    function tumblr(){
      if(!jQuery('.s2s_tumblr_iframe').hasClass('s2s_loaded')){
        jQuery('.s2s_tumblr_iframe').addClass("s2s_loaded");
        //var language =  jQuery('.s2s_linkedin').attr('lang');
        is_on_screen(jQuery('.s2s_tumblr_iframe'));
        
        //old
        //jQuery.getScript('http://platform.tumblr.com/v1/share.js');
        !function(d,s,id){
          var js,ajs=d.getElementsByTagName(s)[0];
          if(!d.getElementById(id)){
            js=d.createElement(s);js.id=id;js.src="https://secure.assets.tumblr.com/share-button.js";
            ajs.parentNode.insertBefore(js,ajs);
          }
        }(document, "script", "tumblr-js");
      }
    }

    function vk(){
      if(!jQuery('.s2s_vk_iframe').hasClass('s2s_loaded')){
        jQuery('.s2s_vk_iframe').addClass("s2s_loaded");
        //var language =  jQuery('.s2s_vk_iframe').attr('lang');
        is_on_screen(jQuery('.s2s_vk_iframe'));
        
        jQuery.getScript('http://vkontakte.ru/js/api/share.js?9', function() {         
          //document.getElementById('s2s_vk_iframe').innerHTML = VK.Share.button(document.URL, {type: 'link'});
        });
      }
    }

/*PRO*/

/*STUPID COOKIES*/
  function checkCookie(){
    var checkCookie = jQuery('.checkCookie').text().split("")[0];
    //if param activate
    if(checkCookie == "1"){

      var s2s_cookie=getCookie("s2s_cookie");
      var ccm_cookie=getCookie("ccm_cookies_accepted");
      //si la cookie existe
      if((s2s_cookie!=null && s2s_cookie!="") || (ccm_cookie!=null && ccm_cookie=="yes")){
        //alert("activada (true)");

        jQuery('.s2s_cookie_contenedor').hide();
        return true;
      }else{
        //alert("desactivada (false)");
        jQuery('.s2s_cookie_contenedor').show();
        return false;
      }
    }else{
      return true;
    }
  }

  function setCookie(c_name,value,exdays){
    var exdate=new Date();
    exdate.setDate(exdate.getDate() + exdays);
    var c_value=escape(value) + ((exdays==null) ? "" : "; expires="+exdate.toUTCString());
    document.cookie=c_name + "=" + c_value;
  }

  function getCookie(c_name){
    var c_value = document.cookie;
    var c_start = c_value.indexOf(" " + c_name + "=");
    if(c_start == -1){
      c_start = c_value.indexOf(c_name + "=");
    }
    if(c_start == -1){
      c_value = null;
    }else{
      c_start = c_value.indexOf("=", c_start) + 1;
      var c_end = c_value.indexOf(";", c_start);
      if (c_end == -1){
        c_end = c_value.length;
      }
      c_value = unescape(c_value.substring(c_start,c_end));
    }
    return c_value;
  }

  function cookieAccept(){
    //alert("cookie_aceptada");
    setCookie("s2s_cookie",1,365);
    jQuery('.s2s_cookie_contenedor').hide();

  }

  function is_on_screen(objeto){

    var obj_x = objeto.offset().left;
    var obj_y = objeto.offset().top;

    //variable obj w = obj.offsetWidth
    var obj_w = jQuery(objeto).outerWidth();
    //variable obj h = obj.offsetHeight
    var obj_h = jQuery(objeto).outerHeight();

    //variable window w = window.innerWidth
    var window_w = jQuery(window).width();
    //variable window h = window.innerHeight 
    var window_h = jQuery(window).height();

    var suma_obj_x = obj_x+obj_w;
    var suma_obj_y = obj_y+obj_h;

    var button_w = jQuery(objeto).parent('div.btn').children('a').outerWidth();

    var preventX = (obj_w-button_w)*-1;

    if(suma_obj_x < 0){
      //alert("fuera left");
    }else if(suma_obj_y < 0){
      //alert("fuera top");
    }else if(suma_obj_x > window_w){
      //objeto.addClass('preventOffscreenX');
      objeto.css('left', preventX); 
      objeto.addClass('is_on_screen');
    }else if(suma_obj_y > window_h){
      //alert("fuera bottom");
    }else{
      //objeto.css('left', 'inherit');
      objeto.css('left', 'inherit'); 
      objeto.removeClass('is_on_screen');
    }


  }



});

