<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Vérifiez votre e-mail - BUS365</title>
</head>
<body style="margin: 0; padding: 0; background-color: #f8f9fa; font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; color: #333;">
  <!-- Wrapper -->
  <table width="100%" cellpadding="0" cellspacing="0" style="background-color: #f8f9fa; padding: 20px 0;">
    <tr>
      <td align="center">
        <!-- Main Container -->
        <table width="100%" max-width="600" cellpadding="0" cellspacing="0" style="max-width: 600px; background: #ffffff; border-radius: 10px; overflow: hidden; box-shadow: 0 4px 12px rgba(0,0,0,0.08);">
          <!-- Logo Header -->
          <tr>
            <td style="background-color: #079d49; padding: 20px; text-align: center;">
              <img src="https://bus365demo.bdtask-demo.com/backend/public/image/websetting/1731406829_31638cc6f9bfc860c68e.png" alt="BUS365" style="height: 40px;" />
            </td>
          </tr>

          <!-- Content -->
          <tr>
            <td style="padding: 30px; text-align: center;">
              <h2 style="font-size: 24px; font-weight: bold; margin: 0 0 15px;">Bonjour {{ $user->name }},</h2>
              <p style="font-size: 16px; line-height: 1.6; color: #555; margin: 0 0 25px;">
                Merci de vous être inscrit ! Pour activer votre compte et commencer à réserver vos billets de bus, veuillez confirmer votre adresse e-mail en cliquant sur le bouton ci-dessous.
              </p>

              <!-- Button -->
              <table cellpadding="0" cellspacing="0" style="margin: 25px auto;">
                <tr>
                  <td align="center" style="background-color: #079d49; border-radius: 6px;">
                    <a href="{{ $url }}" target="_blank" style="display: inline-block; color: #ffffff; font-weight: bold; text-decoration: none; padding: 12px 30px; font-size: 16px; border-radius: 6px;">
                      Vérifier mon email
                    </a>
                  </td>
                </tr>
              </table>

              <p style="font-size: 14px; color: #777; margin: 25px 0 0;">
                Si vous n’avez pas créé de compte sur <strong>BUS365</strong>, veuillez ignorer cet e-mail.
              </p>
            </td>
          </tr>

          <!-- Footer -->
          <tr>
            <td style="padding: 20px; text-align: center; font-size: 12px; color: #999; border-top: 1px solid #eee;">
              © 2026 BUS365. Tous droits réservés.<br />
              <a href="https://bus365demo.bdtask-demo.com" style="color: #079d49; text-decoration: none;">Visitez notre site</a>
            </td>
          </tr>
        </table>
      </td>
    </tr>
  </table>
</body>
</html>
