		<div class="row" style="width:100%; height:100%">
		  <div class="text-center" style="background-color:inherit; width:30%; height:100%;">
		    <div class="tab">
					<button class="tablinks active" onclick="openCity(event, 'elemen')" id="defaultOpen">Elemen</button>
					<button class="tablinks" onclick="openCity(event, 'teks')">Teks</button>
					<button class="tablinks" onclick="openCity(event, 'layer')">Layer</button>
				</div>
		<div id="elemen" class="tabcontent">
		  <form class="navbar-form mt-3" role="search">
			<div class="input-group">
			  <input class="form-control" placeholder="Search" name="srch-term" id="srch-term" type="text">
			  <div class="input-group-btn">
				<button class="btn btn-default" type="submit"><i class="glyphicon glyphicon-search"></i></button>
			  </div>
			</div>
		  </form>
		  <div id="dvSource" class="mt-1" style="height:88%; width:100%; overflow : auto; background-color:white;z-index:2;">
				<img id="Koala1" class="zoom" src="<?php echo base_url(); ?>images/Koala.jpg" onclick="initialClick(this.id)" />
				<img id="Gliders1" class="zoom" src="<?php echo base_url(); ?>images/layout/layout_1.jpg" onclick="initialClick(this.id)" />
		  </div>
		</div>
		<div id="teks" class="tabcontent">
			<div class="mt-2">
				<select class="form-control" id="ffamily" onchange="changeFont()">
					<option value="AR Bonnie Medium" style="font-family:'AR Bonnie Medium';">AR Bonnie Medium</option>
					<option value="Arial" selected style="font-family:'Arial';">Arial</option>
					<option value="Century Gothic" style="font-family:'Century Gothic';">Century Gothic</option>
					<option value="Engravers Gothic BT" style="font-family:'Engravers Gothic BT';">Engravers Gothic BT</option>
				</select>
			</div>
			<div class="navbar-form mt-2">
				<div class="input-group">
					<input type="number" min=1 id="fsize" class="form-control" style="width:	30%;" value=20 onchange="changeSize()" oninput="validity.valid||(value='');">
					<input type="color" id="fcolorp" class="form-control" style="width:20%; height:40px" value="#000000" onchange="clickColor()">
					<input type="number" min=0 id="osize" class="form-control" style="width:	30%;" value=0 onchange="clickColorO()" oninput="validity.valid||(value='');">
					<input type="color" id="ocolorp" class="form-control" style="width:20%; height:40px" value="#000000" onchange="clickColorO()">
				</div>
			</div>
			<div id="textID" class="text-center mt-2" contenteditable="true" style="border:1px; height:'40px'; font-size:20px; font-family:'Arial'; color:#000000;-webkit-text-stroke:0px #000000;">
				Your Text Here
			</div>
		</div>
		<div id="layer" class="tabcontent">
		  <ul id="sortable" class="list-group mt-2">
				<li class="list-group-item"><span class="glyphicon glyphicon-sort"></span>Layer 1</li>
				<li class="list-group-item"><span class="glyphicon glyphicon-sort"></span>Layer 2</li>
				<li class="list-group-item"><span class="glyphicon glyphicon-sort"></span>Layer 3</li>
				<li class="list-group-item"><span class="glyphicon glyphicon-sort"></span>Layer 4</li>
				<li class="list-group-item"><span class="glyphicon glyphicon-sort"></span>Layer 5</li>
			</ul>
	</div>
	
          </div>
		  <div id="canvas" class="text-left" style="width:70%;z-index: 0; overflow:auto;">
			<div id="dvDest" style="width:<?php echo $w; ?>px; height:<?php echo $h; ?>px; background-color:white; overflow : none;z-index: 0; margin:auto; position:relative; top: <?php echo (550-$h)/2 ?>px;padding:0;">
				
			</div>
		  </div>
		</div>
    <script>
			
