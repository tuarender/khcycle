<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use App;
use File;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Validator;

class AdminController extends Controller
{
    const BANNER_PATH = 'images/banner';
    const NEWS_PATH = 'images/news';
    const BRAND_PATH = 'images/brand';
    const PRODUCT_PATH = 'images/product';
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */

    public function index()
    {
        return view('admin.admin');
    }

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

    public function getBannerEdit($id=null){
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

    public function getContact(){
        $data = DB::table('KH_CONTACTUS')->get();
        $menu = "Contact Setting";
        return view('admin.contact',['name'=>$menu,'data'=>$data]);
    }

    public function getNews(){
        $sql = "SELECT NEWS_ID, NEWS_ORDER, NEWS_TITLE,NEWS_IS_YOUTUBE FROM KH_NEWS WHERE NEWS_DELETE_STATUS <> 1 AND NEWS_ACTIVE_STATUS = 1 ORDER BY NEWS_ORDER DESC,NEWS_CREATE_DATE DESC";
        $data = DB::select($sql);
        $menu = "News/Articles Setting";
        return view('admin.news',['name'=>$menu,'data'=>$data]);
    }

    public function getNewsEdit($id=null){
        $data = null;
        $name = 'Home Setting->เพิ่ม News/Articles';
        //edit case
        if($id!=null){
            $data = $this->getNewsById($id);
            $name = 'Home Setting->แก้ไขข้อมูล News/Articles';
        }
        
        return  view('admin/newsEdit')
                ->with('data',$data)
                ->with('name',$name);
    }

    public function getMember(){
        $data =  $this->listmember();
        $menu = "ADMIN SETTING";
        return view('admin.member',['name'=>$menu,'data'=>$data]);
    }

    public function getCatalogue(){
        $data =  DB::table('KH_CATALOGUE')
            ->where('CATALOGUE_DELETE_STATUS','<>','1')
            ->get();
        $menu ="CATALOGUE SETTING";
        return view('admin.catalogue',['name'=>$menu,'data'=>$data]);
    }

    public function getCatalogueData($id)
    {
        $catalogue = DB::table('KH_CATALOGUE')
            ->where('CATALOGUE_ID','=',$id)
            ->get();
        return $catalogue;
    }


    public function getBrand(){
        $sql = "SELECT BRAND_ID,BRAND_NAME, BRAND_ORDER FROM KH_BRAND WHERE BRAND_DELETE_STATUS <> 1 ORDER BY BRAND_ORDER DESC, BRAND_CREATE_DATE_TIME DESC";
        $data = DB::select($sql);
        $menu = "Product Setting";
        return view('admin.brand',['name'=>$menu,'data'=>$data]);

    }

    public function getProduct($id){
        $sql = "SELECT PRODUCT_ID,
                    PRODUCT_BRAND_ID,
                    PRODUCT_GROUP_ID,
                    GROUP_NAME,
                    PRODUCT_ORDER,
                    PRODUCT_NAME,
                    PRODUCT_MIN_FILE_NAME,
                    PRODUCT_MIN_EXT,
                    PRODUCT_FULL_FILE_NAME,
                    PRODUCT_FULL_EXT 
                FROM KH_PRODUCT A,KH_GROUP B
                WHERE 
                    A.PRODUCT_GROUP_ID = B.GROUP_ID
                    AND PRODUCT_BRAND_ID =?
                    AND PRODUCT_DELETE_STATUS <> 1 
                ORDER BY PRODUCT_ORDER DESC, 
                    PRODUCT_CREATE_DATE_TIME DESC";
        $queryParam = array($id);
        $data = DB::select($sql,$queryParam);
        $menu = "Product Setting > จัดการสินค้าในแบรนด์";
        return view('admin.product',['name'=>$menu,'data'=>$data]);

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

    private function getNewsById($id){
        $news = DB::table('KH_NEWS')
                ->where('NEWS_ID', '=', $id)
                ->get();
        return $news;
    }

    public function getZone()
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

    public function zoneDelete($id)
    {
        $data = DB::table('KH_ZONE')
            ->where('ID','=',$id)
            ->update(['ZONE_DELETE_STATUS'=>'1']);
        return redirect('admin/zone');
    }

    public function zoneUpdate(Request $request,$id)
    {
        $rules = [
            'zone_name' =>'required'
        ];
        $message =[
            'zone_name.required'=>'กรุณาระบุ Zone'
        ];

        $validator = Validator::make($request->all(),$rules,$message);
        if($validator->fails()) {
            Session::flash('alert-danger', 'เกิดข้อผิดพลาด กรุณาตรวจสอบ');
            return redirect('admin/zone/edit/' . $id)->withErrors($validator)->withInput();
        }else{
            $zone_name = $request->input('zone_name');
            $data = DB::table('KH_ZONE')
                ->where('ID','=',$id)
                ->update(['ZONE_NAME'=>$zone_name]);
            Session::flash('alert-success', 'อัพเดตค่า เรียบร้อย');
            return redirect('admin/zone');
        }
    }

    public function zoneAdd(Request $request)
    {
        $rules = [
            'zone_name' =>'required'
        ];
        $message =[
            'zone_name.required'=>'กรุณาระบุ Zone'
        ];

        $validator = Validator::make($request->all(),$rules,$message);
        if($validator->fails()) {
            Session::flash('alert-danger', 'เกิดข้อผิดพลาด กรุณาตรวจสอบ');
            return redirect('admin/zone/edit/')->withErrors($validator)->withInput();
        }else{
            $zone_name = $request->input('zone_name');
            $data = DB::table('KH_ZONE')
                ->insert(['ZONE_NAME'=>$zone_name]);
            Session::flash('alert-success', 'อัพเดตค่า เรียบร้อย');
            return redirect('admin/zone');
        }
    }

    public function zoneEdit($id=null)
    {
        $data= null;
        $name='Zone Setting->เพิ่ม Zone';
        if($id!=null){
            $data = $this->getZoneData($id);
            $name = 'Zone Setting->แก้ไขข้อมูล Zone';
        }
        return view('admin/zoneEdit')
            ->with('data',$data)
            ->with('name',$name);
    }

    public function getZoneData($id)
    {
        $zone = DB::table('KH_ZONE')
            ->where('ID','=',$id)
            ->get();
        return $zone;
    }

    public function getBranch(Request $request)
    {
        if($request->isMethod('post'))
        {
            $datazone = $request->input('BRANCH_ZONE');
            if($datazone==0) {
                $data = DB::table('KH_BRANCH as br')
                    ->join('KH_ZONE AS zone', 'br.BRANCH_ZONE', '=', 'zone.ID')
                    ->select('zone.ZONE_NAME',
                        'br.BRANCH_ID',
                        'br.BRANCH_SHOP',
                        'br.BRANCH_ADDR',
                        'br.BRANCH_EMAIL')
                    ->where('BRANCH_DELETE_STATUS', '<>', '1')
                    ->get();
            }else{
                $data = DB::table('KH_BRANCH as br')
                    ->join('KH_ZONE AS zone', 'br.BRANCH_ZONE', '=', 'zone.ID')
                    ->select('zone.ZONE_NAME',
                        'br.BRANCH_ID',
                        'br.BRANCH_SHOP',
                        'br.BRANCH_ADDR',
                        'br.BRANCH_EMAIL')
                    ->where('BRANCH_DELETE_STATUS', '<>', '1')
                    ->where('BRANCH_ZONE', '=', $datazone)
                    ->get();
            }
        }
        else
        {
            $data = DB::table('KH_BRANCH as br')
                ->join('KH_ZONE AS zone','br.BRANCH_ZONE','=','zone.ID')
                ->select('zone.ZONE_NAME',
                    'br.BRANCH_ID',
                    'br.BRANCH_SHOP',
                    'br.BRANCH_ADDR',
                    'br.BRANCH_EMAIL')
                ->where('BRANCH_DELETE_STATUS','<>','1')
                ->get();
        }
        $name= 'BRANCH MANAGE';
        $zone = DB::table('KH_ZONE')->get();

        return view('admin/branch',['name'=>$name,'data'=>$data,'zone'=>$zone]);
    }

    private function getBranchData($id)
    {
        $branch = DB::table('KH_BRANCH as br')
            ->leftjoin('KH_ZONE as z','br.BRANCH_ZONE','=','z.ID')
            ->select(
                'z.ID',
                'z.ZONE_NAME',
                'br.BRANCH_ID',
                'br.BRANCH_SHOP',
                'br.BRANCH_ADDR',
                'br.BRANCH_EMAIL'
            )
            ->where('BRANCH_ID','=',$id)
            ->get();
        return $branch;
    }

    public function branchAdd(Request $request)
    {
        $rules = [
            'BRANCH_SHOP'=>'required',
            'BRANCH_ADDR'=>'required',
            'BRANCH_EMAIL'=>'required',
            'BRANCH_ZONE'=>'required'
        ];

        $message =[
            'BRANCH_SHOP.required'=>'กรุณาระบุ ชื่อ SHOP',
            'BRANCH_ADDR.required'=>'กรุณาระบุ ที่อยู่',
            'BRANCH_EMAIL.required'=>'กรุณาระบุ EMAIL',
            'BRANCH_ZONE.required'=>'กรุณาเลือก Zone'
        ];

        $validator = Validator::make($request->all(),$rules,$message);
        if($validator->fails()){
            Session::flash('alert-danger', 'เกิดข้อผิดพลาด กรุณาตรวจสอบ');
            return redirect('admin/branch/edit/')->withErrors($validator)->withInput();
        }else {
            $nameshop = $request->input('BRANCH_SHOP');
            $addrshop = $request->input('BRANCH_ADDR');
            $emailshop = $request->input('BRANCH_EMAIL');
            $valuezone = $request->get('BRANCH_ZONE');
            DB::table('KH_BRANCH')->insert([
                'BRANCH_ZONE' => $valuezone,
                'BRANCH_SHOP' => $nameshop,
                'BRANCH_ADDR' => $addrshop,
                "BRANCH_EMAIL" => $emailshop,
            ]);

            Session::flash('alert-success', 'อัพเดตเรียบร้อย');
            return redirect('admin/branch/');
        }
    }

    public function branchUpdate(Request $request,$id)
    {
        $rules = [
            'BRANCH_SHOP'=>'required',
            'BRANCH_ADDR'=>'required',
            'BRANCH_EMAIL'=>'required',
            'BRANCH_ZONE'=>'required'
        ];

        $message =[
            'BRANCH_SHOP.required'=>'กรุณาระบุ ชื่อ SHOP',
            'BRANCH_ADDR.required'=>'กรุณาระบุ ที่อยู่',
            'BRANCH_EMAIL.required'=>'กรุณาระบุ EMAIL',
            'BRANCH_ZONE.required'=>'กรุณาเลือก Zone'
        ];

        $validator = Validator::make($request->all(),$rules,$message);
        if($validator->fails()){
            Session::flash('alert-danger', 'เกิดข้อผิดพลาด กรุณาตรวจสอบ');
            return redirect('admin/branch/edit/'.$id)->withErrors($validator)->withInput();
        }else {
            $nameshop = $request->input('BRANCH_SHOP');
            $addrshop = $request->input('BRANCH_ADDR');
            $emailshop = $request->input('BRANCH_EMAIL');
            $valuezone = $request->get('BRANCH_ZONE');
            DB::table('KH_BRANCH')
                ->where('BRANCH_ID','=',$id)
                ->update([
                'BRANCH_ZONE' => $valuezone,
                'BRANCH_SHOP' => $nameshop,
                'BRANCH_ADDR' => $addrshop,
                "BRANCH_EMAIL" => $emailshop,
            ]);

            Session::flash('alert-success', 'อัพเดตเรียบร้อย');
            return redirect('admin/branch/');
        }
    }

    public function branchDelete($id)
    {
        $data = DB::table('KH_BRANCH')
            ->where('BRANCH_ID','=',$id)
            ->update(['BRANCH_DELETE_STATUS'=>'1']);
        return redirect('admin/branch');
    }

    public function branchEdit($id=null)
    {
        $data= null;
        $name='Branch Setting->เพิ่ม Branch';
        $zone = DB::table('KH_ZONE')
            ->orderBy('ID','ASC')
            ->get();
        if($id!=null){
            $data = $this->getBranchData($id);
            $name = 'Branch Setting->แก้ไขข้อมูล Branch';
        }
        return view('admin/branchEdit')
            ->with('data',$data)
            ->with('name',$name)
            ->with('zone',$zone);
    }

    private function getBannerList(){
        $bannerList = DB::table('KH_BANNER')
                    ->where('BANNER_IS_DELETED', '<>', 1)
                    ->orderBy('BANNER_ORDER', 'DESC')
                    ->get();
        return $bannerList;
    }

    public function listmember()
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
                ->where('login.KH_MEMBER_RULE','<>','ADMIN')
                ->get();

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

    public function catalogueEdit($id=null)
    {
        $data= null;
        $name='Catalogue Setting->เพิ่ม Catalogue';
        if($id!=null){
            $data = $this->getCatalogueData($id);
            $name = 'Catalogue Setting->แก้ไขข้อมูล Catalogue';
        }
        return view('admin/catalogueEdit')
            ->with('data',$data)
            ->with('name',$name);
    }

    public function catalogueUpdate(Request $request,$id)
    {
        $rules=[
            'CATALOGUE_NAME' =>'required',
            'filecover' =>'image|max:1024',
            'filepdf'=>'mimes:pdf|max:2048'
        ];
        $message = [
            'CATALOGUE_NAME.required'=>'กรุณาระบุ CATALOGUE',
            'filecover.image' =>'กรุณาระบุประเภทรูปภาพให้ถูกต้อง',
            'filecover.size' =>'ขนาดของรูปภาพต้องไม่เกิน 1MB',
            'filepdf.mimes' =>'ไฟล์ต้องเป็น .PDF เท่านั้น',
            'filepdf.size' =>'ขนาดของไฟล์ต้องไม่เกิน 2MB'
        ];

        $validator = Validator::make($request->all(),$rules,$message);
        if($validator->fails()){
            Session::flash('alert-danger', 'เกิดข้อผิดพลาด กรุณาตรวจสอบ');
            return redirect('admin/catalogue/edit/'.$id)->withErrors($validator)->withInput();
        }else{
            $namecatalogue = $request->input('CATALOGUE_NAME');
            $data = DB::table('KH_CATALOGUE')
                ->where('CATALOGUE_ID','=',$id)
                ->update(['CATALOGUE_NAME'=>$namecatalogue]);

            if(Input::hasFile('filecover'))
            {
                $file = Input::file('filecover');
                $destination = 'cover';
                $extension  = $file->getClientOriginalExtension();
                $fileName = rand(11111,99999)."_".$id;
                $fullname = $fileName.".".$extension;
                $fileMoved = $file->move($destination, $fullname);
                if (File::exists($fileMoved->getRealPath())){
                    $data = DB::table('KH_CATALOGUE')
                        ->where('CATALOGUE_ID','=',$id)
                        ->update(['CATALOGUE_COVER_PIC'=>$fullname]);
                }
                else{
                    Session::flash('alert-danger', 'เกิดข้อผิดพลาด กรุณาติดต่อผู้ดูแลระบบ');
                    return redirect('admin/catalogue/');
                }
            }
            if(Input::hasFile('filepdf'))
            {
                $file = Input::file('filepdf');
                $destination = 'cover';
                $fileName = rand(11111,99999)."_".$id;
                $fullname = $fileName.".pdf";
                $fileMoved = $file->move($destination, $fullname);
                if (File::exists($fileMoved->getRealPath())){
                    $data = DB::table('KH_CATALOGUE')
                        ->where('CATALOGUE_ID','=',$id)
                        ->update(['CATALOGUE_PATH_PDF'=>$fullname]);
                }
                else{
                    Session::flash('alert-danger', 'เกิดข้อผิดพลาด กรุณาติดต่อผู้ดูแลระบบ');
                    return redirect('admin/catalogue/');
                }

            }
            Session::flash('alert-success', 'อัพเดตเรียบร้อย');
            return redirect('admin/catalogue/');
        }
    }

    public function catalogueAdd(Request $request)
    {
        $rules=[
            'CATALOGUE_NAME' =>'required',
            'filecover' =>'image|max:1024',
            'filepdf'=>'mimes:pdf|max:2048'
        ];
        $message = [
            'CATALOGUE_NAME.required'=>'กรุณาระบุ CATALOGUE',
            'filecover.image' =>'กรุณาระบุประเภทรูปภาพให้ถูกต้อง',
            'filecover.size' =>'ขนาดของรูปภาพต้องไม่เกิน 1MB',
            'filepdf.mimes' =>'ไฟล์ต้องเป็น .PDF เท่านั้น',
            'filepdf.size' =>'ขนาดของไฟล์ต้องไม่เกิน 2MB'
        ];

        $validator = Validator::make($request->all(),$rules,$message);
        if($validator->fails()){
            Session::flash('alert-danger', 'เกิดข้อผิดพลาด กรุณาตรวจสอบ');
            return redirect('admin/catalogue/edit/')->withErrors($validator)->withInput();
        }else{
            $namecatalogue = $request->input('CATALOGUE_NAME');

            if(Input::hasFile('filecover'))
            {
                $file = Input::file('filecover');
                $destination = 'cover';
                $extension  = $file->getClientOriginalExtension();
                $fileName = rand(11111,99999);
                $fullname = $fileName.".".$extension;
                $fileMoved = $file->move($destination, $fullname);
                if (File::exists($fileMoved->getRealPath())){
                    $pathpic = $fileName;
                }
                else{
                    Session::flash('alert-danger', 'เกิดข้อผิดพลาด กรุณาติดต่อผู้ดูแลระบบ');
                    return redirect('admin/catalogue/');
                }
            }else{
                $pathpic = '';
            }
            if(Input::hasFile('filepdf'))
            {
                $file = Input::file('filepdf');
                $destination = 'cover';
                $extension  = $file->getClientOriginalExtension();
                $fileName = rand(11111,99999);
                $fullname = $fileName.".".$extension;
                $fileMoved = $file->move($destination, $fullname);
                if (File::exists($fileMoved->getRealPath())){
                    $pathpdf = $fullname;
                }
                else{
                    Session::flash('alert-danger', 'เกิดข้อผิดพลาด กรุณาติดต่อผู้ดูแลระบบ');
                    return redirect('admin/catalogue/');
                }
            }else{
                $pathpdf='';
            }
            $sqlcommand = DB::insert('insert into KH_CATALOGUE (CATALOGUE_NAME,CATALOGUE_COVER_PIC,CATALOGUE_PATH_PDF) value (?,?,?)',[$namecatalogue,$pathpic,$pathpdf]);
            Session::flash('alert-success', 'อัพเดตเรียบร้อย');
            return redirect('admin/catalogue/');
        }
    }

    public function catalogueDelete($id)
    {
        $data = DB::table('KH_CATALOGUE')
            ->where('CATALOGUE_ID','=',$id)
            ->update(['CATALOGUE_DELETE_STATUS'=>'1']);
        return redirect('admin/catalogue');
    }

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
            'bannerImage'=>'image|max:1024',
        ];
        $messages = [
            'bannerType.required'=>'กรุณาระบุประเภทของแบนเนอร์',
            'url.required'=>'กรุณาระบุลิงค์',
            'url.url'=>'ลิงค์ไม่ถูกต้อง',
            'bannerImage.image'=>'กรุณาระบุประเภทของรูปภาพให้ถูกต้อง',
            'bannerImage.max'=>'ขนาดของรูปภาพต้องไม่เกิน 1MB',
        ];

        $validator = Validator::make($request->all(),$rules,$messages);
        if($validator->fails()){
            Session::flash('alert-danger', 'เกิดข้อผิดพลาด กรุณาตรวจสอบ');
            return redirect('admin/home/banner/'.$id)->withErrors($validator)->withInput();
        }else {
            $file = Input::file('bannerImage');
            $youtubeUri = "";
            if ($file!=null&&$file->isValid()) {
                $destinationPath = self::BANNER_PATH; 
                $extension = $file->getClientOriginalExtension(); 
                $fileName = rand(11111,99999)."_".$id; 
                $fileNameFull = $fileName.".".$extension;
                $fileMoved = $file->move($destinationPath, $fileNameFull);
                if (File::exists($fileMoved->getRealPath())){
                    $bannerType = $request->input('bannerType', '0');
                    $url = $request->input('url');
                    $sqlUpdate = "UPDATE KH_BANNER SET BANNER_IMAGE=?,BANNER_IMAGE_EXT=?, BANNER_URL=?, BANNER_IS_YOUTUBE=?,BANNER_YOUTUBE_URI=? WHERE BANNER_ID=?";
                    if($bannerType==1){
                        $youtubeUri = $url;
                        $url = "";
                    }
                    $updateParam = array($fileName,$extension,$url,$bannerType,$youtubeUri,$id);
                    $data = DB::update($sqlUpdate,$updateParam);
                    Session::flash('alert-success', 'อัพเดทสำเร็จ ');
                    return redirect('admin/home/');
                }
                else{
                    Session::flash('alert-danger', 'เกิดข้อผิดพลาด กรุณาติดต่อผู้ดูแลระบบ');
                    return redirect('admin/home/');
                }
            }
            else if($file==null){
                $bannerType = $request->input('bannerType', '0');
                $url = $request->input('url');
                if($bannerType==1){
                    $youtubeUri = $url;
                    $url = "";
                }
                $sqlUpdate = "UPDATE KH_BANNER SET BANNER_URL=?, BANNER_IS_YOUTUBE=?,BANNER_YOUTUBE_URI=? WHERE BANNER_ID=?";
                $updateParam = array($url,$bannerType,$youtubeUri,$id);
                DB::update($sqlUpdate,$updateParam);
                Session::flash('alert-success', 'อัพเดทสำเร็จ ');
                return redirect('admin/home/');
            }
            else {
                Session::flash('alert-danger', 'เกิดข้อผิดพลาด กรุณาติดต่อผู้ดูแลระบบ');
                return redirect('admin/home/');
            }

        }

    }

