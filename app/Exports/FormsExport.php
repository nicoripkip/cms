<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use DB;

class FormsExport implements FromCollection
{
    /**
     * @var String $tablename
     */
    protected $tablename;


    /**
     * @var Integer $object_id
     */
    protected $object_id;


    /**
     * Constructor
     */
    public function __construct(string $tablename, int $object_id)
    {
        $this->tablename = $tablename;
        $this->object_id = $object_id;
    }


    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return DB::table('forms_'.$this->tablename)->get();
    }
}