$(document).ready(function(){
    $('.zoom').hover(function() {
        $(this).addClass('transisi');
    }, function() {
        $(this).removeClass('transisi');
    });
});  
		document.getElementById("defaultOpen").click();
		$(function () {
					$("#dvSource img").draggable({
							drag: function (event, ui) {
									ui.helper.addClass("draggable");
							}
					}),
					$("#dvDest").droppable({
							drop: function (event, ui) {
								if ($("#dvDest img").length == 0) {
										$("#dvDest").html("");
								}
								ui.draggable.addClass("dropped");
								ui.draggable.removeClass("draggable");
								$(ui.draggable).clone().appendTo($(this));
								var a = ui.draggable.attr('id');
								var b = parseInt(a.replace(/[^0-9]/g, ''))+1;
								var c = a.replace(/[0-9]/g, '');
								ui.draggable.attr('id', c+(b.toString()));
								$("#"+a).attr('id', a+"_");
								remClass(a+"_");
							}
					}),
					$( "#sortable" ).sortable();
					$( "#sortable" ).disableSelection();
			});
			var moving = false;
			var scaling = false;
			var kratio = false;
			var rotating = false;
			var posx;
			var posy;
			var oposx;
			var oposy;
			var idx="";
			var width;
			var height;
			var rotate;
			function remClass(id){
				document.getElementById(id).className="";
			}
			function ikey(e){
				if (e.charCode==83 || e.charCode==115) {
					if(scaling){
						scaling = false;
						kratio = false;
						document.getElementById(idx).click();
					}else{
						scaling = true;
						rotating = false;
					}
				}else if(e.charCode==114){
					if(rotating){
						rotating = false;
						document.getElementById(idx).click();
					}else{
						rotating = true;
						scaling = false;
					}
				}else if(e.charCode==82){
					document.getElementById(idx).style.transform = "rotate(0deg)";
				}
				if (e.charCode==83){
					kratio = true;
				}
			}
			function move(e){
				var kla1 = document.getElementById(idx);
				if(scaling){
					var ha;
					var wa;
					if (kratio){
						ha = wa = ((e.clientX - posx)>(e.clientY - posy))?e.clientX - posx:e.clientY - posy;
					}else{
						ha = e.clientY - posy;
						wa = e.clientX - posx;
					}
					nwidth = width + wa;
					nheight = height + ha;
					nwidth = (nwidth>0)?nwidth:1;
					nheight = (nheight>0)?nheight:1;
					kla1.style.height = nheight.toString() + "px";
					kla1.style.width = nwidth.toString() + "px";
				}else if(rotating){
					var deg;
					deg = rotate+(e.clientY - posy);
					kla1.style.transform = "rotate("+deg+"deg)";
				}else{
					var newX = oposx + (e.clientX - posx);
					var newY = oposy + (e.clientY - posy);
					kla1.style.left = newX.toString() + "px";
					kla1.style.top = newY.toString() + "px";
				}		
			}

			function initialClick(id) {
				e = window.event;
				idx = id;
				var kla1 = document.getElementById(idx);
				if(idx.indexOf("_") != -1){
					if(moving){
						document.removeEventListener("mousemove", move);
						moving = !moving;
						scaling = false;
						kratio = false;
						idx = "";
					}else{
						if (kla1.style.top.length==0 || kla1.style.left.length==0){
							oposx = 0;
							oposy = 0;
						}else{
							oposx = parseInt(kla1.style.left.replace(/[^0-9]/g, ''));;
							oposy = parseInt(kla1.style.top.replace(/[^0-9]/g, ''));;
						}
						var trans = document.getElementById(idx).style.transform;
						rotate = (trans.length ==0)?0:parseInt(trans.replace(/[^0-9]/g, ''));;
						posx = e.clientX;
						posy = e.clientY;
						moving = !moving;
						image = this;
						width = kla1.width;
						height = kla1.height;
						document.addEventListener("keypress", ikey, false);
						document.addEventListener("mousemove", move, false);
					}
				}
			}
		function openCity(evt, cityName) {
			var i, tabcontent, tablinks;
			tabcontent = document.getElementsByClassName("tabcontent");
			for (i = 0; i < tabcontent.length; i++) {
				tabcontent[i].style.display = "none";
			}
			tablinks = document.getElementsByClassName("tablinks");
			for (i = 0; i < tablinks.length; i++) {
				tablinks[i].className = tablinks[i].className.replace(" active", "");
			}
			document.getElementById(cityName).style.display = "block";
			evt.currentTarget.className += " active";
		}
		var hh = 0;
		function changeFont() {
			typef = document.getElementById("ffamily").value;
			document.getElementById("textID").style.fontFamily = typef;
		}
		function changeSize() {
			size = document.getElementById("fsize").value;
			document.getElementById("textID").style.fontSize = size.toString()+"px";
		}
			function clickColor() {
				var c;
				c = document.getElementById("fcolorp").value;
				cObj = w3color(c);
    		colorhex = cObj.toHexString();
				document.getElementById("textID").style.color = cObj.toHexString();
			}
			function clickColorO() {
				var c;
				c = document.getElementById("ocolorp").value;
				d = document.getElementById("osize").value;
				cObj = w3color(c);
    		colorhex = cObj.toHexString();
				document.getElementById("textID").style.webkitTextStroke = d.toString()+"px "+cObj.toHexString();
			}
		</script>