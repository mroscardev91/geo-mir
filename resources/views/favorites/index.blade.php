<h1>Favorits</h1>
<ul>
@foreach($favorites as $favorite)
    <li><a href="{{ route('favorites.show', $favorite->id) }}">Lloc: {{ $favorite->place->name }} | Usuari: {{ $favorite->user->name }}</a></li>
@endforeach
</ul>