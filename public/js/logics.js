
function handlebrowselogo(){
    var a = document.getElementById("logo_card");
    a.click();

}

function handlebrowseclick(){
    var z = document.getElementById("del_text").value;
    document.getElementById("del_text").click();
    if(z == 0){
        document.getElementById("del_text").value = 1;
        document.getElementById("edit_del").style.background = "#023550";


    }
    else if(z == 1){
        document.getElementById("del_text").value = 0;
        document.getElementById("edit_del").style.background = "#028b9e";
    }

    // alert(z);
}

function handlefontcolor(){
    var z = document.getElementById("color").value;
    document.getElementById("color").click();
    if(z == 0){
        document.getElementById("color").value = 1;
        document.getElementById("edit_color").style.background = "#023550";

    }
    else if(z == 1){
        document.getElementById("color").value = 0;
        document.getElementById("edit_color").style.background = "#028b9e";

    }

    // alert(z);
}



function handlefontstyle(){
    var z = document.getElementById("bold").value;
    document.getElementById("bold").click();
    if(z == 0){
        document.getElementById("bold").value = 1;
        document.getElementById("edit_bold").style.background = "#023550";
    }
    else if(z == 1){
        document.getElementById("bold").value = 0;
        document.getElementById("edit_bold").style.background = "#028b9e";

    }

    // alert(z);
}

function handlefontitalic(){
    var z = document.getElementById("italic").value;
    document.getElementById("italic").click();
    if(z == 0){
        document.getElementById("italic").value = 1;
        document.getElementById("edit_italic").style.background = "#023550";
    }
    else if(z == 1){
        document.getElementById("italic").value = 0;
        document.getElementById("edit_italic").style.background = "#028b9e";

    }

    // alert(z);
}


function handlefontunderline(){
    var z = document.getElementById("underline").value;
    document.getElementById("underline").click();
    if(z == 0){
        document.getElementById("underline").value = 1;
        document.getElementById("edit_underline").style.background = "#023550";
    }
    else if(z == 1){
        document.getElementById("underline").value = 0;
        document.getElementById("edit_underline").style.background = "#028b9e";

    }
}

function handlesizeclick(){
    var z = document.getElementById("size").value;
    document.getElementById("size").click();
    if(z == 0){
        document.getElementById("size").value = 1;
        document.getElementById("size_div").style.background = "#023550";
        document.getElementById("size_child").style.display = "block";


    }
    else if(z == 1){
        document.getElementById("size").value = 0;
        document.getElementById("size_div").style.background = "#028b9e";
        document.getElementById("size_child").style.display = "none";
    }

    // alert(z);
}

