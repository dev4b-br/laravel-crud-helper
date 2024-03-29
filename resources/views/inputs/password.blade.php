<div class="mb-3 {{ implode(' ', $containerClasses) }}" id="{{$id}}-container">
    <label for="{{ $id }}" class="form-label">{{ $label }}@if($required)
            <span class="text-danger">*</span>
        @endif</label>
    <div class="input-group input-group-merge">
        <input type="password" class="form-control
           @if($errors->get($name)) is-invalid @endif {{ implode(' ', $inputClasses) }}" name="{{ $name }}"
               id="{{ $id }}" placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;" value="{{ $value }}"/>
        @if($visibilityEye)
            <span class="input-group-text cursor-pointer" id="password-eye"><i
                    class="mdi mdi-eye-off-outline"></i></span>
        @endif
    </div>

    @if($hint)
        <div class="form-text">{{ $hint }}</div>
    @endif
    @if($showInputErrorMessages)
        @if($errors->get($name))
            @foreach($errors->get($name) as $error)
                <div class="invalid-feedback">
                    {{$error}}
                </div>
            @endforeach
        @endif
    @endif
</div>

@section('laravel-crud-helper-scripts')
    @parent
    <script>
        @if($visibilityEye)
            $("#password-eye").click(function () {
                if ($(this).find('i').attr('class') == 'mdi mdi-eye-off-outline') {
                    $(this).find('i').removeClass('mdi-eye-off-outline');
                    $(this).find('i').addClass('mdi-eye-outline');
                    $(this).parent().find('input')[0].type = 'text';
                } else {
                    $(this).find('i').removeClass('mdi-eye-outline');
                    $(this).find('i').addClass('mdi-eye-off-outline');
                    $(this).parent().find('input')[0].type = 'password';
                }
            });
        @endif
    </script>
@endsection
