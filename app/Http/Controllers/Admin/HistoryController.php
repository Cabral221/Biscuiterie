<?php

namespace App\Http\Controllers\Admin;

use Carbon\Carbon;
use App\Models\History_user;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class HistoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $years = [];
        for ($i = 0; $i < 10; $i++) { 
            $k = Carbon::now()->year;
            $v = (Carbon::now()->year - 1) .' - '. Carbon::now()->year;
            $years[$k] = $v;
        }

        return view('admin.histories', [
            'years' => $years,
        ]);
    }

    public function getDataForApi(Request $request)
    {
        // valider la date
        $validator = Validator::make($request->all(), [
            'year' => ['required', 'numeric', 'min:'.(Carbon::now()->year - 10), 'max:' . Carbon::now()->year],
        ]);

        if($validator->fails()) {
            return response()->json($validator->messages(), 400);
        }

        $masters = History_user::where('period', $request->year - 1 . '-' . $request->year)->get();
        if($masters->count() < 1){
            return response()->json(['message' => 'Aucun résultat trouvé'], 404);
        }

        $data = [];
        foreach ($masters as $master) {
            $data[] = [
                'id' => $master->id,
                'full_name' => $master->full_name,
                'phone' => $master->phone,
                'email' => $master->email,
                'classe' => $master->classe,
                'added_at' => $master->added_at->format('d m Y  H:m'),
            ];
        }

        return response()->json($data, 200);
    }
}
