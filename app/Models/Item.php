<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Intervention\Image\ImageManagerStatic as Image;
use Illuminate\Support\Facades\Storage;

class Item extends Model
{
    use \Backpack\CRUD\app\Models\Traits\CrudTrait;
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'code',
        'min',
        'qty',
        'price',
        'active',
        'image',
        'group_id',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'active' => 'boolean',
        'group_id' => 'integer',
    ];



    public function group()
    {
        return $this->belongsTo(Group::class);
    }

    public function customer()
    {
        return $this->belongsToMany(Customer::class, 'exports', 'item_id', 'customer_id')
            ->withPivot('qty', 'date')
            ->withTimeStamps();
    }


    public function supplier()
    {
        return $this->belongsToMany(Supplier::class, 'emports', 'item_id', 'supplier_id')
        ->withPivot('qty', 'date')
        ->withTimeStamps();
    }



    public function setImageAttribute($value)
    {
        $attribute_name = "image";
        $disk = "uploads";
        $destination_path = ""; //relative to $disk
        $this->uploadFileToDisk($value, $attribute_name, $disk, $destination_path);
    }


    protected static function boot()
    {

        parent::boot();

        static::deleting(function ($item) {

            if ($item->customer->count() > 0 || $item->supplier->count() > 0) {
                return false;
            }
        });
    }
}
