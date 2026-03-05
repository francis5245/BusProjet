<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Réinitialiser votre mot de passe</title>
</head>
<body style="margin: 0; padding: 0; font-family: 'Poppins', Arial, sans-serif; background-color: #f8f9fa; color: #333;">
  <table width="100%" cellpadding="0" cellspacing="0" style="background-color: #f8f9fa; padding: 20px 0;">
    <tr>
      <td align="center">
        <!-- Main Container -->
        <table width="100%" max-width="600" cellpadding="0" cellspacing="0" style="max-width: 600px; background: #ffffff; border-radius: 10px; overflow: hidden; box-shadow: 0 4px 12px rgba(0,0,0,0.08);">
          <!-- Logo Header -->
          <tr>
            <td style="background-color: #079d49; padding: 20px; text-align: center;">
              <img src="https://bus365demo.bdtask-demo.com/backend/public/image/websetting/1731406829_31638cc6f9bfc860c68e.png" alt="BUS365" style="height: 40px;">
            </td>
          </tr>

          <!-- Content -->
          <tr>
            <td style="padding: 30px; text-align: center;">
              <h2 style="font-weight: bold; margin: 0 0 20px; color: #333;">Bonjour {{ $user->name }},</h2>

              <p style="line-height: 1.6; color: #666; margin: 0 0 20px;">
                Vous avez demandé la réinitialisation de votre mot de passe.
              </p>

              <p style="line-height: 1.6; color: #666; margin: 0 0 25px;">
                Cliquez sur le bouton ci-dessous pour continuer.<br>
                <strong>⚠️ Ce lien expire dans 60 minutes.</strong>
              </p>

              <!-- Button -->
              <table cellpadding="0" cellspacing="0" style="margin: 25px auto;">
                <tr>
                  <td align="center" style="background-color: #079d49; border-radius: 6px;">
                    <a href="{{ $url }}" target="_blank" style="display: inline-block; color: #ffffff; text-decoration: none; padding: 12px 30px; font-weight: bold; font-size: 16px; border-radius: 6px;">
                      Réinitialiser mon mot de passe
                    </a>
                  </td>
                </tr>
              </table>

              <!-- Fallback Link -->
              <p style="font-size: 13px; color: #999; margin-top: 20px;">
                Si le bouton ne fonctionne pas, copiez ce lien dans votre navigateur :<br>
                <a href="{{ $url }}" target="_blank" style="color: #079d49; word-break: break-all;">"{{ $url }}"</a>
              </p>

              <!-- Footer Note -->
              <p style="font-size: 12px; color: #aaa; margin-top: 30px;">
                Si vous n’êtes pas à l’origine de cette demande, ignorez ce message.
              </p>
            </td>
          </tr>
        </table>
      </td>
    </tr>
  </table>
</body>
</html>
