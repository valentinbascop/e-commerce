@extends('backend.layout.base')

@section('content')

<div class="product-container">
  
<h1 class="title" colspan="3">Liste des utilisateurs</h1>

<table>
    <thead>
        <tr>
            <th>Nom</th>
            <th>Prénom</th>
            <th>Email</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($users as $user)
            <tr>
                <td>{{ $user->name }}</td>
                <td>{{ $user->firstname }}</td>
                <td>{{ $user->email }}</td>
                <td class="action-row">
                    <a href="{{ route('backend.users.edit', $user->id) }}"><i class="fa-solid fa-pen-to-square" style="color: #868fd5;"></i></a>
                    <form action="{{ route('backend.users.destroy', $user->id) }}" method="POST" style="display: inline-block;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="delete-button" style="background: none; border: none; cursor: pointer;">
                            <i class="fa-solid fa-trash" style="color: #ff000d;"></i>
                        </button>
                    </form>
                </td>
            </tr>
        @endforeach
    </tbody>
</table>


</div>
@endsection
