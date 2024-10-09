<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Contact;
use Illuminate\Http\Request;


class AdminController extends Controller
{
    public function index(Request $request)
    {
        $categories = Category::all();

        // リセットボタンが押されたかを判定
        if ($request->has('reset')) {
            return redirect()->route('admin.index'); // ルートにリダイレクトして検索条件をクリア
        }

        // 入力された条件を取得
        $keyword = $request->input('keyword');
        $gender = $request->input('gender');
        $categoryId = $request->input('category_id');
        $createdAt = $request->input('created_at');

        // contactsテーブルから必要なカラムを取得し、検索条件に応じてフィルタリング
        $contacts = Contact::select('id', 'last_name', 'first_name', 'gender', 'email', 'tel', 'address', 'building', 'category_id', 'detail', 'created_at')
            ->with('category'); // 必要に応じてリレーションをロード

        // keywordによる検索（部分一致）
        if ($keyword) {
            $contacts->where(function ($query) use ($keyword) {
                $query->where('last_name', 'LIKE', "%{$keyword}%")
                    ->orWhere('first_name', 'LIKE', "%{$keyword}%")
                    ->orWhere('email', 'LIKE', "%{$keyword}%");
            });
        }

        // genderによる検索（完全一致）
        if ($gender) {
            $contacts->where('gender', $gender);
        }

        // category_idによる検索（完全一致）
        if ($categoryId) {
            $contacts->where('category_id', $categoryId);
        }

        // created_atによる検索（完全一致）
        if ($createdAt) {
            $contacts->whereDate('created_at', $createdAt);
        }

        // ページネーション
        $contacts = $contacts->paginate(7);

        // admin.blade.php にデータを渡す
        return view('admin', [
            'categories' => $categories,
            'contacts' => $contacts
        ]);
    }

    public function destroy($id)
    {
        // 指定されたIDのレコードを削除
        Contact::destroy($id);

        // 削除後、インデックスページにリダイレクト
        return redirect()->route('admin.index')->with('success', 'レコードが削除されました。');
    }
}
