<style>

div.map table td
{
	width: {{ $size }}px;
	height: {{ $size }}px;
}

div.map table img
{
	width: {{ $size - 10 }}px;
	height: {{ $size - 10 }}px;
}

</style>

<div class="map">
	<table>

		@for($y = $map->getHeight() -1; $y >= 0; $y--)
		<tr>
			{{--<td class="y">{{ $y }}</td>--}}

			@for($x = 0; $x < $map->getWidth(); $x++)
			<td>
				@if($map->getStairsLocation()['x'] == $x && $map->getStairsLocation()['y'] == $y)
					<img src="/images/stairs.jpg" alt="stairs" />
				@elseif($map->getUnit($x, $y) instanceof Services\Game\Units\Unit)
					<img src="/images/{{ strtolower($map->getUnit($x, $y)) }}.jpg" alt="{{ strtolower($map->getUnit($x, $y)) }}" />
				@endif
			</td>
			@endfor

		</tr>
		@endfor

		{{--
		<tr>
			<td class="y x"></td>
			@for($x = 0; $x < $map->getWidth(); $x++)

			<td class="x">{{ $x }}</td>

			@endfor
		</tr>
		--}}

	</table>
</div>