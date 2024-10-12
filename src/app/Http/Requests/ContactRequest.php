<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ContactRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'last_name'  => ['required', 'string', 'max:255'],
            'first_name' => ['required', 'string', 'max:255'],
            'gender'     => ['required', 'in:1,2,3'], // 1:男性, 2:女性, 3:その他
            'email'      => ['required', 'email', 'max:255'],
            // 'tel_part1' => ['required'],
            // 'tel_part2' => ['required'],
            // 'tel_part3' => ['required'],
            'address'    => ['required', 'string', 'max:255'],
            'building'   => ['nullable', 'string', 'max:255'], // 任意入力
            'category_id' => ['required', 'exists:categories,id', 'integer'],
            'detail'     => ['required', 'string', 'max:120'], // 全角120文字まで
        ];
    }

    public function messages()
    {
        return [
            'last_name.required' => '姓を入力してください',
            'first_name.required' => '名を入力してください',
            'gender.required' => '性別を選択してください',
            'email.required' => 'メールアドレスを入力してください',
            'email.email' => 'メールアドレスは「ユーザー名@ドメイン」形式で入力してください',
            // 'tel_part1.required' => '電話番号1必須です',
            // 'tel_part2.required' => '電話番号2必須です',
            // 'tel_part3.required' => '電話番号3必須です',
            'address.required' => '住所を入力してください',
            'category_id.required' => 'お問い合わせの種類を選択してください',
            'detail.required' => 'お問い合わせ内容を入力してください',
            'detail.max' => 'お問い合わせ内容は120文字以内で入力してください',
        ];
    }
}
