<?php

namespace Cherryant\CountryStateGeo\Models;

use Cherryant\CountryStateGeo\Casts\Json;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Province extends Model
{
    use HasFactory;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'csg_provinces';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */

    protected $fillable = [
        'csg_country_id',
        'csg_state_id',
        'code',
        'name',
        'geo',
        'visible',
    ];

    /**
     * The model's default values for attributes.
     *
     * @var array
     */
    protected $attributes = [
        'visible' => true,
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'geo' => Json::class,
        'visible' => 'boolean',
    ];

    /**
     * Get the country.
     */
    public function country()
    {
        return $this->belongsTo(Country::class, 'csg_country_id');
    }

    /**
     * Get the state.
     */
    public function state()
    {
        return $this->belongsTo(State::class, 'csg_state_id');
    }

    /**
     * Get all provinces for country
     *
     * @param integer $csg_country_id
     * @return Illuminate\Database\Eloquent\Collection
     */
    public function fromCountry(int $csg_country_id)
    {
        return $this->where('csg_country_id', $csg_country_id)->get();
    }

    /**
     * Get all provinces for state
     *
     * @param integer $csg_state_id
     * @return Illuminate\Database\Eloquent\Collection
     */
    public function fromState(int $csg_state_id)
    {
        return $this->where('csg_state_id', $csg_state_id)->get();
    }

    /**
     * Find a province by code.
     *
     * @param string $code
     *
     * @return Illuminate\Database\Eloquent\Collection
     */
    public function whereCode(string $code)
    {
        return $this->where('code', $code);
    }
}
