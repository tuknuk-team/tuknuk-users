@extends('emails.layouts.default')
@section('content')

<div class="miro-title-block" style="background-position:center;background-repeat:no-repeat;background-size:100% auto;font-family:Helvetica,Arial,sans-serif;padding:40px 40px 36px">
    <div class="miro-title-block__title font-size-42" style="color:#23262F;font-family:Helvetica,Arial,sans-serif;font-size:42px!important;font-stretch:normal;font-style:normal;font-weight:700;letter-spacing:normal;line-height:1.24">Recuperação de Senha</div>
    <div class="miro-title-block__subtitle font-size-20 m-top-16" style="color:#23262F;font-family:Helvetica,Arial,sans-serif;font-size:20px!important;font-stretch:normal;font-style:normal;font-weight:400;letter-spacing:normal;line-height:1.4;margin-top:16px;opacity:.6">Para continuar com a recuperação de senha de acesso, por favor, digite o código abaixo:</div>
  </div>
  <div class="miro-confirmation-code-block" style="font-family:Helvetica,Arial,sans-serif;padding:0 40px">
    <div class="miro-confirmation-code-block__code" style="background-color:#f3f4f8;border-radius:4px;color:#23262F;font-family:Helvetica,Arial,sans-serif;font-size:48px;font-stretch:normal;font-style:normal;font-weight:700;height:128px;letter-spacing:normal;line-height:128px;text-align:center">{{$token}}</div>
  </div>
  <div class="miro-title-block" style="background-position:center;background-repeat:no-repeat;background-size:100% auto;font-family:Helvetica,Arial,sans-serif;padding:10px 0 23px 40px">
    <div class="miro-title-block__title font-size-42" style="color:#23262F;font-family:Helvetica,Arial,sans-serif;font-size:42px!important;font-stretch:normal;font-style:normal;font-weight:700;letter-spacing:normal;line-height:1.24"></div>
    <div class="miro-title-block__subtitle font-size-20 m-top-16" style="color:#23262F;font-family:Helvetica,Arial,sans-serif;font-size:20px!important;font-stretch:normal;font-style:normal;font-weight:400;letter-spacing:normal;line-height:1.4;margin-top:16px;opacity:.6">Se você não solicitou a recuperação de senha, entre em contato com a nossa equipe de suporte.</div>
  </div>

@endsection


