<!DOCTYPE html>
<html>
<head>
    <style>
        body { font-family: Arial, sans-serif; background-color: #f4f4f4; padding: 20px; }
        .container { max-width: 600px; margin: 0 auto; background: #ffffff; padding: 30px; border-radius: 8px; box-shadow: 0 2px 5px rgba(0,0,0,0.1); }
        .header { text-align: center; border-bottom: 2px solid #ff6600; padding-bottom: 20px; margin-bottom: 20px; }
        .footer { text-align: center; font-size: 12px; color: #888; margin-top: 30px; border-top: 1px solid #eee; padding-top: 20px; }
        .btn { background-color: #ff6600; color: white; padding: 10px 20px; text-decoration: none; border-radius: 5px; display: inline-block; margin-top: 20px; }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1 style="color: #333;">Bienvenue chez PLUSS CI !</h1>
        </div>
        
        <p>Bonjour <strong>{{ $subscriber->name }}</strong>,</p>
        
        <p>Merci de vous être inscrit à notre newsletter. C'est un plaisir de vous compter parmi nous.</p>
        
        <p>Vous recevrez désormais nos dernières actualités, rapports et informations sur l'initiative "Une Seule Santé" directement dans votre boîte mail.</p>
        
        <p style="text-align: center;">
            <a href="{{ route('home') }}" class="btn">Visiter notre site web</a>
        </p>
        
        <div class="footer">
            <p>PLUSS CI - Plateforme Une Seule Santé Côte d'Ivoire</p>
            <p>
                Vous ne souhaitez plus recevoir ces emails ? 
                <a href="{{ $unsubscribeUrl }}" style="color: #ff6600;">Se désinscrire</a>
            </p>
        </div>
    </div>
</body>
</html>