<?php

namespace App\Http\Controllers\General;

use App\Models\CoreOption;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class Options extends Controller
{

    /**
     * The instace of core_option table
     * 
     * @param object
     */
    protected $option;

    /**
     * Create an Instance of CoreOption table ORM
     * 
     */
    public function __construct()
    {
        //  ...
    }

    /**
     * Update/Set Options of Application
     * 
     * @param \Illuminate\Http\Request option
     * @param \Illuminate\Http\Request Value
     * @return void
     */
    public function set_option(Request $request)
    {
        
        try {
            switch ($request->option) {
                case 'CLOSE_DAY':
                    DB::table('core_options')->updateOrInsert(
                        ['option'   => 'CLOSE_DAY'],
                        ['value'    => json_encode($request->value)]
                    );
                    break;
                default:
                    DB::table('core_options')->updateOrInsert(
                        ['option'   => $request->option],
                        ['value'    => $request->value]
                    );
            }

            return response()->json([
                'success'   => true
            ], 200);

        } catch (\Throwable $th) {
            
            return response()->json([
                'error'     => $th->getMessage()
            ], 500);
        
        }
    }

    /**
     * Retrieve Itmes of Options
     * 
     * @return string
     */
    public function get_options()
    {
        try {
            $this->option = new CoreOption;
            return response()->json([
                'options'   => $this->option->full_options 
            ], 200);
            
        } catch (\Throwable $th) {
            
            return response()->json([
                'error'     => $th->getMessage()
            ], 500);
        
        }
    }
}