    public function bannerAdd(Request $request){
        $rules=[
            'bannerType'=>'required',
            'url'=>'required|url',
            'bannerImage'=>'required|image|max:1024',
        ];
        $messages = [
            'bannerType.required'=>'กรุณาระบุประเภทของแบนเนอร์',
            'url.required'=>'กรุณาระบุลิงค์',
            'url.url'=>'ลิงค์ไม่ถูกต้อง',
            'bannerImage.required'=>'กรุณาระบุภาพ',
            'bannerImage.image'=>'กรุณาระบุประเภทของรูปภาพให้ถูกต้อง',
            'bannerImage.max'=>'ขนาดของรูปภาพต้องไม่เกิน 1MB',
        ];

        $validator = Validator::make($request->all(),$rules,$messages);
        if($validator->fails()){
            Session::flash('alert-danger', 'เกิดข้อผิดพลาด กรุณาตรวจสอบ');
            return redirect('admin/home/banner')->withErrors($validator)->withInput();
        }else {
            $file = Input::file('bannerImage');
            $youtubeUri = "";
            if ($file!=null&&$file->isValid()) {
                /** DO INSERT FIRST **/
                //getMaxOrder
                $sqlMaxOrder = "SELECT MAX(BANNER_ORDER) AS MAX_ORDER FROM KH_BANNER WHERE BANNER_IS_DELETED <> 1";
                $dataMaxOrder = DB::select($sqlMaxOrder);
                $maxOrder = 0;
                if(count($sqlMaxOrder)>0){
                    $maxOrder = $dataMaxOrder[0]['MAX_ORDER']+1;
                }

                //insert
                $bannerType = $request->input('bannerType', '0');
                $url = $request->input('url');
                $sqlInsert = "INSERT INTO KH_BANNER(BANNER_ORDER,BANNER_URL,BANNER_IS_YOUTUBE,BANNER_YOUTUBE_URI) VALUES(?,?,?,?)";
                if($bannerType==1){
                    $youtubeUri = $url;
                    $url = "";
                }
                $insertParam = array($maxOrder,$url,$bannerType,$youtubeUri);
                DB::insert($sqlInsert,$insertParam);
                $id = DB::getPdo()->lastInsertId();
                if($id>0){
                    $destinationPath = self::BANNER_PATH; 
                    $extension = $file->getClientOriginalExtension(); 
                    $fileName = rand(11111,99999)."_".$id; 
                    $fileNameFull = $fileName.".".$extension;
                    $fileMoved = $file->move($destinationPath, $fileNameFull);
                    if (File::exists($fileMoved->getRealPath())){
                        $sqlUpdate = "UPDATE KH_BANNER SET BANNER_IMAGE=?, BANNER_IMAGE_EXT=? WHERE BANNER_ID=?";
                        $updateParam = array($fileName,$extension,$id);
                        DB::update($sqlUpdate,$updateParam);
                        Session::flash('alert-success', 'บันทึกข้อมูลสำเร็จ ');
                        return redirect('admin/home/');
                    }
                    else{
                        Session::flash('alert-danger', 'เกิดข้อผิดพลาด กรุณาติดต่อผู้ดูแลระบบ');
                        return redirect('admin/home/');
                    }
                }
                else{
                    Session::flash('alert-danger', 'เกิดข้อผิดพลาด กรุณาติดต่อผู้ดูแลระบบ');
                    return redirect('admin/home/');
                }
            }
            else {
                Session::flash('alert-danger', 'เกิดข้อผิดพลาด กรุณาติดต่อผู้ดูแลระบบ');
                return redirect('admin/home/');
            }

        }

    }

