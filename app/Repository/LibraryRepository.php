<?php


namespace App\Repository;

use App\Grade;
use App\Library;

use App\Repository\LibraryRepositoryInterface;

class LibraryRepository implements LibraryRepositoryInterface
{
    public function index()
    {
        $books = Library::all();
        return view('pages.library.index', compact('books'));
    }

    public function create()
    {
        $grades = Grade::all();
        return view('pages.library.create', compact('grades'));
    }

    public function store($request)
    {
        try {

            $library = new Library();
            $library->title = $request->title;
            $library->file_name =  $request->file('file_name')->getClientOriginalName();
            $library->grade_id = $request->Grade_id;
            $library->classroom_id = $request->Classroom_id;
            $library->section_id = $request->section_id;
            $library->teacher_id = 1;
            $library->save();

            $file = $request->file('file_name');
            $name = $request->file('file_name')->getClientOriginalName();
            $path =   public_path('attachments/library/' . $library->title);
            if (!file_exists($path)) {
                mkdir($path, 0777, true);
            }
            $file->move($path, $name);

            toastr()->success(trans('messages.success'));
            return redirect()->route('library.create');
        } catch (\Exception $e) {
            return redirect()->back()->with(['error' => $e->getMessage()]);
        }
    }

    public function edit($id)
    {
        $grades = Grade::all();
        $book = library::findorFail($id);
        return view('pages.library.edit', compact('book', 'grades'));
    }

    public function update($request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'Grade_id' => 'required|integer',
            'Classroom_id' => 'required|integer',
            'section_id' => 'required|integer',
            'file_name' => 'nullable|file|mimes:pdf|max:2048'
        ]);
        try {

            $library = library::findorFail($request->id);
            $library->title = $request->title;

            if ($request->hasfile('file_name')) {


                $filePath = public_path('\attachments/library/' . $library->title . '/' . $library->file_name);
                if (file_exists($filePath)) {
                    unlink($filePath);
                }

                $file = $request->file('file_name');
                $name = $request->file('file_name')->getClientOriginalName();
                $path =   public_path('attachments/library/' . $library->title);
                if (!file_exists($path)) {
                    mkdir($path, 0777, true);
                }
                $file->move($path, $name);

                $file_name_new = $request->file('file_name')->getClientOriginalName();
                $library->file_name = $library->file_name !== $file_name_new ? $file_name_new : $library->file_name;
            }

            $library->grade_id = $request->Grade_id;
            $library->classroom_id = $request->Classroom_id;
            $library->section_id = $request->section_id;
            $library->teacher_id = 1;
            $library->save();
            toastr()->success(trans('messages.Update'));
            return redirect()->route('library.index');
        } catch (\Exception $e) {
            return redirect()->back()->with(['error' => $e->getMessage()]);
        }
    }

    public function destroy($request)
    {

        library::destroy($request->id);
        toastr()->error(trans('messages.Delete'));
        return redirect()->route('library.index');
    }

    public function download($filename)
    {
        return response()->download(public_path('attachments/library/' . $filename));
    }
}
