<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\MassDestroyFkilkomRequest;
use App\Http\Requests\StoreFkilkomRequest;
use App\Http\Requests\UpdateFkilkomRequest;
use App\Models\Fkilkom;
use Gate;
use Illuminate\Http\Request;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Symfony\Component\HttpFoundation\Response;

class FkilkomController extends Controller
{
    use MediaUploadingTrait;

    public function index()
    {
        abort_if(Gate::denies('fkilkom_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $fkilkom = Fkilkom::with(['media'])->get();

        return view('admin.fkilkoms.index', compact('fkilkom'));
    }

    public function create()
    {
        abort_if(Gate::denies('fkilkom_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.fkilkoms.create');
    }

    public function store(StoreFkilkomRequest $request)
    {
        $fkilkom = Fkilkom::create($request->all());

        if ($request->input('image', false)) {
            $fkilkom->addMedia(storage_path('tmp/uploads/' . basename($request->input('image'))))->toMediaCollection('image');
        }

        if ($media = $request->input('ck-media', false)) {
            Media::whereIn('id', $media)->update(['model_id' => $fkilkom->id]);
        }

        return redirect()->route('admin.fkilkoms.index');
    }

    public function edit(Fkilkom $fkilkom)
    {
        abort_if(Gate::denies('fkilkom_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.fkilkoms.edit', compact('fkilkom'));
    }

    public function update(UpdateFkilkomRequest $request, Fkilkom $fkilkom)
    {
        $fkilkom->update($request->all());

        if ($request->input('image', false)) {
            if (! $fkilkom->image || $request->input('image') !== $fkilkom->image->file_name) {
                if ($fkilkom->image) {
                    $fkilkom->image->delete();
                }
                $fkilkom->addMedia(storage_path('tmp/uploads/' . basename($request->input('image'))))->toMediaCollection('image');
            }
        } elseif ($fkilkom->image) {
            $fkilkom->image->delete();
        }

        return redirect()->route('admin.fkilkoms.index');
    }

    public function show(Fkilkom $fkilkom)
    {
        abort_if(Gate::denies('fkilkom_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.fkilkoms.show', compact('fkilkom'));
    }

    public function destroy(Fkilkom $fkilkom)
    {
        abort_if(Gate::denies('fkilkom_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $fkilkom->delete();

        return back();
    }

    public function massDestroy(MassDestroyFkilkomtRequest $request)
    {
        $fkilkom = Fkilkom::find(request('ids'));

        foreach ($fkilkom as $fkilkom) {
            $fkilkom->delete();
        }

        return response(null, Response::HTTP_NO_CONTENT);
    }

    public function storeCKEditorImages(Request $request)
    {
        abort_if(Gate::denies('fkilkom_create') && Gate::denies('fkilkom_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $model         = new Fkilkom();
        $model->id     = $request->input('crud_id', 0);
        $model->exists = true;
        $media         = $model->addMediaFromRequest('upload')->toMediaCollection('ck-media');

        return response()->json(['id' => $media->id, 'url' => $media->getUrl()], Response::HTTP_CREATED);
    }
}