    function orderBanner($id,$order){
        //order of selected banner id
        $sql = "SELECT BANNER_ID,BANNER_ORDER FROM KH_BANNER WHERE BANNER_ID = ?";
        $queryParam = array($id);
        $data = DB::select($sql,$queryParam);

        if(count($data)>0){
            $sqlReplace = "SELECT BANNER_ID,BANNER_ORDER FROM KH_BANNER WHERE BANNER_ORDER = ?";
            $queryReplaceParam = array($order);
            $dataReplace = DB::select($sqlReplace,$queryReplaceParam);
            if(count($dataReplace)==1){
                //replace after order with current banner order
                $sqlUpdateReplace = "UPDATE KH_BANNER SET BANNER_ORDER = ? WHERE BANNER_ORDER = ?";
                $updateReplaceParam = array($data[0]['BANNER_ORDER'],$order);
                DB::update($sqlUpdateReplace,$updateReplaceParam);

                //update current banner with specific order order
                $sqlUpdateOder = "UPDATE KH_BANNER SET BANNER_ORDER = ? WHERE BANNER_ID = ?";
                $updateCurrentParam = array($order,$id);
                DB::update($sqlUpdateOder,$updateCurrentParam);
                return redirect('admin/home/');
            }
            else{
                return redirect('home');
            }
        }
        else{
            return redirect('home');
        }
    }

