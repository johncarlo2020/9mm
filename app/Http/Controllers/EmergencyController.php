<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Emergency;
use App\Models\EmergencyImage;
use DB;
use App\Events\EmergencyEvent;


class EmergencyController extends Controller
{
    public function add(Request $request)
    {
        $this->validate($request, [
            'images'            => 'required|array',
            'title'             => 'required',
            'description'       => 'required',
            'location'        => 'required',
        ]);

        DB::beginTransaction();
        try {
            $client = auth()->user();
            $date = now()->format('Ymd_His');
            $emergency =  new Emergency;
            $emergency->title = $request->title;
            $emergency->description = $request->description;
            $emergency->user_id = $client->id;
            $emergency->location = $request->location;
            $emergency->save();

            $array=[];

            foreach ($request->images as $key => $image) {

                $imagePath = $image->storeAs(
                    'emergencies', $date . '_'.$key.'emergency.png', 'public'
                );
                
                $emergency->images = $imagePath;
                $array[] = [
                    'emergency_id'=>$emergency->id, 
                    'image'=>$imagePath, 
                ];
            }

            $images = EmergencyImage::insert($array);
            event(new EmergencyEvent($emergency));
          
            DB::commit();
            return response()->json(['id'=>$emergency->id], 201);

        } catch (ValidationException $e) {
            // Handle validation errors
            $errors = $e->validator->errors()->toArray();
            return response()->json(['errors' => $errors], 422);
        } catch (\Exception $e) {
            // Handle other exceptions
            DB::rollBack();
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }
}
