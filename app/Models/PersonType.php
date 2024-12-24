<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Cache;

class PersonType extends Model
{

    public static function selectToArray()
    {
        return Cache::remember("personTypeSelect", 3600, function () {
            return PersonType::pluck('name', 'key')->toArray();
        });
    }

    public function model()
    {
        if ($this->group == 1) {
            return new \App\Models\Side\People();
        } else if ($this->group == 2) {
            return new \App\Models\Side\Lawyer();
        } else if ($this->group == 3) {
            return new \App\Models\Side\Company();
        }
    }

    private $rowMapping = [
        1 => "person_id",
        2 => "lawyer_id",
        3 => "company_id"
    ];

    public function row()
    {
        return $this->rowMapping[$this->group];
    }

    public function service()
    {
        if ($this->group == 1) {
            return new \App\Services\PeopleService();
        } else if ($this->group == 2) {
            return new \App\Services\LawyerService();
        } else if ($this->group == 3) {
            return new \App\Services\CompanyService();
        }
    }
}
