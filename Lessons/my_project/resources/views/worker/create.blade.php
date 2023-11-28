@extends('layout.main')

@section('content')

<H1>Create page</H1>
<hr>
<div>
    <form action="{{  route('worker.store') }}" method="post">
        @csrf
        @error('name')
        {{ $message }}
        @enderror
        <div style="margin-bottom: 15px;"><input type="text" name="name" placeholder="name" value="{{ old('name')}}"></div>
        @error('surname')
        {{ $message }}
        @enderror
        <div style="margin-bottom: 15px;"><input type="text" name="surname" placeholder="surname"  value="{{ old('surname')}}"></div>
        @error('email')
        {{ $message }}
        @enderror
        <div style="margin-bottom: 15px;"><input type="email" name="email" placeholder="email" value="{{ old('email')}}"></div>
        @error('age')
        {{ $message }}
        @enderror
        <div style="margin-bottom: 15px;"><input type="number" name="age" placeholder="age" value="{{ old('age')}}"></div>
        @error('description')
        {{ $message }}
        @enderror
        <div style="margin-bottom: 15px;"><textarea name="description" placeholder="description" >{{ old('description')}}</textarea></div>
        <div style="margin-bottom: 15px;">
            <input
                {{ old('is_married') == 'on' ? 'checked' : '' }}
                id="isMarried" type="checkbox" name="is_married">
            <label for="isMarried">is married</label>
        </div>
        <div style="margin-bottom: 15px;"><input type="submit" value="Добавить"></div>
    </form>
</div>
@endsection

