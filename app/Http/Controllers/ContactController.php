<?php

namespace App\Http\Controllers;

use App\Http\Requests\ContactRequest;
use Illuminate\Support\Facades\Log;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    public function index()
    {
        return view("contact.index");
    }

    public function complete()
    {
        return view("contact.complete");
    }

    public function sendMail(ContactRequest $request)
    {
        $validated = $request->validated([
        'name' => ['required', 'string', 'max:255'],
        'name_kana' => ['required', 'string', 'max:255', 'regex:/^[ァ-ロワンヴー]*$/u'],
        'phone' => ['nullable', 'regex:/^0(\d-?\d{4}|\d{2}-?\d{3}|\d{3}-?\d{2}|\d{4}-?\d|\d0-?\d{4})-?\d{4}$/'],
        'email' => ['required', 'email'],
        'body' => ['required', 'string', 'max:2000'],
        ]);

        // これ以降の行は入力エラーがなかった場合のみ実行されます
        // 登録処理(実際はメール送信などを行う)
        Log::debug($validated['name']. 'さんよりお問い合わせがありました');
        return to_route('contact.complete');
    }
}
