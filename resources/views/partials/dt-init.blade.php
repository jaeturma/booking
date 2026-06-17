@php
  // Defaults (override when including)
  $tableId        = $tableId        ?? 'dataTable';
  $orderCol       = $orderCol       ?? 0;          // index to sort (desc)
  $pageLength     = $pageLength     ?? 10;
  $noOrderTargets = $noOrderTargets ?? [-1];       // disable order on last col (actions)
@endphp

<script>
document.addEventListener('DOMContentLoaded', function () {
  if (!window.jQuery || !($.fn && $.fn.DataTable)) {
    console.error('DataTables missing — check public/vendor paths.');
    return;
  }

  // Bootstrap 5 sample layout:
  // top: length (left) + filter/search (right)
  // middle: table
  // bottom: info (left) + pagination (right)
  const dt = new $.fn.dataTable.Api($('#{{ $tableId }}').DataTable({
    dom:
      "<'row'<'col-sm-12 col-md-6'l><'col-sm-12 col-md-6'f>>" +
      "rt" +
      "<'row'<'col-sm-12 col-md-5'i><'col-sm-12 col-md-7'p>>",
    pageLength: {{ $pageLength }},
    lengthMenu: [[10,25,50,-1],[10,25,50,'All']],
    order: [[{{ $orderCol }}, 'desc']],
    responsive: true,
    deferRender: true,
    stateSave: true,
    orderClasses: false,
    columnDefs: [{ targets: {!! json_encode($noOrderTargets) !!}, orderable: false }]
    // note: no language overrides, no autofocus
  }));

  // expose if you need to access it elsewhere
  window.__dt = window.__dt || {};
  window.__dt['{{ $tableId }}'] = dt;
});
</script>
