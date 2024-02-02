@extends('layouts.app')

@section('content')
<div class="container">
    <h2 class="text-center mt-4 mb-4">Чтобы подать заявку в абитуренты заполните форму ниже</h2>
    @if(session()->has('success'))
        <div class="alert alert-success">
            {{ session()->get('success') }}
        </div>
    @endif
    <form action="{{ $abiturent ? url('/abiturents/' . $abiturent->id) : url('/abiturents') }}" method="POST">
        @if($abiturent)
            @method('PUT')
        @else
            @method('POST')
        @endif
        @csrf
        <div class="input-container mb-4">
            <label for="formControlEmail" class="form-label">Почта</label>
            <input type="text" class="form-control @error('email') is-invalid @enderror" id="formControlEmail" name="email" value="{{ $user->email }}" readonly>
            @error('email')
                <div class="alert alert-danger">{{ $message }}</div>
            @enderror
        </div>
        <div class="input-container mb-4">
            <label for="formControlName" class="form-label">Имя</label>
            <input type="text" class="form-control @error('name') is-invalid @enderror" name="name" id="formControlName" value="{{ $user->name }}">
            @error('name')
                <p class="text-danger">{{ $message }}</p>
            @enderror
        </div>
        <div class="input-container mb-4">
            <label for="formControlSurname" class="form-label">Фамилия</label>
            <input type="text" class="form-control @error('surname') is-invalid @enderror" name="surname" id="formControlSurname" value="{{ optional($abiturent)->surname }}">
            @error('surname')
                <p class="text-danger">{{ $message }}</p>
            @enderror
        </div>
        <div class="input-container mb-4">
            <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio" name="gender" id="inlineRadio1" value="0" checked>
                <label class="form-check-label" for="inlineRadio1">Мужской</label>
            </div>
            <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio" name="gender" id="inlineRadio2" value="1">
                <label class="form-check-label" for="inlineRadio2">Женский</label>
            </div>
            @error('gender')
                <p class="text-danger">{{ $message }}</p>
            @enderror
        </div>
        <div class="input-container mb-4">
            <label for="formControlGroupNumber" class="form-label">Номер группы</label>
            <input type="text" class="form-control @error('groupNumber') is-invalid @enderror" name="groupNumber" id="formControlGroupNumber" value="{{ optional($abiturent)->group_number }}">
            @error('groupNumber')
                <p class="text-danger">{{ $message }}</p>
            @enderror
        </div>
        <div class="input-container mb-4">
            <label for="formControlTotalEge" class="form-label">Сумма баллов ЕГЭ</label>
            <input type="text" class="form-control @error('totalEge') is-invalid @enderror" name="totalEge" id="formControlTotalEge" value="{{ optional($abiturent)->total_ege }}">
            @error('totalEge')
                <p class="text-danger">{{ $message }}</p>
            @enderror
        </div>
        <div class="input-container mb-4">
            <label for="formControlBirthday" class="form-label">Дата рождения</label>
            <input type="text" class="form-control @error('birthday') is-invalid @enderror" name="birthday" id="formControlBirthday" value="{{ optional($abiturent)->date_of_birth }}">
            @error('birthday')
                <p class="text-danger">{{ $message }}</p>
            @enderror
        </div>
        <div class="input-container mb-4">
            <label for="formControlPhone" class="form-label">Номер телефона</label>
            <input type="text" class="form-control @error('phone') is-invalid @enderror" name="phone" id="formControlPhone" value="{{ optional($abiturent)->phone_number }}">
            @error('phone')
                <p class="text-danger">{{ $message }}</p>
            @enderror
        </div>
        @if($abiturent)
            <button class="btn btn-primary" type="submit">Редактировать заявку</button>
        @else
            <button class="btn btn-primary" type="submit">Подать заявку</button>
        @endif
    </form>
    @can('view', $abiturent)
        <form action="{{ url('/abiturents/' . optional($abiturent)->id) }}" method="POST" class="mt-4">
            @method('DELETE')
            @csrf
            <button class="btn btn-danger">Удалить заявку</button>
        </form>
    @endcan
</div>
@endsection
