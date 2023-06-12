<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>

    <style>
        .detailTicket {
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: flex-start;
            gap: 0.5rem;
        }
        .textInfo {
            color: #9CA3AF;
            font-size: 0.75rem;
            line-height: 1rem;
            margin-top: 20px;
            padding-top: 100px;

        }

        main {
            padding: 1.25rem;
            background-color: #ffffff;
            border-radius: 0.75rem;
            margin-bottom: 100px
        }
    </style>
</head>
<body>

<main>
    <table cellpadding="0" cellspacing="0" class="es-content esd-header-popover" align="center">
        <tbody>
        <tr>
            <td class="esd-stripe" align="center">
                <table bgcolor="rgba(0, 0, 0, 0)" class="es-content-body" align="center" cellpadding="0" cellspacing="0" width="600" style="background-color: transparent;">
                    <tbody>
                    <tr>
                        <p>Prezado(a) {{ $data['user']['name'] }},</p>
                    </tr>
                    <tr><span><b>Detalhes da compra:</b></span></tr>
                    <tr><span><b>Evento:</b> {{ $data['event']['name'] }}</span></tr>
                    <tr><span><b>Data:</b> {{ formart_date($data['event_date']) }}</span></tr>
                    <tr><span><b>Horário:</b> {{ $data['hour'] }}:00</span></tr>

                    <tr>
                        <p>
                            Agradecemos por adquirir os ingressos para o tão aguardado Evento de Arte!
                            É com grande prazer que informamos que sua compra foi concluída com sucesso.
                            Agora, você está pronto para vivenciar uma experiência artística incrível!
                        </p>
                    </tr>
                    <tr>
                        <div style="display: flex; flex-direction: column;">
                            <a>Atenciosamente,</a>
                            <a>João Vitor</a>
                        </div>
                    </tr>
                    <tr>
                        <span class="textInfo">
                            Os ingressos foram enviados para o endereço de e-mail registrado em sua conta, juntamente com este e-mail. Certifique-se de verificar sua caixa de entrada e também a pasta de spam, caso necessário. Os ingressos estarão em formato PDF, prontos para impressão.
                            Ao comparecer ao evento, lembre-se de levar seus ingressos impressos ou apresentar o código de barras diretamente em seu smartphone. Pedimos que chegue com antecedência para evitar qualquer inconveniente.
                            Se tiver alguma dúvida ou precisar de assistência adicional, nossa equipe de atendimento ao cliente estará pronta para ajudá-lo. Não hesite em nos contatar através do número [Número de telefone] ou do e-mail [Endereço de e-mail de suporte].
                            Agradecemos novamente por sua compra e esperamos que aproveite o Evento de Arte ao máximo. Prepare-se para se encantar com as diversas formas de expressão artística que serão apresentadas!
                        </span>
                    </tr>
                    </tbody>
                </table>
            </td>
        </tr>
        </tbody>
    </table>
</main>


</body>
</html>
