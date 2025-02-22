<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Usuario extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */

    public static function generos()
    {
        return [
            'Masculino' => 'Masculino',
            'Feminino' => 'Feminino',
            'Não Declarado' => 'Não Declarado',
        ];
    }
    
    protected $fillable = [
        'nome',
        'cpf',
        'data_nascimento',
        'telefone',
        'genero',
        'senha',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'senha',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {

        return [
            'nome' => 'string',
            'cpf' => 'integer',
            'data_nascimento' => "date",
            'telefone' => "integer",
            // 'genero' => ,
            'senha' => 'hashed',
        ];
    }

    public function getAuthPassword()
    {
        return $this->senha;
    }
}
