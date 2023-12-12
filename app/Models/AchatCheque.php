<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
class AchatCheque extends Model
{
    protected $table = "achat_cheques";
    protected $guarded = [];
    use HasFactory;
    use SoftDeletes;

    /**
     * Get the bank that owns the AchatCheque
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function bank(): BelongsTo
    {
        return $this->belongsTo(Bank::class, 'bank_id');
    }
}
