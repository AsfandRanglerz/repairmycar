<div class="form-check form-switch toggler_switch lang_toggler mt-1 mt-lg-3">
    <label class="form-check-label arabi" for="flexSwitchCheckDefault">Arabic</label>
    @if ($current_locale == 'en')
        <input class="form-check-input"checked type="checkbox" id="flexSwitchCheckDefault">
    @else
        <input class="form-check-input"  type="checkbox" id="flexSwitchCheckDefault">
    @endif
    <label class="form-check-label english" for="flexSwitchCheckDefault">English</label>
</div>

