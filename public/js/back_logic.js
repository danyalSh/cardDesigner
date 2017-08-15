
function handlebrowselogo_back(){
    var a = document.getElementById("logo_card_back");
    a.click();

}

function handlebrowseclick_back(){
    var z = document.getElementById("del_text_back").value;
    document.getElementById("del_text_back").click();
    if(z == 0){
        document.getElementById("del_text_back").value = 1;
        document.getElementById("edit_del_back").style.background = "#023550";


    }
    else if(z == 1){
        document.getElementById("del_text_back").value = 0;
        document.getElementById("edit_del_back").style.background = "#028b9e";
    }

    // alert(z);
}

function handlefontcolor_back(){
    var z = document.getElementById("color_back").value;
    document.getElementById("color_back").click();
    if(z == 0){
        document.getElementById("color_back").value = 1;
        document.getElementById("edit_color_back").style.background = "#023550";

    }
    else if(z == 1){
        document.getElementById("color_back").value = 0;
        document.getElementById("edit_color_back").style.background = "#028b9e";

    }

    // alert(z);
}



function handlefontstyle_back(){
    var z = document.getElementById("bold_back").value;
    document.getElementById("bold_back").click();
    if(z == 0){
        document.getElementById("bold_back").value = 1;
        document.getElementById("edit_bold_back").style.background = "#023550";
    }
    else if(z == 1){
        document.getElementById("bold_back").value = 0;
        document.getElementById("edit_bold_back").style.background = "#028b9e";

    }

    // alert(z);
}

function handlefontitalic_back(){
    var z = document.getElementById("italic_back").value;
    document.getElementById("italic_back").click();
    if(z == 0){
        document.getElementById("italic_back").value = 1;
        document.getElementById("edit_italic_back").style.background = "#023550";
    }
    else if(z == 1){
        document.getElementById("italic_back").value = 0;
        document.getElementById("edit_italic_back").style.background = "#028b9e";

    }

    // alert(z);
}


function handlefontunderline_back(){
    var z = document.getElementById("underline_back").value;
    document.getElementById("underline_back").click();
    if(z == 0){
        document.getElementById("underline_back").value = 1;
        document.getElementById("edit_underline").style.background = "#023550";
    }
    else if(z == 1){
        document.getElementById("underline_back").value = 0;
        document.getElementById("edit_underline_back").style.background = "#028b9e";

    }
}

function handlesizeclick_back(){
    var z = document.getElementById("size_back").value;
    document.getElementById("size_back").click();
    if(z == 0){
        document.getElementById("size_back").value = 1;
        document.getElementById("size_div_back").style.background = "#023550";
        document.getElementById("size_child_back").style.display = "block";


    }
    else if(z == 1){
        document.getElementById("size_back").value = 0;
        document.getElementById("size_div_back").style.background = "#028b9e";
        document.getElementById("size_child_back").style.display = "none";
    }

    // alert(z);
}

function handlefamilyclick_back(){
    var z = document.getElementById("family_back").value;
    document.getElementById("family_back").click();
    if(z == 0){
        document.getElementById("family_back").value = 1;
        document.getElementById("family_div_back").style.background = "#023550";
        document.getElementById("family_child_back").style.display = "block";


    }
    else if(z == 1){
        document.getElementById("family_back").value = 0;
        document.getElementById("family_div_back").style.background = "#028b9e";
        document.getElementById("family_child_back").style.display = "none";
    }

    // alert(z);
}




