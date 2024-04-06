<?php 

namespace App\Core;

use Illuminate\Database\Capsule\Manager as Capsule;

class Database
{
    public function __construct(array $config)
    {
        $this->initEloquent($config);
    }

    private function initEloquent(array $config)
    {
        $capsule = new Capsule;

        // Ajouter les connexions définies dans le fichier de configuration
        foreach ($config['connections'] as $connectionName => $connectionConfig) {
            $capsule->addConnection($connectionConfig, $connectionName);
        }

        // Définir la connexion par défaut
        $capsule->setAsGlobal();

        // Démarrer Eloquent
        $capsule->bootEloquent();
    }
}