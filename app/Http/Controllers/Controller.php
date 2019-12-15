<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class Controller extends BaseController{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;
    
    public function indexController($objectModel, $object_p, $loads = '', $filter = null){
        if(is_array($filter)){
            $object = $objectModel::where($filter)->get();
        }else{
            $object = $objectModel::all();
        }
        
        $this->loads($object, $loads);
        
        $data = array_add(config('global.dataSuccessNoMessage'), $object_p, $object);
        
        return $this->responseApi($data);
    }
    
    public function showController($id, $objectModel, $object_s, $objectName, $loads = ''){
        $object = $objectModel::find($id);
        $this->loads($object, $loads);
        
        if(is_object($object)){
            $data = array_add(config('global.dataSuccessNoMessage'),$object_s, $object);
        }else{
            $data = config('global.dataErrorNotFound');
            $data['message'] = str_replace(':object', $objectName, $data['message']);
        }
        
        return $this->responseApi($data);
    }
    
    public function storeController(
        $request, $objectModel, $object_s, $objectNameArr, $storeUserId = false, $objectModelDetail = null, 
        $columnIdForeignKey = ''
    ){
        $paramArr = $this->requestJsonDecodeArr($request);
        
        if($object_s == 'user'){
            $pwd = hash('sha256', $paramArr['password']);
            $paramArr['password'] = $pwd;
        }
        
        if($storeUserId){
            $user = $this->getIdentity($request);
            $paramArr['idUser'] = $user->sub;
        }
        
        $object = $objectModel;
        $object->newObject($paramArr);
        try{
            \DB::beginTransaction();
            $object->save();

            $data = array_add(config('global.dataSuccessMessage'), $object_s, $object);

            if(!is_null($objectModelDetail)){
                $data['details'] = $this->saveDetails($object->id, $paramArr['details'], $objectModelDetail, $columnIdForeignKey);
            }

            \DB::commit();            
        } catch (Throwable $e){
            \Db::rollback();
        }
        
        $data['message'] = trans('messages.store', $objectNameArr);
        return $this->responseApi($data);
    }
    
    public function updateController(
        $id, $request, $objectModel, $objectName, $object_s, $objectNameArr, $filterUserId = false, 
        $objectModelDetail = null, $columnIdForeignKey = ''
    ) {
        $changes = $this->getArrayChangesByObject($object_s, $this->requestJsonDecodeArr($request));
            
        $objectWhere = $objectModel::where('id', $id);
        $object = $objectWhere->first();
        $this->validateObject($object, $objectName);
        
        if($filterUserId){
            $user = $this->getIdentity($request);
            $objectWhereFilterUser = $objectWhere->where('user_id', $user->sub);
            $object = $objectWhereFilterUser->first();
            $this->validateObject($object, $objectName, trans('messages.notFoundByUser', ['object' => $objectName]));
        }
        
        try{
            \DB::beginTransaction();
            $objectWhere->update($changes);

            $data = array_add(config('global.dataSuccessMessage'), $object_s, $object);
            $data['changes'] = $changes;

            if(!is_null($objectModelDetail)){
                $paramArr = $this->requestJsonDecodeArr($request);
                $data['details'] = $this->saveDetails($object->id, $paramArr['details'], $objectModelDetail, $columnIdForeignKey, true);
            }
            
            \DB::commit();            
        } catch (Throwable $e){
            \Db::rollback();
        }
        
        $data['message'] = trans('messages.update', $objectNameArr);
        
        return $this->responseApi($data);
    }
    
    public function destroyController(
        $id, $request, $objectModel, $objectName, $object_s, $objectNameArr, $filterUserId = false, 
        $objectModelDetail = null, $columnIdForeignKey = ''
    ) {
        $objectWhere = $objectModel::where('id', $id);
        $object = $objectWhere->first();
        $this->validateObject($object, $objectName);
        
        if($filterUserId){
            $user = $this->getIdentity($request);
            $objectWhereFilterUser = $objectWhere->where('user_id', $user->sub);
            $object = $objectWhereFilterUser->first();
            $this->validateObject($object, $objectName, trans('messages.notFoundByUser', ['object' => $objectName]));
        }
        
        try{
            \DB::beginTransaction();
            if(!is_null($objectModelDetail)){
                $objectModelDetail::where($columnIdForeignKey, $id)->delete();
            }

            $objectWhere->delete();
            \DB::commit();            
        } catch (Throwable $e){
            \Db::rollback();
        }
        
        $data = array_add(config('global.dataSuccessMessage'), $object_s, $object);
        $data['message'] = trans('messages.destroy', $objectNameArr);
        
        return $this->responseApi($data);
    }
    
    public function loads($object, $loads){
        if($loads !== ''){
            foreach($loads as $load){
                $object = $object->load($load);
            }
        }                
    }
    
    public function saveDetails($id, $paramDetailArr, $objectModelDetail, $columnIdForeignKey, $deleteDetail = false){
        if($deleteDetail){
            $objectModelDetail::where($columnIdForeignKey, $id)->delete();
        }
        
        $index = 0;
        foreach ($paramDetailArr as $detail){
            $detail[$columnIdForeignKey] = $id;
            $objectDetail = new $objectModelDetail;
            $objectDetail->newObject($detail);
            $objectDetail->save();
            $detailsSave[$index] = $objectDetail;
            $index++;
        }
        return $detailsSave;        
    }
}
