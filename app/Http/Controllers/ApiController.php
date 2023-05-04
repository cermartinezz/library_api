<?php

namespace App\Http\Controllers;

use Illuminate\Http\Response as StatusResponse;
use Illuminate\Support\Facades\Response;

class ApiController extends Controller
{
    protected $statusCode = 200;

    public function respondCreated($message = "Record Created Successfully", $data = null)
    {
        $result = [
            'message' => $message,
        ];

        $result = array_merge($result,$data);
        return $this->setStatusCode(StatusResponse::HTTP_CREATED)
            ->respond([
                'result'=>$result
            ]);
    }

    public function respondSuccess($message = "Success",$data = [])
    {
        $result = [
            'message' => $message,
        ];

        $result = array_merge($result,$data);

        return $this->setStatusCode(StatusResponse::HTTP_OK)
            ->respond([
                'result'=>$result
            ]);
    }

    public function respondNotFound($message = 'Not Found'){
        return $this->setStatusCode(StatusResponse::HTTP_NOT_FOUND)
            ->respondWithError($message);
    }

    public function respondWithErrorValidation(String $message, array $fields)
    {
        return $this->setStatusCode(StatusResponse::HTTP_UNPROCESSABLE_ENTITY)
            ->respond([
                'result' => [
                    "message" => $message,
                    "invalid_inputs" => $fields
                ]
            ]);
    }

    public function respondFailAuthentication($message = "Incorrect Credentials"){
        return $this->setStatusCode(StatusResponse::HTTP_UNAUTHORIZED)->respond([
            'result' => [
                'message' => $message,
            ]
        ]);
    }

    public function respondInternalError($message = "There was an internal problem"){
        return $this->setStatusCode(StatusResponse::HTTP_INTERNAL_SERVER_ERROR)->respond([
            'result' => [
                'message' => $message,
            ]
        ]);
    }

    public function respondBadRequest($message){
        return $this->setStatusCode(StatusResponse::HTTP_BAD_REQUEST)->respond([
            'result' => [
                'message' => $message,
            ]
        ]);
    }

    public function respondWithError($message)
    {
        return $this->respond([
            'result' => [
                'status' => 'fail',
                'ok' => false,
                'message' => $message,
                'status_code' => $this->getStatusCode()
            ]
        ]);
    }

    public function respond($data,$headers = [])
    {
        return Response::json($data,$this->getStatusCode(),$headers);
    }

    public function getStatusCode(): int
    {
        return $this->statusCode;
    }

    public function setStatusCode(int $statusCode)
    {
        $this->statusCode = $statusCode;

        return $this;
    }
}
