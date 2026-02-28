<x-mail::message>
# Nouveau message depuis la plateforme PLUSS.CI

Vous avez reçu une nouvelle demande de contact via le site web.

**Informations de l'expéditeur :**
- **Nom :** {{ $contactData['name'] }}
- **E-mail :** {{ $contactData['email'] }}
- **Sujet :** {{ $contactData['subject'] }}

<x-mail::panel>
**Message :** {{ $contactData['message'] }}
</x-mail::panel>

<x-mail::button :url="url('/admin/contact-messages')">
Voir dans l'administration
</x-mail::button>

Cordialement,<br>
Le système automatique de {{ config('app.name') }}
</x-mail::message>