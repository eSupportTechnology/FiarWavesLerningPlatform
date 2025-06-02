<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Storage;

use App\Models\Course;
use App\Models\CourseFile;
use Illuminate\Http\Request;

class CourseFileController extends Controller
{


    // Show files index
    public function index()
    {
        $courses = Course::all();
        return view('AdminDashboard.courseFiles.index', compact('courses'));
    }

    //show files & Documents
    public function second($courseId)
    {
        $course = Course::with('batches')->findOrFail($courseId);
        $files = CourseFile::where('course_id', $courseId)->get();
        return view('AdminDashboard.courseFiles.second', compact('course', 'files'));
    }

    public function store(Request $request, $courseId)
    {
        $request->validate([
            'file_name' => 'required|string|max:255',
            'files' => 'required',
            'files.*' => 'mimes:pdf,docx,txt',
            'batches' => 'required|array', // ensure batches are passed as array
            'batches.*' => 'exists:batches,id', // validate batch IDs
        ]);

        if ($request->hasFile('files')) {
            foreach ($request->file('files') as $file) {
                $originalName = $file->getClientOriginalName();
                $extension = $file->getClientOriginalExtension();
                $fileName = time() . '_' . $originalName;

                // Upload path like: public/uploads/courses/{id}/files
                $uploadPath = public_path("uploads/courses/{$courseId}/files");

                if (!file_exists($uploadPath)) {
                    mkdir($uploadPath, 0777, true);
                }

                $file->move($uploadPath, $fileName);

                // Save file
                $newFile = CourseFile::create([
                    'course_id'   => $courseId,
                    'file_name'   => $request->file_name,
                    'file_path'   => "uploads/courses/{$courseId}/files/{$fileName}",
                    'file_type'   => $extension,
                ]);

                // Attach file to selected batches
                $newFile->batches()->attach($request->batches);
            }
        }

        return redirect()->route('courseFile.second', $courseId)->with('success', 'Files uploaded and assigned to batches successfully.');
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'file_name' => 'required|string|max:255',
            'batches' => 'nullable|array',
        ]);

        $file = CourseFile::findOrFail($id);
        $file->file_name = $request->file_name;
        $file->save();

        // Sync selected batches
        $file->batches()->sync($request->batches ?? []);

        return back()->with('success', 'File updated successfully.');
    }




    public function destroy($fileId)
    {
        $file = CourseFile::findOrFail($fileId);

        // Check if the file exists in the public directory
        $filePath = public_path($file->file_path);

        if (file_exists($filePath)) {
            unlink($filePath);  // Delete the file from the public directory
        }

        // Delete the file entry from the database
        $file->delete();

        return redirect()->back()->with('success', 'File deleted successfully.');
    }






    
}
