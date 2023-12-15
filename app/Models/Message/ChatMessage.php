<?php

namespace App\Models\Message;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ChatMessage extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $table = "tbl_chat_message";
    protected $fillable = ['acknowledge', 'acknowledgedate', 'ackstatus'];
}