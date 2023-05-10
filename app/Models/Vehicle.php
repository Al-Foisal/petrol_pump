<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Vehicle extends Model {
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'vehicles';

    /**
     * The database primary key value.
     *
     * @var string
     */
    protected $primaryKey = 'id';

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['model', 'vehicle_number', 'supervisor_name', 'supervisor_mobile', 'vehicle_type', 'group_id'];

    public function group() {
        return $this->belongsTo(Group::class);
    }
}
