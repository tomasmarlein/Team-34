@extends('layouts.templatesnoshade')
@section('title', 'User update')
@section('css_after')
    <style>
        body, html {
            background-image:linear-gradient(rgba(0, 0, 0, 0.5), rgba(0, 0, 0, 0.5)), url("../assets/images/hero.jfif") ;
            background-repeat: no-repeat;
            background-attachment: fixed;
            background-size: cover;
            background-position: center;
            background-color: #443339 ;
            isolation: isolate;
        }



        #footer hr{
            height: 1px;
            background-color: #ccc;
            border: none;
        }
        main{
            min-height: 70vh;
        }
        h1, label{
            color: white;
        }

    </style>
@endsection

@section('main')
    <h1>Update profile</h1>
    @include('shared.alert')
    <form action="/user/profile" method="post">
        @csrf
        <div class="form-group">
            <label for="name">Naam</label>
            <input type="text" name="name" id="name"
                   class="form-control @error('name') is-invalid @enderror"
                   placeholder="Your name"
                   value="{{ old('name', auth()->user()->name ) }}"
                   required>
            @error('name')
            <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
        <div class="form-group">
            <label for="email">Email</label>
            <input type="email" name="email" id="email"
                   class="form-control @error('email') is-invalid @enderror"
                   placeholder="Your email"
                   value="{{ old('email', auth()->user()->email) }}"
                   required>
            @error('email')
            <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
        <button type="submit" class="btn btn-success">Update Profile</button>
    </form>
@endsection
@section('script_after')
    <script>
        $(document).ready(function () {
            $('div.hidden').fadeIn(2000).removeClass('hidden');
        });
    </script>
@endsection
