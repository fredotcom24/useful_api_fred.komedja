<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserModule extends Model
{
    /** @use HasFactory<\Database\Factories\UserModuleFactory> */
    use HasFactory;

    protected $fillable = [
        'user_id',
        'module_id',
        'active',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    protected function casts(): array
    {
        return [
            'active' => 'boolean',
        ];
    }
}
