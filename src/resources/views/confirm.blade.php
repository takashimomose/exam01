@extends('layouts.app')

@section('title', '確認画面') <!-- タイトルセクションを上書き -->

@push('css')
    <link rel="stylesheet" href="{{ asset('css/confirm.css') }}" /> <!-- ページ用のCSS読み込み -->
@endpush

@section('content') <!-- コンテンツを指定 -->
    <div class="heading">
        <div class="confirm__heading">
            <h2>Confirm</h2>
        </div>
        <div class="container">
            <form class="form" action="/contacts" method="post">
                @csrf
                <div class="confirm-table">
                    <table class="confirm-table__inner">
                        <tr class="confirm-table__row">
                            <th class="confirm-table__header">お名前</th>
                            <td class="confirm-table__text">
                                <!-- 姓名を表示 -->
                                <input class="full-name" type="text" name="full_name"
                                    value="{{ $contact['last_name'] }}　{{ $contact['first_name'] }}" readonly />
                                <!-- 送信用にhiddenで別々に姓名を送信 -->
                                <input type="hidden" name="last_name" value="{{ $contact['last_name'] }}" readonly />
                                <input type="hidden" name="first_name" value="{{ $contact['first_name'] }}" readonly />
                            </td>
                        </tr>
                        <tr class="confirm-table__row">
                            <th class="confirm-table__header">性別</th>
                            <td class="confirm-table__text">
                                <!-- genderのテキストを表示 -->
                                <input class="gender" type="text"
                                    value="{{ $contact['gender'] == 1 ? '男性' : ($contact['gender'] == 2 ? '女性' : 'その他') }}"
                                    readonly />
                                <!-- 送信用にhiddenで数値を送信 -->
                                <input type="hidden" name="gender" value="{{ $contact['gender'] }}" readonly />
                            </td>
                        </tr>
                        <tr class="confirm-table__row">
                            <th class="confirm-table__header">メールアドレス</th>
                            <td class="confirm-table__text">
                                <input class="email" type="email" name="email" value="{{ $contact['email'] }}"
                                    readonly />
                            </td>
                        </tr>
                        <tr class="confirm-table__row">
                            <th class="confirm-table__header">電話番号</th>
                            <td class="confirm-table__text">
                                <input class="tel" type="tel" name="tel"
                                    value="{{ $contact['tel_part1'] }}{{ $contact['tel_part2'] }}{{ $contact['tel_part3'] }}"
                                    readonly />
                            </td>
                        </tr>
                        <tr class="confirm-table__row">
                            <th class="confirm-table__header">住所</th>
                            <td class="confirm-table__text">
                                <input class="address" type="text" name="address" value="{{ $contact['address'] }}"
                                    readonly />
                            </td>
                        </tr>
                        <tr class="confirm-table__row">
                            <th class="confirm-table__header">建物名</th>
                            <td class="confirm-table__text">
                                <input class="building" type="text" name="building" value="{{ $contact['building'] }}"
                                    readonly />
                            </td>
                        </tr>
                        <tr class="confirm-table__row">
                            <th class="confirm-table__header">お問い合わせの種類</th>
                            <td class="confirm-table__text">
                                <!-- お問い合わせ種類のテキストを表示 -->
                                <input class="category-id" type="text" name="category_id"
                                    value="{{ $contact['category_id'] == 1
                                        ? '商品のお届けについて'
                                        : ($contact['category_id'] == 2
                                            ? '商品の交換について'
                                            : ($contact['category_id'] == 3
                                                ? '商品トラブル'
                                                : ($contact['category_id'] == 4
                                                    ? 'ショップへのお問い合わせ'
                                                    : 'その他'))) }}"
                                    readonly />
                                <!-- 送信用にhiddenで数値を送信 -->
                                <input type="hidden" name="category_id" value="{{ $contact['category_id'] }}" readonly />
                            </td>
                        </tr>
                        <tr class="confirm-table__row">
                            <th class="confirm-table__header">お問い合わせ内容</th>
                            <td class="confirm-table__text">
                                <input class="detail" type="text" name="detail" value="{{ $contact['detail'] }}"
                                    readonly />
                            </td>
                        </tr>
                    </table>
                </div>
                <div class="form-submit-container">
                    <form action="/confirm" method="post">
                        @csrf
                        <button class="submit" type="submit">送信</button>
                    </form>
                    <form action="{{ route('contact.back') }}" method="post">
                        @csrf
                        <button class="edit" type="submit" onclick="location.href='/?from_confirm=true';">修正</button>
                    </form>
                </div>
            </form>
        </div>
    </div>
@endsection
