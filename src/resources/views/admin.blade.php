@extends('layouts.app')

@section('title', '管理画面') <!-- タイトルセクションを上書き -->

@push('css')
    <link rel="stylesheet" href="{{ asset('css/admin.css') }}" /> <!-- ページ用のCSS読み込み -->
@endpush

@section('content') <!-- コンテンツを指定 -->
    <div class="heading">
        <h2>Admin</h2>
    </div>
    <form action="{{ route('admin.index') }}" method="GET">
        @csrf
        <div class="search-filters">
            <input class="filter-keyword" type="text" name="keyword" value="{{ request('keyword') }}" placeholder="名前やメールアドレスを入力してください">
            <select class= "filter-gender" name="gender">
                <option value="" selected hidden>性別</option>
                <option value="">全て</option>
                <option value="1" {{ request('gender') == '1' ? 'selected' : '' }}>男性</option>
                <option value="2" {{ request('gender') == '2' ? 'selected' : '' }}>女性</option>
                <option value="3" {{ request('gender') == '3' ? 'selected' : '' }}>その他</option>
            </select>
            <select class= "filter-category_id" name="category_id">
                <option value="" selected hidden>お問い合わせの種類</option>
                @foreach ($categories as $category)
                    <option value="{{ $category->id }}" {{ request('category_id') == $category->id ? 'selected' : '' }}>
                        {{ $category->content }}
                    </option>
                @endforeach
            </select>
            <input class= "filter-date" type="date" name="created_at" value="{{ request('created_at') }}" placeholder="年/月/日" min="2024-10-01"
                max="2025-12-31">
            <button type="submit" class="search-btn">検索</button>
            <button type="submit" class="reset-btn" name="reset" value="true">リセット</button>
        </div>
    </form>
    <div class="table-controls">
        <div class="export-btn">
            <button>エクスポート</button>
        </div>

        <div class="pagination">
            {{ $contacts->links() }} <!-- 動的に生成されたページネーションリンクを表示 -->
        </div>
    </div>

    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <table class="admin-table">
        <thead>
            <tr>
                <th>お名前</th>
                <th>性別</th>
                <th>メールアドレス</th>
                <th>お問い合わせの種類</th>
                <th></th>
            </tr>
        </thead>
        <tbody>
            @foreach ($contacts as $contact)
                <tr>
                    <td>{{ $contact->last_name }}　{{ $contact->first_name }}</td>
                    <td>{{ $contact['gender'] == 1 ? '男性' : ($contact['gender'] == 2 ? '女性' : 'その他') }}</td>
                    <td>{{ $contact->email }}</td>
                    <td>{{ $contact['category_id'] == 1
                        ? '商品のお届けについて'
                        : ($contact['category_id'] == 2
                            ? '商品の交換について'
                            : ($contact['category_id'] == 3
                                ? '商品トラブル'
                                : ($contact['category_id'] == 4
                                    ? 'ショップへのお問い合わせ'
                                    : 'その他'))) }}
                    </td>
                    <td><button class="open-modal"
                            onclick="openModal('{{ $contact->last_name }} {{ $contact->first_name }}', 
                               {{ $contact->gender }}, 
                               '{{ $contact->email }}', 
                               '{{ $contact->tel }}', 
                               '{{ $contact->address }}', 
                               '{{ $contact->building }}', 
                               {{ $contact->category_id }}, 
                               '{{ $contact->detail }}', {{ $contact->id }})">詳細</button>
                    </td>
                </tr>
            @endforeach
            <!-- Repeat rows as needed -->
        </tbody>
    </table>

    <!-- 詳細モーダル -->
    <div id="modal" class="modal">
        <div class="modal-content">
            <span class="close" onclick="document.getElementById('modal').style.display='none'">&times;</span>
            <table class="modal-table">
                <tr>
                    <td class="label">お名前</td>
                    <td class="value" id="modal-name"></td>
                </tr>
                <tr>
                    <td class="label">性別</td>
                    <td class="value" id="modal-gender"></td>
                </tr>
                <tr>
                    <td class="label">メールアドレス</td>
                    <td class="value" id="modal-email"></td>
                </tr>
                <tr>
                    <td class="label">電話番号</td>
                    <td class="value" id="modal-tel"></td>
                </tr>
                <tr>
                    <td class="label">住所</td>
                    <td class="value" id="modal-address"></td>
                </tr>
                <tr>
                    <td class="label">建物名</td>
                    <td class="value" id="modal-building"></td>
                </tr>
                <tr>
                    <td class="label">お問い合わせの種類</td>
                    <td class="value" id="modal-category"></td>
                </tr>
                <tr>
                    <td class="label">お問い合わせ内容</td>
                    <td class="wrap-text value" id="modal-content"></td>
                </tr>
            </table>
            <form id="delete-form" action="" method="POST">
                @csrf
                @method('DELETE')
                <button type="submit" class="delete-btn">削除</button>
            </form>
        </div>
    </div>
@endsection
<script>
    function openModal(name, gender, email, tel, address, building, categoryId, content, id) {
        document.getElementById('modal-name').innerText = name;
        document.getElementById('modal-gender').innerText = gender == 1 ? '男性' : (gender == 2 ? '女性' : 'その他');
        document.getElementById('modal-email').innerText = email;
        document.getElementById('modal-tel').innerText = tel;
        document.getElementById('modal-address').innerText = address;
        document.getElementById('modal-building').innerText = building;
        document.getElementById('modal-category').innerText = categoryId == 1 ? '商品のお届けについて' : (categoryId == 2 ?
            '商品の交換について' : (categoryId == 3 ? '商品トラブル' : (categoryId == 4 ? 'ショップへのお問い合わせ' : 'その他')));
        document.getElementById('modal-content').innerText = content;

        // 削除フォームのactionを設定
        document.getElementById('delete-form').action = `/admin/contacts/${id}`;

        // モーダルを表示
        document.getElementById('modal').style.display = 'block';
    }
</script>
