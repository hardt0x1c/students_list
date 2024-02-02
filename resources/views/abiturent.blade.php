@extends('layouts.abiturents')

@section('content')
    <h1 class="text-center mb-5">Данные абитурента</h1>
    <div class="container">
        <p>Имя: {{ $abiturent->name }}</p>
        <p>Фамилия: {{ $abiturent->surname }}</p>
        <p>Пол: {{ $abiturent->gender === 0 ? 'Мужской' : 'Женский' }}</p>
        <p>Номер группы: {{ $abiturent->group_number }}</p>
        <p>Почта: {{ $abiturent->email }}</p>
        <p>Сумма баллов: {{ $abiturent->total_ege }}</p>
        <p>Дата рождения: {{ $abiturent->date_of_birth }}</p>
        <p>Номер телефона: {{ $abiturent->phone_number }}</p>
        <a href="{{ route('abiturents.index') }}" class="btn btn-primary">Назад</a>
    </div>
@endsection
