<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up()
    {
        $persons = DB::table('persons')->whereNull('unique_code')->get();
        
        foreach ($persons as $person) {
            $code = $this->generateUniqueCode();
            DB::table('persons')
                ->where('id', $person->id)
                ->update(['unique_code' => $code]);
        }
    }

    private function generateUniqueCode()
    {
        do {
            $code = str_pad(random_int(0, 99999), 5, '0', STR_PAD_LEFT);
        } while (DB::table('persons')->where('unique_code', $code)->exists());

        return $code;
    }

    public function down()
    {
        //
    }
};