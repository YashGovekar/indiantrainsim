<?php

namespace App\Services;

use App\Models\File;
use App\Models\Report;
use App\Models\UserDownload;
use App\Repositories\FileRepository;
use Exception;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Symfony\Component\HttpFoundation\StreamedResponse;

class FileService
{
    private $fileRepo;

    /**
     * FileService constructor.
     * @param $fileRepo
     */
    public function __construct(FileRepository $fileRepo)
    {
        $this->fileRepo = $fileRepo;
    }

    public function getAll($approved = null)
    {
        $files = $this->fileRepo->getAll();
        if ($approved) {
            return $files->where('approved', $approved);
        }
        return $files;
    }

    public function upload(UploadedFile $file, string $path, string $name)
    {
        $user = Auth::user();

        return Storage::putFileAs(
            $path,
            $file,
            str_replace(' ', '_', $name).'_By_'.$user->username.'.'.$file->getClientOriginalExtension()
        );
    }

    public function uploadFile(UploadedFile $file, string $name): array
    {
        $data = [];

        $path = $this->upload($file, 'files', $name);

        $data['path'] = $path;
        $data['size'] = Storage::size($path);

        return $data;
    }

    public function uploadPublicly(UploadedFile $file, string $path, string $name)
    {
        return $this->upload($file, 'public/'.$path, $name);
    }

    public function store(array $data, array $file_info): bool
    {
        try {
            unset($data['file']);
            unset($data['image_file']);

            $file = File::where($data);
            if ($file->exists()) {
                $this->delete([$data['path'], $data['image']]);
                return false;
            }

            $data = array_merge($data, $file_info);
            $data['user_id'] = Auth::id();

            $this->fileRepo->create($data);
            return true;
        } catch (Exception $e) {
            $this->delete([$data['path'], $data['image']]);
            Log::error($e->getMessage());
            return false;
        }
    }

    public function destroy($id): bool
    {
        $file = $this->fileRepo->find($id);
        if ($this->delete([$file->path, $file->image])) {
            try {
                $file->delete();
                return true;
            } catch (Exception $e) {
                Log::error($e->getMessage());
                return false;
            }
        }
        return false;
    }

    public function delete(array $files): bool
    {
        try {
            Storage::delete($files);
            return true;
        } catch (Exception $e) {
            Log::error($e->getMessage());
            return false;
        }
    }

    public function get($id): File
    {
        return $this->fileRepo->find($id);
    }

    public function update($id, $data): void
    {
        $update = $this->get($id)->update($data);
        if ($update) {
            flash('Edited Successfully')->success();
        } else {
            flash('Error!')->error();
        }
    }

    public function download($id): StreamedResponse
    {
        $file = $this->get($id);
        UserDownload::updateOrCreate(
            [
                'user_id' => Auth::id(),
                'file_id' => $id,
            ],
            []
        )->increment('times_downloaded');
        $file->increment('downloads_count');
        return Storage::download($file->path);
    }

    public function getTotalDownloads(): int
    {
        $total_downloads = 0;
        foreach ($this->getAll() as $file) {
            $total_downloads += (int) $file->downloads_count;
        }
        return $total_downloads;
    }

    public function report(int $id)
    {
        Report::updateOrCreate(
            [
                'user_id' => Auth::id(),
                'file_id' => $id,
            ],
            []
        );
    }

    public function hotFiles()
    {
        return $this->getAll()->sortByDesc('downloads_count');
    }
}
