<?php 
namespace App\Services;

use App\Models\Dating;
use App\Models\Matching;
use App\Repositories\UserRepository;

class DatingService{
    protected $userRepository;

    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function updateDating($user_id,$address,$money,$gender,$work,$lever,$type_selects,$zodiac,$minAge,$maxAge){
        $check = Matching::where('user_id',$user_id)->first();
        if($check){
            $this->userRepository->updateDating($user_id,$address,$money,$gender,$work,$lever,$type_selects,$zodiac);
        }
        else{
            $this->userRepository->createDating($user_id,$address,$money,$gender,$work,$lever,$type_selects,$zodiac);
            
        }
        $this->userRepository->updateAge($user_id,$minAge,$maxAge);
        return true;
    }

    public function likeUser($requester_id,$requested_id)
    {
        $compatible = $this->userRepository->checklikeUser($requester_id,$requested_id);
        if($compatible){
            if($compatible->requested_id === $requester_id && $compatible->status ==='pending'){
                $this->userRepository->updateCompatible($requester_id,$requested_id);
            }
        }
        else{
            $this->userRepository->createCompatible($requester_id,$requested_id);

        }
    }
}