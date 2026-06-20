<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Log;
use Illuminate\Http\File;
use Illuminate\Http\Response;
use App\Helpers\LogActivity;

class BackupController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware(function ($request, $next) {
            if (!Gate::allows('admin')) {
                abort(403);
            }
            return $next($request);
        });
    }

    /**
     * Show backup form with last backup info.
     */
    public function index()
    {
        // List existing backups in storage/backups directory
        $backups = collect([]);
        if (Storage::disk('local')->exists('backups')) {
            $files = Storage::disk('local')->files('backups');
            foreach ($files as $file) {
                $lastModified = Storage::disk('local')->lastModified($file);
                $size = Storage::disk('local')->size($file);
                $backups->push([
                    'name' => basename($file),
                    'path' => $file,
                    'modified' => $lastModified,
                    'size' => $size,
                ]);
            }
            // Sort by modified descending
            $backups = $backups->sortByDesc('modified');
        }

        return view('backup.index', compact('backups'));
    }

    /**
     * Create a new database backup.
     */
    public function store(Request $request)
    {
        try {
            // Run db:dump command
            $exitCode = Artisan::call('db:dump', [
                '--destination' => storage_path('app/backups/database_' . now()->format('Y-m-d_H-i-s') . '.sql')
            ]);

            if ($exitCode === 0) {
                \App\Helpers\LogActivity::addToLog('Database backup created successfully.');
                return redirect()->back()->with('success', 'Cadangan database berhasil dibuat.');
            } else {
                throw new \Exception('Artisan command failed with exit code: '.$exitCode);
            }
        } catch (\Throwable $e) {
            Log::error('Backup error: '.$e->getMessage());
            \App\Helpers\LogActivity::addToLog('Database backup gagal: '.$e->getMessage());
            return redirect()->back()->with('error', 'Gagal membuat cadangan database: '.$e->getMessage());
        }
    }

    /**
     * Download the specified backup.
     */
    public function download($filename)
    {
        $path = 'backups/'.$filename;
        if (!Storage::disk('local')->exists($path)) {
            abort(404);
        }

        return Storage::disk('local')->download($path, $filename, [
            'Content-Type' => 'application/sql',
        ]);
    }

    /**
     * Delete the specified backup.
     */
    public function destroy($filename)
    {
        $path = 'backups/'.$filename;
        if (!Storage::disk('local')->exists($path)) {
            abort(404);
        }

        Storage::disk('local')->delete($path);

        \App\Helpers\LogActivity::addToLog('Database backup deleted: '.$filename);
        return redirect()->back()->with('success', 'Cadangan database berhasil dihapus.');
    }
}