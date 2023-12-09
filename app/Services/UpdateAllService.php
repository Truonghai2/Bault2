<?php
namespace App\Services;

use App\Models\Random;
use App\Repositories\UserRepository;

class UpdateAllService{
    protected $userRepository;
    public function __construct(UserRepository $userRepository) {
        $this->userRepository = $userRepository;

    }
    public function Update($user_id,$newData,$column){
        
        return $this->userRepository->Update($user_id,$newData,$column);
    }

    public function updateRelations($id, $newData,$to_id){
        $check = Random::where('from_id',$id)->first();
        if($check){
            return $this->userRepository->updateRandom($check,$newData,$to_id);
        }
        return $this->userRepository->CreateRandom($id,$newData,$to_id);
    }
}