<?php

namespace App\Http\Controllers;

use App\Models\Trip;
use App\Models\Memory;
use App\Models\Destination;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;
use Symfony\Component\HttpFoundation\BinaryFileResponse;
use Illuminate\Support\Facades\Validator;
use Illuminate\Database\QueryException;
use Illuminate\Database\UniqueConstraintViolationException;

class TripController extends Controller
{
    function index(): View {
        return view('trips.home');
    }

    function memories(): View {
        $trips = Trip::where('status', 'done')->latest()->get();
        return view('trips.memories', ['trips' => $trips]);
    }

    function offers(): View {
        $trips = Trip::where('status', 'offer')->orderBy('travel_date')->get();
        return view('trips.offers', ['trips' => $trips]);
    }

    function show($id): View {
        $trip = Trip::find($id);
        if($trip == null) abort(404);
        return view('trips.show', ['trip' => $trip]);
    }

    function create(): View {
        $destinations = Destination::all(); 
        return view('trips.create', ['destinations' => $destinations]);
    }

    function store(Request $request): RedirectResponse {
        $rules = [
            'title'          => 'required|min:3|max:60',
            'destination_id' => 'required|exists:destinations,id',
            'travel_date'    => 'required|date',
            'status'         => 'required|in:done,offer',
            'price'          => 'nullable|numeric',
            'description'    => 'required|min:10',
            'image'          => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048'
        ];
        
        $validator = Validator::make($request->all(), $rules);
        if($validator->fails()) return back()->withInput()->withErrors($validator);

        $result = false;
        $message = '';
        
        try {
            $data = $request->except(['image']);

            if ($request->hasFile('image')) {
                $file = $request->file('image');
                $filename = $file->hashName();
               $file->move(storage_path('app/private_photos'), $filename);
                $data['image_url'] = $filename;
            }

            $trip = new Trip($data);
            $result = $trip->save();
            $message = 'El viaje se ha creado correctamente.';

        } catch(\Exception $e) {
            $message = 'Error al guardar: ' . $e->getMessage();
        }
        
        if($result) return redirect()->route('home')->with(['general' => $message]);
        else return back()->withInput()->withErrors(['general' => $message]);
    }

    function edit($id): View {
        $trip = Trip::find($id);
        if($trip == null) abort(404);
        $destinations = Destination::all(); 

        return view('trips.edit', [
            'trip' => $trip,
            'destinations' => $destinations
        ]);
    }

    function update(Request $request, $id): RedirectResponse {
         $rules = [
            'title'       => 'required|min:3|max:100',
            'description' => 'required',
            'travel_date' => 'required|date',
            'price'       => 'nullable|numeric',
            'image'       => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048'
        ];

        $validator = Validator::make($request->all(), $rules);
        if($validator->fails()) return back()->withInput()->withErrors($validator);

        $trip = Trip::find($id);
        if(!$trip) abort(404);

        $result = false;
        $message = '';

        try {
            $data = $request->except(['image']);

            if ($request->hasFile('image')) {
                $file = $request->file('image');
                $filename = $file->hashName();
              $file->move(storage_path('app/private_photos'), $filename);
                $data['image_url'] = $filename;
            }

            $result = $trip->update($data);
            $message = 'El viaje ha sido editado correctamente.';
        } catch(\Exception $e) {
            $message = 'Error al actualizar.';
        }

        if($result) return redirect()->route('trips.offers')->with(['general' => $message]);
        else return back()->withInput()->withErrors(['general' => $message]);
    }

    function destroy($id): RedirectResponse {
        $trip = Trip::find($id);
        if($trip == null) abort(404);

        try {
            $trip->memories()->delete(); 
            $trip->delete();
            $message = 'El viaje ha sido eliminado correctamente.';
        } catch(\Exception $e) {
            $message = 'Error al eliminar el viaje: ' . $e->getMessage();
            return back()->withErrors(['general' => $message]);
        }
        return back()->with(['success' => $message]);
    }

    function storeMemory(Request $request, $id): RedirectResponse {
        $rules = ['note' => 'required'];
        $validator = Validator::make($request->all(), $rules);
        
        if($validator->fails()) return back()->withInput()->withErrors($validator);

        $result = false;
        $message = '';
        try {
            $memory = new Memory(['trip_id' => $id, 'note' => $request->note]);
            $result = $memory->save();
            $message = 'Recuerdo añadido correctamente.';
        } catch(\Exception $e) {
            $message = 'Error al guardar el recuerdo.';
        }

        if($result) return back()->with(['general' => $message]);
        else return back()->withInput()->withErrors(['general' => $message]);
    }

    function buy($id): RedirectResponse {
        $trip = Trip::find($id);
        if($trip == null || $trip->status != 'offer') {
            return back()->withInput()->withErrors(['error' => 'Este viaje no se puede comprar.']);
        }
        return redirect()->route('home')->with(['success' => '¡Enhorabuena! Has reservado el viaje: ' . $trip->title]);
    }

    function getPrivateImage($filename): BinaryFileResponse {
        $path = storage_path('app/private_photos/' . $filename);
        if (!file_exists($path)) abort(404);
        return response()->file($path);
    }
}