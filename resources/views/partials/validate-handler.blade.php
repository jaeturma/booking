<script>
document.addEventListener('DOMContentLoaded', function () {
  if (!window.Swal) { console.error('SweetAlert2 missing'); return; }

  // Delegated click (works after DataTables redraw)
  $(document).on('click', '.js-validate', async function (e) {
    const btn    = e.currentTarget;
    const action = btn.dataset.action;
    const code   = btn.dataset.code;
    const token  = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

    const result = await Swal.fire({
      title: "Save the changes?",
      text: `Validation of Booking NO. ${code}`,
      showDenyButton: false,
      showCancelButton: true,
      confirmButtonText: "Save",
      denyButtonText: false
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

      // Reload the DataTable to reflect the updated status
      const tableEl = btn.closest('table');
      const tableId = tableEl ? tableEl.id : null;
      const dt = window.__dt && tableId && window.__dt[tableId];
      if (dt) {
        dt.ajax.reload(null, false);
      } else {
        // fallback: remove row from DOM for client-side tables
        const rowSel = btn.dataset.row;
        const rowEl = rowSel ? document.querySelector(rowSel) : null;
        if (rowEl) rowEl.remove();
      }
    } catch (err) {
      Swal.fire("Error", err.message || "Validation failed", "error");
    }
  });
});
</script>
