<?php

namespace App\Http\Controllers;

use App\Models\taskModel;
use App\Models\users;
use Illuminate\Http\Request;

class taskController extends Controller
{
//        public function __construct(){
//
//        $this->middleware('AdminAuth',['except' => ['index']]);
//    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function index()
    {
        //
        $data =   taskModel::join('users','tasks.addedBy','=','users.id')->select('tasks.*','users.id')->where('tasks.addedBy',auth()->user()->id)->get();
        return view('tasks.index',['data'=>$data]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('tasks.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $this->validate(request(),
            [
                "title"       => "required",
                "description" => "required",
                "sDate"       => "required",
                "eDate"       => "required",
                "image"       => "required|image|mimes:png,jpg,gif,svg"
            ]);

        $FinalName = time().rand().'.'.$request->image->extension();

        # public folder
        if($request->image->move(public_path('images'),$FinalName)){

            $data['image'] = $FinalName;
            $data['addedBy'] = auth()->user()->id;

            $op =  taskModel::create($data);

            if($op){
                $message = "Raw Inserted";
            }else{
                $message = "Error Try Again";
            }

        }else{
            $message = "Error In Uploading Try Again";
        }

        session()->flash('Message',$message);

        return redirect(url('/Tasks'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data = taskModel::find($id);
        return view('tasks.edit',['data' => $data]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        # Validate Data .....
       $this->validate($request,[
            "title"       => "required",
            "description" => "required",
            "sDate"       => "required",
            "eDate"       => "required",
            "image"       => "image|mimes:png,jpg,gif,svg"
        ]);

        $data = taskModel::find($request->id);

        $file_name = $data->image;

        $path = public_path('images/'.$file_name);

        if($request->hasFile('image')){
          //  dd($request->hasFile('image'));
            unlink($path);
            $file_extention =$request->image->getClientOriginalExtension();
            $file_name = time().'.'.$file_extention;
            $request->image->move(public_path('images'),$file_name);
        }else {
            $data->image = $request->old_image;
        }
        $data['image'] = $file_name;
        $op =   taskModel::where('id',$request->id)->update([
            "title"       => $request->title,
            "description" => $request->description,
            "sDate"       => $request->sDate,
            "eDate"       => $request->eDate,
            "image"       => $file_name
        ]);

        if($op){
            $message = "Raw Updated";
        }else{
            $message = "Error Try Again";
        }

        session()->flash('Message',$message);

        return redirect(url('/Tasks'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $data = taskModel::find($id);

        $op = taskModel::where('id',$id)->delete();

        if($op){

            unlink(public_path('images/'.$data->image));

            $message = "Raw Removed";
        }else{
            $message = "Errot Try Again";
        }

        session()->flash('Message',$message);

        return redirect(url('/Tasks'));
    }


    # Auth
    public function doRegister(Request $request){

        # Validate Data .....
        $data =   $this->validate(request(),
            [
            "name"     => "required|min:3",
            "email"    => "required|email",
            "password" => "required|min:6"

        ]);

        $data['password'] =  bcrypt($data['password']);

        $op =   users::create($data);

        if($op){
            $message = "Raw Inserted .";
        }else{
            $message = 'Error Try Again !';
        }

        session()->flash('Message',$message);
        return redirect(url('/Tasks'));
    }
    public function Login(){
        return view('tasks.login');
    }
    public function DoLogin(Request $request){
        // logic .....

        $data = $this->validate($request,[
            "email"    => "required|email",
            "password" => "required|min:6"
        ]);

        if(auth()->attempt($data)){
            return redirect(url('/Tasks'));
        }else{
            return redirect('/Login');
        }

    }
    public function logout(){
        auth()->logout();
        return redirect(url('/Login'));
    }

}
