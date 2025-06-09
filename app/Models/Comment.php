<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Comment extends Model
{
  /** @use HasFactory<\Database\Factories\CommentFactory> */
  use HasFactory;

  protected $fillable = ['comment', 'user_id', 'post_id'];

  public function user(): BelongsTo
  {
    return $this->belongsTo(User::class, 'user_id');
  }

  public function post(): BelongsTo
  {
    return $this->belongsTo(Post::class, 'post_id');
  }

  public function replies(): HasMany
  {
    return $this->hasMany(Reply::class, 'comment_id');
  }
}
