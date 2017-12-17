<div style="width:100%;height:75%;" >
<div class="row" style="width:100%;">
	<div class="text-center" style="background-color:inherit; width:30%;">
		<div class="tab">
			<button class="tablinks active" onclick="openCity(event, 'elemen')" id="defaultOpen">Elemen</button>
			<button class="tablinks" onclick="openCity(event, 'teks')">Teks</button>
			<button class="tablinks" onclick="openCity(event, 'layer')">Layer</button>
		</div>
<div id="elemen" class="tabcontent">
	<form class="navbar-form mt-1" role="search">
	<div class="input-group">
		<input class="form-control" placeholder="Search" name="srch-term" id="srch-term" type="text">
		<div class="input-group-btn">
		<button class="btn btn-default" type="submit"><i class="glyphicon glyphicon-search"></i></button>
		</div>
	</div>
	</form>
	<div id="dvSource" class="mt-1" style="height:90%; width:100%; overflow : auto; background-color:white;z-index:2;">
		<img id="Koala" class="zoom" src="<?php echo base_url(); ?>images/Koala.jpg" />
		<img id="Koala" class="zoom" src="<?php echo base_url(); ?>images/layout/layout_1.jpg" />
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
