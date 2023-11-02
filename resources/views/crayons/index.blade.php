@extends('layouts.app')

@section('content')
    <h1>Liste des crayons</h1>
    <form action="/recherche" method="post" style="float: left">
        @csrf
        Recherche <input type="text" id="texte" name="texte"> <input type="submit" id="recherche">
    </form>
    <div style="display:block; float:left; margin-left: 200px">
        <a href="/?page=random.blade.php">Choisir un crayon au hasard</a>
        <div>
            <?php
            if (array_key_exists('page', $_GET)) {
                $page = $_GET['page'];
                include_once($page);
            }
            ?>
        </div>
    </div>
    <table style="clear: both">
        <thead>
        <tr>
            <th>Nom</th>
            <th>Quantité</th>
            <th>Actions</th>
        </tr>
        </thead>
        <tbody>
        @foreach($crayons as $crayon)
            <tr>
                <td>{!! $crayon->nom !!}</td>
                <td>{!! $crayon->quantite !!}</td>
                <td>
                    <a href="{{ route('crayons.edit', $crayon->id) }}">Modifier</a>
                    <form action="{{ route('crayons.destroy', $crayon->id) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="submit">Supprimer</button>
                    </form>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>

    <a href="{{ route('crayons.create') }}">Ajouter un crayon</a>
@endsection
