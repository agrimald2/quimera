
	<div style="border: 1px solid black; margin: 1px; height: 50px; width:150px; display:flex">
		<div style="width:50px; height:50px">
			{!! QrCode::size(50)->generate($array->codigo) !!}
		</div>	
		<div 
			style="
					font-size: 0.8rem;
    				width: 100px;
    				height: 50px;
    				font-weight: bolder;
    				padding: 5px;
				"
		>
			{{$array->name}}
			S/150
			<br>
			Talla 36
		</div>	
	</div>

