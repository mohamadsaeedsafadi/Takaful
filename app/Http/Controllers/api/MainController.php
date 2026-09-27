<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Http\Resources\expert as ResourcesExpert;
use App\Http\Resources\reguser as ResourcesReguser;
use App\Http\Resources\user as ResourcesUser;
use App\Http\Resources\user as TimeResource;
use App\Models\Expert;
use App\Models\Fav;
use App\Models\Reguser;
use App\Models\Time;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator as FacadesValidator;
use Illuminate\Validation\Validator;
use DateTime;
use DateInterval;
use Carbon\Carbon;
use function PHPSTORM_META\type;

class MainController extends Controller
{
    use ApiResponse;
    public function regs()
    {
        $reg = ResourcesReguser::collection(Reguser::get());
        return $this->apiresponse($reg, 200, 'ok');
    }

    public function users()
    {
        $user = ResourcesUser::collection(User::get());
        return $this->apiresponse($user, 200, 'ok');
    }


    public function experts()
    {
        $expert = ResourcesExpert::collection(Expert::get());
        return $this->apiresponse($expert, 200, 'ok');
    }
    //-----------------------------------



    public function reg($id)
    {
        $reg = Reguser::find($id);
        if ($reg) {
            return $this->apiresponse(new ResourcesReguser($reg), 200, 'ok');
        }
        return $this->apiresponse(null, 404, 'not found');
    }

    public function user($id)
    {

        $user = User::find($id);
        if ($user) {
            return $this->apiresponse(new ResourcesUser($user), 200, 'ok');
        }
        return $this->apiresponse(null, 404, 'not found');
    }


    public function expert($id)
    {
        $expert = Expert::find($id);
        if ($expert) {
            return $this->apiresponse(new ResourcesExpert($expert), 200, 'ok');
        }
        return $this->apiresponse(null, 404, 'not found');
    }

    public function expertinfo(Request $request)
    {
        $expert = Expert::find($request->id);
        if ($expert) {
            return $this->apiresponse(new ResourcesExpert($expert), 200, 'ok');
        }
        return $this->apiresponse(null, 404, 'not found');
    }

    public function insert_regs(Request $request)
    {
        $val = FacadesValidator::make($request->all(), [
            'name' => 'required',
            'email' => 'required',
            'password' => 'required',
            'photo',
            'phone',
            'address',
            'type',
        ]);
        if ($val->fails()) {
            return $this->apiresponse(null, 400, $val->errors());
        }



        $post = Reguser::create($request->all());
        if ($post) {
            return $this->apiresponse(new ResourcesReguser($post), 200, 'ok');
        }
        return $this->apiresponse(null, 400, 'not save');
    }
    public function insert_users(Request $request)
    {
        $val = FacadesValidator::make($request->all(), [
            'name' => 'required',
            'email' => 'required',
            'password' => 'required',
            'type',

        ]);
        if ($val->fails()) {
            return $this->apiresponse(null, 400, $val->errors());
        }
        $post = User::create($request->all());
        if ($post) {
            return $this->apiresponse(new ResourcesUser($post), 200, 'ok');
        }
        return $this->apiresponse(null, 400, 'not save');
    }

    public function insert_experts(Request $request)
    {
        $val = FacadesValidator::make($request->all(), [
            'name' => 'required',
            'email' => 'required',
            'password' => 'required',
            'photo',
            'phone',


            'address' => 'required',
            'time1' => 'required',
            'time2' => 'required',

            'experience' => 'required',
            'consultation_type' => 'required',
            'type',
            'rate',
        ]);
        if ($val->fails()) {
            return $this->apiresponse(null, 400, $val->errors());
        }
        $post = Expert::create($request->all());
        if ($post) {
            return $this->apiresponse(new ResourcesExpert($post), 200, 'ok');
        }
        return $this->apiresponse(null, 400, 'not save');
    }

    public function update_reg(Request $request, $id)
    {

        $val = FacadesValidator::make($request->all(), [
            'name' => 'required',
            'email' => 'required',
            'password' => 'required',
            'photo',
            'phone',
            'address',
            'type',
        ]);
        if ($val->fails()) {
            return $this->apiresponse(null, 400, $val->errors());
        }
        $post = Reguser::find($id);
        if (!$post) {
            return $this->apiresponse(null, 404, 'not found');
        }
        $post->update($request->all());
        if ($post) {
            return $this->apiresponse(new ResourcesReguser($post), 200, 'the post updated');
        }
        return $this->apiresponse(null, 404, 'not found');
    }


