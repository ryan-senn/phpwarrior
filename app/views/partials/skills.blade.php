<h2>Warrior Skills</h2>

<ul>
	@foreach($skills as $skill)
	<li>
		<code>$this->{{ $skill }}</code>
		<span>{{ Services\Game\Skills\Skill::getDescription($skill) }}</span>
	</li>
	@endforeach
</ul>