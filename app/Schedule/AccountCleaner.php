<?php

namespace App\Schedule;
use App\Models\User;
use Carbon\Carbon;
use App\Notifications\InactiveAccountDeletion;
use Illuminate\Support\Facades\Storage;

Class AccountCleaner{

  public function __invoke(){

    $users = User::all();
    foreach($users as $user){
        $todayTimeStamp = Carbon::now()->startOfDay()->timestamp ;

        $deadline = Carbon::createFromTimestamp($user->last_active)->addMonths(6);
        if($deadline->timestamp == $todayTimeStamp){
          $user->notify(new InactiveAccountDeletion());
        }else{
          if($deadline->addWeek(1)->timestamp > $todayTimeStamp){
            if (Storage::disk('public')->exists($user->profile_image)) Storage::disk('public')->delete($user->profile_image);
            $user->delete();
          }
        }
      }
  }

}
