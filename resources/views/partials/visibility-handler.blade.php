<script>
document.addEventListener('DOMContentLoaded', function () {
  const token = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

  async function postAndUpdate(action, rowSel, desiredHidden) {
    const res = await fetch(action, {
      method: 'POST',
      headers: { 'X-CSRF-TOKEN': token, 'Accept': 'application/json' },
      credentials: 'same-origin'
    });
    if (!res.ok) {
      const data = await res.json().catch(() => ({}));
      throw new Error(data.message || 'Request failed');
    }

    // Update the row UI for admin
    const row = document.querySelector(rowSel);
    if (!row) return;

    // Toggle "Hidden" badge in Status column
    const statusCell = row.querySelector('td:nth-child(6)'); // adjust if columns change
    if (statusCell) {
      const badge = statusCell.querySelector('.badge.text-bg-secondary');
      if (desiredHidden) {
        if (!badge) {
          const span = document.createElement('span');
          span.className = 'badge text-bg-secondary ms-1';
          span.textContent = 'Hidden';
          statusCell.appendChild(span);
        }
      } else {
        if (badge) badge.remove();
      }
    }

    // Toggle row tint
    row.classList.toggle('table-secondary', desiredHidden);

    // Swap action buttons
    const actionCell = row.lastElementChild;
    if (actionCell) {
      const hideBtn   = actionCell.querySelector('.js-hide');
      const unhideBtn = actionCell.querySelector('.js-unhide');
      if (desiredHidden && hideBtn) {
        hideBtn.outerHTML = `<button class="js-unhide btn btn-outline-secondary btn-sm me-1"
                                  data-action="${action}"
                                  data-row="${rowSel}">Unhide</button>`;
      } else if (!desiredHidden && unhideBtn) {
        unhideBtn.outerHTML = `<button class="js-hide btn btn-outline-secondary btn-sm me-1"
                                   data-action="${action.replace('/unhide','/hide')}"
                                   data-row="${rowSel}">Hide</button>`;
      }
    }
  }

  // Delegated handlers
  $(document).on('click', '.js-hide', async function (e) {
    const btn    = e.currentTarget;
    const action = btn.dataset.action;
    const rowSel = btn.dataset.row;
    try {
      const result = await Swal.fire({
        title: "Hide this booking?",
        text: "Hidden bookings are invisible to office users.",
        showCancelButton: true,
        confirmButtonText: "Hide",
        icon: "warning"
      });
      if (!result.isConfirmed) return;

      await postAndUpdate(action, rowSel, true);
      await Swal.fire("Hidden", "", "success");
    } catch (err) {
      Swal.fire("Error", err.message || "Hide failed", "error");
    }
  });

  $(document).on('click', '.js-unhide', async function (e) {
    const btn    = e.currentTarget;
    const action = btn.dataset.action;
    const rowSel = btn.dataset.row;
    try {
      const result = await Swal.fire({
        title: "Unhide this booking?",
        showCancelButton: true,
        confirmButtonText: "Unhide"
      });
      if (!result.isConfirmed) return;

      await postAndUpdate(action, rowSel, false);
      await Swal.fire("Visible", "", "success");
    } catch (err) {
      Swal.fire("Error", err.message || "Unhide failed", "error");
    }
  });
});
</script>
