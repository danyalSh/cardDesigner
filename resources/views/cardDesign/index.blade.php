@extends('layouts1.body') @section('section')
  <link rel="stylesheet" href="{{asset('css/bootstrap.min.cc')}}">
  <link rel="stylesheet" href="{{ asset('assets/cardcss/query-ui.css') }}" />
  <script type="text/javascript" src="{{ asset('assets/js1/jquery.js') }}"></script>
  <script type="text/javascript" src="{{ asset('assets/js1/jquery-ui.js') }}"></script>
  <script type="text/javascript" src="{{ asset('assets/js1/touch-punch.min.js') }}"></script>
  <script src="{{ asset('assets/js1/bootstrap.min.js') }}"></script>
  <link href="{{ asset('assets/cardcss/bootstrap-imageupload.css') }}" rel="stylesheet">
  <link href="{{ asset('assets/cardcss/custom.css') }}" rel="stylesheet">
  <script src="{{ asset('assets/js1/angular.min.js') }}"></script>
  <script src="{{ asset('assets/cardjs/xeditable.js') }}"></script>
  <script src="{{ asset('assets/cardjs/bootstrap-imageupload.js') }}"></script>
  <script src="{{ asset('assets/cardjs/alterclass.js') }}"></script>
  <script src="{{ asset('assets/cardjs/numeric.js') }}"></script>
  <script src="{{ asset('assets/cardjs/w3color.js') }}"></script>
  {{--<link rel="stylesheet" href="{{ asset('assets/ruler/css/jquery.ui.ruler.css') }}" />--}}
  {{--<script src="{{ asset('assets/ruler/jquery.ui.ruler.js') }}"></script>--}}


  <link rel="stylesheet" href="{{ asset('assets/ruler2/styleRuler.css') }}" />
  <script src="{{ asset('assets/ruler2/jquery.ruler.js') }}"></script>
  <script src="{{ asset('assets/ruler2/modernizr-2.6.2.min.js') }}"></script>

  <script language="JavaScript">
    $(document).ready(function () {
      setTimeout(function(){
        $('.card-div').ruler();
      },300);
    });

    </script>
    <script>
    var app = angular.module("app", ["xeditable"]);
    app.run(function(editableOptions) {
      editableOptions.theme = 'bs3'; // bootstrap3 theme. Can be also 'bs2', 'default'
    });
    app.controller('Ctrl', function($scope) {
      $scope.company = 'Organization';
      $scope.cardSide = 1;
      $scope.cityState = 'City, State';
      $scope.phoneNumber = 'Telephone(office)';
      $scope.titleHeading = 'Name';
      $scope.titleText = 'Title 1';
      $scope.titleText2 = 'Title 2';
      $scope.mobileNumber = 'Mobile';
      $scope.fax = 'Fax';
      $scope.address1 = 'Address 1';
      $scope.address2 = 'Address 2';
      $scope.city = 'City, Country';
      $scope.webaddress = 'Web Address';
      $scope.myFunction = function(){
        if($('.editable-input').focus()){
          setTimeout(function(){
            $("#editor").show();
            $('#editor').clone().appendTo('.editable-buttons');
          }, 1000);
        }
      }
      $scope.myfunc = function(id){
        if (! id || id =='') {
          $scope.cardSide = 1;
        } else {
          $scope.cardSide = id;
        }
        console.log("card side: ", $scope.cardSide);
        var selectedSide = $scope.cardSide;
        window.selectedSide = $scope.cardSide;
        if (selectedSide  != '' ) {
          if (selectedSide == 1) {
            var settings = {
              "async": true,
              "crossDomain": true,
              "url": "/getFrontCard",
              "method": "GET",
              "headers": {
                "cache-control": "no-cache",
              }
            }
          } else {
            var settings = {
              "async": true,
              "crossDomain": true,
              "url": "/getBackCard",
              "method": "GET",
              "headers": {
                "cache-control": "no-cache",
              }
            }
          }
          $.ajax(settings).done(function (response) {
            console.log(response);
              $scope.company = 'Organization';
              $scope.cityState = 'City, State';
              $scope.phoneNumber = 'Telephone(office)';
              $scope.titleHeading = 'Name';
              $scope.titleText = 'Title 1';
              $scope.titleText2 = 'Title 2';
              $scope.mobileNumber = 'Mobile';
              $scope.fax = 'Fax';
              $scope.address1 = 'Address 1';
              $scope.address2 = 'Address 2';
              $scope.city = 'City, Country';
              $scope.webaddress = 'Web Address';
              $('.card-div').css('background-image', 'url()');
              $('#editImg').html('');
              $('#drag1').css('left', '395px');
              applyCss('#drag2', '5', '10');
              applyCss('#drag3', '5', '40');
              applyCss('#drag4', '5', '70');
              applyCss('#drag5', '5', '100');
              applyCss('#drag6', '5', '130');
              applyCss('#drag7', '5', '160');
              applyCss('#drag8', '5', '190');
              applyCss('#drag9', '5', '220');
//              applyCss('#drag10', '5', '250');
              applyCss('#drag11', '5', '250');
              applyCss('#drag12', '5', '280');
              $('.drag').children('p').attr('class', 'textArea');
              $('#imageView').find('.editImg').html('');
              $('.default-text').removeClass('hide');
              $('.crossImage').addClass('hide');
              $('.card-div').css('background-color', '');

              $scope.$apply();

            if(response.card == ''){
              return false;
            }

            var data = JSON.parse(response.card);
            console.log(data);
            $scope.company = (data.company) ? data.company.text : 'Organization';
            if($scope.company != 'Organization'){
                $('#drag8').show();
                $('#cb_organization').attr('checked', 'checked');
            }
            applyCss('#drag8', data.company && data.company.left ? data.company.left : '5', data.company && data.company.top ? data.company.top : '300');
            applyClass('#drag8', (data.company && data.company.fontweight) ? data.company.fontweight:'',
              (data.company && data.company.fontstyle) ? data.company.fontstyle:'',
              (data.company && data.company.textdecoration) ? data.company.textdecoration:'',
              (data.company && data.company.fontsize) ? 'font-'+data.company.fontsize:'',
              (data.company && data.company.fontfamily) ? data.company.fontfamily:'');

            $scope.phoneNumber = (data.phone) ? data.phone.text:'Telephone(office)';
            if($scope.phoneNumber != 'Telephone(office)'){
                $('#drag5').show();
                $('#cb_telephone').attr('checked', 'checked');
            }
            applyCss('#drag5', data.phone && (data.phone.left) ? data.phone.left:'5', data.phone && (data.phone.top) ? data.phone.top:'210');
            applyClass('#drag5', (data.phone && data.phone.fontweight) ? data.phone.fontweight:'',
              (data.phone && data.phone.fontstyle) ? data.phone.fontstyle:'',
              (data.phone && data.phone.textdecoration) ? data.phone.textdecoration:'',
              (data.phone && data.phone.fontsize) ? 'font-'+data.phone.fontsize:'',
              (data.phone && data.phone.fontfamily) ? data.phone.fontfamily:'');

            $scope.titleHeading = (data.heading) ? data.heading.text : 'Name';
            if($scope.titleHeading != 'Name'){
                $('#drag2').show();
                $('#cb_name').attr('checked', 'checked');
            }
            applyCss('#drag2', data.heading && (data.heading.left) ? data.heading.left : '5', data.heading && (data.heading.top) ? data.heading.top : '120');
            applyClass('#drag2', (data.heading && data.heading.fontweight) ? data.heading.fontweight:'',
              (data.heading && data.heading.fontstyle) ? data.heading.fontstyle:'',
              (data.heading && data.heading.textdecoration) ? data.heading.textdecoration:'',
              (data.heading && data.heading.fontsize) ? 'font-'+data.heading.fontsize:'',
              (data.heading && data.heading.fontfamily) ? data.heading.fontfamily:'');

            $scope.titleText = (data.title1) ? data.title1.text : 'Title 1';
            if($scope.titleText != 'Title 1'){
                $('#drag3').show()
                $('#cb_title1').attr('checked', 'checked');
            }
            applyCss('#drag3', data.title1 && (data.title1.left) ? data.title1.left:'5', data.title1 && (data.title1.top) ? data.title1.top:'150');
            applyClass('#drag3', (data.title1 && data.title1.fontweight) ? data.title1.fontweight:'',
              (data.title1 && data.title1.fontstyle) ? data.title1.fontstyle:'',
              (data.title1 && data.title1.textdecoration) ? data.title1.textdecoration:'',
              (data.title1 && data.title1.fontsize) ? 'font-'+data.title1.fontsize:'',
              (data.title1 && data.title1.fontfamily) ? data.title1.fontfamily:'');

            $scope.titleText2 = (data.title2) ? data.title2.text:'Title 2';
            if($scope.titleText2 != 'Title 2'){
                $('#drag4').show();
                $('#cb_title2').attr('checked', 'checked');
            }
            applyCss('#drag4', data.title2 && (data.title2.left) ? data.title2.left:'5', data.title2 && (data.title2.top) ? data.title2.top:'180');
            applyClass('#drag4', (data.title2 && data.title2.fontweight) ? data.title2.fontweight:'',
              (data.title2 && data.title2.fontstyle) ? data.title2.fontstyle:'',
              (data.title2 && data.title2.textdecoration) ? data.title2.textdecoration:'',
              (data.title2 && data.title2.fontsize) ? 'font-'+data.title2.fontsize:'',
              (data.title2 && data.title2.fontfamily) ? data.title2.fontfamily:'');

            $scope.mobileNumber = (data.mobile) ? data.mobile.text:'Mobile';
            if($scope.mobileNumber != 'Mobile'){
                $('#drag6').show();
                $('#cb_mobile').attr('checked', 'checked');
            }
            applyCss('#drag6', data.mobile && (data.mobile.left) ? data.mobile.left:'5', data.mobile && (data.mobile.top) ? data.mobile.top:'240');
            applyClass('#drag6', (data.mobile && data.mobile.fontweight) ? data.mobile.fontweight:'',
              (data.mobile && data.mobile.fontstyle) ? data.mobile.fontstyle:'',
              (data.mobile && data.mobile.textdecoration) ? data.mobile.textdecoration:'',
              (data.mobile && data.mobile.fontsize) ? 'font-'+data.mobile.fontsize:'',
              (data.mobile && data.mobile.fontfamily) ? data.mobile.fontfamily:'');

            $scope.fax = (data.fax) ? data.fax.text:'Fax';
            if($scope.fax != 'Fax'){
                $('#drag7').show();
                $('#cb_fax').attr('checked', 'checked');
            }
            applyCss('#drag7', data.fax && (data.fax.left) ? data.fax.left:'5', data.fax && (data.fax.top) ? data.fax.top:'270')
            applyClass('#drag7', (data.fax && data.fax.fontweight) ? data.fax.fontweight:'',
              (data.fax && data.fax.fontstyle) ? data.fax.fontstyle:'',
              (data.fax && data.fax.textdecoration) ? data.fax.textdecoration:'',
              (data.fax && data.fax.fontsize) ? 'font-'+data.fax.fontsize:'',
              (data.fax && data.fax.fontfamily) ? data.fax.fontfamily:'');

            $scope.address1 = (data.address1) ? data.address1.text:'Address 1';
            if($scope.address1 != 'Address 1'){
                $('#drag9').show();
                $('#cb_address1').attr('checked', 'checked');
            }
            applyCss('#drag9', data.address1 && (data.address1.left) ? data.address1.left:'5', data.address1 && (data.address1.top) ? data.address1.top:'330');
            applyClass('#drag9', (data.address1 && data.address1.fontweight) ? data.address1.fontweight:'',
              (data.address1 && data.address1.fontstyle) ? data.address1.fontstyle:'',
              (data.address1 && data.address1.textdecoration) ? data.address1.textdecoration:'',
              (data.address1 && data.address1.fontsize) ? 'font-'+data.address1.fontsize:'',
              (data.address1 && data.address1.fontfamily) ? data.address1.fontfamily:'');


            $scope.address2 = data.address2 && (data.address2) ? data.address2.text:'Address 2';
            if($scope.address2 != 'Address 2'){
                $('#drag10').show();
                $('#cb_address2').attr('checked', 'checked');
            }
            applyCss('#drag10', data.address2 && (data.address2.left) ? data.address2.left:'5', data.address2 && (data.address2.top) ? data.address2.top:'360');
            applyClass('#drag10', (data.address2 && data.address2.fontweight) ? data.address2.fontweight:'',
              (data.address2 && data.address2.fontstyle) ? data.address2.fontstyle:'',
              (data.address2 && data.address2.textdecoration) ? data.address2.textdecoration:'',
              (data.address2 && data.address2.fontsize) ? 'font-'+data.address2.fontsize:'',
              (data.address2 && data.address2.fontfamily) ? data.address2.fontfamily:'');

            $scope.city = (data.city) ? data.city.text:'City, Country';
            if($scope.city != 'City, Country'){
                $('#drag11').show();
                $('#cb_cityCountry').attr('checked', 'checked');
            }
            applyCss('#drag11', data.city && (data.city.left) ? data.city.left:'5', data.city &&  (data.city.top) ? data.city.top:'390');
            applyClass('#drag11', (data.city && data.city.fontweight) ? data.city.fontweight:'',
              (data.city && data.city.fontstyle) ? data.city.fontstyle:'',
              (data.city && data.city.textdecoration) ? data.city.textdecoration:'',
              (data.city && data.city.fontsize) ? 'font-'+data.city.fontsize:'',
              (data.city && data.city.fontfamily) ? data.city.fontfamily:'');

            $scope.webaddress = (data.webaddress) ? data.webaddress.text:'Web Address';
            if($scope.webaddress != 'Web Address'){
                $('#drag12').show();
                $('#cb_webAddress').attr('checked', 'checked');
            }
            applyCss('#drag12', data.webaddress &&  (data.webaddress.left) ? data.webaddress.left:'5', data.webaddress && (data.webaddress.top) ? data.webaddress.top:'420');
            applyClass('#drag12', (data.webaddress && data.webaddress.fontweight) ? data.webaddress.fontweight:'',
              (data.webaddress && data.webaddress.fontstyle) ? data.webaddress.fontstyle:'',
              (data.webaddress && data.webaddress.textdecoration) ? data.webaddress.textdecoration:'',
              (data.webaddress && data.webaddress.fontsize) ? 'font-'+data.webaddress.fontsize:'',
              (data.webaddress && data.webaddress.fontfamily) ? data.webaddress.fontfamily:'');

            if (data.background) {
//              alert(data.background.backgroundimage);
              $('.card-div').css('background-image', data.background.backgroundimage);
              $('.card-div').css('background-size', '100% auto');
              $("#bg_image").val(data.background.backgroundimage);
              $("#bg_repeat").val('round');
              $('.card-div').css({
                'background-color': data.background &&  data.background.backgroundcolor ?  data.background.backgroundcolor : '',
                'background-image': data.background && data.background.backgroundimage ? data.background.backgroundimage : '',
                'background-repeat': data.background && data.background.backgroundrepeat ? data.background.backgroundrepeat : ''
              });
            }
            console.log(data.logo);
            if(data.logo){
              $('#isEdit').val(1);
              $('#logo_image').val(data.logo.text);
              $('#logo_top').val(data.logo.top);
              $('#logo_left').val(data.logo.left);
              
              applyCss('#drag1', (data.logo && data.logo.left) ? data.logo.left:'500', (data.logo && data.logo.top) ? data.logo.top:'500');
              if(data.logo && data.logo.text){
                setTimeout(function(){
                  applyCss1('#drag1', data.logo.left, data.logo.top, data.logo.width, data.logo.height)
//                  $('#drag1').css('width', data.logo.width+'px !important');
//                  $('#drag1').css('height', data.logo.height+'px !important');
                }, 100);

                $('#imageView').find('.editImg').html('<img src="{{asset('images')}}/'+data.logo.text+'" />');
                $('.default-text').addClass('hide');
                $('.crossImage').removeClass('hide');
                setTimeout(function(){
                  $("#imageView").find('img').css('max-width', '100%');
                  $("#imageView").find('img').css({'position' : 'relative','width' : '100%', 'padding' : '0px'});
                }, 300);
              }
            }
            $scope.$apply();
          });
        }
      };
      $scope.showHideField = function(id){
          //console.log("field id: ", id);
          if(id != ''){
              $('#drag'+id).toggle();
          }
      };
      $scope.$watch('titleHeading', function(newValue, oldValue) {
        if($scope.titleHeading != 'Name'){
          $("#drag2").addClass('change');
        } else {
          $("#drag2").removeClass('change');
        }
      });
      $scope.$watch('titleText', function(newValue, oldValue) {
        if($scope.titleText != 'Title 1'){
          $("#drag3").addClass('change');
        } else {
          $("#drag3").removeClass('change');
        }
      });
      $scope.$watch('titleText2', function(newValue, oldValue) {
        if($scope.titleText2 != 'Title 2'){
          $("#drag4").addClass('change');
        } else {
          $("#drag4").removeClass('change');
        }
      });
      $scope.$watch('phoneNumber', function(newValue, oldValue) {
        if($scope.phoneNumber != 'Telephone(office)'){
          $("#drag5").addClass('change');
        } else {
          $("#drag5").removeClass('change');
        }
      });
      $scope.$watch('mobileNumber', function(newValue, oldValue) {
        if($scope.mobileNumber != 'Mobile'){
          $("#drag6").addClass('change');
        } else {
          $("#drag6").removeClass('change');
        }
      });
      $scope.$watch('fax', function(newValue, oldValue) {
        if($scope.fax != 'Fax'){
          $("#drag7").addClass('change');
        } else {
          $("#drag7").removeClass('change');
        }
      });
      $scope.$watch('company', function(newValue, oldValue) {
        if($scope.company != 'Organization'){
          $("#drag8").addClass('change');
        } else {
          $("#drag8").removeClass('change');
        }
      });
      $scope.$watch('address1', function(newValue, oldValue) {
        if($scope.address1 != 'Address 1'){
          $("#drag9").addClass('change');
        } else {
          $("#drag9").removeClass('change');
        }
      });
      $scope.$watch('address2', function(newValue, oldValue) {
        if($scope.address2 != 'Address 2'){
          $("#drag10").addClass('change');
        } else {
          $("#drag10").removeClass('change');
        }
      });
      $scope.$watch('city', function(newValue, oldValue) {
        if($scope.city != 'City, Country'){
          $("#drag11").addClass('change');
        } else {
          $("#drag11").removeClass('change');
        }
      });
      $scope.$watch('webaddress', function(newValue, oldValue) {
        if($scope.webaddress != 'Web Address'){
          $("#drag12").addClass('change');
        } else {
          $("#drag12").removeClass('change');
        }
      });

      var applyCss = function(id,left,top){
        console.log(id);
        console.log(left);
        console.log(top);
        $(''+id+'').css({'left':''+left+'px', 'top':''+top+'px'});
      }
      
      var applyCss1 = function(id,left,top, width, height){
          console.log(id);
        console.log(left);
        console.log(top);
        $(''+id+'').css({'left':''+left+'px', 'top':''+top+'px', 'width':''+width+'px', 'height':''+height+'px'});
      }

      var applyClass = function(id,class1,class2,class3,class4,class5){
        if(class1 != ''){
          $(''+id+'').children('p').addClass(''+class1+'');
        }
        if(class2 != ''){
          $(''+id+'').children('p').addClass(''+class2+'');
        }
        if(class3 != ''){
          $(''+id+'').children('p').addClass(''+class3+'');
        }
        if(class4 != ''){
          $(''+id+'').children('p').addClass(''+class4+'');
        }
        if(class5 != ''){
          if(class5 == 'Source Sans Pro'){
            $(''+id+'').children('p').addClass('ff-source-sans');
          }else if(class5 == 'Comic Sans MS'){
            $(''+id+'').children('p').addClass('ff-comic-sans');
          } else {
            $(''+id+'').children('p').addClass('ff-'+class5+'');
          }
        }
      }


    });
    
    
    $(function () {
//      $( ".editImg" ).draggable().resizable();;
    })
    
  </script>
  <style>
    .ui-icon {
      height: 10px !important;
      width: 7px !important;
    }
    
    .cross {
      color: red;
      cursor: pointer;
      font-weight: bold !important;
      font-style: normal !important;
      font-family: inherit !important;
      padding-left: 10px;
      position: relative;
    }
    
    .crossImage {
      color: red;
      cursor: pointer;
      font-weight: bold;
      position: relative;
    }
    
    .bg-image {
      position: relative;
      width: 100%;
      padding: 5px;
      border: 1px solid grey;
      cursor: pointer;
    }
    
    .bg-image:hover {
      background-color: grey;
    }
  </style>
  
  
  
  @if(\Illuminate\Support\Facades\Auth::user()->hasRole('company_owner'))
    <script>window.companyId = '{{\Auth::user()->getCompanyId(\Auth::user()->id)->id}}';</script> @endif
  <div class="container" ng-app="app" ng-controller="Ctrl">

    <div class="row text-center">
      <h3 id="stepsHeading">Step 1: Logo Upload and Positioning</h3>
      <span id="counter" style="display:none;">1</span>
    </div>
    
    <div class="row">
      @if (isset($companies) && count($companies) > 0)
        <div class="col-md-3" style="margin-top: 20px">
          <label for="companies">Select Company:</label>
          <select name="" id="companies" class="form-control companies">
            <option value="">Select Company</option>
            @foreach($companies as $key => $val)
              <option value="{{$val->id}}">{{$val->name}}</option>
            @endforeach
          </select>
        </div>
      @endif
  
        <script>
          setTimeout(function(){
            $('#cardSide1').val(1);
          }, 2000);
        </script>
      <div class="col-md-3" style="margin-top: 20px; margin-bottom: 20px; display: none;" ng-init="myfunc()">
        <label for="users">Select Side:</label>
        <select name="" id="cardSide1" ng-change="myfunc()" ng-model="cardSide" class="form-control">
          <option value="1" selected>Front Card</option>
          <option value="2">Back Card</option>
        </select>
      </div>
        <div class="col-md-2">&nbsp;&nbsp;&nbsp;</div>
        <div class="col-md-8">
          <div class="col-md-2" style="margin-top: 20px; margin-bottom: 20px; text-align: right; "  >
            <button type="button" class="btn btn-primary"  ng-click="myfunc(1)">
              Front
            </button>
          </div>
          <div class="col-md-2" style="margin-top: 20px; margin-bottom: 20px; text-align: left;"  >
            <button type="button" class="btn btn-primary" ng-click="myfunc(2)">
              Back
            </button>
          </div>


          <div class="col-md-5" style="margin-top: 20px; margin-bottom: 20px; text-align: right; ">
            <button type="button" class="btn btn-primary getData">
              Save
            </button>
          </div>

          <div class="col-md-2" style="margin-top: 20px; margin-bottom: 20px; text-align: left;"  >
            <button type="button" class="btn btn-primary showModal" data-toggle="modal" data-target="#myModal">
              Preview
            </button>
          </div>
        </div>


    </div>
  
    <script>
      $(function () {
        $('.showModal').on('click', function () {
          $('.hide').css('display', 'block !important');
//          if (selectedSide == 1) {
            var settings1 = {
              "async": true,
              "crossDomain": true,
              "url": "/getFrontCard",
              "method": "GET",
              "headers": {
                "cache-control": "no-cache",
              }
            }
            
            var settings2 = {
              "async": true,
              "crossDomain": true,
              "url": "/getBackCard",
              "method": "GET",
              "headers": {
                "cache-control": "no-cache",
              }
            }


          $.ajax(settings1).done(function (response) {
            if (response.htmlPreview == '') {
              $('#frontHtmlPreview').html('No Card Designed Yet');
              $('#frontHtmlPreview').addClass('ok');
            } else {
              $('#frontHtmlPreview').html(response.htmlPreview);
            }
            
            if(!$('#frontHtmlPreview #drag1 #imageView .thumbnail').length) { //hiding if there is no thumb
              $('#backHtmlPreview #drag1').hide();
            };

            var drag2front = ($('#frontHtmlPreview .card-div #drag2 .textArea').text()).replace('X', '');
            var drag3front = ($('#frontHtmlPreview .card-div #drag3 .textArea').text()).replace('X', '');
            var drag4front = ($('#frontHtmlPreview .card-div #drag4 .textArea').text()).replace('X', '');
            var drag5front = ($('#frontHtmlPreview .card-div #drag5 .textArea').text()).replace('X', '');
            var drag6front = ($('#frontHtmlPreview .card-div #drag6 .textArea').text()).replace('X', '');
            var drag7front = ($('#frontHtmlPreview .card-div #drag7 .textArea').text()).replace('X', '');
            var drag8front = ($('#frontHtmlPreview .card-div #drag8 .textArea').text()).replace('X', '');
            var drag9front = ($('#frontHtmlPreview .card-div #drag9 .textArea').text()).replace('X', '');
            var drag11front = ($('#frontHtmlPreview .card-div #drag11 .textArea').text()).replace('X', '');
            var drag12front = ($('#frontHtmlPreview .card-div #drag12 .textArea').text()).replace('X', '');
            
            if (drag2front.trim() == 'Name') {
              $('#frontHtmlPreview .card-div #drag2').hide()
            }
            if (drag3front.trim() == 'Title 1') {
              $('#frontHtmlPreview .card-div #drag3').hide()
            }
            if (drag4front.trim() == 'Title 2') {
              $('#frontHtmlPreview .card-div #drag4').hide()
            }
            if (drag5front.trim() == 'Telephone(office)') {
              $('#frontHtmlPreview .card-div #drag5').hide()
            }
            if (drag6front.trim() == 'Mobile') {
              $('#frontHtmlPreview .card-div #drag6').hide()
            }
            if (drag7front.trim() == 'Fax') {
              $('#frontHtmlPreview .card-div #drag7').hide()
            }
            if (drag8front.trim() == 'Organization') {
              $('#frontHtmlPreview .card-div #drag8').hide()
            }
            if (drag9front.trim() == 'Address 1') {
              $('#frontHtmlPreview .card-div #drag9').hide()
            }
            if (drag11front.trim() == 'City, Country') {
              $('#frontHtmlPreview .card-div #drag11').hide()
            }
            if (drag12front.trim() == 'Web Address') {
              $('#frontHtmlPreview .card-div #drag12').hide()
            }
            
          });

          $.ajax(settings2).done(function (response) {
            if (response.htmlPreview == '') {
              $('#backHtmlPreview').html('No Card Designed Yet');
            } else {
              $('#backHtmlPreview').html(response.htmlPreview);
            }
            
            
            if(!$('#backHtmlPreview #drag1 #imageView .thumbnail').length) { //hiding if there is no thumb
              $('#backHtmlPreview #drag1').hide();
            };
            
//
            var drag2back = ($('#backHtmlPreview .card-div #drag2 .textArea').text()).replace('X', '');
            var drag3back = ($('#backHtmlPreview .card-div #drag3 .textArea').text()).replace('X', '');
            var drag4back = ($('#backHtmlPreview .card-div #drag4 .textArea').text()).replace('X', '');
            var drag5back = ($('#backHtmlPreview .card-div #drag5 .textArea').text()).replace('X', '');
            var drag6back = ($('#backHtmlPreview .card-div #drag6 .textArea').text()).replace('X', '');
            var drag7back = ($('#backHtmlPreview .card-div #drag7 .textArea').text()).replace('X', '');
            var drag8back = ($('#backHtmlPreview .card-div #drag8 .textArea').text()).replace('X', '');
            var drag9back = ($('#backHtmlPreview .card-div #drag9 .textArea').text()).replace('X', '');
            var drag11back = ($('#backHtmlPreview .card-div #drag11 .textArea').text()).replace('X', '');
            var drag12back = ($('#backHtmlPreview .card-div #drag12 .textArea').text()).replace('X', '');

            if (drag2back.trim() == 'Name') {
              $('#backHtmlPreview .card-div #drag2').hide()
            }
            if (drag3back.trim() == 'Title 1') {
              $('#backHtmlPreview .card-div #drag3').hide()
            }
            if (drag4back.trim() == 'Title 2') {
              $('#backHtmlPreview .card-div #drag4').hide()
            }
            if (drag5back.trim() == 'Telephone(office)') {
              $('#backHtmlPreview .card-div #drag5').hide()
            }
            if (drag6back.trim() == 'Mobile') {
              $('#backHtmlPreview .card-div #drag6').hide()
            }
            if (drag7back.trim() == 'Fax') {
              $('#backHtmlPreview .card-div #drag7').hide()
            }
            if (drag8back.trim() == 'Organization') {
              $('#backHtmlPreview .card-div #drag8').hide()
            }
            if (drag9back.trim() == 'Address 1') {
              $('#backHtmlPreview .card-div #drag9').hide()
            }
            if (drag11back.trim() == 'City, Country') {
              $('#backHtmlPreview .card-div #drag11').hide()
            }
            if (drag12back.trim() == 'Web Address') {
              $('#backHtmlPreview .card-div #drag12').hide()
            }
//
          });
            
        })
      })
    </script>
    <style>
      
      #frontHtmlPreview .card-div #drag11 {
        left: 0px !important;
      }
 
      #frontHtmlPreview .card-div {
        min-height: 455px !important;
      }
      
      #frontHtmlPreview .col-md-8 {
        min-height: 360px !important;
        width: 630px !important;
      }
      #frontHtmlPreview .getData {
        display: none !important;
      }
      #frontHtmlPreview .card-div #drag1 .crossImage {
        display: none !important;
      }

      #frontHtmlPreview .card-div .thumbnail {
        border: none
      }

      #frontHtmlPreview #drag1 {
        box-shadow: none !important;
      }
      
      #frontHtmlPreview #myGridImg {
        background-image: none !important;
      }
     
      #backHtmlPreview .card-div #drag11 {
        left: 0px !important;
      }
  
      #backHtmlPreview .card-div {
        min-height: 455px !important;
      }
      
      #backHtmlPreview .col-md-8 {
        width: 100% !important;
      }

      #backHtmlPreview .getData {
        display: none !important;
      }
      
      #backHtmlPreview .card-div #drag1 .crossImage {
        display: none !important;
      }

      #backHtmlPreview .col-md-8 {
        min-height: 360px !important;
        width: 630px !important;
      }

      #backHtmlPreview .card-div .thumbnail {
        border: none
      }

      #backHtmlPreview #drag1 {
        box-shadow: none !important;
      }

      #backHtmlPreview #myGridImg {
        background-image: none !important;
      }
      
      .modal-dialog {
        width: 900px;
      }
      #cardHTML {
        position: relative;
      }
      #frontHtmlPreview .card-div .ruler{
        display: none;
      }
      #backHtmlPreview .card-div .ruler{
        display: none;
      }
    </style>
    {{--<div class="row" style="background-image:url('https://upload.wikimedia.org/wikipedia/commons/7/7c/Lightblue_empty_grid.svg');">--}}
    <div class="row" id="mainDiv"  style="height: 360px;">
      
      <div class="col-md-2" style="padding: 0px; width: 228px; background-color:white;">
        {{--<div class="col-md-12" style="padding:0px;">--}}
          {{--<table class="table table-bordered">--}}
            {{--<tbody>--}}
            {{--<tr>--}}
              {{--<th colspan="2">Corporate RGB</th>--}}
            {{--</tr>--}}
            {{--<tr>--}}
              {{--<th colspan="2">--}}
                {{--<ul id="tabDiv" class="nav nav-tabs">--}}
                  {{--<li class="active"><a href="javascript:;" class="tab-btn" data-div="rgb-sec">RGB</a></li>--}}
                  {{--<li class=""><a href="javascript:;" class="tab-btn" data-div="hexa-sec">Hexa</a></li>--}}
                  {{--<li class=""><a href="javascript:;" class="tab-btn" data-div="cmyk-sec">CMYK</a></li>--}}
                {{--</ul>--}}
              {{--</th>--}}
            {{--</tr>--}}
            {{--<tr class="rgb-sec">--}}
              {{--<th style="width:10%;">R</th>--}}
              {{--<td style="padding:0px;"><input type="tel" size="3" maxlength="3" class="form-control rgb-class" id="red" name="red" style="border:none;"--}}
                {{--/></td>--}}
            {{--</tr>--}}
            {{--<tr class="rgb-sec">--}}
              {{--<th style="width:10%;">G</th>--}}
              {{--<td style="padding:0px;"><input type="tel" size="3" maxlength="3" class="form-control rgb-class" id="green" name="green"--}}
                                              {{--style="border:none;" /></td>--}}
            {{--</tr>--}}
            {{--<tr class="rgb-sec">--}}
              {{--<th style="width:10%;">B</th>--}}
              {{--<td style="padding:0px;"><input type="tel" size="3" maxlength="3" class="form-control rgb-class" id="blue" name="blue"--}}
                                              {{--style="border:none;" /></td>--}}
            {{--</tr>--}}
            {{--<tr class="rgb-sec">--}}
              {{--<td style="width:100%;" colspan="2">--}}
                {{--<button type="button" class="btn btn-primary btn-sm applyColor">Apply</button>--}}
                {{--<button type="button" class="btn btn-default btn-sm cancel">Cancel</button>--}}
              {{--</td>--}}
            {{--</tr>--}}
            {{----}}
            {{----}}
            {{--<tr class="cmyk-sec hide">--}}
              {{--<th style="width:35%;">C in %</th>--}}
              {{--<td style="padding:0px;"><input type="tel" size="3" maxlength="3" class="form-control cmyk-class" id="c" name="c" style="border:none;"--}}
                {{--/></td>--}}
            {{--</tr>--}}
            {{--<tr class="cmyk-sec hide">--}}
              {{--<th style="width:20%;">M in %</th>--}}
              {{--<td style="padding:0px;"><input type="tel" size="3" maxlength="3" class="form-control cmyk-class" id="m" name="m" style="border:none;"--}}
                {{--/></td>--}}
            {{--</tr>--}}
            {{--<tr class="cmyk-sec hide">--}}
              {{--<th style="width:20%;">Y in %</th>--}}
              {{--<td style="padding:0px;"><input type="tel" size="3" maxlength="3" class="form-control cmyk-class" id="y" name="y" style="border:none;"--}}
                {{--/></td>--}}
            {{--</tr>--}}
            {{--<tr class="cmyk-sec hide">--}}
              {{--<th style="width:20%;">K in %</th>--}}
              {{--<td style="padding:0px;"><input type="tel" size="3" maxlength="3" class="form-control cmyk-class" id="k" name="k" style="border:none;"--}}
                {{--/></td>--}}
            {{--</tr>--}}
            {{--<tr class="cmyk-sec hide">--}}
              {{--<td style="width:100%;" colspan="2">--}}
                {{--<button type="button" class="btn btn-primary btn-sm applyCmykColor">Apply</button>--}}
                {{--<button type="button" class="btn btn-default btn-sm cancel">Cancel</button>--}}
              {{--</td>--}}
            {{--</tr>--}}
            {{----}}
            {{--<tr class="hexa-sec hide">--}}
              {{--<th style="width:10%;">HEXA</th>--}}
              {{--<td style="padding:0px;"><input type="tel" size="7" maxlength="7" class="form-control hexa-class" id="hexa" name="hexa"--}}
                                              {{--style="border:none;" /></td>--}}
            {{--</tr>--}}
            {{--<tr class="hexa-sec hide">--}}
              {{--<td style="width:100%;" colspan="2">--}}
                {{--<button type="button" class="btn btn-primary btn-sm applyHexaColor">Apply</button>--}}
                {{--<button type="button" class="btn btn-default btn-sm cancel">Cancel</button>--}}
              {{--</td>--}}
            {{--</tr>--}}
            {{----}}
            {{----}}
            {{--</tbody>--}}
          {{--</table>--}}
        {{--</div>--}}
        <div class="col-md-12" style="padding:0px; display:block; height: 500px;" id="componentsTable1">
