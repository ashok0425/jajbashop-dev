<?php
namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Level;
use App\Models\Levelearning;
use App\Models\Epintransfer;
use Illuminate\Support\Facades\Auth;
use File;
use Illuminate\Support\Facades\DB;
class LevelearningController extends Controller
{




    public  function levelearning($userid){
        $level=Level::all();

        return view('admin.income.levelearning',compact('level','userid'));

    }


    public  function levelincomeshow($userid,$id){
        $income=DB::table('levels')->join('levelearnings','levelearnings.user_id','levels.user_id')->where('levels.l'.$id,$userid)->select('levelearnings.*')->get();

        return view('admin.income.levelincomeshow',compact('income','id','userid'));

    }



      public  function allearning(){

        $income=DB::table('levels')->join('levelearnings','levelearnings.user_id','levels.user_id')->where(function($level){
            $level->where('levels.l1',Auth::user()->userid)->orwhere('levels.l2',Auth::user()->userid)->orwhere('levels.l3',Auth::user()->userid)->orwhere('levels.l4',Auth::user()->userid)->orwhere('levels.l5',Auth::user()->userid)->orwhere('levels.l6',Auth::user()->userid)->orwhere('levels.l7',Auth::user()->userid)->orwhere('levels.l8',Auth::user()->userid)->orwhere('levels.l9',Auth::user()->userid)->orwhere('levels.l10',Auth::user()->userid);
          })->select('levelearnings.l1 as el1','levelearnings.l2 as el2','levelearnings.l3 as el3','levelearnings.l4 as el4','levelearnings.l5 as el5','levelearnings.l6 as el6','levelearnings.l7 as el7','levelearnings.l8 as el8','levelearnings.l9 as el9','levelearnings.l10 as el10','levelearnings.created_at as created','levels.*')->get();
        //   dd($income);
        return view('member.income.income',compact('income'));

    }
}
