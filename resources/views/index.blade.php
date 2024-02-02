@extends('layouts.abiturents')
@section('content')
    <h1 class="text-center mb-5">Список абитурентов</h1>
    <div class="container">
        <div class="row justify-content-center mb-5">
            <div class="col-md-3 text-center">
                <form action="{{ route('abiturent.index') }}" method="get">
                    <label for="search" class="form-label">Поиск</label>
                    <input type="text" class="form-control" id="search" name="search" value="">
                    <button class="btn btn-success mt-2" type="submit">Найти</button>
                </form>
            </div>
        </div>
        <table class="table">
            <thead>
            <tr>
                <th scope="col" class="text-center"><a href="{{ route('abiturents.index', ['sort' => 'name', 'order' => $order]) }}">Имя</a></th>
                <th scope="col" class="text-center"><a href="{{ route('abiturents.index', ['sort' => 'surname', 'order' => $order]) }}">Фамилия</a></th>
                <th scope="col" class="text-center"><a href="{{ route('abiturents.index', ['sort' => 'group_number', 'order' => $order]) }}">Номер группы</a></th>
                <th scope="col" class="text-center"><a href="{{ route('abiturents.index', ['sort' => 'total_ege', 'order' => $order]) }}">Баллов</a></th>
            </tr>
            </thead>

            <tbody>
            @foreach($abiturents as $abiturent)
                <tr>
                    <td class="text-center"><a href="{{ route('abiturents.show', $abiturent->id) }}">{{$abiturent->name}}</a></td>
                    <td class="text-center">{{$abiturent->surname}}</td>
                    <td class="text-center">{{$abiturent->group_number}}</td>
                    <td class="text-center">{{$abiturent->total_ege}}</td>
                </tr>
            @endforeach
            </tbody>
        </table>
        <div>{{ $abiturents->links() }}</div>
    </div>
@endsection
