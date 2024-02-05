<?php

namespace Cherryant\CountryStateGeo\Models;

use Cherryant\CountryStateGeo\Casts\Json;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class City extends Model
{
    use HasFactory;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'csg_cities';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */

    protected $fillable = [
        'csg_country_id',
        'csg_state_id',
        'csg_province_id',
        'name',
        'cp',
        'lat',
        'lng',
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
        'cp' => Json::class,
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
     * Get the state.
     */
    public function province()
    {
        return $this->belongsTo(Province::class, 'csg_province_id');
    }

    /**
     * Get all cities for country
     *
     * @param integer $csg_country_id
     * @return Illuminate\Database\Eloquent\Collection
     */
    public function fromCountry(int $csg_country_id)
    {
        return $this->where('csg_country_id', $csg_country_id)->get();
    }

    /**
     * Get all cities for state
     *
     * @param integer $csg_state_id
     * @return Illuminate\Database\Eloquent\Collection
     */
    public function fromState(int $csg_state_id)
    {
        return $this->where('csg_state_id', $csg_state_id)->get();
    }

    /**
     * Get all cities for province
     *
     * @param integer $csg_province_id
     * @return Illuminate\Database\Eloquent\Collection
     */
    public function fromProvince(int $csg_province_id)
    {
        return $this->where('csg_province_id', $csg_province_id)->get();
    }

    /**
     * Find a province by code.
     *
     * @param string $code
     *
     * @return Illuminate\Database\Eloquent\Collection
     */
    public function whereCP(string $cp)
    {
        return $this->where('cp', $cp);
    }
}
