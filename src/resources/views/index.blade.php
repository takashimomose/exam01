@extends('layouts.app')

@section('title', 'お問い合わせフォーム') <!-- タイトルセクションを上書き -->

@push('css')
    <link rel="stylesheet" href="{{ asset('css/index.css') }}" /> <!-- ページ用のCSS読み込み -->
@endpush

@section('content') <!-- コンテンツを指定 -->
    <div class="heading">
        <h2>Contact</h2>
    </div>
    <div class="container">
        <form class="inquiry-form" action="/confirm" method="post" novalidate>
            @csrf
            <div class="form-group">
                <div class="form-sub-group">
                    <label class="form-label">お名前<span class="form-label-sub">※</span></label>

                    <!-- Last Name Field -->
                    <input class="last-name" type="text" name="last_name" placeholder="例: 山田"
                        value="{{ old('last_name', $oldData['last_name'] ?? '') }}" />

                    @error('last_name')
                        <div class="error-message">{{ $message }}</div>
                    @enderror

                    <!-- First Name Field -->
                    <input class="first-name" type="text" name="first_name" placeholder="例: 太郎"
                        value="{{ old('first_name', $oldData['first_name'] ?? '') }}" />

                    @error('first_name')
                        <div class="error-message">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-sub-group">
                    <label class="form-label">性別<span class="form-label-sub">※</span></label>
                    <div class="gender-options">
                        <label class="accented">
                            <input class="form-radio" type="radio" name="gender" value="1"
                                {{ old('gender', $oldData['gender'] ?? '') == 1 ? 'checked' : '' }} checked />
                            男性
                        </label>
                        <label class="accented">
                            <input class="form-radio" type="radio" name="gender" value="2"
                                {{ old('gender', $oldData['gender'] ?? '') == 2 ? 'checked' : '' }} />
                            女性
                        </label>
                        <label class="accented">
                            <input class="form-radio" type="radio" name="gender" value="3"
                                {{ old('gender', $oldData['gender'] ?? '') == 3 ? 'checked' : '' }} />
                            その他
                        </label>

                        @error('gender')
                            <div class="error-message">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="form-sub-group">
                    <label class="form-label">メールアドレス<span class="form-label-sub">※</span></label>
                    <input class="form-input" type="email" name="email" placeholder="例: test@example.com"
                        value="{{ old('email', $oldData['email'] ?? '') }}" />

                    @error('email')
                        <div class="error-message">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-sub-group">
                    <label class="form-label">電話番号<span class="form-label-sub">※</span></label>
                    <input class="form-input" type="tel" name="tel_part1" placeholder="080"
                        value="{{ old('tel_part1', $oldData['tel_part1'] ?? '') }}" />
                    <span>-</span>
                    <input class="form-input" type="tel" name="tel_part2" placeholder="1234"
                        value="{{ old('tel_part2', $oldData['tel_part2'] ?? '') }}" />
                    <span>-</span>
                    <input class="form-input" type="tel" name="tel_part3" placeholder="5678"
                        value="{{ old('tel_part3', $oldData['tel_part3'] ?? '') }}" />

                    @error('tel_part1')
                        <div class="error-message">{{ $message }}</div>
                    @enderror
                    @error('tel_part2')
                        <div class="error-message">{{ $message }}</div>
                    @enderror
                    @error('tel_part3')
                        <div class="error-message">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-sub-group">
                    <label class="form-label">住所<span class="form-label-sub">※</span></label>
                    <input class="form-input" type="text" name="address" placeholder="例: 東京都渋谷区千駄ヶ谷1-2-3"
                        value="{{ old('address', $oldData['address'] ?? '') }}" />

                    @error('address')
                        <div class="error-message">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-sub-group">
                    <label class="form-label">建物名<span class="form-label-sub">　</span></label>
                    <input class="form-input" type="text" name="building" placeholder="例: 千駄ヶ谷マンション101"
                        value="{{ old('building', $oldData['building'] ?? '') }}" />
                </div>

                <div class="form-sub-group">
                    <label class="form-label">お問い合わせの種類<span class="form-label-sub">※</span></label>
                    <div class="select-wrapper"> <!-- セレクションボックスをラップする要素を追加 -->
                        <select class= "form-selectbox" name="category_id">
                            <option value="" hidden
                                {{ old('category_id', $oldData['category_id'] ?? '') ? '' : 'selected' }}>選択してください</option>
                            @foreach ($categories as $category)
                                <option value="{{ $category->id }}"
                                    {{ old('category_id', $oldData['category_id'] ?? '') == $category->id ? 'selected' : '' }}>
                                    {{ $category->content }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    @error('category_id')
                        <div class="error-message">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-sub-group">
                    <label class="form-label">お問い合わせ内容<span class="form-label-sub">※</span></label>
                    <textarea class="form-textarea" name="detail" placeholder="お問い合わせ内容をご記載ください">{{ old('detail', $oldData['detail'] ?? '') }}</textarea>

                    @error('detail')
                        <div class="error-message">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-submit-container">
                    <button type="submit" class="form-submit">確認画面</button>
                </div>
            </div>
        </form>
    </div>
@endsection