$(document).ready(function(){

    $('.colors_back,.card_back_back,.fcolor_back').click(function(event){

        var f_color = $(this).css("background-color");
        if($("#color_back").val() == 1){
            $(".div_back").click(function () {
                // alert("abc");
                var ids = $(this).map(function() {
                    return this.id;
                }).get();
                // alert(ids);
                if($(this).is('#'+ids)) {
                    $("#"+ids).css("color", f_color);
                }
            });
        }


        if($("#color_back").val() == 0) {
            var abc = $(this).css("background-color");
            var xyz = $(this).css('background-image');
            // var  fcolorr = $(this).css("background-color");
            // alert('xyz');
            // alert(abc);
            $('#myCanvas_back').css("background-color", abc);
            // $('#myCanvas .div').css("color", fcolorr);
            $('#myCanvas_back').css('background-image', xyz);

        }


    });



    $("#myCanvas_back").keyup(function(){
        // alert("abc");
        $('.div_back').draggable().resizable();
        // $('#myCanvas .div').draggable().resizable();
    });
    $("#myCanvas_back").click(function(){
        // alert("draggable class not ren");
        $('.logo_main_back').draggable().resizable();
    });

    // $(".div").focus(function(){
    //     $(this).css("border", "solid","5px");
    // });


    // if($(".mycanvas").click()){
    $("#edit_text_back").click(function(){
        // if($("#input_text").is(':checked')){
        var textdiv = document.createElement("div");


        var cla = document.createAttribute("class");
        cla.value = "div_back";
        textdiv.setAttributeNode(cla);

        var div_id = document.createAttribute("id");
        var child_divs = $("#myCanvas div").length;
        for(var i=0; i<=child_divs; i++){
            div_id.value = "myid_"+i;
            textdiv.setAttributeNode(div_id);

        }

        var att = document.createAttribute("contenteditable");
        att.value = "true";
        textdiv.setAttributeNode(att);
        textdiv.innerHTML = "&nbsp;";
        $("#myCanvas_back").append(textdiv);

        $('#input_text_back').attr('checked', false);
        // alert("abc");
        $(".div_back").focus();
        // }
    });
    // }


    $("#logo_card_back").click(function() {
        // var img_val = $("#logo_card").val();
        // alert(img_val);
        if($("#logo_card_back").val() !== 0){
            // var imgdiv = document.createElement("img");
            var logo_div = document.createElement("div");
            // logo_div.innerHTML = "<img src='' id='logo' class=''>";

            // var logo_id = document.createAttribute("id");
            // logo_id.value = "logo";
            // imgdiv.setAttributeNode(logo_id);

            // var logo_div_id = document.createAttribute("id");
            // logo_div_id.value = "myid_98";
            // logo_div.setAttributeNode(logo_div_id);

            var logo_div_id = document.createAttribute("id");
            var logo_div_id_child = $("#myCanvas .logo_main").length;
            for(var b=0; b<=logo_div_id_child; b++){
                logo_div_id.value = "myid_"+b;
                logo_div.setAttributeNode(logo_div_id);

            }

            var logo_class = document.createAttribute("class");
            logo_class.value = "logo_main_back";
            logo_div.setAttributeNode(logo_class);

            $("#myCanvas_back").append(logo_div);
            // $(".logo_main").append(imgdiv);

            $(".logo_main_back").focus();
        }

    });
}); // end first function

// ===============================================================================================================

function readURL_back(event){
    var getImagePath = URL.createObjectURL(event.target.files[0]);
    $('.logo_main_back').css('background-image', 'url(' + getImagePath + ')');
    // $("#logo_url_input").val(getImagePath);
    document.getElementById('logo_url_input_back').src = getImagePath;
}



