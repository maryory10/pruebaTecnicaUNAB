<?php

namespace App\Http\Controllers;

use App\Models\Asignatura;
use App\Models\Docente;
use App\Models\Horario;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class HorarioController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $horarios = Horario::query();
        if ($request->filled("id_docente")) {
            $docenteEnviado = Docente::where("correo", $request->id_docente)->first();
            if(!$docenteEnviado){
                return response()->json(["error" => "Docente no reconocido"], 404);
            }

            $horarios->where("id_docente", $docenteEnviado->id)->with("docente");
        } else {
            $horarios = Horario::with("docente");
        }
        $horarios = $horarios->get();
        return response()->json($horarios, 200);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        $request->validate([
            "correo" => "required|string",
            "codigo_asignatura" => "required|string",
            "dia_semana" => "required|string",
            "hora_inicio" => "required|date_format:H:i",
            "hora_fin" => "required|date_format:H:i"
        ]);

        try {
            DB::beginTransaction();
            $docenteEnviado = Docente::where("correo", $request->correo)->first();
            $asignaturaEnviado = Asignatura::where("codigo", $request->codigo_asignatura)->first();
            if (!$docenteEnviado || !$asignaturaEnviado) {
                return response()->json(["error" => "Docente o Asignatura no reconocida"], 404);
            }
            $revisionHorario = Horario::where("id_docente", $docenteEnviado->id)->where("dia_semana", $request->dia_semana)->where("hora_inicio", $request->hora_inicio)->first();
            if ($revisionHorario) {
                return response()->json(["error" => "Docente ya posee un horario asignado en el día y hora listada"], 404);
            }
            $horario = new Horario();
            $horario->fill($request->only([
                "dia_semana",
                "hora_inicio",
                "hora_fin"
            ]));
            $horario->id_docente = $docenteEnviado->id;
            $horario->id_asignatura = $asignaturaEnviado->id;
            $horario->save();
            DB::commit();
            return response()->json(["success" => "Se creo el horario con exito"], 200);
        } catch (Exception $e) {
            DB::rollback();
            return response()->json(["error" => $e->getMessage()]);
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Horario $horario)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Horario $horario)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Horario $horario)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request)
    {
        $horario = Horario::find($request->id);
        $horario->delete();

        return response()->json(["success" => "Horario eliminado con éxito"]);
    }
}
