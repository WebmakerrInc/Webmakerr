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

<div id="ff-popup" class="fixed inset-0 z-50 hidden items-center justify-center bg-black/70 px-4 py-6" role="dialog" aria-modal="true" aria-hidden="true">
  <div class="relative mx-auto w-full max-w-xl rounded-none border border-zinc-200 bg-white p-6 font-sans shadow-lg sm:max-w-lg" data-popup-content>
    <button type="button" class="absolute right-4 top-4 text-2xl font-light text-zinc-500 transition hover:text-zinc-900 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-dark" data-popup-close aria-label="<?php esc_attr_e('Close popup', 'webmakerr'); ?>">&times;</button>
    <div class="space-y-6 text-left text-zinc-900">
      <?php echo do_shortcode('[fluentform id="' . esc_attr($form_id) . '"]'); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
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
