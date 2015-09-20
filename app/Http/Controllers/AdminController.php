<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use App;
use Illuminate\Support\Facades\Validator;

class AdminController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */

    public function getSetting($pageSetting=null)
    {
        $data = DB::table('KH_CONTACTUS')->get();
        return view('admin.admin',['page'=>$pageSetting]);
    }

    public function getHome(){
        $data = $this->getBannerList();
        $menu = "Home Setting";
        return view('admin.home',['name'=>$menu,'data'=>$data]);
    }

<<<<<<< HEAD
        if ($page == 'contact') {
            $data = DB::table('KH_CONTACTUS')->get();
            $menu = "Contact Setting";
        } else if ($page == 'catalogue') {
            $data=  DB::table('KH_CATALOGUE')->get();
            $menu="CATALOGUE SETTING";
        } else if($page=='member') {
            $data =  $this->listmember($request);
            $menu = "ADMIN SETTING";
        } else if($page=='zone'){

        }
        else{
            return "Page not found";
        }
        
        return view('admin.'.$page,['name'=>$menu,'data'=>$data]);
=======
    public function getContact(){
        $data = DB::table('KH_CONTACTUS')->get();
        $menu = "Contact Setting";
        return view('admin.contact',['name'=>$menu,'data'=>$data]);
    }

    public function getNews(){
        $data = null;
        $menu = "News Setting";
        return view('admin.news',['name'=>$menu,'data'=>$data]);
    }

    public function getMember(){
        $data =  $this->listmember($request);
        $menu = "ADMIN SETTING";
        return view('admin.member',['name'=>$menu,'data'=>$data]);
    }

    public function getCatalogue(){
        $data =  DB::table('KH_CATALOGUE')->get();
        $menu ="CATALOGUE SETTING";
        return view('admin.catalogue',['name'=>$menu,'data'=>$data]);
    }

    public function getProduct(){
        $data = null;
        $menu = "Product Setting";
        return view('admin.product',['name'=>$menu,'data'=>$data]);
>>>>>>> 7a58680d91ebc3da332b157af3328a06464ae76f
    }

    public function postContact(Request $request)
    {
        $contact = $request->input('contact_name');

        DB::table('KH_CONTACTUS')->update([
            'KH_CONTACTUS'=>$contact,
        ]);

        Session::flash('alert-success', 'อัพเดตเรียบร้อยแล้ว');
        return redirect('admin/contact');
    }

    private function getBanner($id){
        $banner = DB::table('KH_BANNER')
                ->where('BANNER_ID', '=', $id)
                ->get();
        return $banner;
    }

    private function getBannerList(){
        $bannerList = DB::table('KH_BANNER')
                    ->where('BANNER_IS_DELETED', '<>', 1)
                    ->orderBy('BANNER_ORDER', 'DESC')
                    ->orderBy('BANNER_ID','ASC')
                    ->get();
        return $bannerList;
    }

    public function listmember($request)
    {

        if ($request->isMethod('post'))
        {
            $data = 2;
        }
        else{
            $data = DB::table('KH_MEMBER_LOGIN AS login ')
                ->leftjoin('KH_INFORMATION AS info','login.ID','=','info.KH_INFORMATION_MEMBER')
                ->leftjoin('KH_CONTACT AS contact','login.ID','=','contact.KH_CONTACT_MEMBER')
                ->select(
                    'login.ID',
                    'login.KH_MEMBER_LOGIN_USERNAME',
                    'contact.KH_CONTACT_NAME',
                    'contact.KH_CONTACT_EMAIL',
                    'contact.KH_CONTACT_TEL',
                    'info.KH_INFORMATION_HEIGHT',
                    'info.KH_INFORMATION_WEIGHT',
                    'info.KH_INFORMATION_SHOE',
                    'contact.KH_CONTACT_ADDR')
                ->where('login.KH_MEMBER_RULE','<>','ADMIN')
                ->get();
        }

        return $data;
    }

    public function memberEdit($id)
    {
        $data = DB::table('KH_MEMBER_LOGIN AS login ')
            ->leftjoin('KH_INFORMATION AS info','login.ID','=','info.KH_INFORMATION_MEMBER')
            ->leftjoin('KH_CONTACT AS contact','login.ID','=','contact.KH_CONTACT_MEMBER')
            ->select(
                'login.ID',
                'login.KH_MEMBER_LOGIN_USERNAME',
                'contact.KH_CONTACT_NAME',
                'contact.KH_CONTACT_EMAIL',
                'contact.KH_CONTACT_TEL',
                'info.KH_INFORMATION_HEIGHT',
                'info.KH_INFORMATION_WEIGHT',
                'info.KH_INFORMATION_SHOE',
                'contact.KH_CONTACT_ADDR')
            ->where('login.ID','=',$id)
            ->get();
        return view('admin/memberdetail')->with('data',$data)
            ->with('name','Member Setting->แก้ไขข้อมูลสมาชิก');
    }

    public function updatemember(Request $request,$id)
    {
        $rules=[
            'member_name'=>'required',
            'member_tel'=>'required',
            'member_address'=>'required',
            'member_weight'=>'required',
            'member_height'=>'required',
            'member_shoe'=>'required'
        ];
        //Custom ควบคุม Message Error
        $messages = [
            'member_name.required'=>'กรุณาระบุชื่อ-นามสกุล',
            'member_tel.required'=>'กรุณาระบุเบอร์โทร',
            'member_address.required'=>'กรุณาระบุที่อยู่',
            'member_weight.required'=>'กรุณาระบุน้ำหนัก',
            'member_height.required'=>'กรุณาระบุส่วนสูง',
            'member_shoe.required'=>'กรุณาระบุเบอร์รองเท้า'
        ];

        $validator =  Validator::make($request->all(),$rules,$messages);

        if($validator->fails()){
            return redirect('admin/member')->withErrors($validator)->withInput();
        }else {

            $member_name = $request->input('member_name', 'John Doe');
            $member_tel = $request->input('member_tel', '0x-xxx-xxxx');
            $member_addr = $request->input('member_address', 'Example Address');

            //data for kh_information
            $member_height = $request->input('member_height', 0.00);
            $member_weight = $request->input('member_weight', 0.00);
            $member_shoe = $request->input('member_shoe', 0.00);

            //insert contact
            DB::table('KH_CONTACT')
                ->where('KH_CONTACT_MEMBER','=',$id)
                ->update([
                        'KH_CONTACT_NAME'=>$member_name,
                        'KH_CONTACT_TEL'=>$member_tel,
                        'KH_CONTACT_ADDR'=>$member_addr]
                );

            //insert information
            DB::table('KH_INFORMATION')
                ->where('KH_INFORMATION_MEMBER','=',$id)
                ->update([
                    'KH_INFORMATION_HEIGHT'=>$member_height,
                    'KH_INFORMATION_WEIGHT'=>$member_weight,
                    'KH_INFORMATION_SHOE'=>$member_shoe
                ]);
            Session::flash('alert-success', 'อัพเดตค่าเรียบร้อยแล้ว');
            return redirect('admin/member');
        }
    }

    public function zoneIndex()
    {
        $name= 'ZONE MANAGE';
        $data = DB::table('KH_ZONE')
            ->select(
                'ID',
                'ZONE_NAME')
            ->where('ZONE_DELETE_STATUS','<>','1')
            ->get();
        return view('admin/zone',['name'=>$name,'data'=>$data]);
    }

    public function zoneCreate(Request $request)
    {
        if($request->isMethod('post'))
        {
            $zone_name = $request->input('zone_name');
            DB::table('KH_ZONE')->insert([
                'ZONE_NAME'=>$zone_name
            ]);

            $name= 'ZONE MANAGE';
            $data = DB::table('KH_ZONE')
                ->select(
                    'ID',
                    'ZONE_NAME')
                ->where('ZONE_DELETE_STATUS','<>','1')
                ->get();
            return redirect('admin/zone')->with(['name'=>$name,'data'=>$data]);
        }
        $name = 'Zone Add';
        return view('admin/zoneEdit',[
            'name'=>$name]);
    }

    public function zoneEdit($id)
    {

    }

    public function branchIndex()
    {

    }

    public function catalogueEdit($id)
    {

    }

