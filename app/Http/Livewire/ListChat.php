<?php

namespace App\Http\Livewire;

use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class ListChat extends Component
{
    public function render()
    {
        
            $id = Auth::user()->id;
            $messages = DB::table('messege')->where('requested_id', $id)->orWhere('requester_id', $id)->get();
            $chat_list = [];
    
            // Tạo một mảng chứa các tin nhắn của từng người dùng
            foreach ($messages as $message) {
                if ($message->requester_id != $id) {
                    $chat_list[$message->requester_id][] = $message;
                } elseif ($message->requested_id != $id) {
                    $chat_list[$message->requested_id][] = $message;
                }
            }
    
            $save = [];
    
            // Lặp qua danh sách tin nhắn của từng người dùng và lấy tin nhắn cuối cùng
            foreach ($chat_list as $user_id => $user_messages) {
                $lastMessenger = collect($user_messages)
                    ->sortByDesc('created_at')
                    ->first();
    
                if ($lastMessenger) {
                    $save[] = $lastMessenger;
                }
            }
            foreach($save as $index){
                $words = str_word_count($index->content, 1);
                if (count($words) > 3) {
                    $shortenedContent = implode(' ', array_slice($words, 0, 3)) . '...';
                } else {
                    $shortenedContent = $index->content;
                }
                $html = '';
                if($index->requester_id === $id){
                    $useri = User::find($index->requested_id);
                    $fullname = $useri->first_name . ' ' . $useri->last_name;
                    $startDate = Carbon::parse($index->created_at); // Sử dụng parse để chuyển đổi ngày tháng từ chuỗi hoặc timestamp
                    $endDate = Carbon::now(); // Ngày đích, hiện tại
                    $indexContent = $index->content; // Lấy nội dung gốc
                    $diff = $startDate->diffForHumans($endDate); // Đảo ngày bắt đầu và ngày kết thúc để tính khoảng thời gian
                    $html .= '<div class="route-layout" onclick="testOnclick('.$useri->id.')">
                        <div class="content-messenger d-flex">
                            <div class="user d-flex">
                                <div class="avatar">
                                    <img src="' . (!is_null($useri->avatar) ? asset("storage/users_avatar/{$useri->avatar}") : asset("storage/users_avatar/guest-user-250x250.jpg")) . '" alt="">
                                </div>
                                <div class="box">
                                    <div class="username"><h6>' . $fullname . '</h6></div>
                                    <div class="messege d-flex">
                                        <span>Bạn: '.$shortenedContent.'</span>
                                        <div class="space"> . </div>
                                        <div class="time">
                                            <span>'.$diff.'</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>';
                }
                else{

                    $useri = User::find($index->requester_id);
                    
                    $fullname = $useri->first_name . ' ' . $useri->last_name;
                    $startDate = Carbon::parse($index->created_at); // Sử dụng parse để chuyển đổi ngày tháng từ chuỗi hoặc timestamp
                    $endDate = Carbon::now(); // Ngày đích, hiện tại
                    $diff = $startDate->diffForHumans($endDate); // Đảo ngày bắt đầu và ngày kết thúc để tính khoảng thời gian
                    $html .= '<div class="route-layout" onclick="testOnclick('.$useri->id.')"  >
                        <div class="content-messenger d-flex">
                            <div class="user d-flex">
                                <div class="avatar">
                                    <img src="' . asset("storage/users_avatar/{$useri->avatar}") . '" alt="">
                                </div>
                                <div class="box">
                                    <div class="username"><h6>' . $fullname . '</h6></div>
                                    <div class="messege ' . ($index->status === 0 ? 'active' : '') . ' d-flex">
                                        <span>'.$shortenedContent.'</span>
                                        <div class="space"> . </div>
                                        <div class="time">
                                            <span>'.$diff.'</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="status">' . ($index->status === 0 ? '<i class="bx bxs-circle"></i>' : '') . '</div>
                        </div>
                    </div>';
                }
            }
            return view('livewire.list-chat',[
                'html' => $html,
            ]);
    }
}
