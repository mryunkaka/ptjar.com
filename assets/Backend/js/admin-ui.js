(function () {
  'use strict';

  function enhanceScrollableTables(root) {
    if (!root || !root.querySelectorAll) return;

    root.querySelectorAll('.table-responsive').forEach(function (region) {
      if (!region.closest('.admin-content') || !region.querySelector('table')) return;
      if (!region.hasAttribute('role')) region.setAttribute('role', 'region');
      if (!region.hasAttribute('tabindex')) region.setAttribute('tabindex', '0');
      if (!region.hasAttribute('aria-label')) {
        region.setAttribute('aria-label', 'Tabel data dengan scroll horizontal');
      }
    });
  }

  enhanceScrollableTables(document);
  document.querySelectorAll('#messages [data-auto-dismiss]').forEach(function (alert) {
    var delay = parseInt(alert.getAttribute('data-auto-dismiss'), 10) || 10000;
    window.setTimeout(function () {
      if (!document.documentElement.contains(alert)) return;
      if (window.bootstrap && bootstrap.Alert) {
        bootstrap.Alert.getOrCreateInstance(alert).close();
      } else {
        alert.remove();
      }
    }, delay);
  });

  var importForm = document.getElementById('importNewsForm');
  if (importForm) {
    importForm.addEventListener('submit', async function (event) {
      var submitter = event.submitter;
      if (!submitter || submitter.name !== 'import_scope' || submitter.value !== 'all') return;

      event.preventDefault();
      if (!window.confirm('Tarik semua berita yang tersedia dari Jhonlin Magazine? Proses berjalan bertahap dan dapat memerlukan waktu.')) return;

      var progress = document.getElementById('importProgress');
      var buttons = importForm.querySelectorAll('button[type="submit"]');
      var page = 1;
      var token = importForm.querySelector('input[type="hidden"]');
      var imported = 0;
      var duplicates = 0;
      var failed = 0;
      buttons.forEach(function (button) { button.disabled = true; });
      progress.innerHTML = '<div class="alert alert-info mb-0" role="status">Menyiapkan penarikan seluruh arsip…</div>';

      try {
        while (true) {
          var body = new FormData(importForm);
          body.delete('import_scope');
          body.set('page', String(page));
          var response = await fetch(importForm.getAttribute('data-batch-url'), {
            method: 'POST',
            body: body,
            credentials: 'same-origin',
            headers: { 'X-Requested-With': 'XMLHttpRequest' }
          });
          var result;
          try {
            result = await response.json();
          } catch (_parseError) {
            throw new Error('Server tidak memberikan respons yang valid. Coba mulai ulang penarikan.');
          }
          if (!response.ok || !result.ok) {
            throw new Error((result.partial ? 'Sebagian berita sudah tersimpan. ' : '') + (result.error || 'Batch impor gagal.'));
          }

          if (token && result.csrf_hash) token.value = result.csrf_hash;
          if (typeof result.imported === 'number') imported = result.imported;
          if (typeof result.duplicates === 'number') duplicates = result.duplicates;
          if (typeof result.failed === 'number') failed = result.failed;
          if (result.done) {
            progress.innerHTML = '<div class="alert alert-success mb-0" role="status">Penarikan arsip selesai. Halaman akan diperbarui…</div>';
            window.location.reload();
            return;
          }

          var pageLabel = result.total_pages > 0 ? page + ' dari ' + result.total_pages : String(page);
          progress.innerHTML = '<div class="alert alert-info mb-0" role="status">Memproses batch ' + pageLabel + '. ' + imported + ' draft baru, ' + duplicates + ' duplikat dilewati, ' + failed + ' gagal.</div>';
          page++;
        }
      } catch (error) {
        var warning = document.createElement('div');
        warning.className = 'alert alert-warning mb-0';
        warning.setAttribute('role', 'alert');
        warning.textContent = error.message + ' Berita yang sudah berhasil diproses tetap tersimpan; Anda dapat mulai ulang untuk melanjutkan, berita duplikat akan dilewati.';
        progress.replaceChildren(warning);
        buttons.forEach(function (button) { button.disabled = false; });
      }
    });
  }

  document.addEventListener('shown.bs.modal', function (event) {
    enhanceScrollableTables(event.target);
  });

  var sidebar = document.querySelector('[data-admin-sidebar]');
  if (!sidebar) return;

  var storageKey = 'ptjar.admin.sidebar.scrollTop';
  var activeLink = sidebar.querySelector('[data-admin-link][aria-current="page"]');

  function saveSidebarPosition() {
    try {
      window.sessionStorage.setItem(storageKey, String(sidebar.scrollTop));
    } catch (_error) {
      // Navigation should continue normally when storage is unavailable.
    }
  }

  function revealActiveLink() {
    if (!activeLink) return;

    var sidebarBounds = sidebar.getBoundingClientRect();
    var linkBounds = activeLink.getBoundingClientRect();
    if (linkBounds.top < sidebarBounds.top) {
      sidebar.scrollTop -= sidebarBounds.top - linkBounds.top;
    } else if (linkBounds.bottom > sidebarBounds.bottom) {
      sidebar.scrollTop += linkBounds.bottom - sidebarBounds.bottom;
    }
  }

  function restoreSidebarPosition() {
    var savedPosition = null;
    var restoredPosition = false;
    try {
      savedPosition = window.sessionStorage.getItem(storageKey);
      window.sessionStorage.removeItem(storageKey);
    } catch (_error) {
      // Storage may be disabled by the browser; the active link is still revealed.
    }

    if (savedPosition !== null && savedPosition.trim() !== '' && Number.isFinite(Number(savedPosition)) && Number(savedPosition) >= 0) {
      sidebar.scrollTop = Number(savedPosition);
      restoredPosition = true;
    }
    if (!restoredPosition) {
      revealActiveLink();
    }
  }

  window.addEventListener('pagehide', saveSidebarPosition);

  sidebar.addEventListener('click', function (event) {
    var target = event.target && event.target.nodeType === 1 ? event.target : event.target && event.target.parentElement;
    var link = target && target.closest('[data-admin-link]');
    if (!link || event.defaultPrevented || event.button !== 0 || event.metaKey || event.ctrlKey || event.shiftKey || event.altKey) return;
    if (link.target && link.target !== '_self') return;

    var destination;
    try {
      destination = new URL(link.href, window.location.href);
    } catch (_error) {
      return;
    }

    if (destination.origin !== window.location.origin || destination.pathname === window.location.pathname && destination.hash) return;

    saveSidebarPosition();
  });

  if (document.readyState === 'loading') {
    document.addEventListener('DOMContentLoaded', restoreSidebarPosition, { once: true });
  } else {
    restoreSidebarPosition();
  }
})();
