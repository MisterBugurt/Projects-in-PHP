@extends('layout.main')

@section('content')

    <H1>Create page</H1>
<hr>
<div>
    <form action="{{  route('worker.update', $worker->id) }}" method="post">
        @csrf
        @method('Patch')
        @error('name')
        {{ $message }}
        @enderror
        <div style="margin-bottom: 15px;"><input type="text" name="name" placeholder="name"
                                                 value="{{ old('name') ?? $worker -> name }}"></div>
        @error('surname')
        {{ $message }}
        @enderror
        <div style="margin-bottom: 15px;"><input type="text" name="surname" placeholder="surname"
                                                 value="{{ old('surname') ?? $worker -> surname }}"></div>
        @error('email')
        {{ $message }}
        @enderror
        <div style="margin-bottom: 15px;"><input type="email" name="email" placeholder="email"
                                                 value="{{ old('email') ?? $worker -> email }}"></div>
        @error('age')
        {{ $message }}
        @enderror
        <div style="margin-bottom: 15px;"><input type="number" name="age" placeholder="age"
                                                 value="{{ old('age') ?? $worker -> age}}"></div>
        @error('description')
        {{ $message }}
        @enderror
        <div style="margin-bottom: 15px;"><textarea name="description" placeholder="description" >
                {{ old('age') ?? $worker->description }}
            </textarea></div>
        <div style="margin-bottom: 15px;">
            <input id="isMarried" type="checkbox" name="is_married"
                   {{ $worker->is_married ? 'checked' : '' }}
            >
            <label for="isMarried">is married</label>
        </div>
        <div style="margin-bottom: 15px;"><input type="submit" value="Обновить"></div>
    </form>
</div>
@endsection
