<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;

class InvitationDetail extends Model
{
    public $table = 'invitation_detail';
    protected $guarded = [];

    use HasFactory;

    protected function status(): Attribute
    {
        return Attribute::make(
            get: function (string $value) {
                switch ($value) {
                    case 1:
                        $value = 'Rejected';
                        break;
                    case 2:
                        $value = 'Accepted';
                        break;
                    default:
                        $value = 'Pending';
                        break;
                }
                return $value;
            }
        );
    }

    public function getUser()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
