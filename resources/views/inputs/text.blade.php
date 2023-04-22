<div class="mb-3">
  <label for="{{ $id }}" class="form-label">{{ $label }}</label>
  <input type="text" class="form-control" name={{ $name }} id="{{ $id }}" placeholder="{{ $placeholder }}" />
  @if($hint)<div class="form-text">{{ $hint }}</div>@endif
</div>