    function deleteBanner($id){
        $sqlDelete = "UPDATE KH_BANNER SET BANNER_IS_DELETED = 1 WHERE BANNER_ID = ?";
        $deleteParam = array($id);
        DB::update($sqlDelete,$deleteParam);
        return redirect('admin/home');
    }

    public function newsAdd(Request $request){
        $rules=[
            'newsTitle'=>'required|max:100',
            'newsType'=>'required',
            'youTubeUrl'=>'url|required_if:newsType,1',
            'newsImage'=>'image|max:1024|required_if:newsType,0',
            'sample'=>'required|max:500|not_in:<p>&nbsp; &nbsp;</p>',
            'content'=>'required|max:4000|not_in:<p>&nbsp; &nbsp;</p>'
        ];
        $messages = [
            'newsTitle.required'=>'กรุณาระบุชื่อ News/Articles',
            'newsTitle.max'=>'News/Articles ต้องยาวไม่เกิน 100 ตัวอักษร',
            'newsType.required'=>'กรุณาระบุประเภทของแบนเนอร์',
            'youTubeUrl.required_if'=>'กรุณาระบุลิงค์',
            'youTubeUrl.url'=>'ลิงค์ไม่ถูกต้อง',
            'youTubeUrl.active_url'=>'ไม่สามารถติดต่อลิงค์ดังกล่าวได้',
            'newsImage.required_if'=>'กรุณาระบุภาพ',
            'newsImage.image'=>'กรุณาระบุประเภทของรูปภาพให้ถูกต้อง',
            'newsImage.max'=>'ขนาดของรูปภาพต้องไม่เกิน 1MB',
            'sample.required'=>'กรุณาระบุรายละเอียดโดยย่อ',
            'sample.max'=>'รายละเอียดโดยย่อต้องยาวไม่เกิน 500ตัวอักษร',
            'content.required'=>'กรุณาระบุรายละเอียด',
            'content.max'=>'รายละเอียดต้องยาวไม่เกิน4000ตัวอักษร'
        ];
        //set more validate rule
        
        //$data = array($request->input('sample'),$request->input('content'));
        //return  view('admin/newsEdit',['name'=>'jaja','jaja'=>$data]);

        $validator = Validator::make($request->all(),$rules,$messages);
        if($validator->fails()){
            Session::flash('alert-danger', 'เกิดข้อผิดพลาด กรุณาตรวจสอบ');
            return redirect('admin/news/news')->withErrors($validator)->withInput();
        }else {
            $newsType = $request->input('newsType');
            $sample = $request->input('sample');
            $content = $request->input('content');
            $title = $request->input('newsTitle');
            $youtubeUri = "";

            $sqlMaxOrder = "SELECT MAX(NEWS_ORDER) AS MAX_ORDER FROM KH_NEWS WHERE NEWS_DELETE_STATUS <> 1";
            $dataMaxOrder = DB::select($sqlMaxOrder);
            $maxOrder = 0;
            if(count($sqlMaxOrder)>0){
                $maxOrder = $dataMaxOrder[0]['MAX_ORDER']+1;
            }

            if($newsType==0){
                //picture case
                $file = Input::file('newsImage');
                if ($file!=null&&$file->isValid()) {
                    /** DO INSERT FIRST **/
                    //insert
                    $sqlInsert = "INSERT INTO KH_NEWS(NEWS_ORDER,NEWS_TITLE,NEWS_CONTENT,NEWS_SAMPLE,NEWS_IS_YOUTUBE) VALUES(?,?,?,?,0)";
                    $insertParam = array($maxOrder,$title,htmlentities($content),htmlentities($sample));
                    DB::insert($sqlInsert,$insertParam);
                    $id = DB::getPdo()->lastInsertId();
                    if($id>0){
                        $destinationPath = self::NEWS_PATH; 
                        $extension = $file->getClientOriginalExtension(); 
                        $fileName = rand(11111,99999)."_".$id; 
                        $fileNameFull = $fileName.".".$extension;
                        $fileMoved = $file->move($destinationPath, $fileNameFull);
                        if (File::exists($fileMoved->getRealPath())){
                            //update after moved file
                            $sqlUpdate = "UPDATE KH_NEWS SET NEWS_IMAGE_TITLE_NAME=?, NEWS_IMAGE_TITLE_EXT=? WHERE NEWS_ID=?";
                            $updateParam = array($fileName,$extension,$id);
                            DB::update($sqlUpdate,$updateParam);
                            Session::flash('alert-success', 'บันทึกข้อมูลสำเร็จ ');
                            return redirect('admin/news/');
                        }
                        else{
                            Session::flash('alert-danger', 'เกิดข้อผิดพลาด กรุณาติดต่อผู้ดูแลระบบ');
                            return redirect('admin/news/');
                        }
                    }
                    else{
                        Session::flash('alert-danger', 'เกิดข้อผิดพลาด กรุณาติดต่อผู้ดูแลระบบ');
                        return redirect('admin/news/');
                    }
                }
                else {
                    Session::flash('alert-danger', 'เกิดข้อผิดพลาด กรุณาติดต่อผู้ดูแลระบบ');
                    return redirect('admin/news/');
                }
            }
            else{
                //youtube case
                $youtubeUri = $request->input('youTubeUrl');
                $sqlInsert = "INSERT INTO KH_NEWS(NEWS_ORDER,NEWS_TITLE,NEWS_CONTENT,NEWS_SAMPLE,NEWS_IS_YOUTUBE,NEWS_YOUTUBE_URI) VALUES(?,?,?,?,1,?)";
                $insertParam = array($maxOrder,$title,htmlentities($content),htmlentities($sample),$youtubeUri);
                DB::insert($sqlInsert,$insertParam);
                Session::flash('alert-success', 'บันทึกข้อมูลสำเร็จ ');
                return redirect('admin/news/');
            }
        }
    }

