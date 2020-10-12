<?php

namespace App\Http\Controllers;
use File;
use App\Vendor;
use App\vendorpicture;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

use DB;

class VendorController extends Controller
{
    public function show()
    {
 //  echo"hi";exit;
        return view('admin.vendor.vendor');
    }
    public function store(Request $request)
    {
        $file= $request->all();
        //dd( $file);
        $request->validate([
            'company_name'    =>  'required',
            'company_cin'     =>  'required',
            'pan_no'     =>  'required',
            'ownername'     =>  'required'
        ]);
        $vendorpicture = $request->file('vendorpicture');
        $vendorgst = $request->file('vendorgst');
        $ownerpersonaldoc = $request->file('ownerpersonaldoc');
        $cinphoto = $request->file('cinphoto');
        $panimage = $request->file('panimage');
        $gstupload = $request->file('gstupload');
        $companydoc = $request->file('companydoc');
        $otherdoc = $request->file('otherdoc');
        $image = [];
        $fourRandom = hexdec(uniqid());
        $fourRandomDigit =$fourRandom;
        // call the same function if the barcode exists already
      
        // otherwise, it's valid and can be used
       

        // $images2 = [];
        if($request->hasFile('vendorpicture')){
            $image1 = $request->file('vendorpicture');   
            foreach ($image1 as $key => $i)
            {
                $filename1 =  $request->ownername.'_'.$key.'.'.$i->getClientOriginalExtension();
               
                $i->move(storage_path('app/public/documents/'.'client_id-'.$fourRandomDigit.'/'.$request->company_name), $filename1);

              
                $image[] = $filename1; 
             }
              //dd($image);
        }
        if($request->hasFile('vendorgst')){
            $image2 = $request->file('vendorgst');   
            foreach ($image2 as $key => $i)
            {
                $filename1 =  $request->ownername.'_'.$key.'.'.$i->getClientOriginalExtension();
               
                $i->move(storage_path('app/public/documents/'.'client_id-'.$fourRandomDigit.'/'.$request->company_name), $filename1);

              
                $images2[] = $filename1; 
             }
             //dd($image);
        }
        if($request->hasFile('ownerpersonaldoc')){
            $image3 = $request->file('ownerpersonaldoc');   
            foreach ($image3 as $key => $i)
            {
                $filename1 =  $request->ownername.'_'.$key.'.'.$i->getClientOriginalExtension();
               
                $i->move(storage_path('app/public/documents/'.'client_id-'.$fourRandomDigit.'/'.$request->company_name), $filename1);
 
                $images3[] = $filename1; 
             }
             // dd($images3);exit;
        }
        if($request->hasFile('cinphoto')){
            $image4 = $request->file('cinphoto');   
            foreach ($image4 as $key => $i)
            {
                $filename1 =  $request->ownername.'_'.$key.'.'.$i->getClientOriginalExtension();
               
                $i->move(storage_path('app/public/documents/'.'client_id-'.$fourRandomDigit.'/'.$request->company_name), $filename1);

                $images4[] = $filename1; 
             }
             //dd($images4);
        }
        if($request->hasFile('panimage')){
            $image5 = $request->file('panimage');   
            foreach ($image5 as $key => $i)
            {
                $filename1 =  $request->ownername.'_'.$key.'.'.$i->getClientOriginalExtension();
               
                $i->move(storage_path('app/public/documents/'.'client_id-'.$fourRandomDigit.'/'.$request->company_name), $filename1);

                $images5[] = $filename1; 
             }
            // dd($images5);exit;
        }
        if($request->hasFile('gstupload')){
            $image6 = $request->file('gstupload');   
            foreach ($image6 as $key => $i)
            {
                $filename1 =  $request->ownername.'_'.$key.'.'.$i->getClientOriginalExtension();
               
                $i->move(storage_path('app/public/documents/'.'client_id-'.$fourRandomDigit.'/'.$request->company_name), $filename1);

                $images6[] = $filename1; 
             }
            //  dd($image);
        }
        if($request->hasFile('companydoc')){
            $image7 = $request->file('companydoc');   
            foreach ($image7 as $key => $i)
            {
                $filename1 =  $request->ownername.'_'.$key.'.'.$i->getClientOriginalExtension();
               
                $i->move(storage_path('app/public/documents/'.'client_id-'.$fourRandomDigit.'/'.$request->company_name), $filename1);

                $images7[] = $filename1; 
             }
            //  dd($image);
        }
        if($request->hasFile('otherdoc')){
            $image8 = $request->file('otherdoc');   
            foreach ($image8 as $key => $i)
            {
                $filename1 =  $request->ownername.'_'.$key.'.'.$i->getClientOriginalExtension();
               
                $i->move(storage_path('app/public/documents/'.'client_id-'.$fourRandomDigit.'/'.$request->company_name), $filename1);

                $images8[] = $filename1; 
             }
            //  dd($image);
        }
      //  dd(serialize($images4));
       // dd(serialize($image));
        // $new_name = rand() . '.' . $vendorpicture->getClientOriginalExtension();
        // $vendorpicture->move(storage_path('public/images'), $new_name);
        $form_data = array(
            'company_name'    =>   $request->company_name,
            'company_cin'     =>   $request->company_cin,
            'pan_no'          =>   $request->pan_no,
            'ownername'       =>   $request->ownername,
            'gstno'           =>  $request->gstno,
            'pan_no'          =>   $request->pan_no,
            'vendorpicture'   =>serialize($image),
            'vendorgst'       =>serialize($images2),
            'ownerpersonaldoc'=>serialize($images3),
            'cinphoto'=>serialize($images4),
            'panimage'=>serialize($images5),
            'gstupload'=>serialize($images6),
            'companydoc'=>serialize($images7),
            'otherdoc'=>serialize($images8),
        );

        Vendor::create($form_data);
       
      
        return view('admin.vendor.vendor')->with('success', 'Data Added successfully.');
    }
    //upload image 
    public function vendorpicture (Request $request)
    {
        $validator = Validator::make($request->all(), [
            'company_name' => 'required',
          
        ]);
        if ($validator->passes()) {
       $fourRandom = hexdec(uniqid());
       $fourRandomDigit =$fourRandom; 
       $username = Auth::user()->name;
       $userid=Auth::user()->id;
    //    return($userid);
       Vendor::updateOrCreate(
        ['id' =>$userid] ,
        [     
            'user_id'=>$userid,
            'company_name'=>$request->company_name,
            'company_cin'=>$request->company_cin,
            'pan_no'=>$request->pan_no,
            'ownername'=>$request->ownername,
            'gstno'=>$request->gstno]);
      // return(Auth::user()->id ); 
    //    $Vendor = Vendor::findOrFail(Auth::user()->id);    
    //    $Vendor->company_name = request()->input('company_name');
    //    $Vendor->company_cin = request()->input('company_cin');
    //    $Vendor->pan_no = request()->input('pan_no');
    //    $Vendor->ownername = request()->input('ownername');
    //    $Vendor->gstno = request()->input('gstno');
    //    $Vendor->save();
      // return($Vendor); 
       //saving for vendorgst   
       if($request->ownerpersonaldoc > 0)
       {   
          
        for ($x = 0; $x < $request->ownerpersonaldoc; $x++) {   
           
         if ($request->hasFile('ownerpersonaldocimages'.$x)) {   
               
         $file2      = $request->file('ownerpersonaldocimages'.$x);
         $filename2  = $request->ownername.'_'.$file2->getClientOriginalName();
         $extension2 = $file2->getClientOriginalExtension();
        
         $ownerpersonaldoc   = date('His').'-'.$filename2;
         $file2->move(storage_path('app/public/documents/'.'client_id-'.$username), $ownerpersonaldoc);
         $ownerpersonaldocs[] = $ownerpersonaldoc ;
          }
       }
       Vendor::updateOrCreate(
         ['id' =>$userid],
         [     
             'ownerpersonaldoc'=>serialize($ownerpersonaldocs)
 
         ]);
         }
         
       if($request->TotalImages > 0)
       {
          for ($x = 0; $x < $request->TotalImages; $x++) {     
          if ($request->hasFile('images'.$x)) {
           
          $file      = $request->file('images'.$x);
          $filename  = $request->ownername.'_'.$file->getClientOriginalName();
          $extension = $file->getClientOriginalExtension();
       
          $picture   = date('His').'-'.$filename;
          $file->move(storage_path('app/public/documents/'.'client_id-'.$username), $picture);
          $pictures[] = $picture ;
            }
        }
          Vendor::updateOrCreate(
            ['id' =>$userid] ,
            [     
                'vendorpicture'=>serialize($pictures)
    
            ]);
            }
    
        //saving for vendorgst   
        if($request->vendorgst > 0)
        {
            
           for ($x = 0; $x < $request->vendorgst; $x++) {     
           if ($request->hasFile('vendorgstimages'.$x)) {                 
           $file1      = $request->file('vendorgstimages'.$x);
           $filename1  = $file1->getClientOriginalName();
           $extension1 = $file1->getClientOriginalExtension();
        
           $vendorgst   = date('His').'-'.$filename1;
           $file1->move(storage_path('app/public/documents/'.'client_id-'.$username), $vendorgst);
           $vendorgsts[] = $vendorgst ;
            }
         }
         Vendor::updateOrCreate(
            ['id' =>$userid] ,
            [     
                'vendorgst'=>serialize($vendorgsts)
    
            ]);
          }
       
     

        if($request->cinphoto > 0)
        { 
      //upload img for cinphoto
       for ($x = 0; $x < $request->cinphoto; $x++) {     
        if ($request->hasFile('cinphotoimages'.$x)) {           
        $file3      = $request->file('cinphotoimages'.$x);
        $filename3  = $request->ownername.'_'.$file3->getClientOriginalName();
        $extension3 = $file3->getClientOriginalExtension();
     
        $cinphoto   = date('His').'-'.$filename3;
        $file3->move(storage_path('app/public/documents/'.'client_id-'.$username), $cinphoto);
        $cinphotos[] = $cinphoto ;
         }
      }
      Vendor::updateOrCreate(
        ['id' =>$userid] ,
        [     
            'cinphoto'=>serialize($cinphotos)

        ]);
        }
        
      //upload for panimage
      if($request->panimage > 0)
      { 
       // return ($request->panimage);
        for ($x = 0; $x < $request->panimage; $x++) {     
        if ($request->hasFile('panimageimages'.$x)) {           
        $file4      = $request->file('panimageimages'.$x);
        $filename4  = $request->ownername.'_'.$file4->getClientOriginalName();
        $extension4 = $file4->getClientOriginalExtension();
      // echo "hi" ;exit;
        $panimage   = date('His').'-'.$filename4;
        $file4->move(storage_path('app/public/documents/'.'client_id-'.$username), $panimage);
        $panimages[] = $panimage ;
         }
      }
      Vendor::updateOrCreate(
        ['id' =>$userid] ,
        [     
            'panimage'=>serialize($panimages)

        ]);
        }
       
        if($request->gstupload > 0)
        { 
        //upload for gstupload
        for ($x = 0; $x < $request->gstupload; $x++) {     
            if ($request->hasFile('gstuploadimages'.$x)) {           
            $file5      = $request->file('gstuploadimages'.$x);
            $filename5  = $request->ownername.'_'.$file5->getClientOriginalName();
            $extension5 = $file5->getClientOriginalExtension();
        
            $gstupload   = date('His').'-'.$filename5;
            $file5->move(storage_path('app/public/documents/'.'client_id-'.$username), $gstupload);
            $gstuploads[] = $gstupload ;
            }
        }
        Vendor::updateOrCreate(
            ['id' =>$userid] ,
            [     
                'gstupload'=>serialize($gstuploads)
    
            ]);
            }
           
            if($request->companydoc > 0)
            { 
        //upload for companydoc
        for ($x = 0; $x < $request->companydoc; $x++) {     
            if ($request->hasFile('companydocimages'.$x)) {           
            $file6      = $request->file('companydocimages'.$x);
            $filename6  = $request->ownername.'_'.$file6->getClientOriginalName();
            $extension6 = $file6->getClientOriginalExtension();
        
            $companydoc   = date('His').'-'.$filename6;
            $file6->move(storage_path('app/public/documents/'.'client_id-'.$username), $companydoc);
            $companydocs[] = $companydoc ;
            }
        }
        Vendor::updateOrCreate(
            ['id' =>$userid] ,
            [     
                'companydoc'=>serialize($companydocs)
    
            ]);
            }
         
        if($request->otherdoc > 0)
        { 
          //otherdoc
          for ($x = 0; $x < $request->otherdoc; $x++) {     
            if ($request->hasFile('otherdocimages'.$x)) {           
            $file7      = $request->file('otherdocimages'.$x);
            $filename7  = $request->ownername.'_'.$file7->getClientOriginalName();
            $extension7 = $file7->getClientOriginalExtension();
        
            $otherdoc   = date('His').'-'.$filename7;
            $file7->move(storage_path('app/public/documents/'.'client_id-'.$username), $otherdoc);
            $otherdocs[] = $otherdoc ;
            }
        } 
        Vendor::updateOrCreate(
            ['id' =>$userid] ,
            [     
                'otherdoc'=>serialize($otherdocs)
    
            ]);
            }
            

        // $userid = Auth::id();
        // $flight = vendor::updateOrCreate(
        //                ['id' =>  $userid],
        //                ['vendorpicture'=>serialize($pictures),
        //                 'vendorgst'=>serialize($vendorgsts),
        //                 'ownerpersonaldoc'=>serialize($ownerpersonaldocs),
        //                 'cinphoto'=>serialize($cinphotos),
        //                 'panimage'=>serialize($panimages),
        //                 'gstupload'=>serialize($gstuploads),
        //                 'companydoc'=>serialize($companydocs),
        //                 'otherdoc'=>serialize($otherdocs),
        //                 'company_name'=>$request->company_name,
        //                 'company_cin'=>$request->company_cin,
        //                 'pan_no'=>$request->pan_no,
        //                 'ownername'=>$request->ownername,
        //                 'gstno'=>$request->gstno]
        //             );
     
		return response()->json(['success'=>'Added new records.']);
       }

    	return response()->json(['error'=>$validator->errors()->all()]);




        // if($request->hasFile('TotalImages ')){
        //     $image1 = $request->file('images');  
        //     $fourRandom = hexdec(uniqid());
        //     $fourRandomDigit =$fourRandom; 
        //     foreach ($image1 as $key => $i)
        //     {
        //        // $filename1 =  Auth::user()->id.'_'.$key.'.'.$i->getClientOriginalExtension();
        //         $filename1 =  897 .'_'.$key.'.'.$i->getClientOriginalExtension();
       
        //         $i->move(storage_path('app/public/documents/'.'client_id-'.$fourRandomDigit), $filename1);

        //         $images1[] = $filename1; 
        //      } 
        //      vendor::create(['vendorpicture'=>serialize($images1),'company_name'=>$request->company_name]);
        //     return response()
        //     ->json(["message" => "Media added successfully.", "images" => $images1]);
 
         
        }
       
    
}
