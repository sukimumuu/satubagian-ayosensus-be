<?php

namespace App\Http\Controllers\Api\V1;

use App\Models\Household;
use App\Models\Individual;
use Illuminate\Http\Request;
use App\Models\SensusSubmission;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Http\Requests\InputFamilyRequest;
use App\Http\Requests\InputFamilyMemberRequest;

class SensusFormulirController extends Controller
{
    public function startSensus()
    {
       DB::transaction(function () {
            $household = Household::updateOrCreate([
                'user_id' => auth()->id()],
            [
                'kode_desa' => auth()->user()->kode_desa,
            ]);

            SensusSubmission::updateOrCreate([
                'household_id' => $household->id],
            [
                'sensus_year' => now()->year,
            ]);

            Individual::updateOrCreate([
                'household_id' => $household->id],
            [
                'nik' => auth()->user()->name,
                'family_status' => 'Kepala Keluarga'
            ]);
        });

        return response()->json([
            'success' => true,
            'message' => 'Sensus formulir berhasil dimulai!',
        ], 200);
    }

    public function storeFamily(InputFamilyRequest $request){
        $data = $request->validated();
        $data['user_id'] = auth()->user()->id;
        $data['kode_desa'] = auth()->user()->kode_desa;

        DB::transaction(function () use ($data, $request) {
            $household = HouseHold::where('user_id', $data['user_id'])->first();
            $household->update($data);

            if($request->filled(['housings.ownership_status', 'housings.electricity', 'housings.water', 'housings.toilet', 'housings.floor'])) {
                $household->housing()->updateOrCreate(
                    ['household_id' => $household->id],
                    [
                        'ownership_status' => $request->input('housings.ownership_status'),
                        'electricity' => $request->input('housings.electricity'),
                        'water' => $request->input('housings.water'),
                        'toilet' => $request->input('housings.toilet'),
                        'floor' => $request->input('housings.floor'),
                    ]);
            }
        });
        return response()->json([
            'success' => true,
            'message' => 'Data Keluarga Berhasil Disimpan!',
        ], 200);
    }

    public function storeMemberFamily(InputFamilyMemberRequest $request){
        $data = $request->validated();

        DB::transaction(function () use ($data, $request) {
            $individual = Individual::updateOrCreate(
                            ['nik' => $data['nik']],
                            $data
                        );

            if ($request->filled(['works.activity', 'works.job'])) {
                $individual->works()->updateOrCreate(
                    ['individual_id' => $individual->id],
                    [
                    'activity'      => $request->input('works.activity'),
                    'job'           => $request->input('works.job'),
                    'job_status'    => $request->input('works.job_status'),
                ]);
            }

            if ($request->filled('educations.education')) {
                $individual->educations()->updateOrCreate(
                    ['individual_id' => $individual->id],
                    [
                    'education'     => $request->input('educations.education'),
                ]);
            }
        });
        return response()->json([
            'success' => true,
            'message' => 'Data Anggota Keluarga Berhasil Disimpan!',
        ], 200);
    }

    public function getFamily(){
        $household = Household::where('user_id', auth()->user()->id)->first();

        return response()->json([
            'success' => true,
            'message' => 'Data Keluarga Berhasil Diambil!',
            'data' => $household->load('housing')
        ]);        
    }

    public function getFamilyMember(){
        $household = Household::where('user_id', auth()->user()->id)->first();

        return response()->json([
            'success' => true,
            'message' => 'Data Anggota Keluarga Berhasil Diambil!',
            'data' => $household->individuals
        ]);        
    }

    public function submitSensus(){
        $household = Household::where('user_id', auth()->user()->id)->first();
        $household->submission()->updateOrCreate([
            'household_id' => $household->id],
            [
                'sensus_year' => now()->year,
                'status' => 'submitted',
            ]);

        return response()->json([
            'success' => true,
            'message' => 'Sensus formulir berhasil dikirim ke petugas !',
        ], 200);
    }
}
