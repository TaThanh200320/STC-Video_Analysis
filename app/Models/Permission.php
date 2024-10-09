<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Permission extends Model
{
    use HasFactory;

    protected $table = 'permission';

    static public function getRecord()
    {
        $getPermission = Permission::groupBy('groupby')->get();
        $result = [];
        foreach ($getPermission as $value) {
            $getPermissionGroup = Permission::getPermissionGroup($value->groupby);
            $data = [];
            $data['id'] = $value->id;
            $data['name'] = $value->name;
            $group = [];
            foreach ($getPermissionGroup as $valueG) {
                $dataG = [];
                $dataG['id'] = $valueG->id;
                $dataG['name'] = $valueG->name;
                $group[] = $dataG;
            }
            $data['group'] = $group;
            $result[] = $data;
        }
        return $result;
    }

    static public function getPermissionGroup($groupby)
    {
        return Permission::where('groupby', '=', $groupby)->get();
    }

    static public function getSingle($id)
    {
        return Role::find($id);
    }
}
