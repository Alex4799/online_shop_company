<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\UserInterface;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class UserInterfaceController extends Controller
{
    public function editInterface(){
        $data=UserInterface::where('id',1)->first();
        return view('main.admin.account.interface',compact('data'));
    }

    public function getInterface(){
        $data=UserInterface::where('id',1)->first();
        return response()->json($data, 200);
    }

    public function editAboutImage_admin(){
        $data=UserInterface::where('id',1)->first();
        return view('main.admin.account.editAboutImage',compact('data'));
    }

    public function updateAboutImage_admin(Request $req){
        $data=UserInterface::where('id',1)->first()->about_us_image;
        $oldImage=$data[$req->index];
        if ($req->hasFile('image')) {
            $newImage=uniqid().$req->file('image')->getClientOriginalName();
            Storage::delete('public/interface/'.$oldImage);
            $req->file('image')->storeAs('public/interface',$newImage);
            $data[$req->index]=$newImage;
        }
        UserInterface::where('id',1)->update(['about_us_image'=>$data]);
        return back()->with(['success'=>'Image update successful.']);
    }

    public function addAboutImage_admin(Request $req){
        $data=UserInterface::where('id',1)->first()->about_us_image;
        if ($req->hasFile('image')) {
            $newImage=uniqid().$req->file('image')->getClientOriginalName();
            $req->file('image')->storeAs('public/interface',$newImage);
            array_push($data,$newImage);
        }
        // dd($data);
        UserInterface::where('id',1)->update(['about_us_image'=>$data]);
        return back()->with(['success'=>'Image add successful.']);
    }

    public function deleteAboutImage_admin($index){
        $data=UserInterface::where('id',1)->first()->about_us_image;
        $oldImage=$data[$index];
        Storage::delete('public/interface/'.$oldImage);
        unset($data[$index]);
        UserInterface::where('id',1)->update(["about_us_image"=>$data]);
        return back()->with(['danger'=>'Image delete successful.']);

    }

    public function updateInterface(Request $req){
        $interface=UserInterface::where('id',1)->first();
        Validator::make($req->all(),[
            'company_name'=>'required',
            'company_email'=>'required',
            'company_phone'=>'required',
            'company_address'=>'required',
            'description'=>'required',
            'about_us_description'=>'required',
            'footer_description'=>'required',
        ])->validate();

        $data=[
            'company_name'=>$req->company_name,
            'company_email'=>$req->company_email,
            'company_phone'=>$req->company_phone,
            'company_address'=>$req->company_address,
            'description'=>$req->description,
            'about_us_description'=>$req->about_us_description,
            'footer_description'=>$req->footer_description,
            'font_color'=>$req->font_color,
            'bg_color'=>$req->bg_color,
        ];

        if ($req->company_logo!=null) {
            $oldImage=$interface->company_logo;
            if ($oldImage!=null) {
                Storage::delete('public/interface/'.$oldImage);
            }
            $image=uniqid().'_company_logo_'.$req->file('company_logo')->getClientOriginalName();
            $req->file('company_logo')->storeAs('public/interface',$image);
            $data['company_logo']=$image;
        }

        if ($req->cover_image!=null) {
            $oldImage=$interface->cover_image;
            if ($oldImage!=null) {
                Storage::delete('public/interface/'.$oldImage);
            }
            $image=uniqid().'_cover_image_'.$req->file('cover_image')->getClientOriginalName();
            $req->file('cover_image')->storeAs('public/interface',$image);
            $data['cover_image']=$image;
        }

        if ($req->about_us_image!=null) {
            $oldImage=$interface->about_us_image;
            if ($oldImage!=null) {
                Storage::delete('public/interface/'.$oldImage);
            }
            $image=uniqid().'_about_us_image_'.$req->file('about_us_image')->getClientOriginalName();
            $req->file('about_us_image')->storeAs('public/interface',$image);
            $data['about_us_image']=$image;
        }

        UserInterface::where('id',1)->update($data);
        return redirect()->route('admin#editInterface')->with(['success'=>'Profile update successful.']);

    }
}
