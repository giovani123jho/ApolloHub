<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Mentorship extends Model
{
    use HasFactory;

    /**
     * Os atributos que podem ser preenchidos em massa.
     *
     * @var array
     */
    protected $fillable = [
        'company_id',
        'mentor_id',
        'status',
    ];

    /**
     * Relacionamento com o mentor.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function mentor()
    {
        return $this->belongsTo(User::class, 'mentor_id');
    }

    /**
     * Relacionamento com a empresa.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function company()
    {
        return $this->belongsTo(User::class, 'company_id');
    }

    /**
     * Verificar se a mentoria está pendente.
     *
     * @return bool
     */
    public function isPending()
    {
        return $this->status === 'pendente';
    }

    /**
     * Verificar se a mentoria foi aceita.
     *
     * @return bool
     */
    public function isAccepted()
    {
        return $this->status === 'aceita';
    }

    /**
     * Verificar se a mentoria foi recusada.
     *
     * @return bool
     */
    public function isRejected()
    {
        return $this->status === 'recusada';
    }
}
