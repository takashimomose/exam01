@extends('layouts.app')

@section('title', '登録画面') <!-- タイトルセクションを上書き -->

@push('css')
    <link rel="stylesheet" href="{{ asset('css/register.css') }}">
@endpush

@section('content')
    <div class="heading">
        <h2>Register</h2>
    </div>
    <div class="container">
        <div class="sub-container">
            <form class="login-form" action="{{ route('register') }}" method="POST">
                @csrf
                <div class="form-group">
                    <div class="form-sub-group">
                        <label for="name" class="form-label">お名前</label>
                        <input class="form-input" type="text" name="name" value="{{ old('name') }}"
                            placeholder="例: 山田　太郎">
                        @error('name')
                            <div class="error-message">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-sub-group">
                        <label for="email" class="form-label">メールアドレス</label>
                        <input class="form-input" type="email" name="email"
                            value="{{ old('email') }}"placeholder="例: test@example.com">
                        @error('email')
                            <div class="error-message">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-sub-group">
                        <label for="password" class="form-label">パスワード</label>
                        <input class="form-input" type="password" name="password" placeholder="例: coachtech1106">
                        @error('password')
                            <div class="error-message">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <button type="submit" class="register-button">登録</button>
            </form>
        </div>
    </div>
@endsection
