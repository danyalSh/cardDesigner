<div class="col-md-8 card-div " data-w3-color="" style="min-height:500px;border:1px solid #CCC; margin-top: 20px" >
	<div id="drag1" data-id="se" class="drag square imageupload panel panel-default" style="left:500px;top:100px;position:absolute;cursor:all-scroll;">
		<div style="text-align:center; height:100%; width:100%;" >
			<div class="file-tab panel-body" id="imageView" style="max-height:250px; overflow:hidden;cursor:pointer;">
				<div class="default-text" onClick="$('#theFile').click();">
					<span class="glyphicon glyphicon-picture" aria-hidden="true"></span>
					<br/>
					<span>Upload your logo</span>
				</div>
				<label class="btn btn-default btn-file hide">
					<!-- The file is stored here. -->
					<input type="file" id="theFile" name="image" />
				</label>
			</div>
			<span class="crossImage hide">X</span>
		</div>
	</div>
	<div id="drag2" data-id="se" data-name="heading" class="drag square" <?php
	if(isset($data->heading)){
	?>
	ng-init="titleHeading='<?= $data->heading->text;?>'"
	     style="left:<?= (isset($data->heading->left)) ? $data->heading->left.'px;':'5px;';?>position:absolute;top:<?= (isset($data->heading->top)) ? $data->heading->top.'px;':'120px;';?>cursor: all-scroll;"
	     <?php } else { ?> style="left:5px;top:120px;position:absolute;cursor:all-scroll;" <?php } ?>>
		<p <?php
		   if(isset($data->heading)){
		   ?>
		   class="textArea<?= (isset($data->heading->fontweight)) ? ' '.$data->heading->fontweight:'';?><?= (isset($data->heading->fontsize)) ? ' font-'.$data->heading->fontsize:'';?><?= (isset($data->heading->fontstyle)) ? ' '.$data->heading->fontstyle:'';?><?= (isset($data->heading->textdecoration)) ? ' '.$data->heading->textdecoration:'';?>"
		   style=" <?= (isset($data->heading->fontfamily)) ? 'font-family:'.$data->heading->fontfamily.';':'';?>
		   <?= (isset($data->heading->backgroundcolor)) ? 'background-color:'.$data->heading->backgroundcolor.';':'';?>
		   <?= (isset($data->heading->backgroundimage)) ? 'background-image:'.$data->heading->backgroundimage.';':'';?>
		   <?= (isset($data->heading->backgroundrepeat)) ? 'background-repeat:'.$data->heading->backgroundrepeat.';':'';?>"
		   <?php } ?>
		   ng-click="myFunction()" editable-text="titleHeading">@{{ titleHeading }} <span class="cross hide">X</span></p>
	</div>
	<div id="drag3" data-id="se" data-name="title1" class="drag square" style="left:5px;top:150px;position:absolute;cursor:all-scroll;">
		<p class="textArea" ng-click="myFunction()" editable-text="titleText">@{{ titleText }} <span class="cross hide">X</span></p>
	</div>
	<div id="drag4" data-id="se" data-name="title2" class="drag square" style="left:5px;top:180px;position:absolute;cursor:all-scroll;">
		<p class="textArea" ng-click="myFunction()" editable-text="titleText2">@{{ titleText2 || "" }} <span class="cross hide">X</span></p>
	</div>
	<div id="drag5" data-id="se" data-name="phone" class="drag square" style="left:5px;top:210px;position:absolute;cursor:all-scroll;">
		<p class="textArea" ng-click="myFunction()" editable-text="phoneNumber">@{{ phoneNumber || "" }} <span class="cross hide">X</span></p>
	</div>
	<div id="drag6" data-id="se" data-name="mobile" class="drag square" style="left:5px;top:240px;position:absolute;cursor:all-scroll;">
		<p class="textArea" ng-click="myFunction()" editable-text="mobileNumber">@{{ mobileNumber || "" }} <span class="cross hide">X</span></p>
	</div>
	<div id="drag7" data-id="se" data-name="fax" class="drag square" style="left:5px;top:270px;position:absolute;cursor:all-scroll;">
		<p class="textArea" ng-click="myFunction()" editable-text="fax">@{{ fax || "" }} <span class="cross hide">X</span></p>
	</div>
	<div id="drag8" data-id="se" data-name="company" class="drag square" style="left:5px;top:300px;position:absolute;cursor:all-scroll;">
		<p class="textArea" ng-click="myFunction()" editable-text="company">@{{ company || "" }} <span class="cross hide">X</span></p>
	</div>
	<div id="drag9" data-id="se" data-name="address1" class="drag square" style="left:5px;top:330px;position:absolute;cursor:all-scroll;">
		<p class="textArea" ng-click="myFunction()" editable-text="address1">@{{ address1 || "" }} <span class="cross hide">X</span></p>
	</div>
	<div id="drag10" data-id="se" data-name="address2" class="drag square" style="left:5px;top:360px;position:absolute;cursor:all-scroll;">
		<p class="textArea" ng-click="myFunction()" editable-text="address2">@{{ address2 || "" }} <span class="cross hide">X</span></p>
	</div>
	<div id="drag11" data-id="se" data-name="city" class="drag square" style="left:5px;top:390px;position:absolute;cursor:all-scroll;">
		<p class="textArea" ng-click="myFunction()" editable-text="city">@{{ city || "" }} <span class="cross hide">X</span></p>
	</div>
	<div id="drag12" data-id="se" data-name="webaddress" class="drag square" style="left:5px;top:420px;position:absolute;cursor:all-scroll;">
		<p class="textArea" ng-click="myFunction()" editable-text="webaddress">@{{ webaddress || "" }} <span class="cross hide">X</span></p>
	</div>
	<div style="left:88%;position:absolute;top:94%;">
		<button type="button" class="btn btn-default btn-sm getData">Save Card</button>
	</div>
</div>
</div>
<script>
	function reloadAngular() {
		console.log('reloading angular view'+JSON.stringify(app));
		app.controller('Ctrl', function ($scope) {
			$scope.reloadPage = function(){window.location.reload();}
		});
	}
</script>