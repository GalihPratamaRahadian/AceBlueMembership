<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Yajra\DataTables\Contracts\DataTable;
use Yajra\DataTables\DataTables;

class SolarTask extends Model
{
    use HasFactory;

    protected $fillable = [
        'site_id',
        'assigned_by',
        'assigned_to',
        'issue_description',
        'status',
        'accepted_at',
        'completed_at',
        'technician_notes',
    ];

    const STATUS_PENDING = 'pending';
    const STATUS_IN_PROGRESS = 'in_progress';
    const STATUS_COMPLETED = 'completed';

    public function solarSite()
    {
        return $this->belongsTo(SolarSite::class, 'site_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function customer()
    {
        return $this->belongsTo(Customer::class, 'customer_id');
    }

    public function assignedTo()
    {
        return $this->belongsTo(User::class, 'assigned_to');
    }

    public function assignedBy()
    {
        return $this->belongsTo(User::class, 'assigned_by');
    }


    public function createTask($dataTask)
    {
        $siteId = $dataTask['site_id'];
        $customerId = $dataTask['customer_id'];
        $assigned_by = $dataTask['assigned_by'];
        $assigned_to = $dataTask['assigned_to'];
        $issue_description = $dataTask['issue_description'];
        $status = $dataTask['status'];
        $accepted_at = $dataTask['accepted_at'];
        $completed_at = $dataTask['completed_at'];
        $technician_notes = $dataTask['technician_notes'];

        if(!empty($customerId)){
            return self::create([
                'customer_id' => $customerId,
            ]);
        }

        $solarTask = self::create([
            'site_id' => $siteId,
            'assigned_by' => $assigned_by,
            'assigned_to' => $assigned_to,
            'issue_description' => $issue_description,
            'status' => $status,
            'accepted_at' => $accepted_at,
            'completed_at' => $completed_at,
            'technician_notes' => $technician_notes
        ]);

        return $solarTask;
    }

    public function deleteTask()
    {
        $this->delete();
    }

    public function getStatustoCustomer()
    {
        $status = $this->status;

        if ($status === self::STATUS_PENDING) {
            return '<span class="badge bg-warning">Pending</span>';
        }elseif($status === self::STATUS_IN_PROGRESS){
            return '<span class="badge bg-info">In Progress</span>';
        }elseif($status === self::STATUS_COMPLETED){
            return '<span class="badge bg-success">Completed</span>';
        }else{
            return '<span class="badge bg-secondary">' . e($status) . '</span>';
        }
    }

    public static function dt()
    {
        $data = self::with(['solarSite', 'assignedTo', 'assignedBy'])
            ->orderBy('solar_tasks.created_at', 'desc');

        return \DataTables::eloquent($data)
            ->addColumn('site_id', function ($task) {
                return $task->solarSite ? $task->solarSite->name : '-';
            })
            ->addColumn('assigned_to', function ($task) {
                return $task->assignedTo ? $task->assignedTo->name : '-';
            })
            ->addColumn('assigned_by', function ($task) {
                return $task->assignedBy ? $task->assignedBy->name : '-';
            })
            ->addColumn('action', function ($task) {
                return '
                    <div class="btn-group">
                        <button type="button" class="btn btn-outline-primary btn-round dropdown-toggle" data-toggle="dropdown">
                            Aksi
                        </button>
                        <div class="dropdown-menu">
                            <li>
                                <a class="dropdown-item delete text-danger" href="javascript:void(0);"
                                data-delete-message="Yakin ingin menghapus?"
                                data-delete-href="' . route('admin.solar_tasks.destroy', $task->id) . '">
                                    <i class="fa fa-trash mr-2"></i> Hapus
                                </a>
                            </li>
                        </div>
                    </div>';
            })
            ->editColumn('status', function ($task) {
                return match ($task->status) {
                    'pending' => '<span class="badge bg-warning">Pending</span>',
                    'in_progress' => '<span class="badge bg-info">In Progress</span>',
                    'completed' => '<span class="badge bg-success">Completed</span>',
                    default => '<span class="badge bg-secondary">' . e($task->status) . '</span>',
                };
            })
            ->editColumn('updated_at', function ($task) {
                return $task->updated_at->format('d M Y');
            })
            ->rawColumns(['action', 'status', 'updated_at'])
            ->make(true);
    }

    public static function dtTechnician()
    {
        $data = self::with(['solarSite', 'assignedTo', 'assignedBy'])
            ->where('assigned_to', auth()->id())
            ->orderBy('solar_tasks.created_at', 'desc');

        return \DataTables::eloquent($data)
            ->addColumn('site_id', function ($task) {
                return $task->solarSite ? $task->solarSite->name : '-';
            })
            ->addColumn('action', function ($task) {
                $approveBtn = '';
                $completeBtn = '';

                if ($task->status === 'pending') {
                    $approveBtn = '<button class="btn btn-success btn-sm approve-btn" data-id="' . $task->id . '">
                            <i class="fa fa-check"></i> Approve
                        </button>';
                }

                if ($task->status === 'in_progress') {
                    $completeBtn = '<button class="btn btn-primary btn-sm complete-btn" data-id="' . $task->id . '">
                            <i class="fa fa-flag-checkered"></i> Complete
                        </button>';
                }

                return $approveBtn . ' ' . $completeBtn;
            })

            ->editColumn('status', function ($task) {
                return match ($task->status) {
                    'pending' => '<span class="badge bg-warning">Pending</span>',
                    'in_progress' => '<span class="badge bg-info">In Progress</span>',
                    'completed' => '<span class="badge bg-success">Completed</span>',
                    default => '<span class="badge bg-secondary">' . e($task->status) . '</span>',
                };
            })
            ->rawColumns(['action', 'status'])
            ->make(true);
    }

    public static function dtCustomer()
    {
        $data = self::with('solarSite')
            ->whereHas('solarSite', function ($q) {
                $q->where('user_id', auth()->id());
            })
            ->select('solar_tasks.*')
            ->orderBy('solar_tasks.updated_at', 'desc');

        return \DataTables::eloquent($data)
            ->editColumn('status', function ($task) {
                return $task->getStatustoCustomer();
            })

            ->addColumn('last_update', function ($task) {
                return optional($task->updated_at)->format('d M Y H:i');
            })

            ->rawColumns(['status'])
            ->make(true);
    }

}
