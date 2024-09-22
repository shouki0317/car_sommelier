<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GsData extends Model
{
    use HasFactory;

    // 更新可能カラム
    protected $fillable = [
        'store_name', 
        'address',
        'business_hours',
        'tel',
        'self',
        'holiday',
    ];

    // 参照させたいSQLのテーブル名を指定
    protected $table = 'gs_datas';
}
