{{ $project->title }}
<!--{{ $project->description }}-->

<?php foreach ($project->section_tree() as $section): ?>

<?php if ($section['completed'] && !$section['deleted']): ?><?= html_entity_decode($section->title); ?>

<?php if (strlen($section->description)): ?><?php echo html_entity_decode(strip_tags($section->description)); ?><?php endif; ?>

@if (count($section->children)) @foreach ($section->children as $s) @if ($s->completed && !$s->deleted)

<?= html_entity_decode($s->title); ?>

<?php if (strlen($s->description)): ?><?php echo html_entity_decode(strip_tags($s->description)); ?><?php endif; ?>

@if (count($s->children)) @foreach ($s->children as $chch) @if ($chch->completed && !$chch->deleted)

<?= html_entity_decode($chch->title); ?>

<?php if (strlen($chch->description)): ?><?php echo html_entity_decode(strip_tags($chch->description)); ?><?php endif; ?>

@endif @endforeach @endif @endif @endforeach @endif <?php endif; ?> <?php endforeach; ?>
