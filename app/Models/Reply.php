<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Reply extends Model
{
  /** @use HasFactory<\Database\Factories\ReplyFactory> */
  use HasFactory;

  protected $fillable = [
    'comment_id',
    'post_id',
    'user_id',
    'reply'
  ];

  public function post(): BelongsTo
  {
    return $this->belongsTo(Post::class, 'post_id');
  }

  public function user(): BelongsTo
  {
    return $this->belongsTo(User::class, 'user_id');
  }
}
