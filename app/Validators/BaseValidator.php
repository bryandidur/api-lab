<?php

namespace App\Validators;

use Exception;
use Illuminate\Contracts\Validation\{
    Factory,
    Validator
};

abstract class BaseValidator
{
    /**
     * The current scope name.
     *
     * @var string
     */
    protected $currentScope;

    /**
     * The validation scopes.
     *
     * @var array
     */
    protected $scopes = [
        'store',
        'update',
    ];

    /**
     * The additional parameters
     *
     * @var array
     */
    protected $params = [];

    /**
     * Create a new validator instance.
     *
     * @param  \Illuminate\Contracts\Validation\Factory $factory
     * @return void
     */
    public function __construct(Factory $factory)
    {
        $this->factory = $factory;
    }

    /**
     * Validate data.
     *
     * @param  array  $data
     * @param  array  $params
     * @return void
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function validate(array $data, ...$params): void
    {
        $this->setParams($params);

        $this->validator($data)->validate();
    }

    /**
     * Get the validator instance.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    public function validator(array $data): Validator
    {
        return $this->factory->make($data, $this->rules($data));
    }

    /**
     * Get the scope rules.
     *
     * @param  array  $data
     * @return array
     *
     * @throws \Exception
     */
    public function rules(array $data): array
    {
        $methodName = "{$this->currentScope}Rules";

        if (method_exists($this, $methodName)) {
            return $this->{$methodName}($data);
        }

        throw new Exception("Unable to get rules for scope [{$this->currentScope}]", 1);
    }

    /**
     * Set the current scope.
     *
     * @param  string $name
     * @return $this
     *
     * @throws \Exception
     */
    public function setScope(string $name): namespace\BaseValidator
    {
        if ($this->hasScope($name)) {
            $this->currentScope = $name;

            return $this;
        }

        throw new Exception("Invalid validation scope [{$name}]", 1);
    }

    /**
     * Set the additional params.
     *
     * @param  array $params
     * @return $this
     */
    public function setParams(array $params): namespace\BaseValidator
    {
        $this->params = array_collapse($params);

        return $this;
    }

    /**
     * Check if the validator has a given scope name.
     *
     * @param  string  $name
     * @return bool
     */
    public function hasScope(string $name): bool
    {
        return in_array($name, $this->scopes);
    }

    /**
     * Handle calls to the undefined methods.
     *
     * @param  string $methodName
     * @param  array  $arguments
     * @return void
     *
     * @throws \Exception
     */
    public function __call(string $methodName, array $arguments): void
    {
        // If the called method name is same as a scope name, then we
        // handle it as a dinamic scope validation call.
        if ($this->hasScope($methodName)) {
            $this->setScope($methodName)->validate(...$arguments);
            return;
        }

        throw new Exception("Call to undefined method " . static::class . "::{$methodName}", 1);
    }
}
