<?php

namespace App\Http\Controllers;
use App\talent;
use App\Ingredient;
use App\User;
use Illuminate\Http\Request;
use App\Admin;
use App\Like;
use App\Comment;
use App\Message;
use App\Mail\UserResetPassword;
use DB;
use Mail;
use URL;
use Carbon\Carbon;
use Illuminate\Support\Facades\Hash;
class UserController extends Controller
{
    //

    public function login(){
        return view('users.login');
    }

    public function add_talent(){
        return view('users.add_talent');
    }

    public function register(){
        return view('users.register');

    }

    public function forget_password(){
        return view('users.forget');

    }

    public function reset($token){
        $check=DB::table('password_resets')->where('token',$token)->where('created_at','>',Carbon::now()->subHours(2))->first();
        if(!empty($check)){
            return view('users.reset_password',['data'=>$check]);
        }
        else{
            DB::table('password_resets')->where('email','mostafadeveloper2016@gmail.com')->delete();
           return view('users.forget');  
        }

    }

    public function reset_final($token){
        $this->validate(request(),[
                'password'=>'required|confirmed'
        ]);
        $check=DB::table('password_resets')->where('token',$token)->where('created_at','>',Carbon::now()->subHours(2))->first();
        if(!empty($check)){
            $user=User::where('email',$check->email)->update(['email'=>$check->email,'password'=>Hash::make(request('password'))]);
            DB::table('password_resets')->where('email',$check->email)->delete();
            if(auth()->guard('user')->attempt(['email'=>$check->email,'password'=>request('password')],false)){
            return redirect('/');
                }
        }else{
            return back()->with(['error'=>'This email exceeds 2 hours ']);
        }

    }

    public function reset_request(Request $request){
        $user=User::where('email',$request->email)->first();
        if(!empty($user)){
            $token=app('auth.password.broker')->createToken($user);
            DB::table('password_resets')->insert(['email'=>$user->email,'token'=>$token,'created_at'=>Carbon::now()]);
            Mail::to($user->email)->send(new UserResetPassword(['data'=>$user,'token'=>$token]));
            return back()->with(['success'=>'Reset password email sent successfully']);
        }
        return back()->with(['error'=>'This email does not exist']);
        
    }



    public function search(Request $request){
        $country=$request->country;
        $cat_id=$request->cat_id;
        $title=$request->title;
        $sts=1;
        //dd($request);
        if($request->cat_id==0){
            $talents=Talent::where('admin_status',$sts)->Where('country','like','%' . $country . '%')->Where('title','like','%' . $title. '%')->get();
        }else{
            $talents=Talent::where('category_id',$cat_id)->where('country','like','%' . $country. '%')->where('title','like','%' . $title. '%')->where('admin_status',$sts)->get();
        }
        
        return view('users.search',compact(['talents']));
    }

   

    public function by_category($id){

            $talents=Talent::where('category_id',$id)->get();
         
        return view('users.search',compact(['talents']));
    }


    public function history_talents(){

            $talents=Talent::where('user_id',auth()->guard('user')->user()->id)->get();
         
        return view('users.talents_history',compact(['talents']));
    }

    public function likes(){

            $likes=Like::where('user_id',auth()->guard('user')->user()->id)->get();
         
        return view('users.likes',compact(['likes']));
    }
    

    public function talents(){

            $talents=Talent::where('admin_status',1)->paginate(4);
         
        return view('talents',compact(['talents']));
    }

    public function request_talent(Request $request){
        $data=$this->validate(request(),[
            'name'=>'required',
            'v_url'=>'required',
            'description'=>'required',
             'img'=>'required|image|mimes:jpeg,png,jpg,gif,svg',],[
            ],[
                'img'=>'photo',
                'name'=>'name',
                'description'=>'Description'
            

        ]);
        $talent=new Talent();
        $talent->title=$request->name;
        $talent->description=$request->description;
        $talent->category_id=$request->category_id;
        $talent->v_url=$request->v_url;
        $talent->user_id=auth()->guard('user')->user()->id;
        $talent->country=auth()->guard('user')->user()->country;
        $file = $request->file('img');
        $filename = time() . '.' . $file->getClientOriginalName();
        $path = 'assets/img';
        $file->move($path, $filename);
        $talent->img=$filename;
        $talent->save();
            
            return back()->with('success','Added successfully waiting admin approval');
        
    }