function handlefamilyclick(){
    var z = document.getElementById("family").value;
    document.getElementById("family").click();
    if(z == 0){
        document.getElementById("family").value = 1;
        document.getElementById("family_div").style.background = "#023550";
        document.getElementById("family_child").style.display = "block";


    }
    else if(z == 1){
        document.getElementById("family").value = 0;
        document.getElementById("family_div").style.background = "#028b9e";
        document.getElementById("family_child").style.display = "none";
    }

    // alert(z);
}




    $(document).ready(function(){

        $('.colors,.card_back,.fcolor').click(function(event){

            var f_color = $(this).css("background-color");
            if($("#color").val() == 1){
                $(".div").click(function () {
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


            if($("#color").val() == 0) {
                var abc = $(this).css("background-color");
                var xyz = $(this).css('background-image');
                // var  fcolorr = $(this).css("background-color");
                // alert('xyz');
                console.log(xyz);
                console.log($(this).attr('src'));

                // alert(abc);
                $('#myCanvas').css("background-color", abc);
                // $('#myCanvas .div').css("color", fcolorr);
                $('#myCanvas').css('background-image', "url("+$(this).attr('src')+")");

            }


        });



        $("#myCanvas").keyup(function(){
            // alert("abc");
            $('.div').draggable().resizable();
            // $('#myCanvas .div').draggable().resizable();
        });
        $("#myCanvas").click(function(){
            // alert("draggable class not ren");
            $('.logo_main').draggable().resizable();
        });

        // $(".div").focus(function(){
        //     $(this).css("border", "solid","5px");
        // });


        // if($(".mycanvas").click()){
            $("#edit_text").click(function(){
                // if($("#input_text").is(':checked')){
                    var textdiv = document.createElement("div");


                    var cla = document.createAttribute("class");
                    cla.value = "div";
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
                    $("#myCanvas").append(textdiv);

                    $('#input_text').attr('checked', false);
                    // alert("abc");
                $(".div").focus();
                // }
            });
        // }


        $("#logo_card").click(function() {
            // var img_val = $("#logo_card").val();
            // alert(img_val);
            if($("#logo_card").val() !== 0){
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
                logo_class.value = "logo_main";
                logo_div.setAttributeNode(logo_class);

                $("#myCanvas").append(logo_div);
                // $(".logo_main").append(imgdiv);

                $(".logo_main").focus();
            }

        });
    }); // end first function

// ===============================================================================================================

function readURL(event){
    var getImagePath = URL.createObjectURL(event.target.files[0]);
    $('.logo_main').css('background-image', 'url(' + getImagePath + ')');
    // $("#logo_url_input").val(getImagePath);
    document.getElementById('logo_url_input').src = getImagePath;
}



$(document).ready(function(){

    $("#bold").click(function () {
        if($("#bold").val() == 0){
            $(".div").click(function () {
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

        if($("#bold").val() == 1){
            $(".div").click(function () {
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

    $("#italic").click(function () {
        if($("#italic").val() == 0){
            $(".div").click(function () {
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

        if($("#italic").val() == 1){
            $(".div").click(function () {
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


    $("#underline").click(function () {
        if($("#underline").val() == 0){
            $(".div").click(function () {
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

        if($("#underline").val() == 1){
            $(".div").click(function () {
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


    $("#del_text").click(function(){
            if($("#del_text").val() == 0){
                $(".div,.logo_main").click(function () {

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

        if($("#del_text").val() == 1){
            $(".div,.logo_main").click(function () {
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



    $("#size").click(function () {
            $(".div").click(function () {
                // alert("abc");
                var ids = $(this).map(function() {
                    return this.id;
                }).get();
                // alert(ids);
                if($(this).is('#'+ids)) {
                    // $('#' + ids).click(function () {
                    // alert("hello ids");
                    var size_num = $("#size_items").val();
                    $(this).css("font-size", size_num);

                    // });
                }
            });

    });


    $("#family").click(function () {
            $(".div").click(function () {
                // alert("abc");
                var ids = $(this).map(function() {
                    return this.id;
                }).get();
                // alert(ids);
                if($(this).is('#'+ids)) {
                    // $('#' + ids).click(function () {
                    // alert("hello ids");
                    var family_num = $("#family_items").val();
                    $(this).css("font-family", family_num);

                    // });
                }
            });
    });


    $("#del_divs").click(function () {
        $("div").remove(".logo_main");
        $("div").remove(".div");

    });

    $("#back").click(function(){
        $(".flipper").css("transform","rotateY(180deg)");
        $("#back").toggle();
        $("#front").toggle();
        $(".save_back").toggle();
        $(".save").toggle();
        $(".pick_color_section_back").toggle();
        $(".pick_color_section").toggle();
        document.getElementById("card_heading").innerHTML = "Visiting Card Back Side";
    });
    $("#front").click(function(){
        $(".flipper").css("transform","rotateY(0deg)");
        $("#back").toggle();
        $("#front").toggle();
        $(".save_back").toggle();
        $(".save").toggle();
        $(".pick_color_section").toggle();
        $(".pick_color_section_back").toggle();
        document.getElementById("card_heading").innerHTML = "Visiting Card Front Side";
    });



});

$(function() {
    $("#btnSave").click(function() {
        var logo_url = $("#logo_url_input").attr("src");

        var image = new Image();
        image.src = logo_url;

        html2canvas($("#myCanvas"), {
            onrendered: function(canvas) {
                var can = theCanvas = canvas;
                if($("#logo_url_input").attr("src") !== '') {
                    var ctx = can.getContext("2d");
                    var x = $(".logo_main").css('left').replace(/[^-\d\.]/g, '');
                    var y = $(".logo_main").css('top').replace(/[^-\d\.]/g, '');
                    var width = $(".logo_main").css('width').replace(/[^-\d\.]/g, '');
                    var height = $(".logo_main").css('height').replace(/[^-\d\.]/g, '');

                    ctx.drawImage(image, x, y, width, height);
                }
                document.body.appendChild(can);

                // Convert and download as image
                // Canvas2Image.saveAsPNG(canvas);
                $("#img-out").append(canvas);


                var dataURL = canvas.toDataURL();

                $.ajax({
                    type: "POST",
                    url: "/saveImage",
                    data: {
                        imgBase64: dataURL,
                        contactId: $('#users').val(),
                        cardSide: $('#cardSide').val()
                    },
                    success: function (resp) {
                        $('#success').show();
                        setTimeout(function () {
                            window.location.reload();
                        },3000)
                    }
                });
                // Clean up
                //document.body.removeChild(canvas);
            }
        });
    });
});