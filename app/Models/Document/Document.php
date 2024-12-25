<?php

namespace App\Models\Document;

use App\Models\Lawsuit\Lawsuit;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use App\Models\Side\Side;

class Document extends Model
{
    protected $fillable = [
        "lawsuit_id",
        "document_type_id",
        "html",
        "side_id",
        "created_user_id",
        "name",
    ];

    protected $with = ["sides", "document_type"];

    public function sides()
    {
        return $this->belongsTo(Side::class);
    }

    public function document_type()
    {
        return $this->belongsTo(DocumentType::class);
    }

    public function lawsuit()
    {
        return $this->belongsTo(Lawsuit::class);
    }

    public function getPathAttribute()
    {
        $path = public_path('/files/lawsuits/');

        if (!is_dir($path)) {
            mkdir($path, 0777);
        }

        $path = public_path('/files/lawsuits/' . $this->lawsuit_id);

        if (!is_dir($path)) {
            mkdir($path, 0777);
        }

        $path = public_path('/files/lawsuits/' . $this->lawsuit_id) . "/documents";

        if (!is_dir($path)) {
            mkdir($path, 0777);
        }

        return $path . "/";
    }

    public function getFileAttribute()
    {
        return !is_null($this->html) ? asset('/files/lawsuits/' . $this->lawsuit_id . '/documents/' . $this->html) : "";
    }

    protected static function booted()
    {
        static::addGlobalScope('created_user_id', function (Builder $builder) {
            $builder->where('created_user_id', auth()->id());
        });
    }
}
