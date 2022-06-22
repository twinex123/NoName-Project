            
    $(document).ready(function(){
        $(window).scroll(function(){
            var scroll = $(window).scrollTop();
            if (scroll > 10) {
                $(".navigation").css("transition" , "0.1s");
                $(".navigation").css("background" , "#222831");
                $(".navigation").css("top" , "0");
                $(".navigation").css("left" , "0");
                $(".navigation").css("margin-bottom" , "15px");
                $(".navigation").css("z-index", "1");
                $(".userBx").css("margin-left" , "10px");
                $(".userBx").css("margin-top" , "8px");
                $(".tools").css("margin-left" , "20px");
                $(".tools").css("margin-top" , "30px");
            }

            else{
                $(".navigation").css("background" , "transparent");  	
            }
        })
    })