    public function update_user(Request $request, $id)
    {

        $val = FacadesValidator::make($request->all(), [
            'name' => 'required',
            'email' => 'required',
            'password' => 'required',
            'type',


        ]);
        if ($val->fails()) {
            return $this->apiresponse(null, 400, $val->errors());
        }
        $post = User::find($id);
        if (!$post) {
            return $this->apiresponse(null, 404, 'not found');
        }
        $post->update($request->all());
        if ($post) {
            return $this->apiresponse(new ResourcesUser($post), 200, 'the post updated');
        }
        return $this->apiresponse(null, 404, 'not found');
    }



    public function update_expert(Request $request, $id)
    {

        $val = FacadesValidator::make($request->all(), [
            'name' => 'required',
            'email' => 'required',
            'password' => 'required',
            'photo',
            'phone',
            'address' => 'required',
            'time1' => 'required',
            'time2' => 'required',

            'experience' => 'required',
            'consultation_type' => 'required',
            'type',

        ]);
        if ($val->fails()) {
            return $this->apiresponse(null, 400, $val->errors());
        }
        $post = Expert::find($id);
        if (!$post) {
            return $this->apiresponse(null, 404, 'not found');
        }
        $post->update($request->all());
        if ($post) {
            return $this->apiresponse(new ResourcesExpert($post), 200, 'the post updated');
        }
        return $this->apiresponse(null, 404, 'not found');
    }
    public function savereg(Request $request)
    {
        $validator = FacadesValidator::make($request->only(
            'name',
            'email',
            'password',
            'photo',
            'phone',
            'address',
            'type',
        ), [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:regusers',
            'password' => 'required|string|min:5',
            // 'photo',
            // 'phone',
            // 'address',
            // 'type',


        ]);
        if ($validator->fails()) {
            return response()->json($validator->errors()->toJson(), 400);
        }

        $img = $request->file('photo')->getClientOriginalName();
        $path = $request->file('photo')->storeAs('users', $img, 'me');
        $data = Reguser::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => $request->password,
            'photo' => $path,
            'phone' => $request->phone,
            'address' => $request->address,
            'type' => $request->type,
        ]);




        return $this->apiresponse(new ResourcesReguser($data), 200, 'saved info to log in now');
    }


    public function saveexp(Request $request)
    {




        $validator = FacadesValidator::make($request->only(
            'name',
            'email',
            'password',
            'photo',
            'phone',
            'address',
            'time1',
            'time2',
            'experience',
            'consultation_type',
            'type',
        ), [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:experts',
            'password' => 'required|string|min:6',
            'photo',
            'phone',
            'address',
            'time1',
            'time2',

            'experience',
            'consultation_type',
            'type',



        ]);
        if ($validator->fails()) {
            return response()->json($validator->errors()->toJson(), 400);
        }

        $img = $request->file('photo')->getClientOriginalName();
        $path = $request->file('photo')->storeAs('users', $img, 'me');

        $data = Expert::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => $request->password,
            'photo' => $path,
            'phone' => $request->phone,
            'address' => $request->address,

            'time1' => $request->time1,
            'time2' => $request->time2,

            'experience' => $request->experience,
            'consultation_type' => $request->consultation_type,
            'type' => $request->type,
            'rate' => 0,
        ]);
        DB::table('users')->where('email', $request->only('email'))->update([
            'type' => $request->type,
        ]);




        return $this->apiresponse(new ResourcesExpert($data), 200, 'saved info to log in now');
    }

    public function getname(Request $request)
    {



        $name = DB::table('experts')->where('name', 'like', '%' . $request->name . '%')->get(['name', 'email', 'photo', 'phone', 'address', 'time1', 'time2', 'experience', 'consultation_type', 'rate','id']);

        if ($name) {
            return response()->json([

                'data' => $name,
                'status' => 200,

            ]);
        }
    }




    public function getcon(Request $request)
    {


        $con = DB::table('experts')->where('consultation_type', $request->all())->get(['name', 'email', 'photo', 'phone', 'address', 'time1', 'time2', 'experience', 'consultation_type', 'rate','id']);
        if ($con) {
            return response()->json([

                'data' => $con,
                'status' => 200,

            ]);
        }
    }
    public function getAllUseresForCon($id)
    {


        $con = DB::table('times')->where('expert_id',$id)->get(['id','name', 'email', 'photo', 'phone','start_datetime',]);
        if ($con) {
            return response()->json([

                'data' => $con,
                'status' => 200,

            ]);
        }
    }

    public function gettime($id)
    {
        $time = Expert::find($id);



        return response()->json([

            'data' => $time->time,
            'status' => 200,

        ]);
    }

    // public function pick(Request $request, $id,$type)
    // {

    //     if($type==1){
    //         $name = DB::table('experts')->where('id', $id)->value('name');
    //         $email = DB::table('experts')->where('id', $id)->value('email');
    //         $photo = DB::table('experts')->where('id', $id)->value('photo');
    //         $phone = DB::table('experts')->where('id', $id)->value('phone');
    //     }else{
    //         $name = DB::table('regusers')->where('id', $id)->value('name');
    //         $email = DB::table('regusers')->where('id', $id)->value('email');
    //         $photo = DB::table('regusers')->where('id', $id)->value('photo');
    //         $phone = DB::table('regusers')->where('id', $id)->value('phone');
    //     }



    //     $data = Time::create([
    //         'time' => $request->time,
    //         'date' => $request->date,
    //         'expert_id' => $request->expert_id,
    //         'name' => $name,
    //         'email' => $email,
    //         'photo' => $photo,
    //         'phone' => $phone,
    //     ]);


    //     return response()->json([
    //         'status' => 200,


    //     ]);
    // }

    public function getByEmail(Request $request){
        $ex = DB::table('experts')->where('email',$request->only('email'))->value('email');
        $reg = DB::table('regusers')->where('email',$request->only('email'))->value('email');
        if($ex!=null){
         $ex1 = DB::table('experts')->where('email',$request->only('email'))->get(['name', 'email', 'photo', 'phone','type','id']);
         return response()->json([
          'data' => $ex1,
          'status' => 200,

      ]);
        }
        if($reg!=null){
          $reg1 = DB::table('regusers')->where('email',$request->only('email'))->get(['name', 'email', 'photo', 'phone','type','id']);
          return response()->json([
           'data' => $reg1,
           'status' => 200,

       ]);
        }
        else{

          return response()->json([
            'data' => null,
            'status' => 400,

        ]);
        }


      }


    public function rate($id, $request1)
    {
        floatval($fi = DB::table('experts')->where('id', $id)->value('rate'));

        floatval($rate =  $fi + $request1 / 2.0);

        DB::table('experts')->where('id', $id)->update([
            'rate' => $rate,
        ]);

        return response()->json([
            'status' => 200,

        ]);
    }



    /////////////////////////////shehab/////////////////////
    public function search($name)
    { //search for an expert by name
        $data = Expert::where('name', 'like', '%' . $name . '%')->get();
        if (count($data) == 0)
            return $this->apiresponse(null, 404, 'no experts in such name');
        return $this->apiresponse($data, 200, 'expert found');
    }

    public function typeFilter($consultation_type)
    { //filter experts by consultation type
        $consultations = array('family', 'medical', 'psychological', 'professional');
        if (!in_array($consultation_type, $consultations))
            return $this->apiresponse(null, 404, 'no such category');
        $data = Expert::where('consultation_type', '=', $consultation_type)->get();
        if (count($data) == 0)
            return $this->apiresponse(null, 404, 'no experts in this category');
        return $this->apiresponse($data, 200, 'found');
    }

    public function advancedSearch(Request $request)
    { //search for an expert after filtering by consultation type
        $data = Expert::where('consultation_type', '=', $request->consultation_type)->where('name', 'like', '%' . $request->name . '%')->get();
        if (count($data) == 0)
            return $this->apiresponse(null, 404, 'no experts of such info');
        return $this->apiresponse($data, 200, 'found');
    }





    public function toggleFavorite($id,$expert_id)//when toggled, the expert is added to the user_favored_expert which is then used to retrieve a particualr user's favorite experts.
        {   $user = Reguser::where('id',$id)->get()->first();
            $user->favoredExperts()->toggle([$expert_id]);
            return $this->apiResponse(null,200,'toggled successfully');
        }

        public function favoriteList($id)// this is the controller that implements the idea of favorite list. (whenFavoredById() is a scope method that has some query building conditions.)
        {
            $experts = Expert::whenFavoredById($id);
            $data = ResourcesExpert::make($experts)->get();
            if(count($data)==0)
            return $this->apiResponse(null,400,'This user has no favorite experts');
            return $this->apiResponse($data,200,'favorite experts of this user returned');
        }

        public function isFavoredById($user_id,$expert_id){// shows if an expert has been tagged as favorite by a user
            $expert= Expert::where('id',$expert_id)->get()->first();
            $data = $expert->isFavoredById($user_id);
            return $this->apiResponse($data,200,'done');
        }




    public function makeAppointment(Request $request,$id,$type)
    {
        $userId =$id;
        $name = Reguser::where('id', $userId)->value('name');
        $email = Reguser::where('id', $userId)->value('email');
        $image = Reguser::where('id', $userId)->value('photo');
        $phone = Reguser::where('id', $userId)->value('phone');

        //handle money transfer

        //query money values of the authenticated user and desired expert from the User and Expert Models
        $user_money = Reguser::where('id', $userId)->value('money');
        $expert_money = Expert::where('id', $request->expert_id)->value('money');
        //query fee value of the desired expert from the Expert model.
        $fee = Expert::where('id', $request->expert_id)->value('fee');
        //if the fee is more than the user's money, return.
        if(($user_money - $fee < 0))
        return $this->apiResponse(null,400,'User does not have enough money to complete the transaction');

        //else, update the user and expert's money values so that the fee is transferred from the user to the expert.
        Reguser::where('id', $userId)->update(['money' => $user_money - $fee]);
        Expert::where('id', $request->expert_id)->update(['money' => $expert_money + $fee]);

        //handle appointment conflicts
        $clockIn = Expert::where('id', $request->expert_id)->value('time1'); //qurery clock in and clock out from the database
        $clockOut = Expert::where('id', $request->expert_id)->value('time2');

        //grab the desired appointment time and date from the request and parse them to get their components.
        $desiredTimeParsed = date_parse($request->start_time);
        $desiredDateParsed = date_parse($request->date);

        //use the function checkAppointmentConflictWithExpertTime() to check for any conflicts between user's desired appointment time and expert's available time.
        if($this->checkAppointmentConflictWithExpertTime($clockIn, $clockOut, $request->start_time))
        return $this->apiResponse(null,400,'expert is not available at this time');

        //instantiate a DateTime object and set its time and date values according to the desired time and date values.
        $start_time = Carbon::now();
        $start_time->setTime($desiredTimeParsed['hour'], $desiredTimeParsed['minute'],0);
        $start_time->setDate($desiredDateParsed['year'], $desiredDateParsed['month'], $desiredDateParsed['day']);
        $end_time = Carbon::instance($start_time)->addMinutes(59)->addSeconds(59);
        /*get all the appointments from the Appointment model where the expert_id is equal to the id of the user's desired expert,
         end of the appointment is after each appointment start, and the start of the appointment is before each appointment end  */
        $conflictingAppointments = Time::where('expert_id', $request->expert_id)->where('start_datetime', '<=', $end_time)
        ->where('end_datetime', '>=', $start_time)->get();
        if (count($conflictingAppointments) > 0) { //if the appointm
            return $this->apiResponse(null,400,'The desired time is not available');
        }
        // mass assign and return all the data with a message indicating that the appointment has been made.
        $data=Time::create([
            'start_datetime' => $start_time,
            'end_datetime' => $end_time,
            'expert_id' => $request->expert_id,
            'name' => $name,
            'email' => $email,
            'photo' => $image,
            'money_transferred' => $fee,
            'phone' => $phone,
        ]);
        return $this->apiResponse(new TimeResource($data),200,'appointment made');
    }

    function checkAppointmentConflictWithExpertTime($clockIn, $clockOut, $appointmentStart) {
        $availabilityStart = strtotime($clockIn);
        $availabilityEnd = strtotime($clockOut);
        $appointmentStart = strtotime($appointmentStart);
        $appointmentEnd = $appointmentStart + 3600;  // add 1 hour to the start time

        if ($appointmentStart < $availabilityStart) {
          $appointmentEnd += 86400;  // add a day to the end time (86400 seconds in a day)
        }

        if ($availabilityEnd < $availabilityStart) {
          $availabilityEnd += 86400;  // add a day to the end time (86400 seconds in a day)
        }

        if ($appointmentStart >= $availabilityStart && $appointmentStart < $availabilityEnd) {
          return false;  // no conflict
        } elseif ($appointmentEnd > $availabilityStart && $appointmentEnd <= $availabilityEnd) {
          return false;  // no conflict
        } else {
          return true;  // conflict
        }
      }


}
