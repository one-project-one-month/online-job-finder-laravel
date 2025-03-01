<?php

namespace App\Http\Controllers\Api\CompanyProfile;


use App\Http\Controllers\Controller;
use App\Http\Requests\CompanyProfileRequest;
use App\Http\Resources\CompanyProfileResource;
use App\Services\CompanyProfile\CompanyProfileServices;

class CompanyProfileController extends Controller
{

        private $companyProfileService;
        public function __construct(CompanyProfileServices $companyProfileService)
        {
            $this->companyProfileService = $companyProfileService;
        }

        public function store(CompanyProfileRequest $request)
        {
            try{
                $companyProfile = $this->companyProfileService->createCompanyProfile($request->toArray());

                return response()->json(
                    [
                        'status'=>'success',
                        'statusCode'=>201,
                        'message'=>'Company Profile created successfully',
                        'data'=>[
                            'CompanyProfile'=> new CompanyProfileResource($companyProfile)
                        ]
                    ],201
                    );
              } catch (\Exception $e) {
                return response()->json(
                    [
                       'message'=>$e->getMessage(),
                        'status'=>'error',
                        'statusCode'=>500
                    ],500
                    );
            }
        }

        public function index()
        {
                try{
                    $companyProfiles = $this->companyProfileService->GetAllCompanyProfile();
                    return response()->json([
                        'status'=>'success',
                        'statusCode'=>200,
                        'message'=>'fetching successful',
                        'data'=>[
                            'companyProfiles'=> CompanyProfileResource::collection($companyProfiles)
                        ]
                    ],200);
                }   catch (\Exception $e) {
                    return response()->json([
                        'status'=>'error',
                        'message'=>$e->getMessage(),
                        'statusCode'=>500

                    ],500);
                }
        }

        public function show ($id)
        {
            try{
                $companyProfile = $this->companyProfileService->GetCompanyProfileById($id);
                return response()->json([
                    'status'=>'success',
                    'statusCode'=>200,
                    'message'=>'fetching successful',
                    'data'=>[
                        'companyProfile'=> new CompanyProfileResource($companyProfile)
                    ]
                ],200);
                }catch (\Exception $e) {
                    return response()->json([
                        'status'=>'error',
                        'message'=>$e->getMessage(),
                        'statusCode'=>500
                    ],500);
        }
    }

        public function update(CompanyProfileRequest $request, $id)
        {
            try{
                $companyProfile = $this->companyProfileService->updateCompanyProfile($request->toArray(), $id);
                return response()->json([
                    'status'=>'success',
                    'statusCode'=>200,
                    'message'=>'Company Profile updated successfully',
                    'data'=>[
                        'companyProfile'=> new CompanyProfileResource($companyProfile)
                    ]
                ],200);
            }catch (\Exception $e) {
                return response()->json([
                    'status'=>'error',
                    'message'=>$e->getMessage(),
                    'statusCode'=>500

                ],500);
            }
        }

        public function destroy($id)
        {
            try{
                $companyProfile = $this->companyProfileService->deleteCompanyProfile($id);
                return response()->json([
                ],204);
            }catch (\Exception $e) {
                return response()->json([
                    'status'=>'error',
                    'message'=>$e->getMessage(),
                    'statusCode'=>500

                ],500);
            }
        }

}
