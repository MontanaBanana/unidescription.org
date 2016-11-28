{{ $project->title }}
{{ $project->description }}

<?php foreach ($project->section_tree() as $section): ?>

<?php if ($section['completed'] && !$section['deleted']): ?>{{ $section->title }} 

<?php if (strlen($section->description)): ?><?php echo strip_tags($section->description); ?><?php endif; ?>

@if (count($section->children)) @foreach ($section->children as $s) @if ($s->completed && !$s->deleted)

{{ $s->title }}

<?php if (strlen($s->description)): ?><?php echo strip_tags($s->description); ?><?php endif; ?>

@if (count($s->children)) @foreach ($s->children as $chch) @if ($chch->completed && !$chch->deleted)

{{ $chch->title }}

<?php if (strlen($chch->description)): ?><?php echo strip_tags($chch->description); ?><?php endif; ?>

@endif @endforeach @endif @endif @endforeach @endif <?php endif; ?> <?php endforeach; ?>
