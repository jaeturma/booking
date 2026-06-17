import $ from 'jquery';
import 'datatables.net';
import 'datatables.net-responsive';
import 'datatables.net-dt/css/dataTables.dataTables.css';
import 'datatables.net-responsive-dt/css/responsive.dataTables.css';
import Swal from 'sweetalert2';

document.addEventListener('DOMContentLoaded', () => {
  // Compact + gridlines tweak
  const css = `
    table.dataTable.compact thead th, table.dataTable.compact tbody td { padding:.35rem .5rem; }
    .dataTables_filter input { width:260px; font-size:14px; padding:8px 10px; }
    #bookingsTable { border-collapse:collapse; border:1px solid #d1d5db; }
    #bookingsTable th, #bookingsTable td { border:1px solid #d1d5db; }
    table.dataTable thead th { background:#f9fafb; border-bottom:2px solid #cbd5e1 !important; }
    table.dataTable tbody tr:hover { background:#f8fafc; }
  `;
  const style = document.createElement('style'); style.textContent = css; document.head.appendChild(style);

  const $tbl = $('#bookingsTable');
  if (!$tbl.length) return;

  const dt = $tbl.DataTable({
    dom: 'frtip',
    pageLength: 10,
    order: [[4, 'desc']],       // Created column
    responsive: true,
    deferRender: true,
    stateSave: true,
    orderClasses: false,
    columnDefs: [{ targets: -1, orderable: false }],
    initComplete: focusSearch
  });

  function focusSearch() {
    const input = document.querySelector('.dataTables_filter input');
    if (input) setTimeout(() => { input.focus(); input.select(); }, 0);
  }
  dt.on('page.dt draw.dt', focusSearch);

  // Delegated click handler for Validate
  $(document).on('click', '.js-validate', async function (e) {
    const btn    = e.currentTarget;
    const action = btn.dataset.action;
    const rowSel = btn.dataset.row;
    const code   = btn.dataset.code;
    const token  = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

    const result = await Swal.fire({
      title: "Do you want to save the changes?",
      text: `Validate booking ${code}?`,
      showDenyButton: true,
      showCancelButton: true,
      confirmButtonText: "Save",
      denyButtonText: `Don't save`
    });
    if (!result.isConfirmed) {
      if (result.isDenied) Swal.fire("Changes are not saved", "", "info");
      return;
    }

    try {
      const res = await fetch(action, {
        method: 'POST',
        headers: { 'X-CSRF-TOKEN': token, 'Accept':'application/json' },
        credentials: 'same-origin'
      });
      if (!res.ok) {
        const data = await res.json().catch(() => ({}));
        throw new Error(data.message || 'Validation failed');
      }
      await Swal.fire("Saved!", "", "success");
      const rowEl = document.querySelector(rowSel);
      if (rowEl) dt.row(rowEl).remove().draw(false);
    } catch (err) {
      Swal.fire("Error", err.message || "Validation failed", "error");
    }
  });
});
