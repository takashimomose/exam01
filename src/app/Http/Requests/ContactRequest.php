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
            // 'tel_part1'  => ['nullable', 'regex:/^[0-9]{1,5}$/', 'required_with_all:tel_part2,tel_part3'], // ハインフンなし　最大5桁の数字
            // 'tel_part2'  => ['nullable', 'regex:/^[0-9]{1,5}$/', 'required_with_all:tel_part1,tel_part3'], // ハインフンなし　最大5桁の数字
            // 'tel_part3'  => ['nullable', 'regex:/^[0-9]{1,5}$/', 'required_with_all:tel_part1,tel_part2'], // ハインフンなし　最大5桁の数字
            'address'    => ['required', 'string', 'max:255'],
            'building'   => ['nullable', 'string', 'max:255'], // 任意入力
            'category_id' => ['required', 'exists:categories,id', 'integer'],
            'detail'     => ['required', 'string', 'max:240'], // 全角120文字まで
            'tel_part1' => ['nullable'],
            'tel_part2' => ['nullable'],
            'tel_part3' => ['nullable'],
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
            // 'tel_part1.required_with_all' => '電話番号を入力してください',
            // 'tel_part2.required_with_all' => '電話番号を入力してください',
            // 'tel_part3.required_with_all' => '電話番号を入力してください',
            // 'tel_part1.regex' => '電話番号は5桁までの数字で入力してください',
            // 'tel_part2.regex' => '電話番号は5桁までの数字で入力してください',
            // 'tel_part3.regex' => '電話番号は5桁までの数字で入力してください',
            'address.required' => '住所を入力してください',
            'category_id.required' => 'お問い合わせの種類を選択してください',
            'detail.required' => 'お問い合わせ内容を入力してください',
            'detail.max' => 'お問い合わせ内容は120文字以内で入力してください',
        ];
    }
}
