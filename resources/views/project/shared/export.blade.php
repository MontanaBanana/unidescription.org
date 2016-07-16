@if ($project->id)
<div class="panel panel-default">
    <div class="panel-heading">Tip: Exporting</div>
    <div class="panel-body">
        <p>When your project is completed, you can preview the app by clicking on the Preview App button below. When you're ready to upload the app to the app store, click on the Create App button.</p>

        @if ($project->id)
            <p><a href="/account/project/export/{{ $project->id }}" class="btn btn-lg btn-primary btn-icon" target="_blank"><span class="fa fa-download"></span> Preview App</a></p>
            <p><a href="/account/project/build/index/{{ $project->id }}" class="btn btn-lg btn-primary btn-icon"><span class="fa fa-download"></span> Create App</a></p>
        @endif
    </div>
</div>
@endif