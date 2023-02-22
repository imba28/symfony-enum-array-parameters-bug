# How to reproduce

1. Start application and go to `http:127.0.0.1:8888`

If the container behaved like expected, the application would not print the following warning
> Warning: Undefined array key "app.another_parameter"

## Quick fix
1. Replace `Symfony\Component\DependencyInjection\Dumper\PhpDumper::dumpParameter` with the following method:

```php
private function dumpParameter(string $name): string
{
    if ($this->container->hasParameter($name)) {
        $value = $this->container->getParameter($name);
        $dumpedValue = $this->dumpValue($value, false);

        if (!$value || !\is_array($value)) {
            return $dumpedValue;
        }

        $hasEnum = array_filter($value, fn ($v) => $v instanceof \UnitEnum) !== [];

        if (!$hasEnum && !preg_match("/\\\$this->(?:getEnv\('(?:[-.\w\\\\]*+:)*+\w++'\)|targetDir\.'')/", $dumpedValue)) {
            return sprintf('$this->parameters[%s]', $this->doExport($name));
        }
    }

    return sprintf('$this->getParameter(%s)', $this->doExport($name));
}
```
2. Clear Symfony's cache
3. Reload browser
4. You should now see the two dumped parameters.