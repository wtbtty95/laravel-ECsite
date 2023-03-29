@component('mail::message')
{{-- Greeting --}}
@if (!empty($greeting))
# {{ $greeting }}
@else
@if ($level == 'error')
# Whoops!
@else
# メールアドレス変更のお知らせ
@endif
@endif

{{-- Intro Lines --}}
@foreach ($introLines as $line)
{{ $line }}

@endforeach

{{-- Action Button --}}
@isset($actionText)
<?php
switch ($level) {
	case 'success':
		$color = 'green';
		break;
	case 'error':
		$color = 'red';
		break;
	default:
		$color = 'blue';
		break;
}
?>
@component('mail::button', ['url' => $actionUrl, 'color' => $color])
{{ $actionText }}
@endcomponent
@endisset

{{-- Outro Lines --}}
@foreach ($outroLines as $line)
{{ $line }}

@endforeach

{{-- Salutation --}}
@if (!empty($salutation))
{{ $salutation }}
@else
よろしくお願いします。<br>{{ config('app.name') }}
@endif

{{-- Subcopy --}}
@isset($actionText)
@component('mail::subcopy')
上記 "{{ $actionText }}"ボタンを押してもリンクに飛ばない場合、
こちらのURLをコピー&ペーストしてお使いのwebブラウザ上からアクセスしてください: [{{ $actionUrl }}]({!! $actionUrl !!})
@endcomponent
@endisset
@endcomponent
