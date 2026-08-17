<?php
declare(strict_types=1);

namespace Core;

// Container = "usine à objets". Quand on lui dit make(BookController::class),
// il regarde (via la réflexion PHP) de quoi le constructeur a besoin,
// et construit tout automatiquement — y compris les dépendances imbriquées

class Container
{
    private array $bindings = [];
    private array $instances = [];

    public function bind(string $abstract, callable $factory): void
    {
        $this->bindings[$abstract] = $factory;
    }

    public function make(string $class): object
    {
        if (isset($this->instances[$class])) {
            return $this->instances[$class];
        }
        if (isset($this->bindings[$class])) {
        // Si on a explicitement dit "pour cette interface, utilise cette factory"
            return $this->bindings[$class]($this);
        }
        return $this->resolve($class);  // sinon on construit via réflexion
    }

    private function resolve(string $class): object
    {
        $reflection = new \ReflectionClass($class);
        $constructor = $reflection->getConstructor();

        if ($constructor === null) {
            return $reflection->newInstance();
        }

        $dependencies = [];
        foreach ($constructor->getParameters() as $param) {
            $type = $param->getType();
            if ($type === null || $type->isBuiltin()) {
                throw new \RuntimeException("Paramètre non résoluble : {$param->getName()}");
            }
            $dependencies[] = $this->make($type->getName());
        }

        return $reflection->newInstanceArgs($dependencies);
    }
}