    public function newsUpdate(Request $request,$id){
        $rules=[
            'newsTitle'=>'required|max:100',
            'newsType'=>'required',
            'youTubeUrl'=>'url|required_if:newsType,1',
            'newsImage'=>'image|max:1024',
            'sample'=>'required|max:500|not_in:<p>&nbsp; &nbsp;</p>',
            'content'=>'required|max:4000|not_in:<p>&nbsp; &nbsp;</p>'
        ];
        $messages = [
            'newsTitle.required'=>'กรุณาระบุชื่อ News/Articles',
            'newsTitle.max'=>'News/Articles ต้องยาวไม่เกิน 100 ตัวอักษร',
            'newsType.required'=>'กรุณาระบุประเภทของแบนเนอร์',
            'youTubeUrl.required_if'=>'กรุณาระบุลิงค์',
            'youTubeUrl.url'=>'ลิงค์ไม่ถูกต้อง',
            'youTubeUrl.active_url'=>'ไม่สามารถติดต่อลิงค์ดังกล่าวได้',
            'newsImage.image'=>'กรุณาระบุประเภทของรูปภาพให้ถูกต้อง',
            'newsImage.max'=>'ขนาดของรูปภาพต้องไม่เกิน 1MB',
            'sample.required'=>'กรุณาระบุรายละเอียดโดยย่อ',
            'sample.max'=>'รายละเอียดโดยย่อต้องยาวไม่เกิน 500ตัวอักษร',
            'content.required'=>'กรุณาระบุรายละเอียด',
            'content.max'=>'รายละเอียดต้องยาวไม่เกิน4000ตัวอักษร'
        ];
        //set more validate rule
        $validator = Validator::make($request->all(),$rules,$messages);
        if($validator->fails()){
            Session::flash('alert-danger', 'เกิดข้อผิดพลาด กรุณาตรวจสอบ');
            return redirect('admin/news/news')->withErrors($validator)->withInput();
        }else {
            $newsType = $request->input('newsType');
            $sample = $request->input('sample');
            $content = $request->input('content');
            $title = $request->input('newsTitle');
            $youtubeUri = "";

            if($newsType==0){
                //update picture case
                $file = Input::file('newsImage');
                if ($file!=null&&$file->isValid()) {
                    //update
                    $destinationPath = self::NEWS_PATH; 
                    $extension = $file->getClientOriginalExtension(); 
                    $fileName = rand(11111,99999)."_".$id; 
                    $fileNameFull = $fileName.".".$extension;
                    $fileMoved = $file->move($destinationPath, $fileNameFull);
                    if (File::exists($fileMoved->getRealPath())){
                        //update after moved file
                        $sqlUpdate = "UPDATE KH_NEWS SET NEWS_TITLE=?,NEWS_IMAGE_TITLE_NAME=?, NEWS_IMAGE_TITLE_EXT=?,NEWS_SAMPLE=?,NEWS_CONTENT=?,NEWS_IS_YOUTUBE=0 WHERE NEWS_ID=?";
                        $updateParam = array($title,$fileName,$extension,$sample,$content,$id);
                        DB::update($sqlUpdate,$updateParam);
                        Session::flash('alert-success', 'อัพเดทข้อมูลสำเร็จ ');
                        return redirect('admin/news/');
                    }
                    else{
                        Session::flash('alert-danger', 'เกิดข้อผิดพลาด กรุณาติดต่อผู้ดูแลระบบ');
                        return redirect('admin/news/');
                    }
                }
                else {
                    //update without change images
                    $sqlUpdate = "UPDATE KH_NEWS SET NEWS_TITLE=?,NEWS_SAMPLE=?,NEWS_CONTENT=?,NEWS_IS_YOUTUBE=0 WHERE NEWS_ID=?";
                    $updateParam = array($title,$sample,$content,$id);
                    DB::update($sqlUpdate,$updateParam);
                    Session::flash('alert-success', 'อัพเดทข้อมูลสำเร็จ ');
                    return redirect('admin/news/');
                }
            }
            else{
                //update youtube case
                $youtubeUri = $request->input('youTubeUrl');
                $sqlUpdate = "UPDATE KH_NEWS SET NEWS_TITLE=?,NEWS_SAMPLE=?,NEWS_CONTENT=?,NEWS_IS_YOUTUBE=1,NEWS_YOUTUBE_URI=? WHERE NEWS_ID=?";
                $updateParam = array($title,$sample,$content,$youtubeUri,$id);
                DB::update($sqlUpdate,$updateParam);
                Session::flash('alert-success', 'อัพเดทข้อมูลสำเร็จ ');
                return redirect('admin/news/');
            }
        }

    }