<p><h4>Units: mm </br>
Digital Card Dimensions (DCD): </br>
Width x Height (mm) </br>
Ratios: </br> DCD : Canada/US </br>
             DCD : Japan </br>
             DCD : Hong Kong, China,      Singapore, Malaysia </br>
             DCD : ISO 216, A8 sized </br>
             DCD : ISO 216, C8 sized </br>
Or </br>
Country Standard Dimensions/Aspect Ratio Link (pop up of above ratios) </br>
Or </br>
Ratio Calculator: Insert card Width x Height</h4></p></div>
        <div class="col-md-12" style="padding:0px; display:none;" id="componentsTable">
          {{--<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">--}}
            {{--<form accept-charset="UTF-8" enctype="multipart/form-data" role="form" id="uploadImage" name="uploadImage" action="/saveBackgroundImage"--}}
                  {{--method="POST">--}}
              {{--<label for="ub">Upload Background (360 x 630)</label>--}}
              {{--<input type="file" id="ub" name="uploadImage" onchange="$('#uploadImage').submit()">--}}
            {{--</form>--}}
          {{--</div>--}}
          <table class="table table-bordered">
            <tbody>
            <tr>
              <th colspan="4">Select Elements</th>
            </tr>
            
            
            {{--@foreach($design as $key => $val)--}}
              {{--<tr>--}}
                {{--<td><img src="{{asset('assets/images/'.$val->card)}}" class="bg-image" alt=""></td>--}}
              {{--</tr>--}}
              {{--<tr>--}}
                {{--<td>--}}
                  {{--<p>--}}
                    {{--<input type="checkbox" id="checkbox_{{ $val->id }}" />--}}
                    {{--<label for="checkbox_{{ $val->id }}">Red</label>--}}
                  {{--</p>--}}
                {{--</td>--}}
              {{--</tr>--}}
            {{--@endforeach--}}

            {{-- Checkboxes --}}

            <tr>
              <td>
                <p>
                  <input type="checkbox" id="cb_organization" ng-click="showHideField(8)" />
                  <label for="cb_organization">Organization</label>
                </p>
              </td>
            </tr>

            <tr>
              <td>
                <p>
                  <input type="checkbox" id="cb_cityState" />
                  <label for="cb_cityState">City, State</label>
                </p>
              </td>
            </tr>

            <tr>
              <td>
                <p>
                  <input type="checkbox" id="cb_telephone" ng-click="showHideField(5)" />
                  <label for="cb_telephone">Telephone(office)</label>
                </p>
              </td>
            </tr>

            <tr>
              <td>
                <p>
                  <input type="checkbox" id="cb_name" ng-click="showHideField(2)" />
                  <label for="cb_name">Name</label>
                </p>
              </td>
            </tr>

            <tr>
              <td>
                <p>
                  <input type="checkbox" id="cb_title1" ng-click="showHideField(3)" />
                  <label for="cb_title1">Title 1</label>
                </p>
              </td>
            </tr>

            <tr>
              <td>
                <p>
                  <input type="checkbox" id="cb_title2" ng-click="showHideField(4)" />
                  <label for="cb_title2">Title 2</label>
                </p>
              </td>
            </tr>

            <tr>
              <td>
                <p>
                  <input type="checkbox" id="cb_mobile" ng-click="showHideField(6)" />
                  <label for="cb_mobile">Mobile</label>
                </p>
              </td>
            </tr>

            <tr>
              <td>
                <p>
                  <input type="checkbox" id="cb_fax" ng-click="showHideField(7)" />
                  <label for="cb_fax">Fax</label>
                </p>
              </td>
            </tr>

            <tr>
              <td>
                <p>
                  <input type="checkbox" id="cb_address1" ng-click="showHideField(9)" />
                  <label for="cb_address1">Address 1</label>
                </p>
              </td>
            </tr>

            <tr>
              <td>
                <p>
                  <input type="checkbox" id="cb_address2" />
                  <label for="cb_address2">Address 2</label>
                </p>
              </td>
            </tr>

            <tr>
              <td>
                <p>
                  <input type="checkbox" id="cb_cityCountry" ng-click="showHideField(11)" />
                  <label for="cb_cityCountry">City, Country</label>
                </p>
              </td>
            </tr>

            <tr>
              <td>
                <p>
                  <input type="checkbox" id="cb_webAddress" ng-click="showHideField(12)" />
                  <label for="cb_webAddress">Web Address</label>
                </p>
              </td>
            </tr>

            {{-- /Checkboxes --}}

            
            <td style="width:100%;" colspan="4">
              <button type="button" class="btn btn-default btn-sm removeBgImage">Cancel</button>
            </td>
            </tr>
            </tbody>
          </table>
          <input type="hidden" id="bg_color" value="rgb(255,255,255)" />
          <input type="hidden" id="bg_image" value="none" />
          <input type="hidden" id="bg_repeat" value="100% auto" />
        </div>
      
      </div>
  
      <input type="text" id="isEdit" style="display: none">
      <input type="text" id="logo_image" style="display: none">
      <input type="text" id="logo_left" style="display: none">
      <input type="text" id="logo_top" style="display: none">
      <input type="text" id="logo_width" style="display: none">
      <input type="text" id="logo_height" style="display: none">
      <style>
        #drag1 {
          z-index: 104;
        }
        #drag2 {
          z-index: 104;
        }
        #drag3 {
          z-index: 104;
        }
        #drag4 {
          z-index: 104;
        }
        #drag5 {
          z-index: 104;
        }
        #drag6 {
          z-index: 104;
        }
        #drag7 {
          z-index: 104;
        }
        #drag8 {
          z-index: 104;
        }
        #drag9 {
          z-index: 104;
        }
        #drag10 {
          z-index: 104;
        }
        #drag11 {
          z-index: 104;
        }
      </style>
      <div id="cardHTML">
        <span id="myGridImg" style="background-image: url(&quot;https://imgh.us/grid.svg&quot;); z-index: 100 !important; position: absolute; min-height: 360px; width: 630px; left: 21.5%"></span>
        <div class="col-md-8 card-div " data-w3-color="" style="min-height: 360px;width:630px;border:1px solid #CCC; left: 24px;">
          <div id="drag1" data-id="se" class="drag square " style="left:395px;top:20px;position:absolute;cursor:all-scroll;">
            <div style="text-align:center; height:100%; width:100%;">
              <div class="" id="imageView" style="max-height:250px; overflow:hidden;cursor:pointer;">
                <img src="" alt="Image preview" class="thumbnail1" id="imgPreview1" style="max-width: 250px; max-height: 250px; display:none;">
                <div class="editImg"></div>
                <div class="default-text">
                  {{--<span class="glyphicon glyphicon-picture" aria-hidden="true"></span>--}}
                  <br/>
                  <span>LOGO</span>
                </div>
                {{--<label class="btn btn-default btn-file hide">--}}
                  {{--<!-- The file is stored here. -->--}}
                  {{--<form action="" id="cardTemplateForm" accept-charset="UTF-8" enctype="multipart/form-data" role="form">--}}
                    {{--<input type="file" id="theFile" name="image" value="ahsan.png" />--}}
                  {{--</form>--}}
                {{--</label>--}}
              </div>
              <span class="crossImage hide" onclick="$('#isEdit').val('')">X</span>
            </div>
          </div>
          <div id="drag2" data-id="se" data-name="heading" class="drag square" style="left:5px;top:10px;position:absolute;cursor:all-scroll;display:none;">
            <p class="textArea" ng-click="myFunction()" editable-text="titleHeading">@{{ titleHeading }} <span class="cross hide">X</span></p>
          </div>
          <div id="drag3" data-id="se" data-name="title1" class="drag square" style="left:5px;top: 40px; px;position:absolute;cursor:all-scroll;display:none;">
            <p class="textArea" ng-click="myFunction()" editable-text="titleText">@{{ titleText }} <span class="cross hide">X</span></p>
          </div>
          <div id="drag4" data-id="se" data-name="title2" class="drag square" style="left:5px;top:70px;position:absolute;cursor:all-scroll;display:none;">
            <p class="textArea" ng-click="myFunction()" editable-text="titleText2">@{{ titleText2 || "" }} <span class="cross hide">X</span></p>
          </div>
          <div id="drag5" data-id="se" data-name="phone" class="drag square" style="left:5px;top: 100px;px;position:absolute;cursor:all-scroll;display:none;">
            <p class="textArea" ng-click="myFunction()" editable-text="phoneNumber">@{{ phoneNumber || "" }} <span class="cross hide">X</span></p>
          </div>
          <div id="drag6" data-id="se" data-name="mobile" class="drag square" style="left:5px;top:130px;position:absolute;cursor:all-scroll;display:none;">
            <p class="textArea" ng-click="myFunction()" editable-text="mobileNumber">@{{ mobileNumber || "" }} <span class="cross hide">X</span></p>
          </div>
          <div id="drag7" data-id="se" data-name="fax" class="drag square" style="left:5px;top:160px;position:absolute;cursor:all-scroll;display:none;">
            <p class="textArea" ng-click="myFunction()" editable-text="fax">@{{ fax || "" }} <span class="cross hide">X</span></p>
          </div>
          <div id="drag8" data-id="se" data-name="company" class="drag square" style="left:5px;top:190px;position:absolute;cursor:all-scroll;display:none;">
            <p class="textArea" ng-click="myFunction()" editable-text="company">@{{ company || "" }} <span class="cross hide">X</span></p>
          </div>
          <div id="drag9" data-id="se" data-name="address1" class="drag square" style="left:5px;top:220px;position:absolute;cursor:all-scroll;display:none;">
            <p class="textArea" ng-click="myFunction()" editable-text="address1">@{{ address1 || "" }} <span class="cross hide">X</span></p>
          </div>
          {{--
					<div id="drag10" data-id="se" data-name="address2" class="drag square" style="left:5px;top:360px;position:absolute;cursor:all-scroll;">--}} {{--
                    <p class="textArea" ng-click="myFunction()" editable-text="address2">@{{ address2 || "" }} <span class="cross hide">X</span></p>--}} {{--
                </div>--}}
          <div id="drag11" data-id="se" data-name="city" class="drag square" style="left:5px;top:250px;position:absolute;cursor:all-scroll;display:none;">
            <p class="textArea" ng-click="myFunction()" editable-text="city">@{{ city || "" }} <span class="cross hide">X</span></p>
          </div>
          <div id="drag12" data-id="se" data-name="webaddress" class="drag square" style="left:5px;top:280px;position:absolute;cursor:all-scroll;display:none;">
            <p class="textArea" ng-click="myFunction()" editable-text="webaddress">@{{ webaddress || "" }} <span class="cross hide">X</span></p>
          </div>
          {{--<div style="left:88%;position:absolute;top:94%;">--}}
            {{--<button type="button" class="btn btn-primary btn-sm getData" style="margin-top: 25px">Save Card</button>--}}
          </div>
        </div>
      </div>

    {{--<div class="col-md-2" style="margin-top: 50px; text-align: left;margin-left:10px;font-size:18px;">--}}
        {{--<p class="custom-file">Browse: </p>--}}
    {{--</div>--}}
    <div class="col-md-5" style="margin-top: 50px; text-align: left;">
      <form action="" id="cardTemplateForm" accept-charset="UTF-8" enctype="multipart/form-data" role="form">
        <div class="input-group">
          <label class="input-group-btn" >
              <span class="btn btn-primary" >
                  Browse <input type="file" id="theFile" name="image" value="ahsan.png" style="display: none;" >
              </span>
          </label>
          <input type="text" class="form-control" readonly>
        </div>
      </form>
    </div>
    <div class="col-md-2" style="margin-top: 50px; margin-bottom: 20px; text-align: right; "  >
      <button type="button" class="btn btn-primary" id="nextBtn" >
        Next
      </button>
    </div>

    <script>
        function readURL(input) {
            allowedFormats: [ 'jpg', 'jpeg', 'png', 'gif' ];
            if (input.files && input.files[0]) {
                // Check Image size and type

                if (input.files[0].size / 1024 > 2048)
                {
                    alert('File is too large (max 2048 kB).');
                    return;
                }

                // Check image format by file extension.
                var fileExtension = input.files[0].name.substr(input.files[0].name.lastIndexOf('.') + 1).toLowerCase();
//                var fileExtension = getFileExtension(input.files[0].name);
                if ($.inArray(fileExtension, [ 'jpg', 'jpeg', 'png', 'gif' ]) > -1) {
                    //callback(true, 'Image file is valid.');
                }
                else {
                    alert('File type is not allowed.');
                    return;
                }

                // Show Image Preview
                var reader = new FileReader();

                reader.onload = function (e) {
                    $('#imgPreview1').attr('src', e.target.result);
                    $('#imgPreview1').show();
                    $('#imgPreview1').removeClass('hide');
                    $('.crossImage').show();
                }

                reader.readAsDataURL(input.files[0]);
            }
        }

        $("#theFile").change(function(){
            $('#imgPreview1').attr('src', "");
            readURL(this);
        });

        $('#nextBtn').click(function (){
            var count = Number($('#counter').html());
            if(count < 5){
                $('#counter').html(count+1)
                if(count == 1){
                    $('#componentsTable').show();
                    $('#componentsTable1').hide();
                    $('#cardTemplateForm').hide();
                    $('#stepsHeading').html('Step 2: Select Business Card Fields');
                }
                if(count == 2){
                    $('#stepsHeading').html('Step 2: After Selection');
                }
                if(count == 3){
                    $('#stepsHeading').html('Step 2a: Business Card Fields Positioning');
                }
                if(count == 4){
                    $('#stepsHeading').html('Step 3: Select Font & Size');
                }
            }
        });
    </script>

  </div>
    
    <div class="hide">
      <div class="angular-meditor-toolbar" id="editor" style="position:absolute; display:none;">
        <ul style="margin-left: -37px;">
          <li>
            <button type="button" data-attr="font-weight" data-style="bold" class="meditor-button-bold SimpleAction">
              B
            </button>
          </li>
          <li>
            <button type="button" data-attr="font-style" data-style="italic" class="meditor-button-italic SimpleAction">
              I
            </button>
          </li>
          <li>
            <button type="button" data-attr="text-decoration" data-style="underline" class="meditor-button-underline SimpleAction">
              U
            </button>
          </li>
          <li>
            <label class="meditor-select">
              <select class="meditor-size-selector ng-valid ng-dirty font-size">
                <option value="0" label="10">10</option>
                <option value="1" label="13">13</option>
                <option value="2" label="16">16</option>
                <option value="3" label="18">18</option>
                <option value="4" label="24">24</option>
                <option value="5" label="32">32</option>
                <option value="6" label="48">48</option>
              </select>
            </label>
          </li>
          <li>
            <label class="meditor-select">
              <select class="meditor-family-selector ng-valid ng-dirty font-family">
                <option value="0" label="sans-serif">Sans serif</option>
                <option value="1" label="source-sans">Source Sans Pro</option>
                <option value="2" label="monospace">Monospace</option>
                <option value="3" label="serif">Serif</option>
                <option value="4" label="Arial">Arial</option>
                <option value="5" label="comic-sans">Comic Sans MS</option>
                <option value="6" label="Georgia">Georgia</option>
              </select>
            </label>
          </li>
        </ul>
      </div>
      
    </div>
  
    <!-- Modal -->
    <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title" id="myModalLabel">Card Preview</h4>
          </div>
          <div class="modal-body" style="height: 250px;">
          <div class="col-md-12">
              <h4>Card Front</h4>
            <div id="frontHtmlPreview"></div>
            <div id="img-out"></div>
            </div>
            <div class="col-md-12">
              <h4>Card Back</h4>
              <div id="backHtmlPreview"></div>
            </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            {{--<button type="button" class="btn btn-primary" onclick="saveAsImage()">Save changes</button>--}}
          </div>
        </div>
      </div>
    </div>
  
    <script>
      function saveAsImage(){
        html2canvas($("#frontHtmlPreview .card-div"), {
          onrendered: function(canvas) {
            theCanvas = canvas;
//            document.body.appendChild(canvas);
            console.log(canvas);
            // Convert and download as image
//            Canvas2Image.saveAsPNG(canvas);
//            console.log(canvas);
            $("#img-out").append(canvas);
            // Clean up
            //document.body.removeChild(canvas);
          }
        });
      }
    </script>
  
  </div>
  <script>
    $(document).ready(function(e) {
      $(document).on('click', '.tab-btn', function(event){
        $("#tabDiv li").removeClass('active');
        $(this).parent('li').addClass('active');
        var div = $(this).attr('data-div');
        if(div == 'rgb-sec'){
          $('.cmyk-sec, .hexa-sec').addClass('hide');
          $('.rgb-sec').removeClass('hide');
        }
        if(div == 'cmyk-sec'){
          $('.rgb-sec, .hexa-sec').addClass('hide');
          $('.cmyk-sec').removeClass('hide');
        }
        if(div == 'hexa-sec'){
          $('.cmyk-sec, .rgb-sec').addClass('hide');
          $('.hexa-sec').removeClass('hide');
        }
        event.preventDefault();
      });
      $(document).on('click', '.applyCmykColor', function(){
        if($("#c").val() != '' || $("#m").val() != '' || $("#y").val() != '' || $("#k").val() != ''){
          var cyan = $("#c").val() > 0 ? $("#c").val() : 0;
          var magenta = $("#m").val() > 0 ? $("#m").val() : 0;
          var yellow = $("#y").val() > 0 ? $("#y").val() : 0;
          var black = $("#k").val() > 0 ? $("#k").val() : 0;
          $('.card-div').attr('data-w3-color', 'cmyk('+cyan+'%,'+magenta+'%,'+yellow+'%,'+black+'%)');
          w3SetColorsByAttribute();
        }
      });
      $(document).on('click', '.applyHexaColor', function(){
        if($("#hexa").val() != ''){
          var cyan = $("#hexa").val();
          $('.card-div').css('background-color', ''+cyan+'');
          $("#bg_color").val(cyan);
        }
      });
      $(document).on('keyup', '.cmyk-class', function(){
        if($(this).val() != ''){
          if ($(this).val() > 100) {
            $(this).val('100');
          }
        }
      });

    });
  </script>
  <script src="{{ asset('assets/cardjs/custom.js') }}"></script>
  <script src="{{ asset('js/html2canvas.js') }}"></script>
  <script src="{{ asset('js/base64.js') }}"></script>
  <script src="{{ asset('js/canvas2image.js') }}"></script>
@endsection