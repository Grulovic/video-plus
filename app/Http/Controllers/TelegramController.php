<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use pschocke\TelegramLoginWidget\Facades\TelegramLoginWidget;


class TelegramController extends Controller
{
    public function connect() {
        return view ('telegram.connect');
    }

    public function callback(Request $request) {
        if (! $telegramUser = TelegramLoginWidget::validate($request)) {
            return 'Telegram Response not valid';
        }
        $telegramChatID = $telegramUser->get('id');
        // You need to store the chat ID to be able to use it later
        return 'Success!';
    }

}