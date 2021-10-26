<?php
namespace App\Http\Traits;
use App\Models\Category;
use File;
/**
 *
 */
use Illuminate\Support\Facades\DB;
trait status
{
   /**
     * Return a success JSON response.
     *
     * @param  array|string  $data
     * @param  string  $message
     * @param  int|null  $code
     * @return \Illuminate\Http\JsonResponse
     */
    protected function active($id,$table){
        DB::table($table)->where('id',$id)->update([
             'status'=>1,
         ]);
         $notification=array(
             'alert-type'=>'info',
             'messege'=>'Status Activated',

          );
          return redirect()->back()->with($notification);
     }

     protected function deactive($id,$table){
        DB::table($table)->where('id',$id)->update([
            'status'=>0,
        ]);
        $notification=array(
            'alert-type'=>'info',
            'messege'=>'Status Deactivated',

         );
         return redirect()->back()->with($notification);
    }


    protected function destroy($id,$table){
      $image=DB::table($table)->where('id',$id)->value('image');
      if($image){
          File::delete($image);
      }
      DB::table($table)->where('id',$id)->delete();

        $notification=array(
            'alert-type'=>'success',
            'messege'=>'Sucessfull deleted',

         );
         return redirect()->back()->with($notification);
    }


}
