<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ChatbotScript extends Model
{
    protected $table = 'chatbot_script';
    protected $fillabe = [
        'name',
        'key_word',
        'script',
    ];
}