    function orderNews($id,$order){
        //order of selected news id
        $sql = "SELECT NEWS_ID,NEWS_ORDER FROM KH_NEWS WHERE NEWS_ID = ?";
        $queryParam = array($id);
        $data = DB::select($sql,$queryParam);

        if(count($data)>0){
            $sqlReplace = "SELECT NEWS_ID,NEWS_ORDER FROM KH_NEWS WHERE NEWS_ORDER = ?";
            $queryReplaceParam = array($order);
            $dataReplace = DB::select($sqlReplace,$queryReplaceParam);
            if(count($dataReplace)==1){
                //replace after order with current news order
                $sqlUpdateReplace = "UPDATE KH_NEWS SET NEWS_ORDER = ? WHERE NEWS_ORDER = ?";
                $updateReplaceParam = array($data[0]['NEWS_ORDER'],$order);
                DB::update($sqlUpdateReplace,$updateReplaceParam);

                //update current banner with specific order order
                $sqlUpdateOder = "UPDATE KH_NEWS SET NEWS_ORDER = ? WHERE NEWS_ID = ?";
                $updateCurrentParam = array($order,$id);
                DB::update($sqlUpdateOder,$updateCurrentParam);
                return redirect('admin/news/');
            }
            else{
                return redirect('home');
            }
        }
        else{
            return redirect('home');
        }
    }

