@props([
	'type' => 'text',
	'icon' => null,
	'name',
	'placeHolder',
	'maxLength' => null,
	'value' => null,
])
<div {{ $attributes->merge([
		'class' => 'bg-base border-main border flex items-center'
	])}}>
    @if($icon)
		<span class="pl-2 md:pl-3">{{$icon}}</span>
	@endif
    <input class="bg-base px-2 py-3 grow outline-none placeholder-gray-400"
		type="{{$type}}"
		name="{{$name}}"
		@if($maxLength)maxlength="{{$maxLength}}"@endif
        placeholder="{{$placeHolder}}"
        value="{{$value}}"></input>
</div>
