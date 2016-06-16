# php-primary-generator

```
composer install
./vendor/bin/phpbench run PrimaryBench.php --report=default
```

```
PhpBench 0.11-dev (@git_sha@). Running benchmarks.
Using configuration file: /home/mprzybysz/work/GeneratorBenchmark/phpbench.json

\PrimaryBench

    benchPrimeNormal              I999 P0 	[μ Mo]/r: 365.044 360.656 (μs) 	[μSD μRSD]/r: 10.521μs 2.88%
    benchPrimeOldNormalWhile      I999 P0 	[μ Mo]/r: 77.344 76.093 (μs) 	[μSD μRSD]/r: 3.370μs 4.36%
    benchPrimeOldNormalFor        I999 P0 	[μ Mo]/r: 77.212 75.721 (μs) 	[μSD μRSD]/r: 3.068μs 3.97%
    benchPrimeOldNormalGoto       I999 P0 	[μ Mo]/r: 76.721 75.384 (μs) 	[μSD μRSD]/r: 3.232μs 4.21%
    benchPrimeGenerator           I999 P0 	[μ Mo]/r: 13.199 12.488 (μs) 	[μSD μRSD]/r: 1.559μs 11.81%
    benchPrimeGeneratorIf         I999 P0 	[μ Mo]/r: 409.301 404.286 (μs) 	[μSD μRSD]/r: 14.352μs 3.51%

6 subjects, 6,000 iterations, 1,200 revs, 0 rejects
(best [mean mode] worst) = 11.375 [169.803 167.438] 22.750 (μs)
⅀T: 1,018,820.180μs μSD/r 6.017μs μRSD/r: 5.124%
suite: 133a068e31a088ed17154e96051f76b14f9803eb, date: 2016-06-16, stime: 14:06:16
```
