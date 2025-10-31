<?php
if (! defined('ABSPATH')) {
    exit;
}

if (! isset($form_id)) {
    return;
}

$form_id = absint($form_id);

if ($form_id <= 0) {
    return;
}
?>

<div id="ff-popup" class="fixed inset-0 z-50 hidden flex items-center justify-center bg-black/70 px-4 py-6 sm:py-10" role="dialog" aria-modal="true" aria-hidden="true">
  <div class="relative mx-auto w-full max-w-2xl overflow-hidden rounded-none border border-gray-200 bg-white shadow-2xl" data-popup-content>
    <button type="button" class="absolute right-5 top-5 inline-flex h-10 w-10 items-center justify-center text-2xl font-light text-gray-500 transition hover:text-gray-900 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-black" data-popup-close aria-label="<?php esc_attr_e('Close popup', 'webmakerr'); ?>">&times;</button>
    <div class="max-h-[85vh] overflow-y-auto px-6 py-10 text-left font-sans text-gray-900 sm:px-10">
      <div class="space-y-6">
        <?php echo do_shortcode('[fluentform id="' . esc_attr($form_id) . '"]'); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
      </div>
    </div>
  </div>
</div>

<script>
(function() {
  if (window.webmakerrFluentFormPopupInitialized) {
    return;
  }
  window.webmakerrFluentFormPopupInitialized = true;

  var setup = function() {
    var triggers = document.querySelectorAll('[data-popup-trigger]');
    if (!triggers.length) {
      return;
    }

    var popup = document.getElementById('ff-popup');
    if (!popup) {
      return;
    }

    var closeButtons = popup.querySelectorAll('[data-popup-close]');
    var lastTrigger = null;

    var focusFirstElement = function() {
      var focusable = popup.querySelector('input, select, textarea, button, [href], [tabindex]:not([tabindex="-1"])');
      if (focusable && typeof focusable.focus === 'function') {
        focusable.focus();
      }
    };

    var openPopup = function(event) {
      if (event) {
        event.preventDefault();
        lastTrigger = event.currentTarget;
      }

      popup.classList.remove('hidden');
      popup.setAttribute('aria-hidden', 'false');
      document.body.style.overflow = 'hidden';

      window.requestAnimationFrame(focusFirstElement);
    };

    var closePopup = function() {
      if (popup.classList.contains('hidden')) {
        return;
      }

      popup.classList.add('hidden');
      popup.setAttribute('aria-hidden', 'true');
      document.body.style.overflow = '';

      if (lastTrigger && typeof lastTrigger.focus === 'function') {
        lastTrigger.focus();
      }

      lastTrigger = null;
    };

    triggers.forEach(function(trigger) {
      trigger.addEventListener('click', openPopup);
    });

    closeButtons.forEach(function(button) {
      button.addEventListener('click', closePopup);
    });

    popup.addEventListener('click', function(event) {
      if (event.target === popup) {
        closePopup();
      }
    });

    document.addEventListener('keydown', function(event) {
      if (event.key === 'Escape') {
        closePopup();
      }
    });
  };

  if (document.readyState === 'loading') {
    document.addEventListener('DOMContentLoaded', setup);
  } else {
    setup();
  }
})();
</script>
