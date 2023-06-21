<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ClientsAddress extends Model
{
    use HasFactory;

    protected $table="clients_addresses";
    protected $fillable = [
        'client_id',
        'address',
        'coordinates',
        'geo_locations',
        'add_type'
    ];
}
