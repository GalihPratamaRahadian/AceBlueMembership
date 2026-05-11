<?php

namespace App\Http\Controllers;

use App\Models\SolarTask;
use App\MyClass\Response;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use User;

class SolarTaskController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()) {
            return SolarTask::dt();
        }

        return view('admin.solar_tasks.index');
    }

    public function indexTechnician(Request $request)
    {
        if ($request->ajax()) {
            return SolarTask::dtTechnician();
        }

        return view('tecnician.solar_task.index');
    }




    public function approve($id)
    {
        $task = SolarTask::findOrFail($id);

        if ((int) auth()->id() !== (int) $task->assigned_to) {
            return response()->json(['success' => false, 'message' => 'Tidak diizinkan.'], 403);
        }

        $task->user_id = auth()->id();
        $task->status = 'in_progress';
        $task->accepted_at = Carbon::now();
        $task->save();

        return response()->json(['success' => true, 'message' => 'Tugas telah disetujui dan sedang dikerjakan.']);
    }

    public function complete($id)
    {
        $task = SolarTask::findOrFail($id);

        if (auth()->id() !== $task->assigned_to) {
            return response()->json(['success' => false, 'message' => 'Tidak diizinkan.'], 403);
        }

        $task->status = 'completed';
        $task->completed_at = now();
        $task->save();

        return response()->json(['success' => true, 'message' => 'Tugas telah diselesaikan.']);
    }


    public function store(Request $request, SolarTask $solarTask)
    {
        DB::beginTransaction();

        try {
            $dataTask = [
                'site_id' => $request->site_id,
                'assigned_by' => auth()->user()->name,
                'assigned_to' => $request->assigned_to,
                'issue_description' => $request->issue_description,
                'status'    =>  'pending',
                'accepted_at' => null,
                'completed_at' => null,
                'technician_notes' => null,
            ];

            $solarTask->createTask($dataTask);

            DB::commit();
            return \Res::save();
        } catch (\Exception $e) {
            DB::rollBack();
            return \Res::error($e);
        }
    }

    public function destroy(SolarTask $solarTask)
    {
        DB::beginTransaction();

        try {
            $solarTask->deleteTask();
            DB::commit();
            return Response::success([
                'success' => 'Data berhasil dihapus'
            ]);
        } catch (\Exception $e) {
            DB::rollBack();
            return \Res::error($e->getMessage());
        }
    }

    public function updateStatus(Request $request, $id)
    {
        $task = SolarTask::findOrFail($id);

        // Pastikan user teknisi dan hanya update tugas sendiri
        if (auth()->id() !== $task->assigned_to) {
            abort(403, 'Tidak diizinkan.');
        }

        $validated = $request->validate([
            'status' => 'required|in:in_progress,completed',
        ]);

        $task->update([
            'status' => $validated['status'],
        ]);

        return response()->json([
            'success' => true,
            'message' => $validated['status'] === 'in_progress'
                ? 'Tugas diterima dan sedang dikerjakan.'
                : 'Tugas selesai dikerjakan.',
        ]);
    }
}
