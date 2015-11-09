<?php namespace App\Http\Controllers;

use App\time;
use App\info;
use App\User;
use Auth;
use App\Http\Requests;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;

class AttendanceController extends Controller {



    public function currentMonth(){
        // Initialize counters for totals

        $brTotal = 0;
        $otTotal = 0;
        $workTotal = 0;



        $id = Auth::user()->id;
        
        $info = info::select('name','work_hours','br_hours','ot_hours','date','arrived','departed','notes','time.id')
                            ->join('time',function($join)
                            {
                                $join->on('info.id','=','time.id')
                                    ->where('date', 'like' , date('Y-m') . '-%');
                            })
                            ->join('users','time.user', '=' , 'users.id')
                            ->where('users.id', '=', $id)
                            ->get();


        foreach( $info as $test ) {
            $brTotal += $test->br_hours;
            $workTotal += $test->work_hours;
            $otTotal += $test->ot_hours;
        }


        return view('entries')->with('name',$info)
                              ->with('brTotal' , $brTotal)
                              ->with('workTotal' , $workTotal)
                              ->with('otTotal' , $otTotal);

    }

    
    public function userArrived(){
            
        $id = Auth::user()->id;
        
        $now = new \DateTime();
        
        $newEntry = new time;
        
        $newEntry->arrived = $now;
        $newEntry->date = $now;
        $newEntry->user = $id;
        $newEntry->save();
        
        $timeID = time::where('departed','=','00:00:00')
                        ->where('user','=',$id)
                        ->first();

        $editID = $timeID->ID;

        $newInfo = new info;
        $newInfo->ID = $editID;
        $newInfo->notes = 'Insert Notes Here';
        $newInfo->ot_hours = 0;
        $newInfo->br_hours = 1;
        $newInfo->work_hours = 8;
        $newInfo->save();
        
        
        
        return redirect('/entries'); 
            
    }
    
    
    public function userDeparted(){

        
        $id = Auth::user()->id;
        
        $now = new \DateTime();
        
    // for some reason, eloquent does not work . using databse builder. needs to be looked into
        
        \DB::table('time')
            ->whereUserAndDeparted($id, '00:00:00')
            ->update(['departed' => $now]);

        return redirect('/entries');

    }

    public function showDeparted($id) {

        $table = time::find($id);
        $field = 'Departed';

        return view('edit')->with('table', $table)->with('field', $field);

    }

    public function  showArrived($id) {

        $table = time::find($id);
        $field = 'Arrived';

        return view('edit')->with('table', $table)->with('field', $field);


    }

    public  function showBrhours($id) {

        $table = info::find($id);
        $field = 'Break hours';

        return view('edit')->with('table', $table)->with('field', $field);

    }


    public  function  showWorkhours($id) {

        $table = info::find($id);
        $field = 'Work Hours';

        return view('edit')->with('table', $table)->with('field', $field);

    }


    public function showDate($id) {

        $table = time::find($id);
        $field = 'Date';

        return view('edit')->with('table', $table)->with('field', $field);
    }

    public function showOthours($id) {

        $table = info::find($id);
        $field = 'Overtime';

        return view('edit')->with('table', $table)->with('field', $field);
    }

    public function showNotes($id) {

        $table = info::find($id);
        $field = 'Notes';

        return view('edit')->with('table', $table)->with('field', $field);
    }

    public function updateDeparted($id) {


        $oldEntry = \DB::table('time')->find($id);
        $newEntry = \Request::get('departed');

        \DB::table('time')
            ->whereIdAndDeparted($id, $oldEntry->departed)
            ->update(['departed' => $newEntry]);

        return redirect('/entries');
    }

    public function updateArrived($id) {

        $oldEntry = \DB::table('time')->find($id);
        $newEntry = \Request::get('arrived');

        \DB::table('time')
            ->whereIdAndArrived($id, $oldEntry->arrived)
            ->update(['arrived' => $newEntry]);

        return redirect('/entries');

        }

    public function updateDate($id) {

        $oldEntry = \DB::table('time')->find($id);
        $newEntry = \Request::get('date');

        \DB::table('time')
            ->whereIdAndDate($id, $oldEntry->date)
            ->update(['date' => $newEntry]);

        return redirect('/entries');
    }

    public  function  updateWorkhours($id) {

        $oldEntry = \DB::table('info')->find($id);
        $newEntry = \Request::get('work_hours');

        \DB::table('info')
            ->whereIdAndWork_hours($id, $oldEntry->work_hours)
            ->update(['work_hours' => $newEntry]);

        return redirect('/entries');

    }

    public function updateBrhours($id) {

        $oldEntry = \DB::table('info')->find($id);
        $newEntry = \Request::get('br_hours');

        \DB::table('info')
            ->whereIdAndBr_hours($id, $oldEntry->br_hours)
            ->update(['br_hours' => $newEntry]);

        return redirect('/entries');

    }

    public function updateOthours($id) {

        $oldEntry = \DB::table('info')->find($id);
        $newEntry = \Request::get('ot_hours');

        \DB::table('info')
            ->whereIdAndOt_hours($id, $oldEntry->ot_hours)
            ->update(['ot_hours' => $newEntry]);

        return redirect('/entries');
    }



    public function updateNotes($id) {

        $oldEntry = \DB::table('info')->find($id);
        $newEntry = \Request::get('notes');

        \DB::table('info')
            ->whereIdAndNotes($id, $oldEntry->notes)
            ->update(['notes' => $newEntry]);

        return redirect('/entries');
    }
}