    function deleteNews($id){
        $sqlDelete = "UPDATE KH_NEWS SET NEWS_DELETE_STATUS = 1 WHERE NEWS_ID = ?";
        $deleteParam = array($id);
        DB::update($sqlDelete,$deleteParam);
        return redirect('admin/news');
    }

    function orderBrand($id,$order){
        //order of selected brand id
        $sql = "SELECT BRAND_ID,BRAND_ORDER FROM KH_BRAND WHERE BRAND_ID = ?";
        $queryParam = array($id);
        $data = DB::select($sql,$queryParam);

        if(count($data)>0){
            $sqlReplace = "SELECT BRAND_ID,BRAND_ORDER FROM KH_BRAND WHERE BRAND_ORDER = ?";
            $queryReplaceParam = array($order);
            $dataReplace = DB::select($sqlReplace,$queryReplaceParam);
            if(count($dataReplace)==1){
                //replace after order with current brand order
                $sqlUpdateReplace = "UPDATE KH_BRAND SET BRAND_ORDER = ? WHERE BRAND_ORDER = ?";
                $updateReplaceParam = array($data[0]['BRAND_ORDER'],$order);
                DB::update($sqlUpdateReplace,$updateReplaceParam);

                //update current brand with specific order order
                $sqlUpdateOder = "UPDATE KH_BRAND SET BRAND_ORDER = ? WHERE BRAND_ID = ?";
                $updateCurrentParam = array($order,$id);
                DB::update($sqlUpdateOder,$updateCurrentParam);
                return redirect('admin/product');
            }
            else{
                return redirect('home');
            }
        }
        else{
            return redirect('home');
        }
    }

