@php
    $primary = collect($adminlte->menu())->filter(function ($item) {
        return isset($item['active']) && $item['active'] == 1;
    })->first();
    $secondary = collect($primary['submenu'])->filter(function ($item) {
        return isset($item['active']) && $item['active'] == 1;
    })->first();
@endphp

<h1>{{ $primary['text'] }}
    <small>{{ $secondary['text'] }}</small>
</h1>
<ol class="breadcrumb">
    <li><a href="{{ route("home") }}"><i class="fa fa-home"></i> Home</a></li>
    @if($slot->toHtml() && $slot->toHtml() != $secondary['text'])
        <li><a href="{{ $secondary['href'] }}">{{ $secondary['text'] }}</a></li>
        <li class="active">{{ $slot }}</li>
    @else
        <li class="active">{{ $secondary['text'] }}</li>
    @endif
</ol>
