@php
  $tableId        = $tableId        ?? 'dataTable';
  $orderCol       = $orderCol       ?? 0;
  $pageLength     = $pageLength     ?? 10;
  $noOrderTargets = $noOrderTargets ?? [-1];
  $ajaxUrl        = $ajaxUrl        ?? null;
  $columns        = $columns        ?? null;
  $placeholder    = $placeholder    ?? null;
  $dom            = $dom            ?? "<'row'<'col-sm-12 col-md-6'l><'col-sm-12 col-md-6'f>>rt<'row'<'col-sm-12 col-md-5'i><'col-sm-12 col-md-7'p>>";
@endphp

<script>
document.addEventListener('DOMContentLoaded', function () {
  if (!window.jQuery || !($.fn && $.fn.DataTable)) {
    console.error('DataTables missing — check public/vendor paths.');
    return;
  }

  const config = {
    dom: {!! json_encode($dom) !!},
    pageLength: {{ $pageLength }},
    lengthMenu: [[10,25,50,-1],[10,25,50,'All']],
    order: [[{{ $orderCol }}, 'desc']],
    responsive: true,
    stateSave: true,
    orderClasses: false,
    columnDefs: [{ targets: {!! json_encode($noOrderTargets) !!}, orderable: false }]
  };

@if($ajaxUrl)
  Object.assign(config, {
    processing: true,
    serverSide: true,
    deferRender: false,
    ajax: '{{ $ajaxUrl }}',
@if($columns)
    columns: {!! json_encode($columns) !!}
@endif
  });
@else
  config.deferRender = true;
@endif

  const dt = new $.fn.dataTable.Api($('#{{ $tableId }}').DataTable(config));

  window.__dt = window.__dt || {};
  window.__dt['{{ $tableId }}'] = dt;
});
</script>