$(document).ready(function(){

    $("#bold_back").click(function () {
        if($("#bold_back").val() == 0){
            $(".div_back").click(function () {
                // alert("abc");
                var ids = $(this).map(function() {
                    return this.id;
                }).get();
                // alert(ids);
                if($(this).is('#'+ids)) {
                    // $('#' + ids).click(function () {
                    // alert("hello ids");
                    $(this).css("font-weight", "bolder");

                    // });
                }
            });
        }

        if($("#bold_back").val() == 1){
            $(".div_back").click(function () {
                // alert("abc");
                var ids = $(this).map(function() {
                    return this.id;
                }).get();
                // alert(ids);
                if($(this).is('#'+ids)) {
                    // $('#' + ids).keyup(function () {
                    // alert("hello ids");
                    $(this).css("font-weight", "lighter");
                    // });
                }
            });
        }
    });

    // ============================================== italic =================================================================

    $("#italic_back").click(function () {
        if($("#italic_back").val() == 0){
            $(".div_back").click(function () {
                // alert("abc");
                var ids = $(this).map(function() {
                    return this.id;
                }).get();
                // alert(ids);
                if($(this).is('#'+ids)) {
                    // $('#' + ids).keyup(function () {
                    // alert("hello ids");
                    $(this).css("font-style", "italic");

                    // });
                }
            });
        }

        if($("#italic_back").val() == 1){
            $(".div_back").click(function () {
                // alert("abc");
                var ids = $(this).map(function() {
                    return this.id;
                }).get();
                // alert(ids);
                if($(this).is('#'+ids)) {
                    // $('#' + ids).keyup(function () {
                    // alert("hello ids");
                    $(this).css("font-style", "normal");
                    // });
                }
            });
        }
    });

    // =================================================== underline ===========================================================


    $("#underline_back").click(function () {
        if($("#underline_back").val() == 0){
            $(".div_back").click(function () {
                // alert("abc");
                var ids = $(this).map(function() {
                    return this.id;
                }).get();
                // alert(ids);
                if($(this).is('#'+ids)) {
                    // $('#' + ids).keyup(function () {
                    // alert("hello ids");
                    $(this).css("text-decoration", "underline");

                    // });
                }
            });
        }

        if($("#underline_back").val() == 1){
            $(".div_back").click(function () {
                // alert("abc");
                var ids = $(this).map(function() {
                    return this.id;
                }).get();
                // alert(ids);
                if($(this).is('#'+ids)) {
                    // $('#' + ids).keyup(function () {
                    // alert("hello ids");
                    $(this).css("text-decoration", "none");
                    // });
                }
            });
        }
    });


    $("#del_text_back").click(function(){
        if($("#del_text_back").val() == 0){
            $(".div_back,.logo_main_back").click(function () {

                var ids = $(this).map(function() {
                    return this.id;
                }).get();
                if($(this).is('#'+ids)) {
                    $('#' + ids).click(function () {
                        $(this).css("display","none");

                    });
                }
            });
        }

        if($("#del_text_back").val() == 1){
            $(".div_back,.logo_main_back").click(function () {
                var ids = $(this).map(function() {
                    return this.id;
                }).get();
                if($(this).is('#'+ids)) {
                    $('#' + ids).click(function () {
                        $(this).css("display","block");

                    });
                }
            });
        }



        // =============================================================================================


        // if($("#del_text").val() == 0){
        //     $(".logo_main").click(function () {
        //
        //         var ids = $(this).map(function() {
        //             return this.id;
        //         }).get();
        //         if($(this).is('#'+ids)) {
        //             $('#' + ids).click(function () {
        //                 $(this).remove();
        //                 $("#logo").remove();
        //
        //             });
        //         }
        //     });
        // }



    });



    $("#size_back").click(function () {
        $(".div_back").click(function () {
            // alert("abc");
            var ids = $(this).map(function() {
                return this.id;
            }).get();
            // alert(ids);
            if($(this).is('#'+ids)) {
                // $('#' + ids).click(function () {
                // alert("hello ids");
                var size_num = $("#size_items_back").val();
                $(this).css("font-size", size_num);

                // });
            }
        });

    });


    $("#family_back").click(function () {
        $(".div_back").click(function () {
            // alert("abc");
            var ids = $(this).map(function() {
                return this.id;
            }).get();
            // alert(ids);
            if($(this).is('#'+ids)) {
                // $('#' + ids).click(function () {
                // alert("hello ids");
                var family_num = $("#family_items_back").val();
                $(this).css("font-family", family_num);

                // });
            }
        });
    });


    $("#del_divs_back").click(function () {
        $("div").remove(".logo_main");
        $("div").remove(".div");

    });

    $("#back").click(function(){
        $(".flipper").css("transform","rotateY(180deg)");
    });
    $("#front").click(function(){
        $(".flipper").css("transform","rotateY(0deg)");
    });



});

$(function() {
    $("#btnSave_back").click(function() {
        var logo_url = $("#logo_url_input_back").attr("src");

        var image = new Image();
        image.src = logo_url;

        html2canvas($("#myCanvas_back"), {
            onrendered: function(canvas) {
                var can = theCanvas = canvas;
                var ctx = can.getContext("2d");
                var x = $(".logo_main_back").css('left').replace(/[^-\d\.]/g, '');
                var y = $(".logo_main_back").css('top').replace(/[^-\d\.]/g, '');
                var width = $(".logo_main_back").css('width').replace(/[^-\d\.]/g, '');
                var height = $(".logo_main_back").css('height').replace(/[^-\d\.]/g, '');

                ctx.drawImage(image, x, y, width, height);
                document.body.appendChild(can);

                // Convert and download as image
                // Canvas2Image.saveAsPNG(canvas);
                $("#img-out_back").append(canvas);

                // Clean up
                //document.body.removeChild(canvas);
            }
        });
    });
});