<<<<<<< HEAD
    public function catalogueAdd(Request $request)
    {

=======
    public function bannerEdit($id=null){
        $data = null;
        $name = 'Home Setting->เพิ่มแบนเนอร์';
        //edit case
        if($id!=null){
            $data = $this->getBanner($id);
            $name = 'Home Setting->แก้ไขข้อมูลแบนเนอร์';
        }
        
        return  view('admin/homeEdit')
                ->with('data',$data)
                ->with('name',$name);
    }

    public function bannerUpdate(Request $request,$id){
        $rules=[
            'bannerType'=>'required',
            'url'=>'required|url',
            'bannerImage'=>'image|size:2000kb',
        ];
        $messages = [
            'bannerType.required'=>'กรุณาระบุชื่อ-นามสกุล',
            'url.required'=>'กรุณาระบุลิงค์',
            'url.url'=>'ลิงค์ไม่ถูกต้อง',
            'bannerImage.image'=>'กรุณาระบุประเภทของรูปภาพให้ถูกต้อง',
            'bannerImage.size'=>'ขนาดของรูปภาพต้องไม่เกิน 2MB',
        ];

        $validator = Validator::make($request->all(),$rules,$messages);
        if($validator->fails()){
            $data = $this->getBanner($id);
            $name = 'Home Setting->แก้ไขข้อมูลแบนเนอร์';
            return view('admin.homeEdit',['name'=>$name,'request'=>$request->all(),'data'=>$data,'validator'=>$validator]);
        }else {
            $data = $this->getBannerList();
            $name = "Home Setting";
            return view('admin.home',['name'=>$name,'data'=>$data]);
        }
>>>>>>> 7a58680d91ebc3da332b157af3328a06464ae76f
    }

}
