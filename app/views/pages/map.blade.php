<div class="map">
	<table>

		@for($y = $map->getHeight() -1; $y >= 0; $y--)
		<tr>
			<td class="y">{{ $y }}</td>

			@for($x = 0; $x < $map->getWidth(); $x++)
			<td>
				@if($map->getStairsLocation()['x'] == $x && $map->getStairsLocation()['y'] == $y)
					<img src="/images/stairs.jpg" />
				@elseif($map->getUnit($x, $y) instanceof Services\Game\Units\Unit)
					<img src="/images/{{ strtolower($map->getUnit($x, $y)) }}.jpg" />
				@endif
			</td>
			@endfor

		</tr>
		@endfor

		<tr>
			<td class="y x"></td>
			@for($x = 0; $x < $map->getWidth(); $x++)

			<td class="x">{{ $x }}</td>

			@endfor
		</tr>

	</table>
</div>