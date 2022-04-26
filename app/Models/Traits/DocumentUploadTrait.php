<?php
namespace App\Models\Traits;

use App\Models\Document;

trait DocumentUploadTrait {

    public function saveDocument($file, $urlprefix, $data=[]){
        $name = $file->getClientOriginalName();
        $contents = file_get_contents($file);
        $path = $urlprefix.'/' . $this->id . '/' . rand(111, 999) . '_' . str_replace(' ','_', $name);
        \Storage::put($path, $contents, 'public');
        $document=new Document(['file_path'=>$path]);
        $this->gallery()->save($document);
    }

    public function gallery(){
        return $this->morphMany('App\Models\Document', 'entity');
    }

    public function saveImage($file, $urlprefix){
        $name = $file->getClientOriginalName();
        $contents = file_get_contents($file);
        $path = $urlprefix.'/' . $this->id . '/' . rand(111, 999) . '_' . str_replace(' ','_', $name);
        \Storage::put($path, $contents, 'public');
        $this->image=$path;
        $this->save();
    }


    public function saveWorkImage($file, $urlprefix){
        $name = $file->getClientOriginalName();
        $contents = file_get_contents($file);
        $path = $urlprefix.'/' . $this->id . '/' . rand(111, 999) . '_' . str_replace(' ','_', $name);
        \Storage::put($path, $contents, 'public');
        $this->work_image=$path;
        $this->save();
    }

    public function saveKycImage($file, $urlprefix){
        $name = $file->getClientOriginalName();
        $contents = file_get_contents($file);
        $path = $urlprefix.'/' . $this->id . '/' . rand(111, 999) . '_' . str_replace(' ','_', $name);
        \Storage::put($path, $contents, 'public');
        $this->kyc_image=$path;
        $this->save();
    }

    public function saveAadharBack($file, $urlprefix){
        $name = $file->getClientOriginalName();
        $contents = file_get_contents($file);
        $path = $urlprefix.'/' . $this->id . '/' . rand(111, 999) . '_' . str_replace(' ','_', $name);
        \Storage::put($path, $contents, 'public');
        $this->aadhar_back=$path;
        $this->save();
    }

    public function saveAadharFront($file, $urlprefix){
        $name = $file->getClientOriginalName();
        $contents = file_get_contents($file);
        $path = $urlprefix.'/' . $this->id . '/' . rand(111, 999) . '_' . str_replace(' ','_', $name);
        \Storage::put($path, $contents, 'public');
        $this->aadhar_front=$path;
        $this->save();
    }

}
