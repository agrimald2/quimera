@for($i=0; $i< count($array); $i++)

		{!! QrCode::size(200)->generate($array[$i]) !!}


@endfor

