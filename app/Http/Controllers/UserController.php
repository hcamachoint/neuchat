<?php
namespace App\Http\Controllers;
use App\Models\User as User;
use Session;
use Redirect;
use Image;
use DB;
use Mapper;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }


    public function index()
    {
        $user = auth()->user();
        return view('users.view', ['user' => $user]);
    }

    public function update_picture(Request $request, $id)
    {
        $this->validate($request, [
            'avatar' => 'required | dimensions:min_width=100,min_height=100 | image',
        ]);

        try {
            $user = auth()->user();
            if ($user->id == $id) {
                if($request->hasFile('avatar')){
                    $avatar = $request->file('avatar');
                    echo hash('ripemd160', 'user'.time());
                    $filename = hash('ripemd160', auth()->user()). '_' . time() . '.' . $avatar->getClientOriginalExtension();
                    Image::make($avatar)->resize(300, 300)->save( public_path('avatars/' . $filename ) );

                    try {
                        $user = auth()->user();
                        $user->image_path = $filename;
                        $user->save();
                        return Redirect()->route('profile')->with('message', 'Photo successfully updated!');
                    } catch (Exception $e) {
                        Session::flash('message-error', 'An error occurred while trying to process your request');
                        return Redirect::back();
                    }
                }
            }else{
                return abort(403, 'Unauthorized action.');
            }
        } catch (Exception $e) {
            Session::flash('message-error', 'An error occurred while trying to process your request');
            return Redirect::back();
        }
    }

    public function list(Request $request)
    {
        if ($request->ajax()) {  //CHEQUEA QUE LA SOLICITUD SEA API
            $authUserId = auth()->user()->id;
            $users = DB::table('users')
                    ->where('users.id','!=',$authUserId)
                    ->get();
            return $users;
        }
    }
}