        public function do_register(Request $request){
        $data=$this->validate(request(),[
            'name'=>'required',
            'password'=>'required',
            'address'=>'required',
            'phone'=>'required',
            'email'=>'required',
            'country'=>'required',
            'age'=>'required',
             'img'=>'required|image|mimes:jpeg,png,jpg,gif,svg',],[
            ],[
                'img'=>'photo  ',
                'phone'=>'phone ',
                'name'=>' name',
                'address'=>'address',
                'email'=>' email ',
                'password'=>'password ',
                'age'=>'age ',
                'country'=>'country ',
            

        ]);

        $user=new User();
        $user->summary=$request->summary;
        $user->name=$request->name;
        $user->tid=$request->tid;
        $user->address=$request->address;
        $user->country=$request->country;
        $user->gender=$request->gender;
        $user->age=$request->age;
        $user->email=$request->email;
        $user->phone=$request->phone;
        $user->password=Hash::make($request->password);
        $file = $request->file('img');
        $filename = time() . '.' . $file->getClientOriginalName();
        $path = 'assets/img';
        $file->move($path, $filename);
        $user->img=$filename;
        $user->save();
        return back()->with('success','Account registered successfully');
   
    }

    public function save_message(Request $request){

        $data=$this->validate(request(),[
            'name'=>'required',
            'subject'=>'required',
            'body'=>'required',
            'email'=>'required'],[
            ],[
                'name'=>'Name',
                'body'=>'Body',
                'email'=>'Email',
                'subject'=>'Subject',
        ]);
        $msg=new Message();
        $msg->name=$request->name;
        $msg->content=$request->body;
        $msg->email=$request->email;
        $msg->subject=$request->subject;
        $msg->save();
        return back()->with(['success'=>'Message sent successfully....']);
    }


    public function add_like($id)
    {   
        $user_id=auth()->guard('user')->user()->id;
        $like=Like::where('user_id','=',$user_id)->where('talent_id','=',$id)->get();
        if($like->isNotEmpty()){
            if(URL::previous()=='http://talents.dev/talents/search'){
                return redirect('/')->with('error',' U already like his talent');
            }else{
           return back()->with('error',' U already like his talent');
       }
        }else{
            $like=new Like();
            $like->user_id=$user_id;
            $like->talent_id=$id;
            $like->save();
            if(URL::previous()=='http://talents.dev/talents/search'){
                return redirect('/')->with('success',' U liked this talent.');
            }else{
             return back()->withInput()->with('success',' U liked this talent.');
            }
            
            }

        }

    

    public function add_comment(Request $request){


        $data=$this->validate(request(),[
            'talent_id'=>'required',
            'comment'=>'required'],[
            ],[
                'comment'=>'Comment',
        ]);
       
        $comment=new Comment();
        $comment->user_id=auth()->guard('user')->user()->id;
        $comment->talent_id=$request->talent_id;
        $comment->comment=$request->comment;
        $comment->save();
        return back()->with('success',' Your comment added successfully');;
        
    }

    public function talent($id){
        $talent=Talent::find($id);
        return view('talent',compact(['talent']));
    }

    public function user_profile($id){
        $profile=User::find($id);
        return view('users.profile',compact(['profile']));
    }


    public function check_login(Request $request)
    {   
        $remmberme = $request->remmberme==1?true:false;
        if(auth()->guard('user')->attempt(['email'=>$request->email,'password'=>$request->password],$remmberme)){
            return redirect('/');
        }else{
            return back()->with(['error'=>'Please enter a valid email and password to login']);
        }
    }

    public function logout()
    {
        auth()->guard('user')->logout();
        return redirect('/user/login');

    }

    public function edit_profile(Request $request){
        $user= User::find($request->user_id);
        $user->name=$request->name;
        $user->Address=$request->address;
        $user->phone=$request->phone;
        $user->email=$request->email;
        $user->summary=$request->summary;
        $user->password=Hash::make($request->password);
        $file=$request->file('img');
        if($file){
        $filename = time() . '.' . $file->getClientOriginalName();
        $path = 'assets/img';
        $file->move($path, $filename);
        $user->img=$filename;
        }
        
        $user->update();
        return back()->with('success','Your profile updated successfully');
   
    }
        
    

}
