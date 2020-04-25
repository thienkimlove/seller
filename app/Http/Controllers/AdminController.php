<?php

namespace App\Http\Controllers;

use App\Notification;
use App\User;
use Carbon\Carbon;
use Exception;
use Illuminate\Http\Request;
use Image;
use Laravel\Socialite\Facades\Socialite;

class AdminController extends Controller
{
    /**
     * Create a new controller instance.
     */
    public function __construct()
    {
        $this->middleware('auth.backend',  ['except' => [
            'redirectToGoogle',
            'handleGoogleCallback',
            'logout',
            'notice'
        ]]);
    }

    public function notice()
    {
        return view('admin.notification');
    }

    /** Redirect to G+ authenticate.
     * @return mixed
     */
    public function redirectToGoogle()
    {
        return Socialite::driver('google')->redirect();
    }


    public function handleGoogleCallback()
    {
        try {
            $googleUser = Socialite::driver('google')->user();
            $user = User::where('email', $googleUser->email)->first();
            if ($user) {
                session()->put('admin_login', $user);
                session()->put('admin_token', $googleUser->token);
                return redirect('/admin');
            } else {
                @file_get_contents('https://accounts.google.com/o/oauth2/revoke?token='. $googleUser->token);
                flash()->error('User with email '.$googleUser->email. ' not existed in database!');
                return redirect('admin/notice');
            }
        } catch (Exception $e) {
            flash()->error('Have error '.$e->getMessage(). '! Please try again!');
            return redirect('admin/notice');
        }
    }


    public function logout()
    {
        @file_get_contents('https://accounts.google.com/o/oauth2/revoke?token='.session()->get('admin_token'));
        session()->forget('admin_login');
        session()->forget('admin_token');

        return redirect('admin/notice');
    }
    public function index(Request $request)
    {
       $user = session()->get('admin_login');
       return view('admin.index', compact('user'));
    }

    public function saveImage($file, $old = null)
    {
        $filename = md5(uniqid().'_'.time()) . '.' . $file->getClientOriginalExtension();
        Image::make($file->getRealPath())->save(public_path('files/' . $filename));
        if ($old) {
            @unlink(public_path('files/' . $old));
        }
        return $filename;
    }

    public function ajax()
    {
        $user = session()->get('admin_login');
        $todayStart = Carbon::now()->startOfDay();
        $todayEnd = Carbon::now()->endOfDay();
        $notifications = Notification::latest('created_at')->limit(5)->get();
        $userRead = \DB::table('notification_user')
            ->where('user_id', $user->id)
            ->pluck('notification_id')
            ->all();
        $countNew = \DB::table('notifications')
            ->whereNotIn('id', array_unique($userRead))
            ->whereBetween('created_at', [$todayStart, $todayEnd])
            ->count();

        return response()->json(['success' => true, 'html' => view('admin.alert', compact('notifications'))->render(), 'count_new' => $countNew]);
    }

    public function notify()
    {
        $data =  request()->all();
        $status = false;
        $countNew = 0;
        if (isset($data['listRead']) && $data['listRead']) {
            $todayStart = Carbon::now()->startOfDay();
            $todayEnd = Carbon::now()->endOfDay();
            $user = session()->get('admin_login');
            User::find($user->id)->notifications()->attach($data['listRead']);
            $userRead = \DB::table('notification_user')
                ->where('user_id', $user->id)
                ->pluck('notification_id')
                ->all();
            $countNew = \DB::table('notifications')
                ->whereNotIn('id', array_unique($userRead))
                ->whereBetween('created_at', [$todayStart, $todayEnd])
                ->count();
            $status = true;
        }
        return response()->json(['success' => $status, 'count_new' => $countNew]);
    }

}
