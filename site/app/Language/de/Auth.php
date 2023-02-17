<?php

return [

    // Exceptions
    'invalidModel'              => 'Das {0} Model muss geladen werden, bevor es genutzt werden kann.',
    'userNotFound'              => 'Der Benutzer mit der ID = {0, number} konnte nicht gefunden werden.',
    'noUserEntity'              => 'Für die Passwortüberprüfung muss das User Entity angegebenen werden.',
    'tooManyCredentials'        => 'Es kann nur 1 weiteres Benutzerfeld zusätzlich zu dem Passwort überprüft werden.',
    'invalidFields'             => 'Das Feld "{0}" kann nicht genutzt werden um Anmeldedaten zu überprüfen.',
    'unsetPasswordLength'       => 'Die Einstellung `minimumPasswordLength` muss in der Auth Config Datei gesetzt werden.',
    'unknownError'              => 'Es tut uns leid, aber es ist ein Fehler aufgetreten beim Zusenden der E-Mail. Bitte versuche es später noch einmal.',
    'notLoggedIn'               => 'Für den Zugriff auf diese Seite musst du eingeloggt sein.',
    'notEnoughPrivilege'        => 'Du hast keine ausreichende Berechtigung um diese Seite anzusehen.',

    // Registration
    'registerDisabled'          => 'Es tut uns leid, aber momentan können keine neuen Benutzerkonten angelegt werden.',
    'registerSuccess'           => 'Willkommen! Bitte logge dich mit deinen neuen Anmeldedaten ein.',
    'registerCLI'               => 'Neuer Benutzer angelegt: {0}, #{1}',

    // Activation
    'activationNoUser'          => 'Es konnte kein Benutzer für diesen Aktivierungs Code gefunden werden.',
    'activationSubject'         => 'Aktiviere dein Benutzerkonto.',
    'activationSuccess'         => 'Bitte aktiviere dein Benutzerkonto, indem du auf den Link klickst, den wir dir per E-Mail zugesendet haben.',
    'activationResend'          => 'Aktivierungs Code nochmals zusenden.',
    'notActivated'              => 'Dieses Benutzerkonto wurde noch nicht aktiviert.',
    'errorSendingActivation'    => 'Fehler beim Senden des Aktivierungs Codes an: {0}',

    // Login
    'badAttempt'                => 'Fehler beim anmelden, bitte prüfe deine Daten.',
    'invalidPassword'           => 'Fehler beim anmelden, bitte prüfe deine Daten.',

    // Forgotten Passwords
    'forgotDisabled'            => 'Das Zurücksetzen des Passworts ist deaktiviert.',
    'forgotNoUser'              => 'Es konnte kein Benutzer mit dieser E-Mail gefunden werden.',
    'forgotSubject'             => 'Anleitung zum Zurücksetzen des Passworts',
    'resetSuccess'              => 'Dein Passwort wurde erfolgreich geändert. Bitte loggedich mit deinem neuen Passwort ein.',
    'forgotEmailSent'           => 'Ein Code zum Zurücksetzen deines Passworts wurde dir per E-Mail zugesendet. Gib den Code in die Box unten ein um fortzufahren.',
    'errorEmailSent'            => 'Fehler beim Senden der Anleitung zum zurücksetzten des Passworts an: {0}',
    'errorResetting'            => 'Fehler beim Senden der Passwort Zurücksetz-Anleitung an: {0}',

    // Passwords
    'errorPasswordLength'       => 'Das Passwort muss mindestens {0, number} Zeichen lang sein.',
    'suggestPasswordLength'     => 'Passwörter mit bis zu 255 Zeichen sind sicherer und einfacher zu merken.',
    'errorPasswordCommon'       => 'Das Passwort darf kein gewöhnliches Passwort sein.',
    'suggestPasswordCommon'     => 'Das Passwort wurde mit 65.000 Passwörtern, die häufig genutzt werden und mit Passwörtern aus Passwortleaks abgeglichen',
    'errorPasswordPersonal'     => 'Das Passwort darf keine gehashten Benutzerdaten enthalten.',
    'suggestPasswordPersonal'   => 'Variationen deines Benutzernamens oder deiner E-Mail-Adresse sollten nicht als Passwort verwendet werden.',
    'errorPasswordTooSimilar'    => 'Das Passwort ähnelt dem Benutzernamen zu sehr.',
    'suggestPasswordTooSimilar'  => 'Nutze keine Teile deines Benutzernamens in deinem Passwort.',
    'errorPasswordPwned'        => 'Das Passwort {0} wurde durch einen Datenleak veröffentlicht und verbreitet. Es kommt {1, number} mal in {2} von gestohlenen Passwörtern vor.',
    'errorPasswordPwnedDatabase' => 'einer Datenbank',
    'errorPasswordPwnedDatabases' => 'Datenbanken',
    'suggestPasswordPwned'      => '{0} sollte niemals als Passwort verwendet werden. Wenn du es irgendwo als Passwort nutzt, solltest du es umgehen ändern!',
    'errorPasswordEmpty'        => 'Passwort erforderlich.',
    'passwordChangeSuccess'     => 'Passwort wurde erfolgreich geändert',
    'userDoesNotExist'          => 'Das Passwort wurde nicht geändert. Der Benutzer existiert nicht.',
    'resetTokenExpired'         => 'Es tut uns leid, aber der Code zum Zurücksetzen des Passworts ist abgelaufen',

    // Groups
    'groupNotFound'             => 'Die Gruppe: {0} konnte nicht gefunden werden.',

    // Permissions
    'permissionNotFound'        => 'Berechtigung konnte nicht gefunden werden: {0}',

    // Banned
    'userIsBanned'              => 'Der Benutzer wurde gebannt. Bitte kontaktiere einen Administrator.',

    // Too many requests
    'tooManyRequests'           => 'Zu viele Anfragen. Bitte warte {0, number} Sekunden.',

    // Login views
    'home'                      => 'Home',
    'current'                   => 'Momentan',
    'forgotPassword'            => 'Passwort vergessen?',
    'enterEmailForInstructions' => 'Gib deine E-Mail-Adresse ein und wir senden dir eine Anleitung um dein Passwort zurückzusetzen.',
    'email'                     => 'E-Mail',
    'emailAddress'              => 'E-Mail-Adresse',
    'sendInstructions'          => 'Anleitung senden',
    'loginTitle'                => 'Login',
    'loginAction'               => 'Login',
    'rememberMe'                => 'Eingeloggt bleiben',
    'needAnAccount'             => 'Benutzerkonto benötigt?',
    'forgotYourPassword'        => 'Passwort vergessen?',
    'password'                  => 'Passwort',
    'repeatPassword'            => 'Passwort wiederholen',
    'emailOrUsername'           => 'E-Mail-Adresse oder Benutzername',
    'username'                  => 'Benutzername',
    'register'                  => 'Registrieren',
    'signIn'                    => 'Einloggen',
    'alreadyRegistered'         => 'Bereits registriert?',
    'weNeverShare'              => 'Wir werden deine E-Mail-Adresse niemals mit Dritten teilen.',
    'resetYourPassword'         => 'Ihr Passwort zurücksetzen',
    'enterCodeEmailPassword'    => 'Gib den Code zum Zurücksetzten deines Passworts, den du per E-Mail erhalten hast, deine E-Mail-Adresse und dein neues Passwort ein.',
    'token'                     => 'Code',
    'newPassword'               => 'Neues Passwort',
    'newPasswordRepeat'         => 'Neues Passwort wiederholen',
    'resetPassword'             => 'Passwort zurücksetzen',

];
