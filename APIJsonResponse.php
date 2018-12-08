<?php
/**
 * User: Naran
 * Date: 01-Sep-18
 * Time: 11:15 AM
 */

namespace App\Http\Controllers\Traits;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;


trait APIJsonResponse{
    
    
    protected $status = false;
    protected $http = 204;
    protected $msg = 'success';

    /**
     * @param $validator
     * @return \Illuminate\Http\JsonResponse
     */
    protected function throwResponse($validator){
        return response()->json(array(
            'success'    => false,
            'data'      => $validator->getMessageBag(),
            'info'      => 'validation_error'
        ), 422);
    }

    /**
     * @param bool $status
     * @param array $data
     * @param string $msg
     * @param string $info
     * @param int $httpStatus
     * @return \Illuminate\Http\JsonResponse
     */
    protected function jsonResponse($status = true, $data = [], $msg = 'success', $info = 'Success',$httpStatus = 200){
        return response()->json([
            'success'    => $status,
            'data'      => $data,
            'info'      => $info,
        ],$httpStatus);
    }

    /**
     * @param $data
     * @param string $info
     * @return \Illuminate\Http\JsonResponse
     */
    protected function responseParserJson($data, $info = ''){
        if($data instanceof Collection) {
            if($data->count()>0){
                $this->status = true;
                $this->msg = 'success';
                $this->http = 200;
            }
        }else if(is_object($data) && !empty($data)){
            $this->status = true;
            $this->msg = 'success';
            $this->http = 200;
        }else if(is_array($data) && count($data) > 0){
            $this->status = true;
            $this->msg = 'success';
            $this->http = 200;
        }
        return response()->json([
            'success' => $this->status,
            'data'  => $data,
            'info'  => $info,
        ], $this->http);
    }

    /**
     * @param $data
     * @param string $info
     * @return \Illuminate\Http\JsonResponse
     */
    protected function responseParserJsonCreate($data, $info = ''){
        $this->status = true;
        $this->msg = 'success';
        $this->http = 201;

        return response()->json([
            'success' => $this->status,
            'data'  => $data,
            'info'  => $info,
        ], $this->http);
    }

    /**
     * @param $data
     * @param string $info
     * @return \Illuminate\Http\JsonResponse
     */
    protected function responseParserJsonEdit($data, $info = ''){
        if(!empty($data)){
            $this->status = true;
            $this->msg = 'success';
            $this->http = 200;
        }

        return response()->json([
            'success' => $this->status,
            'data'  => $data,
            'info'  => $info,
        ], $this->http);
    }

    /**
     * @param $data
     * @param string $info
     * @return \Illuminate\Http\JsonResponse
     */
    protected function responseParserUpdate($data, $info = ''){

        if(!empty($data)){
            $this->status = true;
            $this->msg = 'success';
            $this->http = 202;
        }
        return response()->json([
            'success' => $this->status,
            'data'  => $data,
            'info'  => $info,
        ], $this->http);

    }


