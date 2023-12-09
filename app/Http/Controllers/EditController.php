<?php
namespace App\Http\Controllers;

use App\Models\User;
use App\Services\BigoService;
use App\Services\UpdateAllService;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
class EditController extends Controller{
    // add bigo in database
    protected $bigoService;  
    protected $updateAll;  
    public function __construct(UpdateAllService $updateAll) {
        
        $this->updateAll = $updateAll;

    }
    public function editBigo(Request $request){
        $user_id = auth()->id();
        $new_bigo = $request->input('new_bigo');
        $this->updateAll->Update($user_id,$new_bigo,'bigo');
        return response()->json(['success' => true,'bigo' => $new_bigo]);
    }
    // add address in database
    public function address (Request $request){
        $user_id = auth()->id();
        $address = $request->input('new_data');
        $address_user = User::select('diachi')->where('id',$user_id);
        if($address !== null && $address !== $address_user ){
            $this->updateAll->Update($user_id,$address,'diachi');
            
            return response()->json(['success'=>true,'address'=>$address]);
        }
        else{
            if($address===null){
                return response()->json(['error'=>'Vui lòng nhập tỉnh/thành phố']);
            }
            
        }
    }

    // // actions random
    // public function actionsRandom(){
    //     $id = auth()->id();
    //     $this->updateAll->Update($id,0,'ready_random');
    //     return response()->json(['success' => true]);
    // }
    // add lever in database
    public function lever(Request $request){
        $user_id = $request->input('user_id');
        $lever = $request->input('lever');
        $this->updateAll->Update($user_id,$lever,'lever');
        return response()->json(['success'=>true,'lever'=>$lever ]);
    }
    // add school in database
    public function school(Request $request){
        $user_id = auth()->id();
        $school = $request->input('school');
        $list_school = DB::table('list_school')->where('name',$school)->first();
        if($list_school){
            $this->updateAll->Update($user_id,$school,'school');
        }
        else{
            DB::table('list_school')->insert([
                'name' => $school,
            ]);
            $this->updateAll->Update($user_id,$school,'school');
        }
        return response()->json(['success'=>true,'school'=>$school]);
    }
    // add work in database
    public function work(Request $request){

        $user_id = auth()->id();
        $work = $request->input('work');
        $check_work = DB::table('list_job')->where('name',$work)->first();
        if($check_work){
           $this->updateAll->Update($user_id,$work,'job');
        }
        else{
            DB::table('list_job')->insert([
                'name'=>$work,
            ]);
            $this->updateAll->Update($user_id,$work,'job');
        }
        return response()->json(['success'=>true,'work'=>$work]);
    }
    // add money in database
    public function Money(Request $request){
        $user_id = auth()->id();
        $money = $request->input("money");
        $this->updateAll->Update($user_id,$money,'meny');
        return response()->json(['success'=>true,'money'=>$money]);
    }
    public function zodiac(Request $request){
        $id = auth()->id();
        $data = $request->input('data');
        $this->updateAll->Update($id,$data,'zodiac');
        return response()->json(['success'=>true]);
    }

    public function zalo(Request $request){
        $id = auth()->id();
        $data = $request->input('data');
        $this->updateAll->Update($id,$data,'zalo');
        return response()->json(['success'=>true]);
    }

    public function instagram(Request $request){
        $id = auth()->id();
        $data = $request->input('data');
        $this->updateAll->Update($id,$data,'link_ig');
        return response()->json(['success'=>true]);
    }
    public function facebook(Request $request){
        $id = auth()->id();
        $data = $request->input('data');
        $this->updateAll->Update($id,$data,'link_fb');
        return response()->json(['success'=>true]);
    }
}