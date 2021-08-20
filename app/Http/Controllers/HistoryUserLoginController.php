<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\HistoryUserLogin;
use App\Helpers\APIHelpers;

class HistoryUserLoginController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $historyData= HistoryUserLogin::with('history_user')->with('history_state_ip')->get();

        $Response=APIHelpers::APIResponse(false,200,null,$historyData);
        return response()->json($Response,200);
    }

    public function search(Request $request){

        $historyData=HistoryUserLogin::where('HulIp', $request->ip)->get();

        $Response=APIHelpers::APIResponse(false,200,null,$historyData);
        return response()->json($Response,200);

    }


    public function update(Request $request, $id)
    {
        DB::beginTransaction();
        try{


            if (HistoryUserLogin::where('id', $id)->exists()) {

                HistoryUserLogin::where('id', $id)->update([
                    'state_ip_id' => $request["stateIP"],
                    'hulComment' => $request["comment"]
                ]);


                DB::commit();

                $message = 'Se actualizo correctamente.';
                $Response = APIHelpers::APIResponse(false, 200, $message, null);
                return response()->json($Response, 200);
            }else{
                $Response = APIHelpers::APIResponse(
                    false,
                    404,
                    'Product not found',
                    null
                );
                return response()->json($Response, 404);
            }
        }catch (\Exception $e) {
            DB::rollback();
            $Response = APIHelpers::APIResponse( false,
                                                400,
                                                $e->getMessage(),
                                                null
                                                );
            return response()->json($Response, 400);
        }
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        DB::beginTransaction();
        try{

            if (HistoryUserLogin::where('id', $id)->exists()) {

                HistoryUserLogin::where('id', $id)->delete();

                DB::commit();

                $message = 'Se a eliminado correctamente.';
                $Response = APIHelpers::APIResponse(false, 200, $message, null);
                return response()->json($Response, 200);
            }else{
                $Response = APIHelpers::APIResponse(
                    false,
                    404,
                    'Product not found',
                    null
                );
                return response()->json($Response, 404);
            }
        }catch (\Exception $e) {
            DB::rollback();
            $Response = APIHelpers::APIResponse( false,
                                                400,
                                                $e->getMessage(),
                                                null
                                                );
            return response()->json($Response, 400);
        }
    }


}