    function deleteBrand($id){
        $sqlDelete = "UPDATE KH_BRAND SET BRAND_DELETE_STATUS = 1 WHERE BRAND_ID = ?";
        $deleteParam = array($id);
        DB::update($sqlDelete,$deleteParam);
        return redirect('admin/product');
    }

    function orderProduct($idBrand,$id,$order){
        //order of selected product id
        $sql = "SELECT PRODUCT_ID,PRODUCT_ORDER FROM KH_PRODUCT WHERE PRODUCT_ID = ?";
        $queryParam = array($id);
        $data = DB::select($sql,$queryParam);

        if(count($data)>0){
            $sqlReplace = "SELECT PRODUCT_ID,PRODUCT_ORDER FROM KH_PRODUCT WHERE PRODUCT_ORDER = ?";
            $queryReplaceParam = array($order);
            $dataReplace = DB::select($sqlReplace,$queryReplaceParam);
            if(count($dataReplace)==1){
                //replace after order with current product order
                $sqlUpdateReplace = "UPDATE KH_PRODUCT SET PRODUCT_ORDER = ? WHERE PRODUCT_ORDER = ?";
                $updateReplaceParam = array($data[0]['PRODUCT_ORDER'],$order);
                DB::update($sqlUpdateReplace,$updateReplaceParam);

                //update current product with specific order order
                $sqlUpdateOder = "UPDATE KH_PRODUCT SET PRODUCT_ORDER = ? WHERE PRODUCT_ID = ?";
                $updateCurrentParam = array($order,$id);
                DB::update($sqlUpdateOder,$updateCurrentParam);
                return redirect('admin/product/productOf/'.$idBrand);
            }
            else{
                Session::flash('alert-danger', 'เกิดข้อผิดพลาด กรุณาติดต่อผู้ดูแลระบบ');
                return redirect('admin/product/productOf/'.$idBrand);
            }
        }
        else{
            Session::flash('alert-danger', 'เกิดข้อผิดพลาด กรุณาติดต่อผู้ดูแลระบบ');
            return redirect('admin/product/productOf/'.$idBrand);
        }
    }

    function deleteProduct($idBrand,$id){
        $sqlDelete = "UPDATE KH_PRODUCT SET PRODUCT_DELETE_STATUS = 1 WHERE PRODUCT_ID = ?";
        $deleteParam = array($id);
        DB::update($sqlDelete,$deleteParam);
        return redirect('admin/product/productOf/'.$idBrand);
    }

}
