@props(['type','color'])

<button type="{{ $type }}" style="padding: 8px; background-color:#008CBA; color:{{ $color }};">
    {{ $slot }}
</button>