@if ($project->id)
<div class="panel panel-default hidden-xs hidden-sm">
    <div class="panel-heading">Tip: Exporting</div>
    <div class="panel-body">
        <p>When your project is completed, you can preview the app by clicking on the Preview App button below. Only sections marked as completed will be in the export. When you're ready to upload the app to the app store, click on the Create App button.</p>

        @if ($project->id)
          <ul style="list-style: none; padding-left: 0;">
            <strong>Active components: {{ $project->active_components() }}<br />
            Inactive components: {{ $project->inactive_components() }}<br /></strong>
            <li><a href="/account/project/export/{{ $project->id }}" class="btn btn-lg btn-primary btn-icon" style="width: 100%;" target="_blank" title="{{ $project->active_components() }} / {{ $project->active_components() + $project->inactive_components() }} components are completed and will display"><span class="fa fa-eye"></span> Preview App ({{ $project->active_components() }} / {{ $project->active_components() + $project->inactive_components() }} ACTIVE)</a></li>
            <li><a href="/account/project/export_text/{{ $project->id }}" class="btn btn-lg btn-primary btn-icon" style="width: 100%;" target="_blank"><span class="fa fa-file-text"></span> Download Text Export</a></li>
            <li><a href="/account/project/export_audio/{{ $project->id }}" class="btn btn-lg btn-primary btn-icon" style="width: 100%;" target="_blank"><span class="fa fa-headphones"></span> Download Audio Only</a></li>
			<li><a href="/account/project/zip/{{ $project->id }}" class="btn btn-lg btn-primary btn-icon" style="width: 100%;" target="_blank"><span class="fa fa-html5"></span> Download HTML Export</a></li>
			<li><a href="/account/project/build/index/{{ $project->id }}" class="btn btn-lg btn-primary btn-icon" style="width: 100%;"><span class="fa fa-download"></span> Create App</a></li>
            <br>
            @if ($project->api_hits)
                <strong>In-app views: {{ $project->api_hits }}</strong>
            @endif
          </ul>
        @endif
    </div>
</div>
@endif
