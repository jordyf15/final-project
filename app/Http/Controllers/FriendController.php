<?php

namespace App\Http\Controllers;

use App\Models\FriendDetail;
use App\Models\FriendRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FriendController extends Controller
{
    //
    public function showFriendPage(){
        if(Auth::user() && Auth::user()->role=='member'){
            $user = Auth::user();
            $incomingFriendRequest = $user->incomingFriendRequests;
            $pendingFriendRequest = $user->pendingFriendRequests;
            $friendDetails = $user->friendList->friendDetails;
            // dd($incomingFriendRequest, $pendingFriendRequest,$friendDetails);
            return view('pages.friend', ['user'=>$user, 'incomingFriendRequest'=>$incomingFriendRequest, 
            'pendingFriendRequest'=>$pendingFriendRequest, 'friendDetails'=>$friendDetails]);
        }else{
            return redirect('/');
        }
    }

    public function addFriend(Request $request){
        $user = Auth::user();
        $friendUsername = $request->username;
        $friend = User::where('username', $friendUsername)->where('role','member')->first();
        if(!$friend) return back()->withErrors(['User was not found']);
        $friend_id = $friend->user_id;
        $user_id = $user->user_id;
        if($friend_id == $user_id) return back()->withErrors(['You cannot befriend yourself']);

        $friendDetails = $user->friendList->friendDetails;
        $alreadyInFriendList = false;
        for($i = 0; $i<count($friendDetails);$i++){
            if($friendDetails[$i]->user->user_id == $friend_id) $alreadyInFriendList = true;
        }
        if($alreadyInFriendList == true){
            return back()->withErrors(['The user is already in the friend list']);
        }

        $incomingFriendRequests = $user->incomingFriendRequests;
        $alreadyIncomingFriendRequest = false;
        for($i = 0;$i<count($incomingFriendRequests);$i++){
            if($incomingFriendRequests[$i]->sender->user_id == $friend_id) $alreadyIncomingFriendRequest = true;
        }
        if($alreadyIncomingFriendRequest == true){
            return back()->withErrors(['The user is already in the incoming friend request list']);
        }

        $pendingFriendRequests = $user->pendingFriendRequests;
        $alreadyPendingFriendRequest = false;
        for($i = 0;$i<count($pendingFriendRequests);$i++){
            if($pendingFriendRequests[$i]->receiver->user_id == $friend_id) $alreadyPendingFriendRequest = true;
        }
        if($alreadyPendingFriendRequest == true){
            return back()->withErrors(['The user is already in the pending friend request list']);
        }

        $friendRequest = new FriendRequest();
        $friendRequest->sender_id = $user_id;
        $friendRequest->receiver_id = $friend_id;
        $friendRequest->save();
        
        return redirect('/friends');
    }


    public function acceptFriendRequest($friend_request_id){
        $friend_request = FriendRequest::where('friend_request_id', $friend_request_id)->first();
        $receiver = User::where('user_id', $friend_request->receiver_id)->first();
        $sender = User::where('user_id', $friend_request->sender_id)->first();
        $receiverFriendListId = $receiver->friendList->friend_list_id;
        $senderFriendListId = $sender->friendList->friend_list_id;

        $receiverNewFriendDetail = new FriendDetail();
        $receiverNewFriendDetail->friend_list_id = $receiverFriendListId;
        $receiverNewFriendDetail->friend_id = $sender->user_id;
        $receiverNewFriendDetail->save();

        $senderNewFriendDetail = new FriendDetail();
        $senderNewFriendDetail->friend_list_id = $senderFriendListId;
        $senderNewFriendDetail->friend_id = $receiver->user_id;
        $senderNewFriendDetail->save();

        $friend_request->delete();
        return redirect('/friends');
    }

    public function rejectFriendRequest($friend_request_id){
        $friend_request = FriendRequest::where('friend_request_id', $friend_request_id)->first();
        $friend_request->delete();
        return redirect('/friends');
    }
}
