@if ($project->id && $project->is_owner())
<div class="panel panel-default">
    <div class="panel-heading">Tip: Exporting</div>
    <div class="panel-body">
        <p>When your project is completed, you can preview the app by clicking on the Preview App button below. Only sections marked as completed will be in the export. When you're ready to upload the app to the app store, click on the Create App button.</p>

        @if ($project->id)
            <p><a href="/account/project/export/{{ $project->id }}" class="btn btn-lg btn-primary btn-icon" style="width: 100%;" target="_blank"><span class="fa fa-eye"></span> Preview App</a></p>
            <p><a href="/account/project/export_text/{{ $project->id }}" class="btn btn-lg btn-primary btn-icon" style="width: 100%;" target="_blank"><span class="fa fa-file-text"></span> Download Text Export</a></p>
			<p><a href="/account/project/zip/{{ $project->id }}" class="btn btn-lg btn-primary btn-icon" style="width: 100%;" target="_blank"><span class="fa fa-html5"></span> Download HTML Export</a></p>
			<p><a href="/account/project/build/index/{{ $project->id }}" class="btn btn-lg btn-primary btn-icon" style="width: 100%;"><span class="fa fa-download"></span> Create App</a></p>
        @endif
    </div>
</div>
@endif
