@extends('layouts.app')

@section('title', 'ログイン画面') <!-- タイトルセクションを上書き -->

@push('css')
    <link rel="stylesheet" href="{{ asset('css/login.css') }}">
@endpush

@section('content')
    <div class="heading">
        <h2>Login</h2>
    </div>
    <div class="container">
        <div class="sub-container">
            <form class="login-form" action="{{ route('login') }}" method="POST">
                @csrf
                <div class="form-group">
                    <div class="form-sub-group">
                        <label for="email" class="form-label">メールアドレス</label>
                        <input class="form-input" type="email" name="email" value="{{ old('email') }}"
                            placeholder="例: test@example.com">
                        @error('email')
                            <div class="error-message">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-sub-group">
                        <label for="password" class="form-label">パスワード</label>
                        <input class="form-input" type="password" name="password" placeholder="例: coachtechni06">
                        @error('password')
                            <div class="error-message">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <button type="submit" class="login-button">ログイン</button>
            </form>
        </div>
    </div>
@endsection
