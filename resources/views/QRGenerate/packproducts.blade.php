<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Inventario</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">
</head>
<body>
<div style="display:flex; width:100vw" class="row">
@for($i=0; $i< count($array); $i++)
	<div class="col-2" style="margin-bottom:1vh; margin-top:1vh">
		<div>
			<img src="https://quimerashoes.com/wp-content/uploads/2019/08/logo-1.png" width="172px" alt="">
		</div>
		<div style="border: 1px solid black; margin: 1px; height: 65px; width:170px; display:flex">
			<div style="width:63px; height:64px; border: 0.5px solid black">
				{!! QrCode::size(60)->generate($array[$i]['codigo']) !!}
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
				{{$array[$i]['codigo']}} <br>
				S/150.00
				<br>
				TALLA 36
			</div>	
		</div>
	</div>
@endfor
</div>
</body>
<style>
	body{
		font-family: 'Keep Calm'!important;
	}
	@font-face {
    font-family: "Keep Calm";
    src: url(../fonts/KeepCalm-Medium.ttf);
	}
</style>
</html>
