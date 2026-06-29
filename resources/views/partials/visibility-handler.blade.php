<script>
document.addEventListener('DOMContentLoaded', function () {
  const token = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

  async function postAndReload(btn, action) {
    const res = await fetch(action, {
      method: 'POST',
      headers: { 'X-CSRF-TOKEN': token, 'Accept': 'application/json' },
      credentials: 'same-origin'
    });
    if (!res.ok) {
      const data = await res.json().catch(() => ({}));
      throw new Error(data.message || 'Request failed');
    }

    const tableEl = btn.closest('table');
    const tableId = tableEl ? tableEl.id : null;
    const dt = window.__dt && tableId && window.__dt[tableId];
    if (dt) dt.ajax.reload(null, false);
  }

  // Delegated handlers
  $(document).on('click', '.js-hide', async function (e) {
    const btn    = e.currentTarget;
    const action = btn.dataset.action;
    try {
      const result = await Swal.fire({
        title: "Hide this booking?",
        text: "Hidden bookings are invisible to office users.",
        showCancelButton: true,
        confirmButtonText: "Hide",
        icon: "warning"
      });
      if (!result.isConfirmed) return;

      await postAndReload(btn, action);
      await Swal.fire("Hidden", "", "success");
    } catch (err) {
      Swal.fire("Error", err.message || "Hide failed", "error");
    }
  });

  $(document).on('click', '.js-unhide', async function (e) {
    const btn    = e.currentTarget;
    const action = btn.dataset.action;
    try {
      const result = await Swal.fire({
        title: "Unhide this booking?",
        showCancelButton: true,
        confirmButtonText: "Unhide"
      });
      if (!result.isConfirmed) return;

      await postAndReload(btn, action);
      await Swal.fire("Visible", "", "success");
    } catch (err) {
      Swal.fire("Error", err.message || "Unhide failed", "error");
    }
  });
});
</script>
