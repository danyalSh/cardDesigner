$(document).ready(function(e) {
	$.noConflict();
		var $imageupload = $('.imageupload');
            $imageupload.imageupload();
			$(".rgb-class, .cmyk-class").numeric();
		/* Resize div code */
		$(".square").each(function () {
			$(this).resizable({
				handles: $(this).attr("data-id"),
				containment: "parent"
			});
		});
		
		/* Drag handle code */
		$("#drag1").draggable({
			containment: "#cardHTML",
			grid: [10,10],
			snap: "true",
			stop: function() {
				var offset = $(this).offset();
				console.log("TOp: "+ offset.top + " LEFT: "+offset.left)
			}
		}).resizable();
		$("#drag2").draggable({
			containment: "#cardHTML",
			grid: [10,10],
			snap: "true",
			stop: function() {
				var offset = $(this).offset();
				console.log("TOp: "+ offset.top + " LEFT: "+offset.left)
			}
		});
		$("#drag3").draggable({
			containment: "#cardHTML",
			grid: [10,10],
			snap: "true",
			stop: function() {
				var offset = $(this).offset();
				console.log("TOp: "+ offset.top + " LEFT: "+offset.left)
			}
		});
		$("#drag4").draggable({
			containment: "#cardHTML",
			grid: [10,10],
			snap: "true",
			stop: function() {
				var offset = $(this).offset();
				console.log("TOp: "+ offset.top + " LEFT: "+offset.left)
			}
		});
		$("#drag5").draggable({
			containment: "#cardHTML",
			grid: [10,10],
			snap: "true",
			stop: function() {
				var offset = $(this).offset();
				console.log("TOp: "+ offset.top + " LEFT: "+offset.left)
			}
		});
		$("#drag6").draggable({
			containment: "#cardHTML",
			grid: [10,10],
			snap: "true",
			stop: function() {
				var offset = $(this).offset();
				console.log("TOp: "+ offset.top + " LEFT: "+offset.left)
			}
		});
		$("#drag7").draggable({
			containment: "#cardHTML",
			grid: [10,10],
			snap: "true",
			stop: function() {
				var offset = $(this).offset();
				console.log("TOp: "+ offset.top + " LEFT: "+offset.left)
			}
		});
		$("#drag8").draggable({
			containment: "#cardHTML",
			grid: [10,10],
			snap: "true",
			stop: function() {
				var offset = $(this).offset();
				console.log("TOp: "+ offset.top + " LEFT: "+offset.left)
			}
		});
		$("#drag9").draggable({
			containment: "#cardHTML",
			grid: [10,10],
			snap: "true",
			stop: function() {
				var offset = $(this).offset();
				console.log("TOp: "+ offset.top + " LEFT: "+offset.left)
			}
		});
		$("#drag10").draggable({
			containment: "#cardHTML",
			grid: [10,10],
			snap: "true",
			stop: function() {
				var offset = $(this).offset();
				console.log("TOp: "+ offset.top + " LEFT: "+offset.left)
			}
		});
		$("#drag11").draggable({
			containment: "#cardHTML",
			grid: [10,10],
			snap: "true",
			stop: function() {
				var offset = $(this).offset();
				console.log("TOp: "+ offset.top + " LEFT: "+offset.left)
			}
		});
		$("#drag12").draggable({
			containment: "#cardHTML",
			grid: [10,10],
			snap: "true",
			stop: function() {
				var offset = $(this).offset();
				console.log("TOp: "+ offset.top + " LEFT: "+offset.left)
			}
		});


		$(document).on('change', '#theFile', function(){
			if($(this).val() != ''){
				setTimeout(function(){
					$("#imageView").find('img').css('max-width', '100%');
					$("#imageView").find('img').css({'position' : 'relative','width' : '100%', 'padding' : '0px'});
				}, 300);
				$('.default-text').addClass('hide');
			}
		});
		
		$(document).on('click', '.cancel', function(){
			$(".rgb-class, .cmyk-class,.hexa-class").val('');
			$('.card-div').css('background-color', 'rgb(255,255,255)');
			$("#bg_color").val('rgb(255,255,255)');
		});
		$(document).on('click', '.applyColor', function(){
			if($("#red").val() != '' || $("#green").val() != '' || $("#blue").val() != ''){
				var red = $("#red").val() > 0 ? $("#red").val() : 0;
				var green = $("#green").val() > 0 ? $("#green").val() : 0;
				var blue = $("#blue").val() > 0 ? $("#blue").val() : 0;
				$('.card-div').css('background-color', 'rgb('+red+','+green+','+blue+')');
				$("#bg_color").val('rgb('+red+','+green+','+blue+')');
			}
		});
		$(document).on('keyup', '.rgb-class', function(){
			if($(this).val() != ''){
				if ($(this).val() > 255) {
					$(this).val('255');
				}
			}
		});
		
		$(document).on('click', '.SimpleAction', function(){
			var fontStyle = $(this).attr('data-style');
			if($(this).closest('form').prev('p').hasClass(''+fontStyle+'')){
				$(this).closest('form').prev('p').removeClass(fontStyle);
			} else {
				$(this).closest('form').prev('p').addClass(fontStyle);
			}
		});
		$(document).on('change', '.font-size', function(){
			 var fontValue = $('option:selected', this).attr('label');
			 if($(this).closest('form').prev('p').hasClass('font-'+fontValue+'')){
				$(this).closest('form').prev('p').removeClass('font-'+fontValue+'');
			} else {
				$(this).closest('form').prev('p').alterClass('font-*', '');
				$(this).closest('form').prev('p').addClass('font-'+fontValue+'');
			}
		});
		$(document).on('change', '.font-family', function(){
			 var fontValue = $('option:selected', this).attr('label');
			 if($(this).closest('form').prev('p').hasClass('ff-'+fontValue+'')){
				$(this).closest('form').prev('p').removeClass('ff-'+fontValue+'');
			} else {
				$(this).closest('form').prev('p').alterClass('ff-*', '');
				$(this).closest('form').prev('p').addClass('ff-'+fontValue+'');
			}
		});
		$(document).on('mouseover', '.drag', function(){
			$(this).find('.cross').removeClass('hide');
		});
		$(document).on('mouseout', '.drag', function(){
			$(this).find('.cross').addClass('hide');
		});
		$(document).on('click', '.cross', function(){
			$(this).parent().parent().remove();
		});
		$(document).on('change', '#theFile', function(){
			if($(this).val() != ''){
				$('.crossImage').removeClass('hide');
			} else {
				$('.crossImage').addClass('hide');
			}
		});
		$(document).on('click', '.crossImage', function(){
			$('#theFile').val('');
			//$("#imageView").children('img').remove();
			$("#imageView").children('img').attr('src', ' ');
			$("#imageView").children('img').addClass('hide');
			$("#imageView").children('div').removeClass('hide');
			$("#imageView").find('.editImg').html('');
			$("#imageView").children('div').removeClass('hide');
			$(this).addClass('hide');
			$("#drag1").removeClass('change');
		});
		
		$(document).on('click', '.getData', function(){
			if (!window.selectedSide || window.selectedSide == undefined) {
				alert('please select card side...!')
			} else {
        $('.cross').addClass('hide');

        var formData = new FormData($('#cardTemplateForm')[0]);
        // var testArray = new Object();
        $('.change').map(function (index, element) {
          if ($(this).attr('id') != "drag1") {
            var parent = $(this).children('p');
            // testArray[$(this).attr('data-name')] = [parent.html()+'|'+$(this).attr('style')+'|'+parent.attr('class')];
            formData.append($(this).attr('data-name'), [parent.html() + '|' + $(this).attr('style') + '|' + parent.attr('class')]);

          }
        });
        if ($("#drag1").hasClass('change')) {
          // testArray['logo'] = [$("#theFile").val()+'|'+$("#drag1").attr('style')];
          formData.append("logo", [$("#theFile").val() + '|' + $("#drag1").attr('style')]);
        }


        $('#logo_left').val($('#drag1').css("left").replace('px', ''));
        $('#logo_top').val($('#drag1').css("top").replace('px', ''));
        $('#logo_width').val($('#drag1').css("width").replace('px', ''));
        $('#logo_height').val($('#drag1').css("height").replace('px', ''));


        // testArray['background'] = [$("#bg_color").val()+'|'+$("#bg_image").val()+'|'+$("#bg_repeat").val()];
        formData.append("background", [$("#bg_color").val() + '|' + $("#bg_image").val() + '|' + $("#bg_repeat").val()]);
        formData.append("se_company", $('.companies').val() ? $('.companies').val() : window.companyId ? window.companyId : '');
        formData.append("se_card_side", window.selectedSide);
        formData.append("se_card_html", $('#cardHTML').html() ? $('#cardHTML').html() : '');
        formData.append("isEdit", $('#isEdit').val() ? $('#isEdit').val() : '');
        formData.append("logo_image", $('#logo_image').val() ? $('#logo_image').val() : '');
        formData.append("logo_left", $('#logo_left').val() ? $('#logo_left').val() : '');
        formData.append("logo_top", $('#logo_top').val() ? $('#logo_top').val() : '');
        formData.append("logo_width", $('#logo_width').val() ? $('#logo_width').val() : '');
        formData.append("logo_height", $('#logo_height').val() ? $('#logo_height').val() : '');
        //
        // testArray['se_company'] = $('.companies').val() ? $('.companies').val() : window.companyId ? window.companyId : '';
        // testArray['se_card_side'] = $('#cardSide').val() ? $('#cardSide').val() : '';
        // testArray['se_card_html'] = $('#cardHTML').html() ? $('#cardHTML').html() : '';

        console.log(formData);
        $.ajax({
          url: '/process',
          type: 'POST',
          data: formData,
          // data: testArray,
          contentType: false,
          processData: false,
          success: function (response) {
            alert('done');
          }
        });
      }
		});
		$(document).on('change', "#theFile", function(){
			if($(this).val() != ''){
        $('#isEdit').val(0);
        $('#logo_image').val('');
        $('#logo_left').val('');
        $('#logo_top').val('');
				  $("#drag1").addClass('change');
			  } else {
				  $("#drag1").removeClass('change');
			  }
		});
		$(document).on('click', '.bg-image', function(){
			$('.card-div').css('background-image', 'url('+$(this).attr('src')+')');
			$('.card-div').css('background-size', '100% auto');
			$("#bg_image").val('url('+$(this).attr('src')+')');
			$("#bg_repeat").val('round');
		});
		$(document).on('click', '.removeBgImage', function(){
			$('.card-div').css('background-image', 'none');
			$("#bg_image").val('none');
			$("#bg_repeat").val('round');
		});
		
		
	});