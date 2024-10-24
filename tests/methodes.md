PHPUnit propose plusieurs méthodes d'assertion permettant de vérifier le comportement et le résultat des tests.
Voici quelques-unes des assertions couramment utilisées autres que `$this->assertEquals()` :
commande :
    execution des test: php bin/phpunit

1. **Assertions de valeur :**
   - `$this->assertSame($expected, $actual)`: Vérifie que `$expected` est strictement égal à `$actual` (type et valeur).
   - `$this->assertNotSame($expected, $actual)`: Vérifie que `$expected` n'est pas strictement égal à `$actual`.
   - `$this->assertNotEquals($expected, $actual)`: Vérifie que `$expected` n'est pas égal à `$actual`.
   - `$this->assertGreaterThan($expected, $actual)`: Vérifie que `$actual` est strictement supérieur à `$expected`.
   - `$this->assertGreaterThanOrEqual($expected, $actual)`: Vérifie que `$actual` est supérieur ou égal à `$expected`.
   - `$this->assertLessThan($expected, $actual)`: Vérifie que `$actual` est strictement inférieur à `$expected`.
   - `$this->assertLessThanOrEqual($expected, $actual)`: Vérifie que `$actual` est inférieur ou égal à `$expected`.

2. **Assertions de type :**
   - `$this->assertTrue($condition)`: Vérifie que `$condition` est vrai (`true`).
   - `$this->assertFalse($condition)`: Vérifie que `$condition` est faux (`false`).
   - `$this->assertNull($value)`: Vérifie que `$value` est `null`.
   - `$this->assertNotNull($value)`: Vérifie que `$value` n'est pas `null`.
   - `$this->assertIsArray($value)`: Vérifie que `$value` est un tableau (`array`).
   - `$this->assertIsString($value)`: Vérifie que `$value` est une chaîne de caractères (`string`).
   - `$this->assertIsInt($value)`: Vérifie que `$value` est un entier (`int`).
   - `$this->assertIsFloat($value)`: Vérifie que `$value` est un nombre à virgule flottante (`float`).
   - `$this->assertIsBool($value)`: Vérifie que `$value` est un booléen (`boolean`).
   - `$this->assertIsObject($value)`: Vérifie que `$value` est un objet (`object`).
   - `$this->assertIsCallable($value)`: Vérifie que `$value` est appelable (`callable`).

3. **Assertions sur les objets et les tableaux :**
   - `$this->assertCount($expectedCount, $arrayOrCountable)`: Vérifie que le nombre d'éléments dans `$arrayOrCountable` est égal à `$expectedCount`.
   - `$this->assertEmpty($value)`: Vérifie que `$value` est vide.
   - `$this->assertNotEmpty($value)`: Vérifie que `$value` n'est pas vide.
   - `$this->assertContains($needle, $haystack)`: Vérifie que `$haystack` contient `$needle`.
   - `$this->assertNotContains($needle, $haystack)`: Vérifie que `$haystack` ne contient pas `$needle`.
   - `$this->assertArrayHasKey($key, $array)`: Vérifie que `$array` contient la clé `$key`.
   - `$this->assertArrayNotHasKey($key, $array)`: Vérifie que `$array` ne contient pas la clé `$key`.

4. **Assertions sur les exceptions :**
   - `$this->expectException(Exception::class)`: Vérifie qu'une exception de type donné est levée.
   - `$this->expectExceptionMessage($message)`: Vérifie que l'exception levée contient le message donné.
   - `$this->expectExceptionCode($code)`: Vérifie que l'exception levée contient le code donné.

5. **Assertions de fichiers et de chaînes :**
   - `$this->assertFileExists($filename)`: Vérifie que le fichier `$filename` existe.
   - `$this->assertFileNotExists($filename)`: Vérifie que le fichier `$filename` n'existe pas.
   - `$this->assertStringContainsString($needle, $haystack)`: Vérifie que la chaîne `$haystack` contient la sous-chaîne `$needle`.
   - `$this->assertStringNotContainsString($needle, $haystack)`: Vérifie que la chaîne `$haystack` ne contient pas la sous-chaîne `$needle`.
   - `$this->assertStringStartsWith($prefix, $string)`: Vérifie que `$string` commence par `$prefix`.
   - `$this->assertStringEndsWith($suffix, $string)`: Vérifie que `$string` se termine par `$suffix`.

6. **Assertions sur des objets :**
   - `$this->assertInstanceOf($expected, $actual)`: Vérifie que `$actual` est une instance de la classe `$expected`.
   - `$this->assertNotInstanceOf($expected, $actual)`: Vérifie que `$actual` n'est pas une instance de la classe `$expected`.
   - `$this->assertObjectHasAttribute($attribute, $object)`: Vérifie que l'objet `$object` a l'attribut `$attribute`.
   - `$this->assertObjectNotHasAttribute($attribute, $object)`: Vérifie que l'objet `$object` n'a pas l'attribut `$attribute`.

Ces méthodes vous permettront de vérifier différents aspects de votre code lors de l'écriture de tests unitaires. Elles sont très utiles pour tester les résultats attendus, les erreurs potentielles, ou vérifier la conformité des types et structures de données.
